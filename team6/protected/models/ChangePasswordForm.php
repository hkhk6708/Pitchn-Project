<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChangePasswordForm
 *
 * @author Lenox
 */
class ChangePasswordForm extends CFormModel{

    public $oldPassword;
    public $confirmOldPassword;
    public $newPassword;
    public $confirmNewPassword;
    public $person;

    public function rules() {
        return array(
            array('oldPassword confirmOldPassword', 'required', 'on'=>'userAccountNonAdmin'),
            array('newPassword confirmNewPassword', 'required'),
            array('confirmOldPassword', 'compare', 'compareAttribute' => 'oldPassword', 'on'=>'userAccountNonAdmin'),
            array('confirmNewPassword', 'compare', 'compareAttribute' => 'newPassword'),
            array('oldPassword confirmOldPassword newPassword confirmNewPassword', 'length', 'min' => 5),
            array('oldPassword', 'authenticate', 'on'=>'userAccountNonAdmin'),
        );
    }

    /**
     * Authenticates the inputted old password with the actual user's old password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->person->password != $this->oldPassword) {
                $this->addError('oldPassword', 'Old Password is Incorrect.');
            }
        }
    }

    /**
     * Update $person->password to $newPassword
     */
    public function changePassword() {
        $this->person->password = $this->newPassword;
        return $this->person->update();
    }

}
