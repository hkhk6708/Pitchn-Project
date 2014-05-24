<?php

class OrgContactController extends Controller {

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
                  ),
                 * 
                 */
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $orgContact = OrgContact::model()->findByPk($id);
        $role = Role::model()->findByPk($orgContact->roleId);
        $person = Person::model()->findByAttributes(array('email' => $orgContact->email));
        $project = Project::model()->findByPk($role->projectId);

        $model = new OrgContactFM;
        $model->roleName = $role->title;
        $model->email = $orgContact->email;
        $model->title = $orgContact->title;
        $model->name = $person->name;
        $model->projectName = $project->projectName;

        //projectName
        //name

        Yii::app()->user->setState('contentTitle', "Organization Contact");

        $this->render('view', array('model' => $model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new OrgContact;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OrgContact'])) {
            $model->attributes = $_POST['OrgContact'];
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
    public function actionCreateWithRid($rId) {
        Yii::app()->user->setState('contentTitle', "New Organization Contact");
        $model = new OrgContact;
        $model->roleId = $rId;
        $role = Role::model()->findByPk($rId);
        $project = Project::model()->findByAttributes(array('id'=>$role->projectId));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OrgContact'])) {
            $model->attributes = $_POST['OrgContact'];
            if ($model->save()) {
                 $this->redirect(Yii::app()->createUrl('project/orgContacts', array('id'=>$project->id, 'roleId'=>$rId)));
        }
        }

        $this->render('create2', array(
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

        if (isset($_POST['OrgContact'])) {
            $model->attributes = $_POST['OrgContact'];
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
    public function actionDelete2($id) {
        $orgC = $this->loadModel($id);
        $role = $orgC->role;
        $rId = $role->id;
        $project = $role->project;
        $projectId = $project->id;
        $orgC->delete();

        $this->redirect(array('project/orgContacts', 'id' => $projectId, 'roleId' => $rId));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OrgContact');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new OrgContact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OrgContact']))
            $model->attributes = $_GET['OrgContact'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OrgContact the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OrgContact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OrgContact $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'org-contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
