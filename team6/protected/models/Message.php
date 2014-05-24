<?php

/**
 * This is the model class for table "pvms.Message".
 *
 * The followings are the available columns in table 'pvms.Message':
 * @property integer $id
 * @property string $email
 * @property string $recipientEmail
 * @property string $senderName
 * @property string $userType
 * @property string $date
 * @property string $content
 * @property string $readmsg
 *
 * The followings are the available model relations:
 * @property Person $email0
 */
class Message extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pvms.Message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email,recipientEmail', 'required'),
            array('email, recipientEmail, senderName', 'length', 'max' => 255),
            array('content', 'length', 'max' => 511),
            array('userType', 'length', 'max' => 20),
            array('readmsg', 'length', 'max' => 1),
            array('date', 'safe'),
            array('recipientEmail','validateEmailExist'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, recipientEmail, senderName, userType, date, content, readmsg', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'email0' => array(self::BELONGS_TO, 'Person', 'email'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'recipientEmail' => 'Recipient Email',
            'senderName' => 'Sender Name',
            'userType' => 'User Type',
            'date' => 'Date',
            'content' => 'Content',
            'readmsg' => 'Readmsg',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('recipientEmail', $this->recipientEmail, true);
        $criteria->compare('senderName', $this->senderName, true);
        $criteria->compare('userType', $this->userType, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('readmsg', $this->readmsg, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Chekc if recipientEmail exists in Person Model
     */
    public function validateEmailExist($attribute,$params) {
        if(!Person::model()->exists('email = :email',array(":email" => $this->recipientEmail))){
            $this->addError($attribute, 'This email does not exist.');
        }
        
    }

}
