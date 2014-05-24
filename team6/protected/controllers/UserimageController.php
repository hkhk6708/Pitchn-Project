<?php

class UserimageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUpdate()
	{
            
          
            
            $userEmail = Yii::app()->user->email;
            Yii::app()->user->setState('contentTitle', 'Change Picture');
            $userImage = new userimage('search');
            $userImage->email = $userEmail;
            $dataProvider = $userImage->search();
            $userImage2 = Userimage::model()->findByAttributes(array('email'=>$userEmail, 'current'=>1));
            $model= Userimage::model()->findAllByAttributes(array('email'=>$userEmail));
		
            
            
            $this->render('update', array('dataProvider'=>$dataProvider, 'userImage'=>$userImage2, 'model'=>$model));
	}

	public function actionUpload($id='')
	{
            Yii::app()->user->setState('contentTitle', 'Upload New Picture');
            $model = new UserImageFM;
            
            if (isset($_POST['UserImageFM'])) {
              $uploadedFile = CUploadedFile::getInstance($model, 'filename');
              $model->filename = $uploadedFile->name;
              $model->tempFilename = $uploadedFile->tempName;
                 if ((strpos(PHP_OS, "WIN") !== false) || (strpos(PHP_OS, "win") !== false)) 
                { 
                    $slash = "\\";
                } else {
                    $slash = "/";
                }
 
                $dirPath = Yii::getPathOfAlias('webroot').'/userImages/' . Yii::app()->user->getState('email') . "/";
                
                if (!file_exists($dirPath)) {
                     mkdir($dirPath, 0777, true);
                    }
                    
                $path = $dirPath . $model->filename;
                    
              $uploadedFile->saveAs($path);
          
                if ($id != '') {
              //change current of old pic to 0
              $userImageOld = UserImage::model()->findByPk($id);
              $userImageOld->current=0;
              $userImageOld->save();
             
                }
            
                
                //check if a userimage instance already exists for this filename
                $userImageCheck = Userimage::model()->findByAttributes(array('email'=>Yii::app()->user->getState('email'), 'filename'=>$model->filename));
                if ($userImageCheck == NULL) {
                     $this->createNewUserimageEntry($model, $path);
                }
             
              

              $this->redirect(Yii::app()->createUrl('userAccount/index'));
           // $this->redirect(Yii::app()->createUrl('userimage/update'));
            
        }
            
            $this->render('upload', array('model'=>$model));
	}
        
        public function createNewUserimageEntry($formModel, $path) {
            $model = new userimage();
            $model->email = Yii::app()->user->email;
            $model->current = 1;
            $model->date = date('Y-m-d');
            $model->filename = $formModel->filename;
            $model->path = $path;
            $model->save();
            
            // do more
        }
        
        public function actionDelete($id) {
            $model = Userimage::model()->findByPk($id);
            if (unlink($model->path)) {
                $model->delete();
            }
        }
        
        public function actionSelect($id) {
            $model = Userimage::model()->findByPk($id);
            $oldModel = Userimage::model()->findByAttributes(array('email'=>Yii::app()->user->email, 'current'=>1));
            if ($oldModel != NULL) {
            $oldModel->current = 0;
            $oldModel->save();
            }
            $model->current = 1;
            $model->save();
            $this->redirect(Yii::app()->createUrl('userAccount/index'));
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