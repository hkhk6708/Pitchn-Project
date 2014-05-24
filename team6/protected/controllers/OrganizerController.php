<?php

class OrganizerController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Organizer Dashboard");

        // get projects data
        $projects = Project::model()->findAllByAttributes(array('organizationId' => Yii::app()->user->getState('defaultOrgId'),
            'status' => 'in progress',));

        $dataProvider = new CArrayDataProvider($projects, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        // initalize the count
        $person_count = 0;
        $pwproject = 0;
        $pwoproject = 0;
        $activeUser = 0;
        $numProject = 0;

        // get all volunteers in the project
        $criteria = new CDbCriteria;
        $criteria->with = array('worksFors');
        $criteria->together = true;
        $criteria->condition = 'worksFors.organizationId = :col_val and userType = "volunteer"';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'));
        $personResult = Person::model()->findAll($criteria);
        $person_count = count($personResult);

        // get all volunteer has a role in a project
        $criteria = new CDbCriteria;
        $criteria->alias = 'Patr';
        $criteria->select = 'Patr.email';
        $criteria->with = array('role', 'role.project', 'role.project.organization',);
        $criteria->join = 'INNER JOIN Person ON Person.email = Patr.email';
        $criteria->together = true;
        $criteria->condition = 'organization.id = :col_val and Person.userType = :col_val2';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'),
            ':col_val2' => 'volunteer');
        $criteria->group = 'Patr.email';
        $pwpResult = PersonAssignedToRole::model()->findAll($criteria);
        $pwproject = count($pwpResult);
        $pwoproject = intval($person_count) - intval($pwproject);

        // get all active volunteers
        $criteria = new CDbCriteria;
        $criteria->with = array('worksFors');
        $criteria->together = true;
        $criteria->condition = 'worksFors.organizationId = :col_val and active = "Y" AND userType = "volunteer"';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'));
        $result = Person::model()->findAll($criteria);
        $activeUser = count($result);

        $SystemData = array($person_count, $pwproject, $pwoproject, $activeUser);

        $this->render("index", array('dataProvider' => $dataProvider, 'SystemData' => $SystemData));
    }

   

    public function actionViewReports() {
        Yii::app()->user->setState('contentTitle', "Organization Reports");

        // initalize the count
        $person_count = 0;
        $pwproject = 0;
        $pwoproject = 0;
        $activeUser = 0;
        $numProject = 0;

        // get all volunteers in the project
        $criteria = new CDbCriteria;
        $criteria->with = array('worksFors');
        $criteria->together = true;
        $criteria->condition = 'worksFors.organizationId = :col_val and userType = "volunteer"';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'));
        $personResult = Person::model()->findAll($criteria);
        $person_count = count($personResult);

        // get all volunteer has a role in a project
        $criteria = new CDbCriteria;
        $criteria->alias = 'Patr';
        $criteria->select = 'Patr.email';
        $criteria->with = array('role', 'role.project', 'role.project.organization',);
        $criteria->join = 'INNER JOIN Person ON Person.email = Patr.email';
        $criteria->together = true;
        $criteria->condition = 'organization.id = :col_val and Person.userType = :col_val2';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'),
            ':col_val2' => 'volunteer');
        $criteria->group = 'Patr.email';
        $pwpResult = PersonAssignedToRole::model()->findAll($criteria);
        $pwproject = count($pwpResult);
        $pwoproject = intval($person_count) - intval($pwproject);

        // get all active volunteers
        $criteria = new CDbCriteria;
        $criteria->with = array('worksFors');
        $criteria->together = true;
        $criteria->condition = 'worksFors.organizationId = :col_val and active = "Y" AND userType = "volunteer"';
        $criteria->params = array(':col_val' => Yii::app()->user->getState('defaultOrgId'));
        $result = Person::model()->findAll($criteria);
        $activeUser = count($result);

        $SystemData = array($person_count, $pwproject, $pwoproject, $activeUser);

        if ($SystemData != null) {
            $this->render('viewReports', array('SystemData' => $SystemData));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function getHostFromCS($connectionString) {
        $array = explode("=", $connectionString);
        $array2 = explode(";", $array[1]);
        $host = $array2[0];
        return $host;
    }

    public function getDBNameFromCS($connectionString) {
        $array = explode("=", $connectionString);
        $count = count($array);
        $dbName = $array[$count - 1];
        return $dbName;
    }

}
