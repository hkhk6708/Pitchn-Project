<?php
require_once('mail/class.phpmailer.php');
/**
 * This is the model class for table "pvms.Person".
 *
 * The followings are the available columns in table 'pvms.Person':
 * @property integer $id
 * @property string $email
 * @property integer $causeId
 * @property integer $skillId
 * @property string $name
 * @property string $phone
 * @property string $workPhone
 * @property string $password
 * @property integer $permissionLevel
 * @property string $userType
 * @property string $birthdate
 * @property string $locationCity
 * @property string $locationProvince
 * @property string $locationCountry
 * @property string $language
 * @property string $description
 * @property string $registered
 * @property string $lastActive
 * @property string $active
 * @property string $status
 *
 * The followings are the available model relations:
 * @property FreeTime[] $freeTimes
 * @property Message[] $messages
 * @property OrgContact[] $orgContacts
 * @property PComments[] $pComments
 * @property Cause $cause
 * @property TComments[] $tComments
 * @property VolunteerNote[] $volunteerNotes
 * @property VolunteerNote[] $volunteerNotes1
 * @property WorksFor[] $worksFors
 */
class Person extends CActiveRecord {

    public $email;
    public $name;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pvms.Person';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, causeId, skillId, name, password, userType, registered, lastActive, active, status', 'required'),
            array('causeId, skillId, permissionLevel', 'numerical', 'integerOnly' => true),
            array('email, name, locationCity, locationCountry, language, description', 'length', 'max' => 255),
            array('email', 'email', 'message' => 'Email is invalid!'),
            array('email', 'unique', 'message' => 'Email is taken!'),
            array('phone, workPhone, password', 'length', 'max' => 30),
            array('userType', 'length', 'max' => 13),
            array('locationProvince', 'length', 'max' => 2),
            array('registered, active', 'length', 'max' => 1),
            array('status', 'length', 'max' => 12),
            array('birthdate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, causeId, skillId, name, phone, workPhone, password, permissionLevel, userType, birthdate, locationCity, locationProvince, locationCountry, language, description, registered, lastActive, active, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'freeTimes' => array(self::HAS_MANY, 'FreeTime', 'email'),
            'messages' => array(self::HAS_MANY, 'Message', 'email'),
            'orgContacts' => array(self::HAS_MANY, 'OrgContact', 'email'),
            'pComments' => array(self::HAS_MANY, 'PComments', 'email'),
            'cause' => array(self::BELONGS_TO, 'Cause', 'causeId'),
            'tComments' => array(self::HAS_MANY, 'TComments', 'email'),
            'volunteerNotes' => array(self::HAS_MANY, 'VolunteerNote', 'volunteerEmail'),
            'volunteerNotes1' => array(self::HAS_MANY, 'VolunteerNote', 'organizerEmail'),
            'worksFors' => array(self::HAS_MANY, 'WorksFor', 'email'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'causeId' => 'Cause',
            'skillId' => 'Skill',
            'name' => 'Name',
            'phone' => 'Phone',
            'workPhone' => 'Work Phone',
            'password' => 'Password',
            'permissionLevel' => 'Permission Level',
            'userType' => 'User Type',
            'birthdate' => 'Birthdate',
            'locationCity' => 'Location City',
            'locationProvince' => 'Location Province',
            'locationCountry' => 'Location Country',
            'language' => 'Language',
            'description' => 'Additional Info',
            'registered' => 'Registered',
            'lastActive' => 'Last Active',
            'active' => 'Active',
            'status' => 'Status',
        );
    }

    public $keyword;

    //add this new attribute to your search rule
    public function rule() {
        return array(
            //other rules
            array('email','email'),
            array('keyword', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($searchOrgID, $allOrg, $skill, $cause, $freeTime, $projects) {
        $criteria = new CDbCriteria;

        $criteria->select = 'id, email, causeId,skillId,name,phone,workPhone,password,permissionLevel,userType,birthdate,locationCity,locationProvince,locationCountry,language,description,registered,lastActive,active,status';
        $criteria->with = array(
            'worksFors');
        $criteria->together = true;
        
        if (!$allOrg) {
            $criteria->addCondition("worksFors.organizationId = '$searchOrgID'");
        }
        
        $skillMatches = $skill->search();
        $causeMatches = $cause->search();
        $freeTimeMatches = $freeTime->search();
        
        $freeTimePeople = array();
        foreach ($freeTimeMatches->getData() as $a) {
            $freeTimePeople[$a->email0->id] = $a->email0->id;
        }
        
//        var_dump($freeTimePeople);
        
        if ($projects !== null && $projects !== "") {
            $assignedRoles = new PersonAssignedToRole();
            $assignedRoleMatches = $assignedRoles->searchAssignedInProjects($projects);
            $assignedRolePeople = array();
            foreach ($assignedRoleMatches->getData() as $match) {
                $assignedRolePeople[$match->id] = $match->email;
            }
            $criteria->addInCondition('t.email', $assignedRolePeople);
        }
        
        $criteria->addInCondition('skillId', $skillMatches->getKeys());
        $criteria->addInCondition('causeId', $causeMatches->getKeys());
        
        if (($freeTime->startDate !== null  && $freeTime->startDate !== "")
                || $freeTime->startTime !== null && $freeTime->startTime !== ""
                || $freeTime->endDate !== null && $freeTime->endDate !== ""
                || $freeTime->endTime !== null && $freeTime->endTime !== "") {
            $criteria->addInCondition('t.id', $freeTimePeople);
        }
        //echo implode(',', $skillMatches->getKeys());
        //echo implode(',', $causeMatches->getKeys());

        $criteria->compare('name', $this->name, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('locationCity', $this->locationCity, true);
        $criteria->compare('locationProvince', $this->locationProvince, true);
        $criteria->compare('locationCountry', $this->locationCountry, true);
        $criteria->compare('language', $this->language, true);
        
        if ($this->active == 1) {
            $criteria->compare('active', "Y");
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
//            'pagination' => false,
            'pagination'=>array('pageSize'=>25)
        ));
    }

    public function searchByEmail($email) {

        $criteria = new CDbCriteria;

        $criteria->select = 'id, email, causeId,skillId,name,phone,workPhone,password,permissionLevel,userType,birthdate,locationCity,locationProvince,locationCountry,language,description,registered,lastActive,active,status';

        $criteria->compare('email', $email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,));
    }

    public function searchByEmailArray($emailArray) {

        $criteria = new CDbCriteria;

        $criteria->select = 'id, email, causeId,skillId,name,phone,workPhone,password,permissionLevel,userType,birthdate,locationCity,locationProvince,locationCountry,language,description,registered,lastActive,active,status';

        $criteria->compare('email', $emailArray, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,));
    }
    
    public function searchVolunteerContacts() {

        $criteria = new CDbCriteria;
//        $criteria->condition = 
//                '((endDate >= :lowerBound AND startDate < :upperBound AND recurring = "once")'
//                . 'OR (startDate < :upperBound AND recurring <> "once"))'
//                . 'AND email=:email';
        $criteria->with = array(
            'worksFors'=>array('organization'));
        
        $criteria->together = false;
       

        $criteria->compare('email', "lenoxchew@gmail.com", true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,));
    }
    
    public function searchVolunteerOrgContacts()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with = array(
                    'worksFors',
                    'worksFors.organization',
                    'worksFors.organization.projects',
                    'worksFors.organization.projects.roles',
                    'worksFors.organization.projects.roles.personAssignedToRoles',
                    'worksFors.organization.projects.roles.orgcontacts');
                $criteria->together = true;
                $criteria->condition = "organization.id = :oid AND orgcontacts.email = t.email AND personAssignedToRoles.email = :email AND t.email <> :email";
                $criteria->params = array(":oid" => Yii::app()->user->getState('defaultOrgId'), ":email" => Yii::app()->user->email);

