<?php

/**
 * This is the model class for table "pvms.PersonAssignedToRole".
 *
 * The followings are the available columns in table 'pvms.PersonAssignedToRole':
 * @property integer $id
 * @property string $email
 * @property integer $roleId
 *
 * The followings are the available model relations:
 * @property WorksFor $email0
 * @property Role $role
 */
class PersonAssignedToRole extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pvms.PersonAssignedToRole';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, roleId', 'required'),
            array('roleId', 'numerical', 'integerOnly' => true),
            array('email', 'length', 'max' => 255),
            array('email', 'validateEmailExist'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, roleId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'email0' => array(self::BELONGS_TO, 'WorksFor', 'email'),
            'role' => array(self::BELONGS_TO, 'Role', 'roleId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'roleId' => 'Role',
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
        $criteria->compare('roleId', $this->roleId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchAssignedInProjects($projects) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->select = 'email';
        $criteria->with = array(
                    'role');
        $criteria->together = true;
        
        $criteria->addInCondition('projectId', $projects);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PersonAssignedToRole the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Chekc if recipientEmail exists in Person Model
     */
    public function validateEmailExist($attribute, $params) {
        if (!Person::model()->exists('email = :email', array(":email" => $this->email))) {
            $this->addError($attribute, 'This email does not exist.');
        }
    }

}
