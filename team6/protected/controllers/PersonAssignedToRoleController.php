<?php

class PersonAssignedToRoleController extends Controller {

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
        $model = new PersonAssignedToRole;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PersonAssignedToRole'])) {
            $model->attributes = $_POST['PersonAssignedToRole'];
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
    public function actionCreateByRid($roleId, $projectId) {
        $model = new PersonAssignedToRole;
        $model->roleId = $roleId;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PersonAssignedToRole'])) {
            $model->attributes = $_POST['PersonAssignedToRole'];
            if ($model->save())
                $this->redirect(array('project/roles', 'id' => $projectId));
        }

        $this->render('createById', array(
            'model' => $model,
        ));
    }

    public function actionAjaxCreate() {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['personId']) && isset($_POST['roleId'])) {
            $model = new PersonAssignedToRole;
            $person = Person::model()->findByPk($_POST['personId']);
            $model->roleId = $_POST['roleId'];
            $model->email = $person->email;

            if ($model->save()) {

                // create a system message 
                $patrId = $model->getPrimaryKey();
                $patr = PersonAssignedToRole::model()->findByPk($patrId);
                $role = $patr->role;
                $rTitle = $role->title;

                $project = $role->project;
                $pTitle = $project->projectName;
                $organization = $project->organization;
                $userName = Yii::app()->user->getState('realName');
                
                $person = Person::model()->findByAttributes(array('email' => $patr->email));

                $message = new Message;
                $message->email = "admin@pitchn.ca";
                $message->recipientEmail = $patr->email;
                $message->senderName = "System";
                $message->userType = $person->userType;
                $message->date = date("Y-m-d");
                $message->readmsg = 'N';
                $content = "";
                $content .= "Hi Volunteer, You have been assigned to the role of $rTitle "
                        . "in project: $pTitle, by $userName of $organization->organizationName. "
                        . "Please click " . CHtml::link('this', array('project/roleView', 'id' => $project->id, 'roleId' => $role->id)) . " to see the details.";
                $message->content = $content;
                $message->save();
                
                Yii::app()->user->setFlash('success', "(" . $model->role->project->projectName . ") " . $model->role->title . "Role Was Assigned To: " . $person->name);
                $this->renderPartial('_ajaxMessage', array(
                        ), false, true);
            }
        }
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

        if (isset($_POST['PersonAssignedToRole'])) {
            $model->attributes = $_POST['PersonAssignedToRole'];
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

    public function actionDelete2($id, $projectId) {
        $this->loadModel($id)->delete();
        $this->redirect(array('project/roles', 'id' => $projectId));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PersonAssignedToRole');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PersonAssignedToRole('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PersonAssignedToRole']))
            $model->attributes = $_GET['PersonAssignedToRole'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PersonAssignedToRole the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PersonAssignedToRole::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PersonAssignedToRole $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-assigned-to-role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
