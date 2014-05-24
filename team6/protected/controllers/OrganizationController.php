<?php

class OrganizationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $causeString;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $model = $this->loadModel($id);
                $causeId = $model->causeId;
                Yii::app()->user->setState('contentTitle', $model->organizationName);
                $cause = Cause::model()->findByPk($causeId);
                $this->causeString = $cause->getSelectedCauseString(" ",",");
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                Yii::app()->user->setState('contentTitle', 'New Organization');
		$model=new Organization;
                $cause = new Cause();
                $cause->save();
                $model->causeId = $cause->id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']) && isset($_POST['causes']))
		{
			$model->attributes=$_POST['Organization'];
                        $cause->setCauseString($_POST['causes'], 0);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
                        'cause'=>$cause
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
                                Yii::app()->user->setState('contentTitle', $model->organizationName);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
                        $cause->setCauseString($_POST['causes'], 0);
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
                        'cause'=>$cause
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
$criteria = new CDbCriteria;
        $criteria->with = array(
            //'roles',
            'roles.personAssignedToRoles',);
        $criteria->together = true;
        $criteria->condition = "personAssignedToRoles.email = :col_val";
        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'));

        $projects = Project::model()->findAll($criteria);

        /*
          $projects = Yii::app()->db->createCommand()
          ->selectDistinct('pro.*')
          ->from('project pro')
          ->join('role r', 'pro.id = r.projectId')
          ->join('personAssignedToRole patr', 'r.id = patr.roleId')
          ->where('patr.email=:email', array(':email' => Yii::app()->user->getState('email')))
          //->group('pro.id')
          ->queryAll(); */

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
	public function actionAdmin()
	{
                Yii::app()->user->setState('contentTitle', "Manage Organizations");
		$model=new Organization('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Organization']))
			$model->attributes=$_GET['Organization'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Organization the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Organization::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Organization $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='organization-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionFetchOrganizationProjects() {
            $orgProjects = Project::model()->findAll('organizationId=:organizationId', array(':organizationId' => Yii::app()->user->getState('defaultOrgId')));
            $projectArray = array();
            foreach ($orgProjects as $project) {
                $slot = array();
                $slot['id'] = $project->id;
                $slot['text'] = $project->projectName;
                $projectArray[] = $slot;
            }
            echo CJSON::encode($projectArray);
        }
}