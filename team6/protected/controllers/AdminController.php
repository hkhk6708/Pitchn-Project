<?php

class AdminController extends Controller {

    public function actionChangePassword() {
        $pid = Yii::app()->getRequest()->getParam('id');
        $model = Person::model()->find('id=:id', array(':id' => $pid));

        if ($pid != null && $model != null) {

            $this->render('changePassword', array('model' => $model));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

//        public function actionGetUpdateUrl() {
//
//        return 'Yii::app()->controller->createUrl("admin/changePassword", array("id"=>$data["id"]))';
//    }
//        
//        public function actionGetPeople() {
//        $user = Yii::app()->user;
//        $connection = Yii::app()->db;
//        $sql = 
//                "SELECT * "
//                . "FROM Person p";
//        $command = $connection->createCommand($sql);
//        $rows = $command->queryAll();
//        
//        $dataProvider = new CArrayDataProvider($rows, array(
//            'id' => 'id',
//            'keyField' => 'id',
//            'sort' => array(
//                'attributes' => array(
//                    'id', 'name', 'email',
//                ),
//            ),
//            'pagination' => array(
//                'pageSize' => 10,
//        )));
//
//        return $dataProvider;
//    }

    public function getOrganizationViewUrl() {
        return 'Yii::app()->controller->createUrl("admin/viewOrganization", array("id"=>$data["id"]))';
    }

    public function getAccountViewUrl() {
        return 'Yii::app()->controller->createUrl("admin/viewAccount", array("id"=>$data["id"]))';
    }

    public function actionEditOrganization() {
        $oid = Yii::app()->getRequest()->getParam('id');
        $model = Organization::model()->find('id=:id', array(':id' => $oid));

        if ($oid != null && $model != null) {

            $this->render('editOrganization', array('model' => $model));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Admin Dashboard");
        $models = Organization::model()->findAll();

        if ($models != null) {
            $dataProvider = new CArrayDataProvider($models, array(
                'id' => 'id',
                'keyField' => 'id',
                'sort' => array(
                    'attributes' => array(
                        'id', 'organizationName',
                    ),
                ),
                'pagination' => array(
                    'pageSize' => 10,
            )));

            $person_count = 0;
            $org_count = 0;
            $pwproject = 0;
            $pwoproject = 0;
            $activeUser = 0;
            $activeOrg = 0;
            $numProject = 0;

            // find all volunteers
            $criteria = new CDbCriteria;
            $criteria->condition = 'userType = "volunteer"';
            $personResult = Person::model()->findAll($criteria);
            $person_count = count($personResult);

            // find all organizations
            $orgResult = Organization::model()->findAll();
            $org_count = count($orgResult);

            // get all volunteer has a role in a project
            $criteria = new CDbCriteria;
            $criteria->alias = 'Patr';
            $criteria->select = 'Patr.email';
            $criteria->with = array('role', 'role.project', 'role.project.organization',);
            $criteria->join = 'INNER JOIN Person ON Person.email = Patr.email';
            $criteria->together = true;
            $criteria->condition = 'Person.userType = :col_val2';
            $criteria->params = array(':col_val2' => 'volunteer');
            $criteria->group = 'Patr.email';
            $pwpResult = PersonAssignedToRole::model()->findAll($criteria);
            $pwproject = count($pwpResult);
            $pwoproject = intval($person_count) - intval($pwproject);

            // all active volunteers
            $criteria = new CDbCriteria;
            $criteria->condition = 'active = "Y" and userType = "volunteer"';
            $result = Person::model()->findAll($criteria);
            $activeUser = count($result);

            // all active organizations
            $criteria = new CDbCriteria;
            $criteria->condition = 'status = "active"';
            $result = Organization::model()->findAll($criteria);
            $activeOrg = count($result);

            // All Projects
            $numProResult = Project::model()->findAll();
            $numProject = count($numProResult);

            $SystemData = array($person_count, $org_count, $pwproject, $pwoproject, $activeUser, $activeOrg, $numProject);

            $this->render('index', array('model' => $dataProvider, 'SystemData' => $SystemData));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionViewOrganizationList() {
        $models = Organization::model()->findAll();

        $dataProvider = new CArrayDataProvider($models, array(
            'id' => 'id',
            'keyField' => 'id',
            'sort' => array(
                'attributes' => array(
                    'id', 'organizationName',
                ),
            ),
        ));

        $this->render('viewOrganizationList', array('model' => $dataProvider));
    }

    public function actionViewAccount() {
        $pid = Yii::app()->getRequest()->getParam('id');
        $model = Person::model()->find('id=:id', array(':id' => $pid));

        if ($pid != null && $model != null) {

            $this->render('viewAccount', array('model' => $model));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionViewAccountList() {
        $models = Person::model()->findAll();

        if ($models != null) {

            $dataProvider = new CArrayDataProvider($models, array(
                'id' => 'id',
                'keyField' => 'id',
                'sort' => array(
                    'attributes' => array(
                        'id', 'name', 'email',
                    ),
                ),
                'pagination' => array(
                    'pageSize' => 10,
            )));

            $this->render('viewAccountList', array('model' => $dataProvider));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionViewOrganization() {
        $oid = Yii::app()->getRequest()->getParam('id');
        $model = Organization::model()->find('id=:id', array(':id' => $oid));

        if ($oid != null && $model != null) {

            $this->render('viewOrganization', array('model' => $model));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionViewReports() {
        Yii::app()->user->setState('contentTitle', "Admin Reports");
        $person_count = 0;
        $org_count = 0;
        $pwproject = 0;
        $pwoproject = 0;
        $activeUser = 0;
        $activeOrg = 0;
        $numProject = 0;

        // find all volunteers
        $criteria = new CDbCriteria;
        $criteria->condition = 'userType = "volunteer"';
        $personResult = Person::model()->findAll($criteria);
        $person_count = count($personResult);

        // find all organizations
        $orgResult = Organization::model()->findAll();
        $org_count = count($orgResult);

        // get all volunteer has a role in a project
        $criteria = new CDbCriteria;
        $criteria->alias = 'Patr';
        $criteria->select = 'Patr.email';
        $criteria->with = array('role', 'role.project', 'role.project.organization',);
        $criteria->join = 'INNER JOIN Person ON Person.email = Patr.email';
        $criteria->together = true;
        $criteria->condition = 'Person.userType = :col_val2';
        $criteria->params = array(':col_val2' => 'volunteer');
        $criteria->group = 'Patr.email';
        $pwpResult = PersonAssignedToRole::model()->findAll($criteria);
        $pwproject = count($pwpResult);
        $pwoproject = intval($person_count) - intval($pwproject);

        // all active volunteers
        $criteria = new CDbCriteria;
        $criteria->condition = 'active = "Y" and userType = "volunteer"';
        $result = Person::model()->findAll($criteria);
        $activeUser = count($result);

        // all active organizations
        $criteria = new CDbCriteria;
        $criteria->condition = 'status = "active"';
        $result = Organization::model()->findAll($criteria);
        $activeOrg = count($result);

        // All Projects
        $numProResult = Project::model()->findAll();
        $numProject = count($numProResult);



        $SystemData = array($person_count, $org_count, $pwproject, $pwoproject, $activeUser, $activeOrg, $numProject);


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
