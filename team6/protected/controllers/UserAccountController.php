<?php

class UserAccountController extends Controller {

    public function actionChangePassword() {
        Yii::app()->user->setState('contentTitle', "Change Password");
        $uid = Yii::app()->user->getState('userId');
        $model = Person::model()->findByPk($uid);
        $form = new ChangePasswordForm;
        
        if ((Yii::app()->user->getState("type") != 'administrator')) {
            $form->scenario = 'userAccountNonAdmin';
        }

        if (isset($_POST['ChangePasswordForm'])) {
            $form->attributes = $_POST['ChangePasswordForm'];
            $form->person = $model;

            if ($form->validate()) {
                if ($form->changePassword()) {
                    Yii::app()->user->setFlash('success', 'Password changed!');
                    $this->redirect(array('index'));
                    return true;
                } else {
                    return false;
                }
            }
        }


        $this->render('changePassword', array('model' => $form));
    }

    public function actionEditPersonalInfo() {
        Yii::app()->user->setState('contentTitle', "Edit Profile");
        $uid = Yii::app()->user->getState('userId');
        $model = Person::model()->findByPk($uid);

        $skill = Skill::model()->find('id=:id', array(':id' => $model->skillId));
        $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Person'])) {
            $model->attributes = $_POST['Person'];
            if ($model->save()) {
                $skill->setSkillString($_POST['skills'], 0);
                $cause->setCauseString($_POST['causes'], 0);
                Yii::app()->user->setFlash('success', 'Account Updated!');
                $this->redirect(array('index'));
            }
        }

        $this->render('editPersonalInfo', array(
            'model' => $model,
            'skill' => $skill,
            'cause' => $cause,
        ));
    }

    public function actionIndex() {
        $userEmail = Yii::app()->user->name;
        $person = Person::model()->findByAttributes(array('email'=>$userEmail));
        Yii::app()->user->setState('contentTitle', $person->name);
        
        $uid = Yii::app()->user->getState('userId');
        $model = Person::model()->findByPk($uid);
        $skill = Skill::model()->find('id=:id', array(':id' => $model->skillId));
        $cause = Cause::model()->find('id=:id', array(':id' => $model->causeId));
        $userImageEntry = Userimage::model()->findByAttributes(array('email'=>$model->email, 'current'=>1));
        //$userImage = $this->readUserImage($userImageEntry);

        $this->render('index', array(
            'model' => $model,
            'skill' => $skill,
            'cause' => $cause,
            'userImage'=>$userImageEntry,
        ));
    }
    
    public function readUserImage($userImageEntry) {
        
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
