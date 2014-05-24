<?php

/**
 * This is the model class for table "pvms.FreeTime".
 *
 * The followings are the available columns in table 'pvms.FreeTime':
 * @property integer $id
 * @property string $email
 * @property string $startDate
 * @property string $endDate
 * @property string $startTime
 * @property string $endTime
 * @property string $recurring
 *
 * The followings are the available model relations:
 * @property Person $email0
 */
class FreeTime extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.FreeTime';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
			array('email, recurring', 'length', 'max'=>255),
			array('startDate, endDate, startTime, endTime', 'safe'),
                        array('startDate', 'validRange'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, startDate, endDate, startTime, endTime, recurring', 'safe', 'on'=>'search'),
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
		);
	}
        
        public function validRange($attribute, $params) {
            if (!$this->hasErrors()) {
                
                if ($this->endTime === "00:00:00" || $this->endTime == NULL) {
                    $this->endTime = "23:59:00";
                    $dateTime = DateTime::createFromFormat('Y-m-d', $this->endDate);
                    date_sub($dateTime, date_interval_create_from_date_string('1 day'));
                    $this->endDate = date_format($dateTime, 'Y-m-d');
                }

                if (!$this->convertToValidDate() || $this->startGreaterThanEnd() || !$this->validRecurringRange()) {
                    $this->addError('startDate, startTime, endDate, endTime', 
                            'Time Range is invalid:'. $this->startDate . ' ' . $this->startTime . ' - ' . $this->endDate . ' ' . $this->endTime);
                }
            }
        }
        
        private function convertToValidDate() {
             $validStart = DateTime::createFromFormat('Y-m-d H:i:s', $this->startDate . ' ' . $this->startTime);
             $validEnd = DateTime::createFromFormat('Y-m-d H:i:s', $this->endDate . ' ' . $this->endTime);
             
             if ($validStart && $validEnd) {
             $this->startDate = $validStart->format('Y-m-d');
             $this->endDate = $validEnd->format('Y-m-d');
             $this->startTime = $validStart->format('H:i:s');
             $this->endTime = $validEnd->format('H:i:s');
             return true;
             } else {
                 return false;
             }
        }
        
        private function validRecurringRange() {
            $startDate = new DateTime($this->startDate . ' ' . $this->startTime);
            $endDate = new DateTime($this->endDate . ' ' . $this->endTime);
            $valid = false;
            $difference = -1;
            
            switch ($this->recurring) {
                case "once":
                    $valid = true;
                    break;
                case "daily":
                    $difference = $startDate->diff($endDate)->format('%a');
                    break;
                case "weekly":
                    $difference = $startDate->diff($endDate)->format('%a');
                    $difference = $difference/7;
                    break;
                case "monthly":
                    $difference = $startDate->diff($endDate)->format('%m');
                    break;
                case "yearly":
                    $difference = $startDate->diff($endDate)->format('%y');
                    break;
                default:
                    $valid = false;
            }
            
            if (($difference < 1 && $difference >= 0) || $valid) {
                $valid = true;
            }
            
            return $valid;
        }
             
        private function startGreaterThanEnd() {
            $greater = true;
            $start = strtotime($this->startDate . ' ' . $this->startTime);
            $end = strtotime($this->endDate . ' ' . $this->endTime);
            $difference = $end - $start;
            
            if ($difference <= 0) {
                return true;
            } else {
                return false;
            }
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'startDate' => 'Start Date',
			'endDate' => 'End Date',
			'startTime' => 'Start Time',
			'endTime' => 'End Time',
			'recurring' => 'Recurring',
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
                date_default_timezone_set('UTC');
		$criteria=new CDbCriteria;

                if ($this->startDate === "" || $this->startDate === NULL) {
                    $lowerBound = date('Y-m-d');
                } else {
                    $lowerBound = $this->startDate;
                }
                
                if ($this->startTime === "" || $this->startTime === NULL) {
                    $lowerBound = $lowerBound . " 00:00:00";
                } else {
                    $lowerBound = $lowerBound . ' ' . $this->startTime;
                }
                                
                if ($this->endDate === "" || $this->endDate === null) {
                    $upperBound = date('Y-m-d');
                } else {
                    $upperBound = $this->endDate;
                }
                
                if ($this->endTime === "" || $this->endTime === null) {
                    $upperBound = $upperBound . " 00:00:00";
                } else {
                    $upperBound = $upperBound . ' ' . $this->endTime;
                }

//                echo $lowerBound;
//                echo $upperBound;
                $criteria->condition = 
                '((cast((cast(endDate as DateTime) + endTime) as DateTime) > :lowerBound) AND '
                        . '(cast((cast(startDate as DateTime) + startTime) as DateTime) < :upperBound) AND recurring = "once") OR'
                        . '((cast((cast(startDate as DateTime) + startTime) as DateTime) < :upperBound) AND recurring <> "once")';
                $criteria->params = array(':lowerBound' => $lowerBound, ':upperBound' => $upperBound);
//                echo $criteria->condition;
                
                $models = FreeTime::model()->findAll($criteria);
                
                $freeTimes = array();
                $start = new DateTime($lowerBound);
                $end = new DateTime($upperBound);

                foreach ($models as $freeTime) {    
                    $interval;
                    $recurrences;
                    $startDate = new DateTime($freeTime->startDate . ' ' . $freeTime->startTime);
                    $endDate = new DateTime($freeTime->endDate . ' ' . $freeTime->endTime);

                    switch ($freeTime->recurring) {
                        case "once":
                            $interval = new DateInterval('P1D');
                            $recurrences = 0;
                            break;
                        case "daily":
                            $interval = new DateInterval('P1D');
                            $recurrences = $startDate->diff($end)->format('%a');
                            break;
                        case "weekly":
                            $interval = new DateInterval('P1W');
                            $recurrences = $startDate->diff($end)->format('%a');
                            $recurrences = $recurrences/7;
                            break;
                        case "monthly":
                            $interval = new DateInterval('P1M');
                            $recurrences = $startDate->diff($end)->format('%m');
                            break;
                        case "yearly":
                            $interval = new DateInterval('P1Y');
                            $recurrences = $startDate->diff($end)->format('%y');
                            break;
                        default:
                            $interval = new DateInterval('P1D');
                            $recurrences = 0;
                    }

                    $dateRange = new DatePeriod($startDate, $interval, $recurrences);
                    foreach ($dateRange as $date) {

                        if ($endDate > $start && $date < $end) {
                            $freeTimes[] = $freeTime;
                            break;
                        }

                        $endDate = $endDate->add($interval);
                    }
                }
                
                
		return new CArrayDataProvider($freeTimes, array(
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FreeTime the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
