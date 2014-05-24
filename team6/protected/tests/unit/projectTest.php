<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProjectTest extends CTestCase {

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

    public function testCreateAndProjectProject() {

        $this->createFakedData();
        //Test to create a project
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

        //Test to create a role under the project
        $role = new Role;
        $role->projectId = $projectId;
        $role->title = "test role";
        $role->roleDescription = 'test description';
        $this->assertTrue($role->save());
        $roleId = $role->getPrimaryKey();

        //Test to create a pcomment
        $pcom = new PComments;
        $pcom->content = 'test';
        $pcom->projectId = $projectId;
        $pcom->email = $this->personEmail;
        $this->assertTrue($pcom->save());
        $pcomId = $pcom->getPrimaryKey();

        //Test to create an Ob note
        $ob = new Ob;
        $ob->content = 'test';
        $ob->roleId = $roleId;
        $this->assertTrue($ob->save());
        $obId = $ob->getPrimaryKey();

        //Test to create an Org Contact
        $orgC = new OrgContact;
        $orgC->email = $this->personEmail;
        $orgC->roleId = $roleId;
        $this->assertTrue($orgC->save());
        $orgCId = $orgC->getPrimaryKey();

        //Test to create a PATR
        $patr = new PersonAssignedToRole;
        $patr->email = $this->personEmail;
        $patr->roleId = $roleId;
        $this->assertTrue($patr->save());
        $patrId = $patr->getPrimaryKey();

        //Test to create a task 
        $task = new Task;
        $task->roleId = $roleId;
        $this->assertTrue($task->save());
        $taskId = $task->getPrimaryKey();

        //Test to create a pcomment
        $tcom = new TComments;
        $tcom->content = 'test';
        $tcom->taskId = $taskId;
        $tcom->email = $this->personEmail;
        $this->assertTrue($tcom->save());
        $tcomId = $tcom->getPrimaryKey();

        // Delete the Project should delete Roles, Tasks, Ob(Onboarding note), OrgContacts, PersnAssigendToRole, PComments, TComments
        $projectModel = Project::model()->findByPk($projectId);
        $projectModel->delete();

        //reload the models
        $projectModel = Project::model()->findByPk($projectId);
        $roleModel = Role::model()->findByPk($roleId);
        $taskModel = Task::model()->findByPk($taskId);
        $obModel = Ob::model()->findByPk($obId);
        $orgCModel = OrgContact::model()->findByPk($orgCId);
        $patrModel = PersonAssignedToRole::model()->findByPk($patrId);
        $pcomModel = PComments::model()->findByPk($pcomId);
        $tcomModel = TComments::model()->findByPk($tcomId);
        $this->assertTrue(empty($tcomModel));
        $this->assertTrue(empty($pcomModel));
        $this->assertTrue(empty($patrModel));
        $this->assertTrue(empty($orgCModel));
        $this->assertTrue(empty($obModel));
        $this->assertTrue(empty($projectModel));
        $this->assertTrue(empty($roleModel));
        $this->assertTrue(empty($taskModel));
        
        //worksFor should still remain in database
        $this->assertTrue(WorksFor::model()->exists('id = :id',array(":id" => $this->worksForId)));

        $this->deleteFakedData();
    }

}
?>
