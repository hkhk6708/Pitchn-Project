<?php

class UserDocsController extends Controller
{
	public function actionAdmin()
	{
            Yii::app()->user->setState('contentTitle', "Administrator User Guide");
		$this->render('admin');
	}

	public function actionIndex()
	{
            $userType = Yii::app()->user->getState('type');
            if ($userType == 'administrator') {
                 $this->redirect(array('admin'));
            } else if ($userType == 'organizer') {
                $this->redirect(array('organizer'));
            } else if ($userType == 'volunteer') {
                $this->redirect(array('volunteer'));
            }
	}

	public function actionOrganizer()
	{
            Yii::app()->user->setState('contentTitle', "Organizer User Guide");
		$this->render('organizer');
	}

	public function actionVolunteer()
	{
            Yii::app()->user->setState('contentTitle', "Volunteer User Guide");
		$this->render('volunteer');
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