<?php

class RoleController extends Controller {

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
        $model = new Role;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateWithPid($projectId) {
        $model = new Role;
        $model->projectId = $projectId;
        $project = Project::model()->findByPk($projectId);
        Yii::app()->user->setState('contentTitle', "New Role");

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];

            if ($model->title == 'general') {
                $model->addError('title', 'Sorry, title cannot be general. Please rename it.');
            } else {
                if ($model->save()) {
                    $this->redirect(array('project/roles', 'id' => $projectId));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * 
     */
    public function actionCopyRole($id, $projectId) {
        $role = $this->loadModel($id);
        $tasks = $role->tasks;
        $ob = $role->obs;
        $contacts = $role->orgcontacts;
        $files = $role->files;

        // copy the record
        $role->id = null;
        $role->isNewRecord = true;
        $role->save();
        $rId = $role->getPrimaryKey();

        if ($ob != null) {
            $ob->id = null;
            $ob->isNewRecord = true;
            $ob->roleId = $rId;
            $ob->save();
        }

        foreach ($tasks as $task) {
            $task->id = null;
            $task->isNewRecord = true;
            $task->roleId = $rId;
            $task->save();
        }

        foreach ($contacts as $contact) {
            $contact->id = null;
            $contact->isNewRecord = true;
            $contact->roleId = $rId;
            $contact->save();
        }

        foreach ($files as $file) {
            $file->id = null;
            $file->isNewRecord = true;
            $file->roleId = $rId;
            $file->save();
        }

        $this->redirect(array('project/roles', 'id' => $projectId));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateWithPid($id, $projectId) {
        $model = $this->loadModel($id);

        $project = Project::model()->findByPk($projectId);
        Yii::app()->user->setState('contentTitle', "$model->title - Update");

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];

            if ($model->title == 'general') {
                $model->addError('title', 'Sorry, title cannot be general. Please rename it.');
            } else {

                if ($model->save()) {
                    $this->redirect(array('project/roles', 'id' => $projectId));
                }
            }
        }

        $this->render('update2', array(
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

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
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
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Role');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Role('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Role']))
            $model->attributes = $_GET['Role'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Role the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Role::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Role $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
