<?php

class DocumentUpload extends CFormModel
{
    public $filename;
    public $tempFilename;
    
    
 public function rules()
    {
        return array(
            array('email', 'required'),
          
        );
    }
    
}
?>