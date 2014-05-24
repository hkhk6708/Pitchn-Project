<?php

/**
 * This is the model class for table "pvms.WorksFor".
 *
 * The followings are the available columns in table 'pvms.WorksFor':
 * @property integer $id
 * @property string $email
 * @property integer $organizationId
 *
 * The followings are the available model relations:
 * @property PersonAssignedToRole[] $personAssignedToRoles
 * @property Person $email0
 * @property Organization $organization
 */
class WorksFor extends CActiveRecord
{
        public $organizationId;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.WorksFor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, organizationId', 'required'),
			array('organizationId', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, organizationId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'personAssignedToRoles' => array(self::HAS_MANY, 'PersonAssignedToRole', 'email'),
			'email0' => array(self::BELONGS_TO, 'Person', 'email'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'organizationId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'organizationId' => 'Organization',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('organizationId',$this->organizationId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public $email;
        
        public function searchByEmail()
        {
                $criteria=new CDbCriteria;
                
                $criteria->compare('email', $this->email, true);
                
                return new CActiveDataProvider($this, array (
                        'criteria'=>$criteria,
                ));

        }
        
                public function searchByOrgId()
        {
                $criteria=new CDbCriteria;
                
                $criteria->compare('organizationId', $this->organizationId, true);
                
                return new CActiveDataProvider($this, array (
                        'criteria'=>$criteria,
                ));

        }
        
                
        public function searchVolunteerMessageContacts($pemail)
	{
                $project = new Project();
                $projects = $project->searchVolunteerProjects($pemail);

                $orgContact = new OrgContact();
                $orgContacts = $orgContact->searchVolunteerOrgContacts($pemail);
                
                $criteria=new CDbCriteria;
                $criteria->with = array(
                    'organization',
                    'organization.projects',
                    'organization.projects.roles',
                    'organization.projects.roles.personAssignedToRoles');
                $criteria->together = true;
                $criteria->condition = "(t.organizationid = :oid AND projects.id IN (:projects) AND personAssignedToRoles.email = t.email) OR (t.email IN ('" . implode("','",$orgContacts->getKeys()) . "'))";
                $criteria->params = array(':oid' => Yii::app()->user->getState('defaultOrgId'), ':projects' => implode(",",$projects->getKeys()));

//                $criteria->addInCondition('projects.id', $projects->getKeys());
//		$criteria->compare('t.organizationid', Yii::app()->user->getState('defaultOrgId'));
//		$criteria->compare('personAssignedToRoles.email', $pemail);
//                $criteria->compare('t.email','<>'.Yii::app()->user->email);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        


        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WorksFor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
