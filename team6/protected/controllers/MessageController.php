<?php

class MessageController extends Controller {

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

                /*
                  array('allow',
                  'actions' => array('index', 'view', 'create', 'update', 'delete', 'admin','inbox'),
                  'expression' => "Yii::app()->user->getState('type') ==  'administrator'",
                  ),
                  array('deny', // deny all users
                  'users' => array('*'),
                  ), */
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->user->setState('contentTitle', "Message Details");
        $model = $this->loadModel($id);
        $model->readmsg = 'Y';
        $model->save();
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($receiver) {
        $model = new Message;
        $model->recipientEmail = $receiver;
        $r = Person::model()->findByAttributes(array('email' => $receiver));
        $rName = $r->name;
        Yii::app()->user->setState('contentTitle', 'To: ' . $rName);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Message'])) {
            $model->email = Yii::app()->user->getState('email');
            $model->senderName = Yii::app()->user->getState('realName');
            $model->userType = Yii::app()->user->getState('type');
            $model->date = date("Y-m-d");
            $model->readmsg = 'N';
            $model->attributes = $_POST['Message'];

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
            'rName' => $rName,
        ));
    }

    public function actionAjaxCreate() {
        $model = new Message;
        $model->unsetAttributes();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Message']) && !isset($_POST['recipients'])) {
            Yii::app()->user->setFlash('error', "No Recipients Selected!");
            header("HTTP/1.0 400  Bad Request");
            $this->renderPartial('_ajaxMessage', array(
                    ), false, true);
        }

        if (isset($_POST['Message']) && isset($_POST['recipients'])) {

            $success = true;
            $error = "";

            foreach ($_POST['recipients'] as $to) {
                $newMsg = new Message;
                $newMsg->email = Yii::app()->user->getState('email');
                $newMsg->senderName = Yii::app()->user->getState('realName');
                $newMsg->userType = Yii::app()->user->getState('type');
                $newMsg->date = date("Y-m-d");
                $newMsg->readmsg = 'N';
                $newMsg->attributes = $_POST['Message'];

                $person = Person::model()->findByPK($to);
                $newMsg->recipientEmail = $person->email;


                if ($newMsg->validate()) {
                    $newMsg->save();
                } else {
                    $success = false;
                    $error = CActiveForm::validate($newMsg);
                }
            }


            if ($success) {
                Yii::app()->user->setFlash('success', "Message(s) Sent");
                $this->renderPartial('_ajaxMessage', array(
                        ), false, true);
            } else {
                Yii::app()->user->setFlash('error', "Message(s) Not Sent" . $error);
                header("HTTP/1.0 400  Bad Request");
                $this->renderPartial('_ajaxMessage', array(
                        ), false, true);
            }
        }

        if (!isset($_POST['Message'])) {
            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
            );

            $contacts = array();
            $possibleContacts = array();

            if (Yii::app()->user->getState("type") == 'administrator') {
                $possibleContacts = WorksFor::model()->findAll();
            }

            if (Yii::app()->user->getState("type") == 'organizer') {
                $possibleContacts = WorksFor::model()->findAll('organizationId=:organizationId', array(':organizationId' => Yii::app()->user->getState('defaultOrgId')));
            }

            if (Yii::app()->user->getState("type") == 'volunteer') {
                $volunteerContactPerson = new WorksFor();
                $volunteerContactPeople = $volunteerContactPerson->searchVolunteerMessageContacts(Yii::app()->user->email);
                $possibleContacts = $volunteerContactPeople->getData();
            }

            foreach ($possibleContacts as $contact) {
                $contacts[$contact->email0->id] = $contact->email0->name;
            }

            $preSelect = -1;
            if (isset($_GET['contact'])) {
                $contact = Person::model()->find('email=:email', array(':email' => $_GET['contact'][0]));
                $preSelect = $contact->id;
            }

            $this->renderPartial('_form', array(
                'model' => $model,
                'availableContacts' => $contacts,
                'contactSelect' => $preSelect,
                    ), false, true);
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

        if (isset($_POST['Message'])) {
            $model->attributes = $_POST['Message'];
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
        if ($this->loadModel($id)->delete()) {

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            //if (!isset($_GET['ajax']))
            //    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            $this->redirect(array('inbox'));
        }
    }

    /**
     * Lists all models.
     */
    /*
      public function actionIndex() {
      $dataProvider = new CActiveDataProvider('Message');
      $this->render('index', array(
      'dataProvider' => $dataProvider,
      ));
      } */

    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Sent Messages");
        $models = Message::model()->findAllByAttributes(
                array('email' => Yii::app()->user->getState('email'))
        );

        $dataProvider = new CArrayDataProvider($models, array(
            'id' => 'id',
            'sort' => array(
                'defaultOrder' => 'date DESC',
                'attributes' => array(
                    'recipientEmail',
                    'date',
                ),
            ),
        ));

        $this->render("index", array('dataProvider' => $dataProvider));
    }

    public function actionInbox() {
        Yii::app()->user->setState('contentTitle', "Inbox");
        $models = Message::model()->findAllByAttributes(
                array('recipientEmail' => Yii::app()->user->getState('email'))
        );
        $unreadCount = Message::model()->countByAttributes(
                array('recipientEmail' => Yii::app()->user->getState('email'),
                    'readmsg' => 'N',)
        );

        $dataProvider = new CArrayDataProvider($models, array(
            'id' => 'id',
            'sort' => array(
                'defaultOrder' => 'date DESC',
                'attributes' => array(
                    'senderName',
                    'date',
                ),
            ),
        ));
        $this->render("inbox", array('dataProvider' => $dataProvider, 'count' => $unreadCount,));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Message('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Message']))
            $model->attributes = $_GET['Message'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Message the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Message::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Message $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'message-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Multiple Create
     */
    public function actionMultiCreate() {

        $models = array();
        $models[] = new Message();
        $models[] = new Message();
        $models[] = new Message();
        $models[] = new Message();
        $models[] = new Message();

        if (isset($_POST['Message']) && is_array($_POST['Message'])) {
            foreach ($models as $i => $model) {
                if (isset($_POST['Message'][$i])) {
                    $model->email = Yii::app()->user->getState('email');
                    $model->senderName = Yii::app()->user->getState('realName');
                    $model->userType = Yii::app()->user->getState('type');
                    $model->date = date("Y-m-d");
                    $model->readmsg = 'N';
                    $model->content = $_POST['Content'];
                    $model->attributes = $_POST['Message'][$i];
                    $model->save();
                }
            }
            $this->redirect(array('index'));
        }
        // displays the view to collect tabular input
        $this->render('multiCreate', array('items' => $models));
    }

    public function getRecipientName($data) {
        $email = $data->recipientEmail;
        $person = Person::model()->findByAttributes(array('email' => $email));
        return $person->name;
    }

}
