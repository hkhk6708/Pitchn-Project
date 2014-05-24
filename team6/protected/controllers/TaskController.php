<?php

class TaskController extends Controller {

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
                //'postOnly + delete', // we only allow deletion via POST request
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
        $model = new Task;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateWithRid($projectId, $roleId) {
        $model = new Task;
        $model->roleId = $roleId;
        $model->status = 'Not Yet Started'; // 1 is 'not yet started', by default when creating a task
        $model->completion = 0;
        $role = Role::model()->findByPk($roleId);
        $model->endDate = $role->project->endDate;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        Yii::app()->user->setState('contentTitle', "$role->title - New Task");
        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];

            if ($model->save()) {

                // create a system message
                $taskId = $model->getPrimaryKey();
                $newTask = Task::model()->findByPk($taskId);
                $role = Role::model()->findByPk($roleId);
                $patr = $role->personAssignedToRoles;

                if ($patr != NULL) {
                    $rTitle = $role->title;
                    $rDescription = $role->roleDescription;
                    $project = $role->project;
                    $pTitle = $project->projectName;
                    $person = Person::model()->findByAttributes(array('email' => $patr->email));

                    $message = new Message;
                    $message->email = "admin@pitchn.ca";
                    $message->recipientEmail = $person->email;
                    $message->senderName = "System";
                    $message->userType = $person->userType;
                    $message->date = date("Y-m-d");
                    $message->readmsg = 'N';
                    $content = "";
                    $content .= "Hi Volunteer, Your organizer has added a new task in the role of $rTitle in project: $pTitle."
                            . "The new task is $newTask->taskName. Start Date: $newTask->startDate. "
                            . "Please click " . CHtml::link('this', array('project/taskView', 'id' => $project->id, 'taskId' => $taskId)) . " to see the details.";
                    $message->content = $content;
                    $message->save();
                }

                $this->redirect(array('project/roleView', 'id' => $projectId, 'roleId' => $roleId));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateWithPid($id, $projectId) {
        $model = $this->loadModel($id);
        Yii::app()->user->setState('contentTitle', "$model->taskName - Update");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];

            if ($model->save()) {
                $taskId = $model->getPrimaryKey();
                $task = Task::model()->findByPk($taskId);

                // create a system message if asking for verification
                if ($task->status = 'Pending Verification') {
                    $role = $task->role;
                    $project = $role->project;

                    // find all organizers 
                    $criteria = new CDbCriteria;
                    $criteria->with = array('worksFors');
                    $criteria->together = true;
                    $criteria->condition = 'worksFors.organizationId = :col_val and userType = "organizer"';
                    $criteria->params = array(':col_val' => $project->organizationId);
                    $organizers = Person::model()->findAll($criteria);

                    foreach ($organizers as $organizer) {
                        $message = new Message;
                        $message->email = "admin@pitchn.ca";
                        $message->recipientEmail = $organizer->email;
                        $message->senderName = "System";
                        $message->userType = $organizer->userType;
                        $message->date = date("Y-m-d");
                        $message->readmsg = 'N';
                        $content = "";
                        $content .= "Hi Organizers, your volunter has asked your verification on the task, $task->taskName. "
                                . "Please click " . CHtml::link('this', array('project/taskView', 'id' => $project->id, 'taskId' => $taskId)) . " to see the details.";
                        $message->content = $content;
                        $message->save();
                    }
                }

                $this->redirect(array('project/taskView', 'id' => $projectId, 'taskId' => $id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete2($id, $projectId) {
        $task = $this->loadModel($id);
        $role = $task->role;
        $rId = $role->id;
        $task->delete();
        $this->redirect(array('project/roleView', 'id' => $projectId, 'roleId' => $rId));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Task');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Task('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Task']))
            $model->attributes = $_GET['Task'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Task the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Task::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Task $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'task-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
