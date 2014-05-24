<?php

class ForgotPassword extends CFormModel
{

    public $email;
    
 public function rules()
    {
        return array(
            array('email', 'required'),
        );
    }
    
   
}


