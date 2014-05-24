<?php

class UserImageFM extends CFormModel
{
    public $filename;
    public $tempFilename;

 public function rules()
    {
        return array(
            array('filename', 'required'),
        );
    }
}
?>