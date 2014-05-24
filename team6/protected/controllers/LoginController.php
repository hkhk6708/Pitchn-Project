<?php

class LoginController extends Controller
{
	public function actionForgotPassword()
	{
            $model = new ForgotPassword();
              if (isset($_POST['ForgotPassword'])) {
                  $model->attributes=$_POST['ForgotPassword'];
                  $email = $model->email;
                  $person = Person::model()->findByAttributes(array('email'=>$email));
                  $sendEmail = new Person();
                  if ($person != NULL) {   
                    $name = $person->name;
                    $tempPasswordName = str_replace(' ','',$name); 
                    if(strlen($tempPasswordName.$person->id) < 5){
                        $tempPassword = "Pitchn".$tempPasswordName.$person->id;
                    }
                    else{
                        $tempPassword = $tempPasswordName.$person->id;
                    }
                    $person->password = $tempPassword;
                    $person->save();
                    $sendEmail->sendForgotEmail($name, $email, $tempPassword);
                    
                     $user = Yii::app()->getComponent('user');
                     $user->setFlash(
                     'success',
                     "<strong>Success!</strong> We've sent you a temporary password. If it's not in your inbox soon, please check your junk mail folder."
                );
                  } else {
                      //do nothing
                  }
                   $this->redirect(Yii::app()->createUrl('site/login'));
              }
            
		$this->render('forgotPassword', array('model'=>$model));
	}

	public function actionIndex()
	{
		$this->render('index');
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
