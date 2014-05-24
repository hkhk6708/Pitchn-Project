<?php

/**
 * This is the model class for table "pvms.OrgContact".
 *
 * The followings are the available columns in table 'pvms.OrgContact':
 * @property integer $id
 * @property string $email
 * @property integer $roleId
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Person $email0
 * @property Role $role
 */
class OrgContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.OrgContact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, roleId', 'required'),
			array('roleId', 'numerical', 'integerOnly'=>true),
			array('email, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, roleId, title', 'safe', 'on'=>'search'),
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
			'email0' => array(self::BELONGS_TO, 'Person', 'email'),
			'role' => array(self::BELONGS_TO, 'Role', 'roleId'),
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
			'roleId' => 'Role',
			'title' => 'Title',
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
		$criteria->compare('roleId',$this->roleId);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchVolunteerOrgContacts($pemail)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with = array(
                    'role',
                    'role.project',
                    'role.personAssignedToRoles',
                    'role.project.organization',
                    'email0');
                $criteria->together = true;

		$criteria->compare('organization.id', Yii::app()->user->getState('defaultOrgId'));
		$criteria->compare('personAssignedToRoles.email', $pemail);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'keyAttribute'=>'email',
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrgContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
