<?php

/**
 * This is the model class for table "pvms.Organization".
 *
 * The followings are the available columns in table 'pvms.Organization':
 * @property integer $id
 * @property integer $causeId
 * @property string $organizationName
 * @property string $status
 * @property string $website
 * @property string $organizationDescription
 * @property string $organizationPhone
 * @property string $contactDetails
 *
 * The followings are the available model relations:
 * @property Cause $cause
 * @property Project[] $projects
 * @property WorksFor[] $worksFors
 */
class Organization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.Organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('causeId, organizationName, status', 'required'),
			array('causeId', 'numerical', 'integerOnly'=>true),
			array('organizationName, website, organizationDescription, organizationPhone, contactDetails', 'length', 'max'=>255),
			array('status', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, causeId, organizationName, status, website, organizationDescription, organizationPhone, contactDetails', 'safe', 'on'=>'search'),
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
			'cause' => array(self::BELONGS_TO, 'Cause', 'causeId'),
			'projects' => array(self::HAS_MANY, 'Project', 'organizationId'),
			'worksFors' => array(self::HAS_MANY, 'WorksFor', 'organizationId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'causeId' => 'Cause',
			'organizationName' => 'Organization Name',
			'status' => 'Status',
			'website' => 'Website',
			'organizationDescription' => 'Organization Description',
			'organizationPhone' => 'Organization Phone',
			'contactDetails' => 'Contact Details',
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
		$criteria->compare('causeId',$this->causeId);
		$criteria->compare('organizationName',$this->organizationName,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('organizationDescription',$this->organizationDescription,true);
		$criteria->compare('organizationPhone',$this->organizationPhone,true);
		$criteria->compare('contactDetails',$this->contactDetails,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Organization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getAllProjectsListData() {
            return CHtml::listData($this->projects, "id", "projectName");
        }
}
