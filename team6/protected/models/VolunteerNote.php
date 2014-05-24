<?php

/**
 * This is the model class for table "pvms.VolunteerNote".
 *
 * The followings are the available columns in table 'pvms.VolunteerNote':
 * @property integer $id
 * @property string $volunteerEmail
 * @property string $organizerEmail
 * @property integer $organizationId
 * @property string $dateTime
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Person $volunteerEmail0
 * @property Person $organizerEmail0
 */
class VolunteerNote extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.VolunteerNote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('volunteerEmail, organizerEmail, organizationId, dateTime', 'required'),
			array('organizationId', 'numerical', 'integerOnly'=>true),
			array('volunteerEmail, organizerEmail, content', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, volunteerEmail, organizerEmail, organizationId, dateTime, content', 'safe', 'on'=>'search'),
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
			'volunteerEmail0' => array(self::BELONGS_TO, 'Person', 'volunteerEmail'),
			'organizerEmail0' => array(self::BELONGS_TO, 'Person', 'organizerEmail'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'volunteerEmail' => 'Volunteer Email',
			'organizerEmail' => 'Organizer Email',
			'organizationId' => 'Organization',
			'dateTime' => 'Date Time',
			'content' => 'Content',
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
		$criteria->compare('volunteerEmail',$this->volunteerEmail,true);
		$criteria->compare('organizerEmail',$this->organizerEmail,true);
		$criteria->compare('organizationId',$this->organizationId);
		$criteria->compare('dateTime',$this->dateTime,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VolunteerNote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
