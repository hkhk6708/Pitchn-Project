<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $record = Person::model()->findByAttributes(array('email' => $this->username));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        /*
          else if ($record->password !==crypt ($this->password,'urzyVJvpD7wPbxMFKKGRKgLkukeWBexM3w0XZeleI7SmQCF49efcn4F64fTT
          Ai2K3JZokr6VnJTWaHCLTkQSLo2WxElOKYdehQDpC1aA5BK8ZwHZrfj0Ah2O
          qq52UpdH173TqniWtBqycVBuEHXa7oyBJCgFX7qA0bfVDIiu25UHH3QKk39n
          FSOuTTgJIUdMnVxZiSSk')) */
        else if ($record->password !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $criteria = new CDbCriteria;
            $criteria->order = 'organizationId ASC';
            $worksFor = worksFor::model()->findByAttributes(array('email' => $record->email),$criteria);
            $this->setState('defaultOrgId', $worksFor->organizationId);
            $this->setState('userId', $record->id);
            $this->setState('type', $record->userType);
            $this->setState('realName', $record->name);
            $this->setState('email', $record->email);
//            $this->setState('messageUnreadSeen', "false");
            $this->setState('messageUnreadAnimationSeen', "false");
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

}
