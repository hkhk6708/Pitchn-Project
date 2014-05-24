<?php

class ProjectController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                  array('allow',  // allow all users to perform 'index' and 'view' actions
                  'actions'=>array('index','view'),
                  'users'=>array('*'),
                  ),
                  array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('create','update'),
                  'users'=>array('@'),
                  ),
                  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('admin','delete'),
                  'users'=>array('admin'),
                  ),
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ), */
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        Yii::app()->user->setState('contentTitle', "Create a Project");
        $model = new Project;
        $cause = new Cause;
//$cause->save();
//$model->causeId = $cause->id;
        $model->organizationId = Yii::app()->user->getState('defaultOrgId');
        $model->status = 'Not Yet Started';
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
//$cause->attributes = $_POST['Cause'];
            $cause->setCauseString($_POST['causes'], 0);
            $model->causeId = $cause->id;
//$model->startDate = date("Y-m-d");
            if ($model->actualEndDate == "0000-00-00") {
                $model->actualEndDate = "";
            }
            if ($model->save()) {
                $role = new Role;
                $role->projectId = $model->id;
                $role->title = 'general';
                $role->roleDescription = 'general role for entire project';
                $role->save();

                $patr = new PersonAssignedToRole;
                $patr->email = Yii::app()->user->getState('email');
                $patr->roleId = $role->getPrimaryKey();
                $patr->save();

                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'cause' => $cause,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
        Yii::app()->user->setState('contentTitle', "Edit " . $model->projectName);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
            $cause->setCauseString($_POST['causes'], 0);
//$cause->attributes = $_POST['Cause'];

            if ($model->save())
                $this->redirect(array('main', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'cause' => $cause,
        ));
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
    /*
      public function actionIndex() {
      $dataProvider = new CActiveDataProvider('Project');
      $this->render('index', array(
      'dataProvider' => $dataProvider,
      ));
      } */

    /**
     * Lists all models/projects.
     */
    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Projects");

        if (Yii::app()->user->getState('type') == 'volunteer') {
            $criteria = new CDbCriteria;
            $criteria->with = array(
                'roles.personAssignedToRoles',);
            $criteria->together = true;
            $criteria->condition = "personAssignedToRoles.email = :col_val and organizationId = :col_val2";
            $criteria->params = array(':col_val' => Yii::app()->user->getState('email'),
                ':col_val2' => Yii::app()->user->getState('defaultOrgId'));
            $projects = Project::model()->findAll($criteria);
        } else {
            $projects = Project::model()->findAllByAttributes(array('organizationId' => Yii::app()->user->getState('defaultOrgId')));
        }

        $dataProvider = new CArrayDataProvider($projects, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("index", array('dataProvider' => $dataProvider));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Project('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Project']))
            $model->attributes = $_GET['Project'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     *  Display all the roles in a project
     */
    public function actionRoles($id) {
        $projectName = Project::model()->findByPK($id)->projectName;
        Yii::app()->user->setState('contentTitle', $projectName);

        $roles = Yii::app()->db->createCommand()
                ->select('r.*, patr.email,p.id as pid, p.name as pname,patr.id as patrId')
                ->from('role r')
                ->leftjoin('personAssignedToRole patr', 'r.id = patr.roleId')
                ->leftjoin('person p', 'p.email = patr.email')
                ->where('r.projectId=:id AND r.title!="general"', array(':id' => $id))
//->group(....)
//->order(....)
                ->queryAll();

        if (Yii::app()->user->getState('type') == 'volunteer') {
            $roles = Yii::app()->db->createCommand()
                    ->select('r.*, patr.email,p.id as pid, p.name as pname,patr.id as patrId')
                    ->from('role r')
                    ->leftjoin('personAssignedToRole patr', 'r.id = patr.roleId')
                    ->leftjoin('person p', 'p.email = patr.email')
                    ->where('r.projectId=:id AND p.email=:email', array(':id' => $id, ':email' => Yii::app()->user->getState('email')))
//->group(....)
//->order(....)
                    ->queryAll();
        }

        $dataProvider = new CArrayDataProvider($roles, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("roles", array(
            'id' => $id,
            'dataProvider' => $dataProvider,
        ));
    }

    /*
     * Display team
     */

    public function actionTeam($id) {
        $project = $this->loadModel($id);
        $projectName = $project->projectName;
        Yii::app()->user->setState('contentTitle', $projectName);
        $roles = Yii::app()->db->createCommand()
                ->select('r.*, patr.email,p.id as pid, p.name as pname,patr.id as patrId')
                ->from('role r')
                ->leftjoin('personAssignedToRole patr', 'r.id = patr.roleId')
                ->leftjoin('person p', 'p.email = patr.email')
                ->where('r.projectId=:id AND r.title!="general"', array(':id' => $id))
//->group(....)
//->order(....)
                ->queryAll();

        $dataProvider = new CArrayDataProvider($roles, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("team", array(
            'id' => $id,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionDeleteRole($id) {
        $role = Role::model()->findByPk($id);
        $role->delete();
    }

    public function actionDeleteTask($id) {
        $task = Task::model()->findByPk($id);
        $task->delete();
    }

    /**
     * Display the specific details of a role in a project
     */
    public function actionRoleView($id, $roleId) {
        $role = Role::model()->findbyPk($roleId);

        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;
        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);
        Yii::app()->user->setState('contentTitle', $role->title);
        /*
          $tasks = Yii::app()->db->createCommand()
          ->select('t.*')
          ->from('task t, role r')
          //->join('role r', 'r.id = t.roleId')
          ->where('r.id=:id', array(':id' => $roleId))
          //->group(....)
          //->order(....)
          ->queryAll(); */

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'role',);
        $criteria->together = true;
        $criteria->condition = "role.id = :col_val";
        $criteria->params = array(':col_val' => $roleId);

        $tasks = Task::model()->findAll($criteria);

        $dataProvider = new CArrayDataProvider($tasks, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("roleView", array(
            'id' => $id,
            'dataProvider' => $dataProvider,
            'roleId' => $roleId,
                //'count' => count($tasks),
        ));
    }

    /**
     *  Display the documents sharing within a project
     */
    public function actionDocuments($id) {
        $projectName = Project::model()->findByPK($id)->projectName;
        Yii::app()->user->setState('contentTitle', $projectName);
        $model = new DocumentUpload;

        $role = new role();
        $role->projectId = $id;
        $role->title = "general";
        $roleDP = $role->search();
        $roleArray = $roleDP->getData();
        $generalRoleId = $roleArray[0]['id'];

        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;

        $file2 = new File('search');
        $file2->roleId = $generalRoleId;
        $file2->projectId = $id;

        $fileDP = $file2->search();

        if (isset($_POST['DocumentUpload'])) {
            $uploadedFile = CUploadedFile::getInstance($model, 'filename');
            $model->filename = $uploadedFile->name;

            //add slash to path
            if ((strpos(PHP_OS, "WIN") !== false) || (strpos(PHP_OS, "win") !== false)) {
                $slash = "\\";
            } else {
                $slash = "/";
            }

            $path = Yii::app()->getBasePath() . $slash . "userUploadedFiles" . $slash . $model->filename;

            $uploadedFile->saveAs($path);

            $file = new File();
            $file->path = $path;
            $file->filename = $model->filename;

            $file->roleId = $generalRoleId;
            $file->addedBy = Yii::app()->user->name;
            $file->projectId = $id;
            $file->save();
        }
        $this->render("documents", array(
            'id' => $id, 'model' => $model, 'dataProvider' => $fileDP, 'projectName' => $projectName
        ));
    }

    public function actionRoleDocuments($id, $roleId) {
        $model = new DocumentUpload;
        $role = Role::model()->findbyPk($roleId);

        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;
        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);

        Yii::app()->user->setState('contentTitle', "$role->title");

        $file2 = new File('search');
        $file2->roleId = $roleId;
        $file2->projectId = $id;

        $fileDP = $file2->search();

        $role = Role::model()->findByPK($roleId);

        if (isset($_POST['DocumentUpload'])) {
            $uploadedFile = CUploadedFile::getInstance($model, 'filename');
            $model->filename = $uploadedFile->name;

            //add slash to path
            if ((strpos(PHP_OS, "WIN") !== false) || (strpos(PHP_OS, "win") !== false)) {
                $slash = "\\";
            } else {
                $slash = "/";
            }

            $path = Yii::app()->getBasePath() . $slash . "userUploadedFiles" . $slash . $model->filename;

            $uploadedFile->saveAs($path);

            $file = new File();
            $file->path = $path;
            $file->filename = $model->filename;

            $file->roleId = $roleId;
            $file->addedBy = Yii::app()->user->name;
            $file->projectId = $id;
            $file->save();
        }

        $this->render("roleDocuments", array(
            'id' => $id, 'roleId' => $roleId, 'model' => $model, 'dataProvider' => $fileDP, 'roleName' => $role->title
        ));
    }

    public function actionDocumentDownload($path, $filename) {
        if (file_exists($path)) {
            return Yii::app()->getRequest()->sendFile($filename, @file_get_contents($path));
        }
    }

    /**
     *  Display the onboarding information of a role
     */
    public function actionOnBoarding($id, $roleId) {
        Yii::app()->user->setState('contentTitle', "Project/Role Introduction");
        
        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;
        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);
        
        $ob = Ob::model()->findByAttributes(array('roleId' => $roleId));
        $addtionalInfo = "Sorry, your organizer hasn't provided any addtional info.";
        if (!empty($ob)) {
            $addtionalInfo = $ob->content;
        }

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'role',
            'role.project',);
        $criteria->together = true;
        $criteria->condition = "role.title = :col_val and project.id = :col_val2";
        $criteria->params = array(':col_val' => 'general',
            ':col_val2' => $id);

        $patr = PersonAssignedToRole::model()->find($criteria);
        $orgContacts = OrgContact::model()->findAllByAttributes(array('roleId' => $roleId));

        $this->render("onboarding", array(
            'id' => $id,
            'roleId' => $roleId,
            'patr' => $patr,
            'info' => $addtionalInfo,
            'orgContacts' => $orgContacts,
        ));
    }

    /**
     * Allow organizers to modify the onboarding system of a role
     */
    public function actionModifyOnBoarding($id, $roleId) {
        $ob = Ob::model()->findByAttributes(array('roleId' => $roleId));
        $role = Role::model()->findbyPk($roleId);

        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;
        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);

        Yii::app()->user->setState('contentTitle', "$role->title");
        if (empty($ob)) {
            $ob = new Ob;
            $ob->roleId = $roleId;
        }

        if (isset($_POST['Ob'])) {
            $ob->attributes = $_POST['Ob'];

            if ($ob->save())
                $this->redirect(array('roleView', 'id' => $id, 'roleId' => $roleId));
        }

        $this->render("modifyOnBoarding", array(
            'id' => $id,
            'roleId' => $roleId,
            'model' => $ob,
        ));
    }

    /**
     * 
     */
    public function actionOrgContacts($id, $roleId) {
        $model = OrgContact::model()->findAllByAttributes(
                array('roleId' => $roleId,)
        );
        $role = Role::model()->findbyPk($roleId);

        $project = Project::model()->findByPK($id);
        $projectName = $project->projectName;
        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);

        Yii::app()->user->setState('contentTitle', "$role->title");

        $dataProvider = new CArrayDataProvider($model, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render('orgContacts', array(
            'id' => $id,
            'roleId' => $roleId,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     *  Display all the tasks in a project
     */
    public function actionTasks($id) {
        $projectName = Project::model()->findByPK($id)->projectName;
        Yii::app()->user->setState('contentTitle', $projectName . " - My Tasks");
        /*
          $tasks = Yii::app()->db->createCommand()
          ->select('t.*')
          ->from('task t')
          ->join('role r', 'r.id = t.roleId')
          ->join('personAssignedToRole patr', 'r.id = patr.roleId')
          ->where('patr.email=:email', array(':email' => Yii::app()->user->getState('email')))
          ->andWhere('r.projectId=:id', array(':id' => $id))
          //->group(....)
          //->order(....)
          ->queryAll(); */

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'role',
            'role.personAssignedToRoles');
        $criteria->together = true;
        $criteria->condition = "personAssignedToRoles.email = :col_val and role.projectId = :col_val2";
        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'),
            ':col_val2' => $id);

        $tasks = Task::model()->findAll($criteria);

        $dataProvider = new CArrayDataProvider($tasks, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("tasks", array(
            'id' => $id,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Generate a view of a specific task in a project
     */
    public function actionTaskView($id, $taskId) {
        $task = Task::model()->findByPk($taskId);
        $role = Role::model()->findByPk($task->roleId);
        $project = Project::model()->findByPK($role->projectId);
        $projectName = $project->projectName;

        $roleLink = CHtml::link($role->title, array('project/roleView',
                    'id' => $project->id,
                    'roleId' => $task->roleId
        ));

        $projectLink = CHtml::link($projectName, array('project/roles',
                    'id' => $project->id
        ));


        Yii::app()->user->setState('projectTitle', $projectLink);
        Yii::app()->user->setState('roleTitle', $roleLink);


        Yii::app()->user->setState('contentTitle', "$task->taskName");
        $tcomments = TComments::model()->findAllByAttributes(array('taskId' => $taskId));
        $dataProvider = new CArrayDataProvider($tcomments, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

// Get Input comment from /project/main and save to database

        if (isset($_POST['comment'])) {
            $tcomment = new TComments();
            $tcomment->taskId = $taskId;
            $tcomment->cdate = date("Y-m-d");
            $tcomment->email = Yii::app()->user->getState('email');
            $tcomment->content = $_POST['comment'];
            $tcomment->save();
            if ($tcomment->save()) {
                $this->redirect(array('taskView', 'id' => $id, 'taskId' => $taskId));
            }
        }

        $this->render('taskView', array(
            'id' => $id,
            'dataProvider' => $dataProvider,
            'model' => $task,
        ));
    }

    public function actionTaskDirect($taskId) {
        $task = Task::model()->findByPk($taskId);
        $this->redirect(array('taskView', 'id' => $task->role->project->id, 'taskId' => $taskId));
    }

    /**
     * Generate the main page of a project
     */
    public function actionMain($id) {
        $projectName = Project::model()->findByPK($id)->projectName;
        Yii::app()->user->setState('contentTitle', $projectName);

        $pcomments = PComments::model()->findAllByAttributes(array('projectId' => $id));
        $causeId = $this->loadModel($id)->causeId;
        $cause = Cause::model()->findByPk($causeId);
        $dataProvider = new CArrayDataProvider($pcomments, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

// Get Input comment from /project/main and save to database

        if (isset($_POST['comment'])) {
            date_default_timezone_set('UTC');
            $pcomment = new PComments();
            $pcomment->projectId = $id;
            $pcomment->cdate = date("Y-m-d");
            $pcomment->email = Yii::app()->user->getState('email');
            $pcomment->content = $_POST['comment'];
            if ($pcomment->save()) {
                $this->redirect(array('main', 'id' => $id));
            }
        }

        $this->render('main', array(
            'id' => $id,
            'dataProvider' => $dataProvider,
            'model' => $this->loadModel($id),
            'cause' => $cause,
        ));
    }

    /**
     * Generate the text of onboarding info of a role
     */
    public function actionOnBoardingText($projectId, $roleId) {
        $userName = Yii::app()->user->getState('realName');
        $role = Role::model()->findByPk($roleId);
        $project = Project::model()->findByPk($projectId);
        $text = "Hi, $userName ! Welcome to Project, $project->projectName. <br>"
                . "The goal of $project->projectName is to $project->projectDescription. <br>"
                . "Your role is $role->title. <br> "
                . "The purpose of this role is $role->roleDescription. <br>"
                . "<br>"
                . "By clicking the 'Dcuments' tab on the left hand side, you will find any files you will need to bring you up to speed with $project->projectName. <br>"
                . "You should read these documents ASAP and read the other ones when you have time! Thank you. <br>"
        ;
        echo $text;
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Project the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Project::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Project $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getArrayOfRoleNames($id) {
        $role = new Role();
        $role->projectId = $id;
        $rolesDP = $role->search();
        $rolesArray = $rolesDP->getData();
        $count = count($rolesArray);
        $roleNamesArray;
        for ($i = 0; $i < $count; $i++) {
            $roleNamesArray[$i] = $rolesArray[$i]["title"];
        }
        return $roleNamesArray;
    }

    public function getAvailableRoles($id) {
        $role = new Role();
//        $role->projectId = $id;
        $rolesDP = $role->searchProjectAvailableRoles($id);
        $rolesArray = $rolesDP->getData();
        $roles = Array();
        foreach ($rolesArray as $role) {
            $slot = array();
            $slot['id'] = $role->id;
            $slot['text'] = $role->title;
            $roles[] = $slot;
        }
        return $roles;
    }

    public function getAssignedRoles($projectid, $personid) {
        $role = new Role();
        $rolesDP = $role->searchProjectAssignedRoles($personid, $projectid);
        $rolesArray = $rolesDP->getData();
        $roles = Array();
        foreach ($rolesArray as $role) {
            $slot = array();
            $slot['id'] = $role->id;
            $slot['text'] = $role->title;
            $roles[] = $slot;
        }
        return $roles;
    }

    public function actionfetchAvailableRoles() {
        if (isset($_GET['id'])) {
            echo CJSON::encode($this->getAvailableRoles($_GET['id']));
        }
    }

    public function actionfetchAssignedRoles() {
        if (isset($_GET['projectid']) && isset($_GET['personid'])) {
            echo CJSON::encode($this->getAssignedRoles($_GET['projectid'], $_GET['personid']));
        }
    }

}
