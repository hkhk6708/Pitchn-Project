<?php

class DataImportController extends Controller {

    public $newInserts = 0;
    public $addedToOrgInserts = 0;
    public $alreadyInOrgInserts = 0;
    public $failedToAdd = 0;
    public $failedToAddArray = array('');
    
    public $EMAIL_ENABLED = false;
    
    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Import Data");
        $model = new CSVFileUpload;
        
        if (isset($_POST['CSVFileUpload'])) {
            $uploadedFile = CUploadedFile::getInstance($model, 'filename');
            $model->filename = $uploadedFile->name;
            $model->tempFilename = $uploadedFile->tempName;
            if ((strpos(PHP_OS, "WIN") !== false) || (strpos(PHP_OS, "win") !== false)) 
                { 
                    $slash = "\\";
                } else {
                    $slash = "/";
                }
            $path= Yii::app()->getBasePath() . $slash . "userUploadedFiles" . $slash . $model->filename; 
            $uploadedFile->saveAs($path);
            
            $fileModel = $this->createNewDataFileEntry($model, $path);

            $this->redirect(Yii::app()->createUrl('dataImport/map', array('id'=>$fileModel->id)));
        }
        
        $this->render('index', array('model'=>$model));
    }
      
      public function actionMap($id) {
         $dataModel = Datafile::model()->findByPK($id);

         $model2 = new DataMapping;

         $model2->fileHeadersArray = $this->parseCSVFileHeaders($dataModel->path);
         $model2->fileHeadersArrayCount = count($model2->fileHeadersArray);
         $model2->path = $dataModel->path;
         
         $model2->setPresets();
         
         if (isset($_POST['DataMapping'])) {
             $model2->attributes = $_POST['DataMapping'];
             
             $this->processMapInput($model2);
             $totalUsers = $this->addedToOrgInserts + $this->alreadyInOrgInserts + $this->newInserts + $this->failedToAdd;
             $user = Yii::app()->getComponent('user');
             
             if ($this->newInserts == 0 && $this->addedToOrgInserts == 0 && $this->alreadyInOrgInserts != 0 && $totalUsers != 0) {
                 $user->setFlash(
                'warning',
                "<strong>Warning:</strong> The $this->alreadyInOrgInserts users you are attempting to add are already in the system, and are already associated with your organization. No users were added."
);
             } else if ($totalUsers == 0) {
                  $user->setFlash(
                'warning',
                "<strong>Warning:</strong> Your dataset did not contain any rows of user data." 
                          );
                 
             } else {
                 $failedToAddString = $this->arrayToString($this->failedToAddArray);
                 $user->setFlash(
                'success',
                "<strong>Success!</strong> <br>"
                         . "Total Users in Your Dataset: $totalUsers<br>"
                         . "New Users Added: $this->newInserts<br>"
                         . "Existing Users Now Assocaited With Your Organization: $this->addedToOrgInserts<br>"
                         . "Existing Users Which Were Already Associated With Your Organization: $this->alreadyInOrgInserts<br>"
                         . "The following $this->failedToAdd users could not be added due to errors in their email address: $failedToAddString<br>"
                        
);
             }
             $this->redirect(Yii::app()->createUrl('organizer/index'));
         }
         
         $this->render('map', array('model2'=>$model2));
      }


    public function parseCSVFileHeaders($file) {
        $handle = fopen($file, "r");

        $tempArray = fgetcsv($handle, 1000, ",");
        fclose($handle);
        array_unshift($tempArray, "");

        return $tempArray;
    }
    
    public function arrayToString($array) {
        $count = count($array);
        $string = $array[0];
        if ($count == 1) {
            
            return $string;
        } else {
        for ($i=1; $i<$count; $i++) {
            $string = $string . ", " . $array[$i];
         }
         return $string;
        }
    }
    
    public function createNewDataFileEntry($model, $path) {
            $fileModel = new Datafile;
            $fileModel->path = $path;
            $fileModel->filename = $model->filename;
            $fileModel->addedBy = Yii::app()->user->name;
            $fileModel->orgId = $this->determineCurrentOrgId();
            $fileModel->date = date('Y-m-d H:i:s');
            $fileModel->save();
        return $fileModel;
    }

    public function processMapInput($model) {
        //change to input only 1 model

        $model->decrementAll();

        $handle = fopen($model->path, "r");

//remove the first line of the csv file and do nothing with it
        $headers = fgetcsv($handle, 1000, ",");

        $currentOrgId = $this->determineCurrentOrgId();

        while (($fileop = fgetcsv($handle, 1000, ",")) != false) {
            if ($this->isPersonAlreadyInDB($fileop[$model->email])) {
                if ($this->doesPersonAlreadyWorkForOrg($fileop[$model->email], $currentOrgId)) {
                    $this->alreadyInOrgInserts++;
                } else {
                    $this->addPersonToWorksFor($fileop[$model->email], $currentOrgId);
                    if ($this->EMAIL_ENABLED) {
                    $person = Person::model()->findByAttributes(array('email'=>$fileop[$model->email]));
                    $person->sendEmail($fileop[$model->name],$fileop[$model->email],$person->password, $this->getOrgName($currentOrgId), "existing");
                    }
                    $this->addedToOrgInserts++;
                }
                
            } else {
                $this->createNewPersonRow($model, $fileop, $currentOrgId);
            }
            
        }

        fclose($handle);
    }
    
    public function isPersonAlreadyInDB($email) {
        $person = Person::model()->findByAttributes(array('email'=>$email));
        if ($person == NULL) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function doesPersonAlreadyWorkForOrg($email, $currentOrgId) {
        $worksFor = WorksFor::model()->findByAttributes(array('email'=>$email, 'organizationId' =>$currentOrgId));
        if ($worksFor == NULL) {
            return false;
        } else {
            return true;
        }
    }

    public function determineCurrentOrgId() {
        $currentUserEmail = Yii::app()->user->getId();

        $model1 = new WorksFor($scenario = 'searchByEmail');
        $model1->unsetAttributes();
        $model1->email = $currentUserEmail;

        $worksForDataProvider = $model1->searchByEmail();

        $worksForRowArray = $worksForDataProvider->getData();

//Assume that organizers work for only 1 organization.
        return $worksForRowArray[0]["organizationId"];
    }

    public function getOrgName($currentOrgId){
        $var = Organization::model()->findByPK($currentOrgId);
        return $var->organizationName;
    }
    public function createNewPersonRow($model2, $fileop, $currentOrgId) {
//$fileop is an array of values taken from a single row of the csv table
// the attributes of $model represent the index of the attribute's label to the position in $fileop
// ex. $person->email = $fileop[$model->email];
// The model has the following attributes:
//                email;
//                name;
//                phone;
//                workPhone; 
//                birthdate; 
//                locationCity; 
//                locationProvince; 
//                locationCountry; 
//                language; 
//                description; 
        $tmppass = $this->ranPassword();
        $person = new Person();
//required attributes that must also be mapped:
        $person->email = $fileop[$model2->email];
        $person->name = $fileop[$model2->name];

//required attributes that will not be mapped:
        $person->causeId = $this->createNewCauseRow();
        $person->skillId = $this->createNewSkillRow();
        $person->userType = 'volunteer';
        $person->password = $tmppass;
        $person->registered = 'N';
        $person->lastActive = date('Y-m-d H:i:s');
        $person->active = 'N';
        $person->status = "active";
        
        if ($this->EMAIL_ENABLED) {
            $person->sendEmail($fileop[$model2->name],$fileop[$model2->email],$tmppass, $this->getOrgName($currentOrgId));
        }
//additional attributes which may or may not be mapped:
        if ($model2->phone != NULL) {
            $person->phone = $fileop[$model2->phone];
        }
        if ($model2->workPhone != NULL) {
            $person->workPhone = $fileop[$model2->workPhone];
        }

        if ($model2->birthdate != NULL) {
            $person->birthdate = $fileop[$model2->birthdate];
        }

        if ($model2->locationCity != NULL) {
            $person->locationCity = $fileop[$model2->locationCity];
        }
        if ($model2->locationProvince != NULL) {
            $person->locationProvince = $fileop[$model2->locationProvince];
        }

        if ($model2->locationCountry != NULL) {
            $person->locationCountry = $fileop[$model2->locationCountry];
        }

        if ($model2->language != NULL) {
            $person->language = $fileop[$model2->language];
        }

        if ($model2->description != NULL) {
            $person->description = $fileop[$model2->description];
        }
        if ($person->validate()) {
                    $person->save();
                    $this->addPersonToWorksFor($person->email, $currentOrgId);
                    $this->newInserts++;
        } else {
            array_push($this->failedToAddArray, $fileop[$model2->name]);
            $this->failedToAdd++;
        }


//return $person->getErrors();
    }

    public function ranPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function addPersonToWorksFor($email, $currentOrgId) {
        $worksFor = new WorksFor();
        $worksFor->email = $email;
        $worksFor->organizationId = $currentOrgId;
        $worksFor->save();
    }

    public function createNewSkillRow() {
        $skill = new Skill();
        $skill->save();
        return $skill->id;
    }

    public function createNewCauseRow() {
        $cause = new Cause();
        $cause->save();
        return $cause->id;
    }

// Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
