<?php

class VolunteerController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setState('contentTitle', "Volunteer Dashboard");

        // find projects
        $criteria = new CDbCriteria;
        $criteria->with = array(
            //'roles',
            'roles.personAssignedToRoles',);
        $criteria->together = true;
        $criteria->condition = "personAssignedToRoles.email = :col_val and organizationId = :col_val2 and status = 'in progress'";
        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'),
            ':col_val2' => Yii::app()->user->getState('defaultOrgId'));

        $projects = Project::model()->findAll($criteria);

        // find tasks
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->with = array(
            'role',
            'role.project',
            'role.personAssignedToRoles');
        $criteria->together = true;
        $criteria->condition = "personAssignedToRoles.email = :col_val and project.organizationId = :col_val2 and t.status <> 'Completed'";
        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'),
            ':col_val2' => Yii::app()->user->getState('defaultOrgId'));

        $tasks = Task::model()->findAll($criteria);

        // find the user model
        $person = Person::model()->find('email=:email', array(':email' => Yii::app()->user->getState('email')));

        $orgContact = new OrgContact();
        $orgContacts = $orgContact->searchVolunteerOrgContacts(Yii::app()->user->email);
        $orgId = Yii::app()->user->getState('defaultOrgId');
        $org = Organization::model()->findByPK($orgId);
        $orgName = $org->organizationName;
        $orgWebsite = $org->website;
        $orgPhone = $org->organizationPhone;

        $dataProvider = new CArrayDataProvider($projects, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $dataProvider2 = new CArrayDataProvider($tasks, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));


        $this->render("index", array('dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'person' => $person,
            'orgName' => $orgName,
            'orgWebsite' => $orgWebsite,
            'orgPhone' => $orgPhone,
            'orgContacts' => $orgContacts));
    }

    public function actionTest($id) {
        Yii::app()->user->setState('defaultOrgId', $id);
        $org = Organization::model()->findByPk($id);
        Yii::app()->user->setState('currentOrgName', $org->organizationName);
        //echo Yii::app()->user->getState('defaultOrgId');
        $this->redirect(array('index'));
    }

    public function actionViewOrganizationList() {
        Yii::app()->user->setState('contentTitle', "Change Organizations");
//        $criteria = new CDbCriteria;
//        $criteria->with = array(
//            'worksFors',);
//        $criteria->together = true;
//        $criteria->condition = "worksFors.email = :col_val";
//        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'));
//
//        $orgs = Organization::model()->findAll($criteria);
        $worksForArray = WorksFor::model()->findAllByAttributes(array('email' => Yii::app()->user->getState('email')));
        $orgs = array();
        for ($i = 0; $i < count($worksForArray); $i++) {
            $org = Organization::model()->findByPk($worksForArray[$i]->organizationId);
            if ($org->status == 'active') {
                array_push($orgs, $org);
            }
        }

        $dataProvider = new CArrayDataProvider($orgs, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        $this->render("viewOrganizationList", array('dataProvider' => $dataProvider));
    }

    public function getTasks($id) {
        /*
          $tasks = Yii::app()->db->createCommand()
          ->select('t.*')
          ->from('task t')
          ->join('role r', 'r.id = t.roleId')
          ->join('personAssignedToRole patr', 'r.id = patr.roleId')
          ->where('patr.email=:email', array(':email' => Yii::app()->user->getState('email')))
          ->andWhere('r.projectId=:id', array(':id' => $id))
          //->group(....)
          //->order(....)
          ->queryAll(); */

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'role',
            'role.personAssignedToRoles');
        $criteria->together = true;
        $criteria->condition = "personAssignedToRoles.email = :col_val and role.projectId = :col_val2";
        $criteria->params = array(':col_val' => Yii::app()->user->getState('email'),
            ':col_val2' => $id);

        $tasks = Task::model()->findAll($criteria);

        $dataProvider = new CArrayDataProvider($tasks, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array('id',),
            ),
        ));

        return $dataProvider;
    }

}
