<?php

/**
 * This is the model class for table "pvms.Project".
 *
 * The followings are the available columns in table 'pvms.Project':
 * @property integer $id
 * @property integer $organizationId
 * @property integer $causeId
 * @property string $status
 * @property string $startDate
 * @property string $endDate
 * @property string $actualEndDate
 * @property string $projectDescription
 * @property string $city
 * @property string $province
 * @property string $recurring
 * @property string $projectWebsite
 * @property string $projectName
 *
 * The followings are the available model relations:
 * @property File[] $files
 * @property PComments[] $pComments
 * @property Organization $organization
 * @property Cause $cause
 * @property Role[] $roles
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.Project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organizationId, causeId, projectName, startDate, endDate','required'),
			array('organizationId, causeId', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>25),
			array('projectDescription, city, province, projectWebsite, projectName', 'length', 'max'=>255),
			array('recurring', 'length', 'max'=>20),
			array('startDate, endDate, actualEndDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, organizationId, causeId, status, startDate, endDate, actualEndDate, projectDescription, city, province, recurring, projectWebsite, projectName', 'safe', 'on'=>'search'),
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
			'files' => array(self::HAS_MANY, 'File', 'projectId'),
			'pComments' => array(self::HAS_MANY, 'PComments', 'projectId'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'organizationId'),
			'cause' => array(self::BELONGS_TO, 'Cause', 'causeId'),
			'roles' => array(self::HAS_MANY, 'Role', 'projectId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'organizationId' => 'Organization',
			'causeId' => 'Cause',
			'status' => 'Status',
			'startDate' => 'Start Date',
			'endDate' => 'Target End Date',
			'actualEndDate' => 'Actual End Date',
			'projectDescription' => 'Project Description',
			'city' => 'City',
			'province' => 'Province',
			'recurring' => 'Recurring',
			'projectWebsite' => 'Project Website',
			'projectName' => 'Project Name',
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
		$criteria->compare('organizationId',$this->organizationId);
		$criteria->compare('causeId',$this->causeId);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('actualEndDate',$this->actualEndDate,true);
		$criteria->compare('projectDescription',$this->projectDescription,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('recurring',$this->recurring,true);
		$criteria->compare('projectWebsite',$this->projectWebsite,true);
		$criteria->compare('projectName',$this->projectName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchVolunteerProjectsInRange($pemail) {
            $criteria=new CDbCriteria;
            $criteria->join = "LEFT JOIN role r ON t.id = r.projectid LEFT JOIN personassignedtorole p ON r.id = p.roleid LEFT JOIN organization o ON o.id = t.organizationid";
            $criteria->condition = "(actualEndDate >= :lowerBound AND endDate < :upperBound AND p.email = :email)";
            
            $criteria->params = array(":email" => $pemail, ":lowerBound" => $this->startDate, ":upperBound" => $this->endDate);
            $criteria->compare('o.id', Yii::app()->user->getState('defaultOrgId'));

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
        public function searchVolunteerProjects($pemail) {
            $criteria=new CDbCriteria;
            $criteria->join = "LEFT JOIN role r ON t.id = r.projectid LEFT JOIN personassignedtorole p ON r.id = p.roleid LEFT JOIN organization o ON o.id = t.organizationid";

            $criteria->compare('o.id', Yii::app()->user->getState('defaultOrgId'));
            $criteria->compare('p.email', $pemail);

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
