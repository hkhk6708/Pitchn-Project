<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RoleTest extends CTestCase {

    private $causeId = null;
    private $skillId = null;
    private $organizationId = null;
    private $personId = null;
    private $personEmail = null;
    private $worksForId = null;

    public function createFakedData() {
        $cause = new Cause;
        $cause->animalWelfare = 1;
        $this->assertTrue($cause->save());
        $this->causeId = $cause->getPrimaryKey();

        $skill = new Skill;
        $skill->accounting = 1;
        $this->assertTrue($skill->save());
        $this->skillId = $skill->getPrimaryKey();

        $organization = new Organization;
        $organization->causeId = $cause->getPrimaryKey();
        $organization->organizationName = 'testOrg';
        $organization->status = 'tested';
        $this->assertTrue($organization->save());
        $this->organizationId = $organization->getPrimaryKey();

        $person = new Person;
        $person->email = 'test@gmail.com';
        $person->causeId = $this->causeId;
        $person->skillId = $this->skillId;
        $person->name = 'Test Kelly';
        $person->password = 'password';
        $person->userType = 'admin';
        $person->registered = 'Y';
        $person->lastActive = date("Y-m-d");
        $person->active = 'Y';
        $person->status = 'test';
        $this->assertTrue($person->save());
        $this->personId = $person->getPrimaryKey();
        $this->personEmail = Person::model()->findByPk($this->personId)->email;

        $worksFor = new WorksFor;
        $worksFor->email = $this->personEmail;
        $worksFor->organizationId = $this->organizationId;
        $this->assertTrue($worksFor->save());
        $this->worksForId = $worksFor->getPrimaryKey();
    }

    public function deleteFakedData() {
        $organizationModel = Organization::model()->findByPk($this->organizationId);
        $causeModel = Cause::model()->findByPk($this->causeId);
        $skillModel = Skill::model()->findByPk($this->skillId);
        $personModel = Person::model()->findByPk($this->personId);
        $worksForModel = WorksFor::model()->findByPk($this->worksForId);
        $worksForModel->delete();
        $organizationModel->delete();
        $personModel->delete();
        $causeModel->delete();
        $skillModel->delete();
    }

    public function testSearchProjectAvailableRoles() {

        $this->createFakedData();
        //Create a project
        $project = new Project;
        $project->setAttributes(array(
            'organizationId' => $this->organizationId,
            'causeId' => $this->causeId,
            'projectName' => 'TestProject',
            'startDate' => date("Y-m-d"),
            'endDate' => date("Y-m-d"),
                ), false);
        $this->assertTrue($project->save());

        $projectId = $project->getPrimaryKey();

        //Create 2 roles under the project, all available
        $role = new Role;
        $role->projectId = $projectId;
        $role->title = "test role";
        $role->roleDescription = 'test description';
        $this->assertTrue($role->save());

        $role2 = new Role;
        $role2->projectId = $projectId;
        $role2->title = "test role 2";
        $role2->roleDescription = 'test description 2';
        $this->assertTrue($role2->save());

        $dataProvider = $role->searchProjectAvailableRoles(array($projectId));
        $dataArray = $dataProvider->getData();

        $this->assertEquals(2, count($dataArray));
        foreach ($dataArray as $data) {
            // no one is assigned to all two roles
            $this->assertTrue(empty($data->personAssignedToRoles));
        }
        $this->deleteFakedData();
    }

    public function testSearchProjectAssignedRoles() {

        $this->createFakedData();
        //Create a project
        $project = new Project;
        $project->setAttributes(array(
            'organizationId' => $this->organizationId,
            'causeId' => $this->causeId,
            'projectName' => 'TestProject',
            'startDate' => date("Y-m-d"),
            'endDate' => date("Y-m-d"),
                ), false);
        $this->assertTrue($project->save());

        $projectId = $project->getPrimaryKey();

        //Create 2 roles under the project, all available
        $role = new Role;
        $role->projectId = $projectId;
        $role->title = "test role";
        $role->roleDescription = 'test description';
        $this->assertTrue($role->save());
        $roleId = $role->getPrimaryKey();

        $role2 = new Role;
        $role2->projectId = $projectId;
        $role2->title = "test role 2";
        $role2->roleDescription = 'test description 2';
        $this->assertTrue($role2->save());

        //Assigned a person to the role 1
        $patr = new PersonAssignedToRole;
        $patr->email = $this->personEmail;
        $patr->roleId = $roleId;
        $this->assertTrue($patr->save());

        $dataProvider = $role->searchProjectAssignedRoles($this->personId, array($projectId));
        $dataArray = $dataProvider->getData();

        // only role 1
        $this->assertEquals(1, count($dataArray));
        foreach ($dataArray as $data) {
            $this->assertEquals($data->personAssignedToRoles->email, $this->personEmail);
            $this->assertTrue(!empty($data->personAssignedToRoles));
        }

        $this->deleteFakedData();
    }

}
