<?php

class CalendarController extends Controller {

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
        $person = Person::model()->find('id=:id', array(':id' => $id));
        Yii::app()->user->setState('contentTitle', "Calendar - " . $person->name);
        //$freeTimes = $this->actionFetchFreeTimeData($person->id, date('Y-m-d'), date('Y-m-d'));
        $editable = "false";
        
        if ($person->email === Yii::app()->user->getState("email")) {
            $editable = "true";
        }
        
        $this->render('view', array(
            //'freeTimes' => $freeTimes,
            'person' => $person,
            'editable' => $editable,
        ));
    }

    /**
     * Displays currently logged in user's calendar.
     */
    public function actionIndex() {
        $person = Person::model()->find('email=:email', array(':email' => Yii::app()->user->email));
        $this->actionView($person->id);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return WorksFor the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Person::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpdate($id) {
        $freeTime = FreeTime::model()->find('id=:id', array(':id' => $id));
        $person = Person::model()->find('email=:email', array(':email' => $freeTime->email));

        if (isset($_POST['Delete'])) {
            $this->actionDelete($id);
        }
        
        if (isset($_POST['FreeTime'])) {
            $freeTime->attributes = $_POST['FreeTime'];
            
            if (!$freeTime->validate()) {
                $error = CActiveForm::validate($freeTime);
                Yii::app()->user->setFlash('error', $error);
                $this->redirect(array('Calendar/View', 'id' => $person->id));
            } else {
                if ($freeTime->save()) {
                    $this->redirect(array('Calendar/View', 'id' => $person->id));
//                Yii::app()->user->setFlash('success', 'Success');
//                    $this->renderPartial('_ajax', array(
//                ), false, true);
                    
                }
            }
        }
//        } else {

        $this->renderPartial('update', array(
            'model' => $freeTime,
                ), false, true);
//        }
    }
    
    public function actionMoveFreeTime() {
        if (isset($_POST['id'])) {
            $freeTime = FreeTime::model()->find('id=:id', array(':id' => $_POST['id']));
            $person = Person::model()->find('email=:email', array(':email' => $freeTime->email));
            
            $startDate = $freeTime->startDate . $freeTime->startTime;
            $endDate = $freeTime->endDate . $freeTime->endTime;
            
            $dateTime = strtotime($startDate) + 60*60*24*$_POST['dayDelta'] + 60*$_POST['minuteDelta'];
            $freeTime->startDate = date('Y-m-d', $dateTime);
            $freeTime->startTime = date('H:i:s', $dateTime);
            
            $dateTime = strtotime($endDate) + 60*60*24*$_POST['dayDelta'] + 60*$_POST['minuteDelta'];
            $freeTime->endDate = date('Y-m-d', $dateTime);
            $freeTime->endTime = date('H:i:s', $dateTime);
            
            if (!$freeTime->validate()) {
                $error = CActiveForm::validate($freeTime);
                Yii::app()->user->setFlash('error', $error);
                //$this->redirect(array('Calendar/View', 'id' => $person->id));
            } else {
            if ($freeTime->save()) {
                //$this->redirect(array('Calendar/View', 'id' => $person->id));
                Yii::app()->user->setFlash('success', "Updated Calendar");
                }
            }
            
           
            
//            if (!$freeTime->validate()) {
//                $error = CActiveForm::validate($freeTime);
//                Yii::app()->user->setFlash('error', $error);
//                $this->redirect(array('Calendar/View', 'id' => $person->id));
//            } else {
//                if ($freeTime->save()) {
//                    $this->redirect(array('Calendar/View', 'id' => $person->id));
//                }
//            }
        }
        $this->renderPartial('_ajax', array(
                ), false, true);
    }
    
        
    public function actionResizeFreeTime() {
        if (isset($_POST['id'])) {
            $freeTime = FreeTime::model()->find('id=:id', array(':id' => $_POST['id']));
            $person = Person::model()->find('email=:email', array(':email' => $freeTime->email));

            $endDate = $freeTime->endDate . $freeTime->endTime;  
            $dateTime = strtotime($endDate) + 60*60*24*$_POST['dayDelta'] + 60*$_POST['minuteDelta'];
            $freeTime->endDate = date('Y-m-d', $dateTime);
            $freeTime->endTime = date('H:i:s', $dateTime);
            
            if (!$freeTime->validate()) {
                $error = CActiveForm::validate($freeTime);
                Yii::app()->user->setFlash('error', $error);
                //$this->redirect(array('Calendar/View', 'id' => $person->id));
            } else {
            if ($freeTime->save()) {
                //$this->redirect(array('Calendar/View', 'id' => $person->id));
                Yii::app()->user->setFlash('success', "Updated Calendar");
                }
            }
        }
        $this->renderPartial('_ajax', array(
                ), false, true);
    }
    

    public function actionCreate($id, $startDate, $startTime, $endDate, $endTime) {
        $freeTime = new FreeTime;
        $freeTime->startDate = $startDate;
        $freeTime->endDate = $endDate;
        $freeTime->recurring = "once";
        
        $freeTime->startTime = $startTime;
        if ($startTime === $endTime && $startTime === "00:00:00") {
            $freeTime->endTime = "23:59:00";
        } else {
            $freeTime->endTime = $endTime;
        }

        $person = Person::model()->find('id=:id', array(':id' => $id));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FreeTime'])) {
            $freeTime->attributes = $_POST['FreeTime'];
            $freeTime->email = $person->email;
            
            if (!$freeTime->validate()) {
                $error = CActiveForm::validate($freeTime);
                Yii::app()->user->setFlash('error', $error);
                $this->redirect(array('Calendar/View', 'id' => $person->id));
            } else {
            if ($freeTime->save()) {
                $this->redirect(array('Calendar/View', 'id' => $person->id));
                }
            }
        }

        $this->renderPartial('create', array(
            'model' => $freeTime,
                ), false, true);
    }
    
    /**
     * Deletes a particular model.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $freeTime = FreeTime::model()->find('id=:id', array(':id' => $id));
        $person = Person::model()->find('email=:email', array(':email' => $freeTime->email));
        $freeTime->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('Calendar/View', 'id' => $person->id));
    
//        if (isset($_POST['id'])) {
//        $freeTime = FreeTime::model()->find('id=:id', array(':id' => $_POST['id']));
//        $person = Person::model()->find('email=:email', array(':email' => $freeTime->email));
//        
//        //$freeTime->delete();
//        Yii::app()->user->setFlash('success', "Deleted Slot");
//
//        $this->renderPartial('_ajax', array(
//                ), false, true);
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        //if (!isset($_GET['ajax']))
//            //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('Calendar/View', 'id' => $person->id));
//        }
    }
    
    /**
     * Performs the AJAX validation.
     * @param OrgContact $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'manage-event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    /**
     * Constructs FullCalendar Event data for all free times that are within the specified date's month
     * @param $id person ID of calendar's owner
     *        $Date All freeTimes that lie within this date's month will be constructed to event data
     * @return $freeTimes The constructed event data
     */
    public function actionFetchFreeTimeData($id, $startDate, $startTime, $endDate, $endTime) {

        $person = Person::model()->find('id=:id', array(':id' => $id));
        
        $criteria = new CDbCriteria();
        $criteria->condition = 
                '((endDate >= :lowerBound AND startDate < :upperBound AND recurring = "once")'
                . 'OR (startDate < :upperBound AND recurring <> "once"))'
                . 'AND email=:email';
        $criteria->params = array(':lowerBound' => $startDate, ':upperBound' => $endDate ,':email'=>$person->email);
        $models = FreeTime::model()->findAll($criteria);

        $freeTimes = array();
        $start = new DateTime($startDate . ' ' . $startTime);
        $end = new DateTime($endDate . ' ' . $endTime);
        $idTag = 1;
        
        foreach ($models as $freeTime) {
            $allDay = false;
            $title = " Available";
            $recurringTag = "";
            $id = "availableEvent" . $idTag;

            if ($freeTime->startTime === "00:00:00" && $freeTime->endTime === "23:59:00") {
                $allDay = true;
                $title = "All Day Available";
            }

            $slot = array(
                'id' => $id,
                'className' => 'availableEvent',
                'allDay' => $allDay,
                'model' => json_encode($freeTime->attributes));

            $interval;
            $recurrences;
            $startDate = new DateTime($freeTime->startDate . ' ' . $freeTime->startTime);
            $endDate = new DateTime($freeTime->endDate . ' ' . $freeTime->endTime);

            switch ($freeTime->recurring) {
                case "once":
                    $interval = new DateInterval('P1D');
                    $recurrences = 0;
                    break;
                case "daily":
                    $interval = new DateInterval('P1D');
                    $recurrences = $startDate->diff($end)->format('%a');
                    $recurringTag = "(D)";
                    break;
                case "weekly":
                    $interval = new DateInterval('P1W');
                    $recurrences = $startDate->diff($end)->format('%a');
                    $recurrences = $recurrences/7;
                    $recurringTag = "(W)";
                    break;
                case "monthly":
                    $interval = new DateInterval('P1M');
                    $recurrences = $startDate->diff($end)->format('%m');
                    $recurringTag = "(M)";
                    break;
                case "yearly":
                    $interval = new DateInterval('P1Y');
                    $recurrences = $startDate->diff($end)->format('%y');
                    $recurringTag = "(Y)";
                    break;
                default:
                    $interval = new DateInterval('P1D');
                    $recurrences = 0;
                    $recurringTag = "(Error)";
            }
            
            $slot['title'] = $title . " " . $recurringTag;
            $slot['rtag'] = $recurringTag;

            $dateRange = new DatePeriod($startDate, $interval, $recurrences);
            foreach ($dateRange as $date) {
                
                if ($endDate >= $start && $date < $end) {
                    $slot['start'] = $date->format('Y-m-d H:i:s');
                    $slot['end'] = $endDate->format('Y-m-d H:i:s');
                    $freeTimes[] = $slot;
                }
                
                $endDate = $endDate->add($interval);
            }
            
             $idTag++;
        }

        echo CJSON::encode($freeTimes);
    }
    
    public function actionFetchProjectEndData($id, $startDate, $startTime, $endDate, $endTime) {
        $project = new Project();
        $project->startDate = $startDate;
        $project->endDate = $endDate;
        $person = Person::model()->findByPk($id);
        $projects = $project->searchVolunteerProjectsInRange($person->email);
        $projectEndTimes = array();
        date_default_timezone_set('America/Vancouver');
        foreach ($projects->getData() as $project) {
             $today = new DateTime(date('Y-m-d'));
             $difference = $today->diff(new DateTime($project->actualEndDate))->format('%a');
             $slot = array(
                'className' => 'projectEvent',
                 'title' => "Project " . $project->projectName . " (Target - Actual End Date) " . $difference . " Days Left",
                 'allDay' => 'false',
                 'start' => $project->endDate,
                 'end' => $project->actualEndDate,
                 'editable' => false
                 );
             $projectEndTimes[] = $slot;
        }
        
        echo CJSON::encode($projectEndTimes);
    }
    
    public function actionFetchTaskEndData($id, $startDate, $startTime, $endDate, $endTime) {
        $task = new Task();
        $task->startDate = $startDate;
        $task->endDate = $endDate;
        $person = Person::model()->findByPk($id);
        $tasks = $task->searchVolunteerProjectsTasks($person->email);
        $taskEndTimes = array();
        date_default_timezone_set('America/Vancouver');
        foreach ($tasks->getData() as $task) {
            $today = new DateTime(date('Y-m-d'));
            $difference = $today->diff(new DateTime($task->endDate))->format('%a');
             $slot = array(
                'className' => 'taskEvent',
                 'title' => "(" . $task->role->project->projectName . ") Task " . $task->taskName . " " . $difference . " Days Left",
                 'allDay' => 'false',
                 'start' => $task->endDate,
                 'end' => $task->endDate,
                 'editable' => false
                 );
             $taskEndTimes[] = $slot;
        }
        
        echo CJSON::encode($taskEndTimes);
    }

}
