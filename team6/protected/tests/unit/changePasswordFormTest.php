<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ChangePasswordFormTest extends CTestCase {

    private $causeId = null;
    private $skillId = null;
    private $personId = null;
    private $personEmail = null;

    public function createFakedData() {
        $cause = new Cause;
        $cause->animalWelfare = 1;
        $this->assertTrue($cause->save());
        $this->causeId = $cause->getPrimaryKey();

        $skill = new Skill;
        $skill->accounting = 1;
        $this->assertTrue($skill->save());
        $this->skillId = $skill->getPrimaryKey();

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
    }

    public function deleteFakedData() {
        $causeModel = Cause::model()->findByPk($this->causeId);
        $skillModel = Skill::model()->findByPk($this->skillId);
        $personModel = Person::model()->findByPk($this->personId);
        $personModel->delete();
        $causeModel->delete();
        $skillModel->delete();
    }

    public function testChangePassword() {

        $this->createFakedData();

        $model = new ChangePasswordForm();
        $model->oldPassword = Person::model()->findByPk($this->personId)->password;
        $model->confirmOldPassword = Person::model()->findByPk($this->personId)->password;
        $model->newPassword = 'newpass';
        $model->confirmNewPassword = 'newpass';
        $model->person = Person::model()->findByPk($this->personId);

        $model->changePassword();

        $this->assertEquals('newpass', Person::model()->findByPk($this->personId)->password);

        $this->deleteFakedData();
    }

}
