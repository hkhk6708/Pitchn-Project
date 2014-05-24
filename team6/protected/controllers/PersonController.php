<?php

class PersonController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    public $EMAIL_ENABLED = false;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            /*
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
             */
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $skill = Skill::model()->find('id=:id', array(':id' => $model->skillId));
        $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
        
        Yii::app()->user->setState('contentTitle', $model->name);
        
        $volunteerNote = new VolunteerNote('search');
        $volunteerNote->volunteerEmail = $model->email;
        $worksFor = WorksFor::model()->findByAttributes(array('email'=>Yii::app()->user->email));
        $volunteerNote->organizationId = $worksFor->organizationId;
        $userImage = Userimage::model()->findByAttributes(array('email'=>$model->email, 'current'=>1));
        
        $dataProvider = $volunteerNote->search();
        //get all the volunteerNote rows which equal the user's email and currentOrgId as a data provider
        //send dataprovider to view
        //on view, use a gridview to display volunteer notes
        
        //add functionality to view so that organizers can make new notes
        
        
        $this->render('view', array(
            'model' => $model,
            'skill' => $skill,
            'cause' => $cause,
            'dataProvider'=>$dataProvider,
            'userImage'=>$userImage,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        date_default_timezone_set('UTC');
        $model = new Person;
        $skill = new Skill;
        $cause = new cause;
        $worksFor = new WorksFor;
        Yii::app()->user->setState('contentTitle', "Create Account");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $allOrgDataProvider = new CActiveDataProvider('Organization');
        
        if (isset($_POST['Person'])) {
            $model->attributes = $_POST['Person'];
            $model->password = "password";
            $model->registered = "Y";
            $model->lastActive = date('Y-m-d');
            $model->active = "Y";
            $model->status = "active";
            $skill->setSkillString($_POST['skills'], 0);
            $cause->setCauseString($_POST['causes'], 0);
            $model->skillId = $skill->id;
            $model->causeId = $cause->id;
            
            if (Yii::app()->user->getState("type") == 'administrator') {
                if (isset($_POST['WorksFor'])) {
                    $worksFor->attributes = $_POST['WorksFor'];
                    $worksFor->email = $model->email;
                }
            } else {
                $model->userType = 'organizer';
                $worksFor->email = $model->email;
                $userOrg = WorksFor::model()->find('email=:email', array(':email' => Yii::app()->user->email));
                $worksFor->organizationId = $userOrg->organizationId;
            }
            
            /*$model->password = crypt($model->password, 'urzyVJvpD7wPbxMFKKGRKgLkukeWBexM3w0XZeleI7SmQCF49efcn4F64fTT
                                                        Ai2K3JZokr6VnJTWaHCLTkQSLo2WxElOKYdehQDpC1aA5BK8ZwHZrfj0Ah2O
                                                        qq52UpdH173TqniWtBqycVBuEHXa7oyBJCgFX7qA0bfVDIiu25UHH3QKk39n   
                                                        FSOuTTgJIUdMnVxZiSSk');*/
            if ($model->save()) {
                $worksFor->save();
                if ($this->EMAIL_ENABLED) {
                    $org = Organization::model()->findByPk($userOrg->organizationId);
                    $model->sendEmail($model->name, $model->email, $model->password, $org->organizationName);
                }
                Yii::app()->user->setFlash('success', 'Account Created!');
                //send an email notification:
                
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'skill' => $skill,
            'cause' => $cause,
            'worksFor' => $worksFor
        ));
    }
    


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $skill = Skill::model()->find('id=:id', array(':id' => $model->skillId));
        $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
        Yii::app()->user->setState('contentTitle', "Edit Profile - $model->name");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Person'])) {
            $model->attributes = $_POST['Person'];
            if ($model->save()) {
                $skill->setSkillString($_POST['skills'], 0);
                $cause->setCauseString($_POST['causes'], 0);
                Yii::app()->user->setFlash('success', 'Account Updated!');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'skill' => $skill,
            'cause' => $cause,
        ));
    }
    
    public function actionAdvancedUpdate($id) {
        $model = $this->loadModel($id);
        Yii::app()->user->setState('contentTitle', "$model->name - Advanced");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $accountOrgList = array();
        $worksFors = WorksFor::model()->findall('email=:email', array(':email' => $model->email));
        foreach ($worksFors as $worksFor) {
            $accountOrgList[] = $worksFor->organization->id;
        }

//        var_dump($accountOrgList);
        $allOrgList = CHtml::listData(Organization::model()->findall(), 'id', 'organizationName');
        
        if (isset($_POST['Person']) && isset($_POST['orgSelect'])) {
            $model->attributes = $_POST['Person'];
//            $worksFor->attributes = $_POST['WorksFor'];
            
            if ($model->save()) {
                
//              var_dump($_POST['orgSelect']);
                foreach ($accountOrgList as $currentOrg) {
                    $found = false;
                    foreach ($_POST['orgSelect'] as $org) {
                        echo "|".$currentOrg;
                        echo "|".$org;
                        if ($currentOrg == $org) {
                            $found = true;
                            break;
                        }
                    }
                    
                    if (!$found) {
                        echo "hey";
                        $criteria = new CDbCriteria;
                        $criteria->compare('organizationId',$currentOrg);
                        $criteria->compare('email',$model->email);
                        WorksFor::model()->deleteAll($criteria);
                        
                        $criteria2 = new CDbCriteria;
                        $criteria2->with = array(
                            'role',
                            'role.project',
                            'role.personAssignedToRoles',
                            'role.project.organization');
                        $criteria2->together = true;
                        
                        $criteria2->compare('organization.id',$currentOrg);
                        $criteria2->compare('personAssignedToRoles.email',$model->email);
                        $assignedRoles = PersonAssignedToRole::model()->findAll($criteria2);
                        foreach ($assignedRoles as $assignedRole) {
                            $assignedRole->delete();
                        }
                    }
                }
                
                foreach ($_POST['orgSelect'] as $org) {
                    $checkOrg = WorksFor::model()->find('email=:email AND organizationid=:oid', array(':email' => $model->email, ':oid' => $org));
                    
                    if ($checkOrg == null) {
                        $newWorksFor = new WorksFor();
                        $newWorksFor->email = $model->email;
                        $newWorksFor->organizationId = $org;
                        $newWorksFor->save();
                    }
                }

                Yii::app()->user->setFlash('success', 'Account Updated!');
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', 'Error updating account!');
            }
        }
        
        if (isset($_POST['Person']) && !isset($_POST['orgSelect'])) {
            Yii::app()->user->setFlash('error', 'Account must be assigned to at least one organization!');
        }
        

        $this->render('advancedUpdate', array(
            'model' => $model,
            'accountOrgList' => $accountOrgList,
            'allOrgList' => $allOrgList,
            
        ));
      
    }
    
    public function actionResetPassword($id){
        $model = $this->loadModel($id);
        
    }
    
    public function actionChangePassword($id) {
        $model = $this->loadModel($id);
        $form = new ChangePasswordForm;
        Yii::app()->user->setState('contentTitle', "$model->name");

        if (isset($_POST['ChangePasswordForm'])) {
            $form->attributes = $_POST['ChangePasswordForm'];
            $form->person = $model;

            if ($form->validate()) {
                if ($form->changePassword()) {
                    Yii::app()->user->setFlash('success', 'Password changed!');
                    $this->redirect(array('view', 'id' => $model->id));
                    return true;
                } else {
                    return false;
                }
            }
        }


        $this->render('changePassword', array('model' => $form));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Person');
        Yii::app()->user->setState('contentTitle', "Accounts");
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    
    public function actionSearch() {
        if (Yii::app()->user->type == 'administrator') {
            Yii::app()->user->setState('contentTitle', "Users");
        } else if (Yii::app()->user->type == 'organizer') {
            Yii::app()->user->setState('contentTitle', "Volunteers");
        }
        
        $person = new Person('search');
        $skill = new Skill('search');
        $cause = new Cause('search');
        $freeTime = new FreeTime('search');
        $person->unsetAttributes();  // clear any default values
        $skill->unsetAttributes();
        $cause->unsetAttributes();
        $freeTime->unsetAttributes();
        $person->active = 1;
        $allOrg = false;
        $orgProjects = Project::model()->findAll('organizationId=:organizationId', array(':organizationId' => Yii::app()->user->getState('defaultOrgId')));
        $orgProjects = CHtml::listData($orgProjects, 'id', 'projectName');
        
        if (isset($_GET['projectAssignId'])) {
            $defaultProjectSelected = $_GET['projectAssignId'];
        } else {
            $defaultProjectSelected = '""';
        }
        
        if (Yii::app()->user->getState("type") === 'administrator') {
            $allOrg = true;
        }
        
        //initial load
        if (!isset($_GET['Person'])) {
            $data = $person->search(Yii::app()->user->getState('defaultOrgId'), $allOrg, $skill, $cause, $freeTime, null);
        }
        
        $organization = Organization::model()->findByPk(Yii::app()->user->getState('defaultOrgId'));

        if (isset($_GET['Person'])) {
            $skill->setSkillString($_GET['skills'], null);
            $cause->setCauseString($_GET['causes'], null);
            $freeTime->attributes = $_GET['FreeTime'];
            $person->attributes = $_GET['Person'];
            if (isset($_GET['orgProjects'])) {
                $projects = $_GET['orgProjects'];
            } else {
                $projects = null;
            }
            $data = $person->search(Yii::app()->user->getState('defaultOrgId'), $allOrg, $skill, $cause, $freeTime, $projects);
            $this->renderPartial('_ajaxSearchTable', array(
            'data' => $data,
            'organization' => $organization,
            ), false, true);
            
        } else {
        $this->render('search', array(
            'person' => $person,
            'skill' => $skill,
            'cause' => $cause,
            'freeTime' => $freeTime,
            'data' => $data,
            'organization' => $organization,
            'defaultProjectSelected' => $defaultProjectSelected,
            'orgProjects' => $orgProjects,
        ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Person('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Person']))
            $model->attributes = $_GET['Person'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Person the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Person::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Person $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
