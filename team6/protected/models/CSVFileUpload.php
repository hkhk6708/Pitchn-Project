<?php

class CSVFileUpload extends CFormModel
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

