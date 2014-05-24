<?php

class DataMapping extends CFormModel
{
    public $fileHeadersArray;
    public $fileHeadersArrayCount;
    public $path;
    
    public $email;
    public $name;
    public $phone;
    public $workPhone; 
    public $birthdate; 
    public $locationCity; 
    public $locationProvince; 
    public $locationCountry; 
    public $language; 
    public $description; 
    
 public function rules()
    {
        return array(
            array('email', 'required'),
            array('name', 'required'),
        );
    }
    
    public function decrementAll() {
        $foundZeroIndex = false;
        
        if ($this->email == 0) {
            $foundZeroIndex = true;
        } else {
            $this->email = $this->email - 1;
        }
        
        if ($this->name == 0 && $foundZeroIndex) {
            $this->name = NULL;
        } else if ($this->name == 0 && !$foundZeroIndex) {
            $foundZeroIndex = true;
        } else {
            $this->name = $this->name - 1;
        }
        
        
        if ($this->phone == 0) {
            $this->phone = NULL;
        } else {
            $this->phone = $this->phone - 1;
        }
        
        if ($this->workPhone == 0) {
            $this->workPhone = NULL;
        } else {
            $this->workPhone = $this->workPhone - 1;
        }
        
        if ($this->birthdate == 0) {
            $this->birthdate = NULL;
        } else {
            $this->birthdate = $this->birthdate - 1;
        }
        
        if ($this->locationCity == 0) {
            $this->locationCity = NULL;
        } else {
            $this->locationCity = $this->locationCity - 1;
        }
        
        if ($this->locationProvince == 0) {
            $this->locationProvince = NULL;
        } else {
            $this->locationProvince = $this->locationProvince - 1;
        }
        
        if ($this->locationCountry == 0) {
            $this->locationCountry = NULL;
        } else {
            $this->locationCountry = $this->locationCountry - 1;
        }
                
        if ($this->language == 0) {
            $this->language = NULL;
        } else {
            $this->language = $this->language - 1;
        }
        
        if ($this->description == 0) {
            $this->description = NULL;
        } else {
            $this->description = $this->description - 1;
        }
    }
    /*
     *     public $email;
    public $name;
    public $phone;
    public $workPhone; 
    public $birthdate; 
    public $locationCity; 
    public $locationProvince; 
    public $locationCountry; 
    public $language; 
    public $description; 

     */
    public function setPresets()
    {
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "mail")) {
                $this->email = $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "name")) {
                $this->name = $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "phone")) {
                $this->phone = $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "work")) {
                $this->workPhone = $i;
            }
        }
        
       for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "birth")) {
                $this->birthdate = $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "city")) {
                $this->locationCity= $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "province")) {
                $this->locationProvince = $i;
            }
        }
        
        for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "country")) {
                $this->locationCountry = $i;
            }
        }
        
       for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "lang")) {
                $this->language = $i;
            }
        }
        
       for ($i=0; $i<$this->fileHeadersArrayCount;$i++) {
            if (stristr($this->fileHeadersArray[$i], "desc")) {
                $this->description = $i;
            }
        }
    
    }
}
?>