//		$criteria->compare('organization.id', Yii::app()->user->getState('defaultOrgId'));
//                $criteria->compare('orgcontacts.email', 't.email');
//		$criteria->compare('personAssignedToRoles.email', Yii::app()->user->email);
//                $criteria->compare('t.email','<>'.Yii::app()->user->email);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
                
                
//                $criteria=new CDbCriteria;
//                $criteria->with = array(
//                    'worksFors',
//                    'worksFors.organization',
//                    'worksFors.organization.projects',
//                    'worksFors.organization.projects.roles',
//                    'worksFors.organization.projects.roles.personAssignedToRoles',
//                    'worksFors.organization.projects.roles.orgcontacts');
//                $criteria->together = true;
//
//		$criteria->compare('organization.id', Yii::app()->user->getState('defaultOrgId'));
//		$criteria->compare('personAssignedToRoles.email', Yii::app()->user->email);
//                $criteria->compare('t.email','<>'.Yii::app()->user->email);
//
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));
	}

    public function sendForgotEmail($name, $email, $tempPassword){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = 'smtp';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        // $mail->Port = 587; 
        // $mail->SMTPSecure = 'tls';


        $mail->Username = "pitchtestmail@gmail.com";
        $mail->Password = "cpsc319team6";

        $mail->IsHTML(true);
        $mail->SingleTo = true;

        $mail->From = "pitchtestmail@gmail.com";
        $mail->FromName = "Pitch'n Support Team";

        $mail->addAddress($email,$name);

        $mail->Subject = "Password Recovery (Pitch'n.ca)";
        $mail->Body = "Hi ".$name."!"."<br />".
        "<h5>It seems that you have forgotten your password.</h5><br/>".
        "Please go to Pitch'n page at <a href="."http://www.pitchn.ca".">www.pitchn.ca</a><br/>".
        "Your Username is: ".$email."<br/>".
        "Your Temporary Password is: ".$tempPassword."<br/>".
        "Please login with the temporary password and change it immediately.<br/><br/><br>".
        "<h5>From our team at Pitch'n, we thank you for using our service! <br/>Have a great 'volunteering' day!</h5>";
        $mail->Send();
    }

    public function sendEmail($name, $email, $password, $orgName, $status='') {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = 'smtp';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        // $mail->Port = 587;
        // $mail->SMTPSecure = 'tls';


        $mail->Username = "pitchtestmail@gmail.com";
        $mail->Password = "cpsc319team6";

        $mail->IsHTML(true);
        $mail->SingleTo = true;

        $mail->From = "pitchtestmail@gmail.com";
        $mail->FromName = "Pitch'n Support Team";

        $mail->addAddress($email,$name);
        $stringimport = "";
        if($orgName != null){
            $stringimport = "You received this email because you have volunteered with ".$orgName.".<br/>".
                $orgName." had upgraded their system with us (Pitch'n Volunteers Management System)".
                "From this point on, you can use our system to manage your volunteering experience with ".$orgName.".<br/>";
        };
        $mail->Subject = "Welcome to Pitch'n.ca!";
        if ($status=='existing') {
              $mail->Body = "Hi ".$name."!"."<br />".
            "<h5>On behalf of Pitch'n volunteer community, we would like to welcome you!</h5><br/>".$stringimport.
            "Please go to the Pitch'n website at <a href="."http://www.pitchn.ca".">www.pitchn.ca</a><br/>".
            "As you are an existing member of Pitch'n, use your existing email/password combination to login. <br/>".
            "To view your information, as it relates to ". $orgName . ", select 'Change Current Organization' from the menu options. <br/>".
            "<h5>From our team at Pitch'n, we thank you for using our service! Have a great 'volunteering' day!</h5>";
        } else {
        $mail->Body = "Hi ".$name."!"."<br />".
            "<h5>On behalf of Pitch'n volunteer community, we would like to welcome you!</h5><br/>".$stringimport.
            "Please go to the Pitch'n website at <a href="."http://www.pitchn.ca".">www.pitchn.ca</a><br/>".
            "Your Username is: ".$email."<br/>".
            "Your Temporary Password is: ".$password."<br/>".
            "Please login with the temporary password and change it immediately.<br/><br/><br>".
            "<h5>From our team at Pitch'n, we thank you for using our service! Have a great 'volunteering' day!</h5>";
        }
        $mail->Send();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Person the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
