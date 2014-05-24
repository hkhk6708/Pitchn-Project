<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
 
        // if user is a guest/not login, load login page
        // else load the userType/index.php
        if (Yii::app()->user->getIsGuest()) {
            $this->actionLogin();
        } else {
            $this->actionUserTypeIndex();
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Display the register page
     */
    public function actionRegister() {
        $model = new RegisterForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('register', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                //$this->redirect(Yii::app()->user->returnUrl);
                $this->actionUserTypeIndex();
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * 
     */
    public function actionUserTypeIndex() {
        // Check the userType and load the userType/index.php
        $type = Yii::app()->user->getState("type");
        $person = Person::model()->findByAttributes(array('email'=>Yii::app()->user->getState('email')));
        if ($person->active == 'N') {
            $person->active = 'Y';
        }
        if ($person->status != 'active') {
            $person->active = 'N';
        }
        $person->lastActive = date("Y-m-d H:i:s");
        $person->save();
        
        if ($type == "administrator" && $person->status == 'active') {
            $this->redirect(array("/admin/index"));
        } else if ($type == "volunteer" && $person->status == 'active' && $this->verifyOrgActive($type)) {
            $org = Organization::model()->findByPk(Yii::app()->user->getState('defaultOrgId'));
            Yii::app()->user->setState('currentOrgName', $org->organizationName);
            $this->redirect(array("/volunteer/index"));
        } else if ($type == "organizer" && $person->status == 'active' && $this->verifyOrgActive($type)) {
            $worksFor = WorksFor::model()->findByAttributes(array('email'=>Yii::app()->user->email));
            $organization = Organization::model()->findByPk($worksFor->organizationId);
            Yii::app()->user->setState('currentOrgName', $organization->organizationName);
            $this->redirect(array("/organizer/index"));
        } else {
            // If not one of the 3 userTypes, log out the user
            $this->actionLogout();
        }
        
    }
    
    public function verifyOrgActive($type) {
        $userEmail = Yii::app()->user->email;
        if ($type == 'organizer') {
            $worksFor = WorksFor::model()->findByAttributes(array('email'=>$userEmail));
            $organization = Organization::model()->findByPk($worksFor->organizationId);
            if ($organization->status == 'active') {
                return true;
            }
        } else if ($type == 'volunteer') {
            $worksForArray = WorksFor::model()->findAllByAttributes(array('email'=>$userEmail));
            $count = count($worksForArray);
            for ($i=0;$i<$count;$i++) {
                $organization = Organization::model()->findByPk($worksForArray[$i]->organizationId);
                if ($organization->status == 'active') {
                    Yii::app()->user->setState('defaultOrgId', $organization->id);
                    return true;
                }
            }
 
        }
        
        return false;
    }
        
        

}
