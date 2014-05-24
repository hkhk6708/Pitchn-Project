<?php

/**
 * This is the model class for table "pvms.Task".
 *
 * The followings are the available columns in table 'pvms.Task':
 * @property integer $id
 * @property integer $roleId
 * @property string $taskName
 * @property string $status
 * @property integer $timeSpent
 * @property integer $estCompTime
 * @property integer $completion
 * @property string $taskDescription
 * @property string $startDate
 * @property string $endDate
 *
 * The followings are the available model relations:
 * @property Role $role
 * @property Tcomments[] $tcomments
 */
class Task extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pvms.Task';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('roleId, timeSpent, estCompTime, completion', 'numerical', 'integerOnly' => true),
            array('completion', 'numerical', 'max' => 100, 'min' => 0),
            array('taskName, status, taskDescription', 'length', 'max' => 255),
            array('startDate, endDate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, roleId, taskName, status, timeSpent, estCompTime, completion, taskDescription, startDate, endDate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'roleId'),
            'tcomments' => array(self::HAS_MANY, 'Tcomments', 'taskId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'roleId' => 'Role',
            'taskName' => 'Task Name',
            'status' => 'Status',
            'timeSpent' => 'Time Spent (hrs.)',
            'estCompTime' => 'Est Comp Time',
            'completion' => 'Completion Progress (%)',
            'taskDescription' => 'Task Description',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchVolunteerProjectsTasks($pemail) {
            $criteria=new CDbCriteria;
            $criteria->join = "LEFT JOIN role r ON t.roleid = r.id LEFT JOIN personassignedtorole p ON r.id = p.roleid LEFT JOIN project pr ON pr.id = r.projectid LEFT JOIN organization o ON o.id = pr.organizationid";
            $criteria->condition = "(t.endDate >= :lowerBound AND t.startDate < :upperBound AND p.email = :email)";
            
            $criteria->params = array(":email" => $pemail, ":lowerBound" => $this->startDate, ":upperBound" => $this->endDate);
            $criteria->compare('o.id', Yii::app()->user->getState('defaultOrgId'));


            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Task the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
