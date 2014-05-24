<?php

/**
 * This is the model class for table "pvms.Cause".
 *
 * The followings are the available columns in table 'pvms.Cause':
 * @property integer $id
 * @property integer $animalWelfare
 * @property integer $artsAndCulture
 * @property integer $children
 * @property integer $communityAndService
 * @property integer $democracyAndPolitics
 * @property integer $education
 * @property integer $environment
 * @property integer $food
 * @property integer $health
 * @property integer $housingAndHomelessness
 * @property integer $humanRights
 * @property integer $humanitarianRelief
 * @property integer $internationalAffairs
 * @property integer $media
 * @property integer $povertyAlleviation
 * @property integer $religion
 * @property integer $scienceAndTechnology
 * @property integer $seniorCitizens
 * @property integer $womensIssues
 * @property string $other
 *
 * The followings are the available model relations:
 * @property Organization[] $organizations
 * @property Person[] $people
 * @property Project[] $projects
 */
class Cause extends CActiveRecord
{
       // public $name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.Cause';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('animalWelfare, artsAndCulture, children, communityAndService, democracyAndPolitics, education, environment, food, health, housingAndHomelessness, humanRights, humanitarianRelief, internationalAffairs, media, povertyAlleviation, religion, scienceAndTechnology, seniorCitizens, womensIssues', 'numerical', 'integerOnly'=>true),
			array('other', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, animalWelfare, artsAndCulture, children, communityAndService, democracyAndPolitics, education, environment, food, health, housingAndHomelessness, humanRights, humanitarianRelief, internationalAffairs, media, povertyAlleviation, religion, scienceAndTechnology, seniorCitizens, womensIssues, other', 'safe', 'on'=>'search'),
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
			'organizations' => array(self::HAS_MANY, 'Organization', 'causeId'),
			'people' => array(self::HAS_MANY, 'Person', 'causeId'),
			'projects' => array(self::HAS_MANY, 'Project', 'causeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'animalWelfare' => 'Animal Welfare',
			'artsAndCulture' => 'Arts And Culture',
			'children' => 'Children',
			'communityAndService' => 'Community And Service',
			'democracyAndPolitics' => 'Democracy And Politics',
			'education' => 'Education',
			'environment' => 'Environment',
			'food' => 'Food',
			'health' => 'Health',
			'housingAndHomelessness' => 'Housing And Homelessness',
			'humanRights' => 'Human Rights',
			'humanitarianRelief' => 'Humanitarian Relief',
			'internationalAffairs' => 'International Affairs',
			'media' => 'Media',
			'povertyAlleviation' => 'Poverty Alleviation',
			'religion' => 'Religion',
			'scienceAndTechnology' => 'Science And Technology',
			'seniorCitizens' => 'Senior Citizens',
			'womensIssues' => 'Womens Issues',
			'other' => 'Other',
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

		//$criteria->compare('id',$this->id);
		$criteria->compare('animalWelfare',$this->animalWelfare);
		$criteria->compare('artsAndCulture',$this->artsAndCulture);
		$criteria->compare('children',$this->children);
		$criteria->compare('communityAndService',$this->communityAndService);
		$criteria->compare('democracyAndPolitics',$this->democracyAndPolitics);
		$criteria->compare('education',$this->education);
		$criteria->compare('environment',$this->environment);
		$criteria->compare('food',$this->food);
		$criteria->compare('health',$this->health);
		$criteria->compare('housingAndHomelessness',$this->housingAndHomelessness);
		$criteria->compare('humanRights',$this->humanRights);
		$criteria->compare('humanitarianRelief',$this->humanitarianRelief);
		$criteria->compare('internationalAffairs',$this->internationalAffairs);
		$criteria->compare('media',$this->media);
		$criteria->compare('povertyAlleviation',$this->povertyAlleviation);
		$criteria->compare('religion',$this->religion);
		$criteria->compare('scienceAndTechnology',$this->scienceAndTechnology);
		$criteria->compare('seniorCitizens',$this->seniorCitizens);
		$criteria->compare('womensIssues',$this->womensIssues);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
	}
        
        public function getCauses()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('animalWelfare',$this->animalWelfare);
		$criteria->compare('artsAndCulture',$this->artsAndCulture);
		$criteria->compare('children',$this->children);
		$criteria->compare('communityAndService',$this->communityAndService);
		$criteria->compare('democracyAndPolitics',$this->democracyAndPolitics);
		$criteria->compare('education',$this->education);
		$criteria->compare('environment',$this->environment);
		$criteria->compare('food',$this->food);
		$criteria->compare('health',$this->health);
		$criteria->compare('housingAndHomelessness',$this->housingAndHomelessness);
		$criteria->compare('humanRights',$this->humanRights);
		$criteria->compare('humanitarianRelief',$this->humanitarianRelief);
		$criteria->compare('internationalAffairs',$this->internationalAffairs);
		$criteria->compare('media',$this->media);
		$criteria->compare('povertyAlleviation',$this->povertyAlleviation);
		$criteria->compare('religion',$this->religion);
		$criteria->compare('scienceAndTechnology',$this->scienceAndTechnology);
		$criteria->compare('seniorCitizens',$this->seniorCitizens);
		$criteria->compare('womensIssues',$this->womensIssues);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cause the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function setCauseString($string, $notSelected)
        {
            $labels = $this->attributeLabels();
            $causeArray = explode(',',$string);
            $causeArrayKeyVal = array();
            foreach ($causeArray as $entry) {
                $causeArrayKeyVal[strtolower($entry)] = $entry; 
            }

            foreach ($labels as $key=>$val) {
                $lowerCaseVal = strtolower($val);
                
                if (array_key_exists($lowerCaseVal, $causeArrayKeyVal)) {        
                    unset($causeArrayKeyVal[$lowerCaseVal]);
                    $this->$key = 1;
                } else {

                    if ($key !== 'id' && $key !== 'other') {
                        $this->$key = $notSelected;

                    }
                }
            }

            $this->other = implode(',',$causeArrayKeyVal);

            if ($notSelected !== null) {
                if ($this->isNewRecord) {
                    $this->save();
                } else {
                    $this->update();
                }
            }
        }
        
        public function getSelectedCauseString($leftSeperator, $rightSeperator) 
        {
            $string = "";
            $i = 0;
            $labels = $this->attributeLabels();
            $numOfAttributes = count($labels);
            $selected = $this->attributes;
            foreach ($labels as $key => $val) {
                if ($i == 0) {
                    $i++;
                    continue;
                }

                if ($i == $numOfAttributes - 1) {
                    $string .= $this->getOtherString($leftSeperator, $rightSeperator, $string);
                    $i++;
                    continue;
                }

                if ($selected[$key] == 1) {
                    $string .= $leftSeperator . $val . $rightSeperator;
                }
                $i++;
            }
            
            if ($string != "") {
                $string = rtrim($string, ", ");
            }
            
            return $string;
        }
        
        private function getOtherString($leftSeperator, $rightSeperator)
        {
            $string = "";
            $other = preg_split("/,/", $this->attributes['other']);
                foreach ($other as $extra) {
                if ($extra != "") {
                    $string .= $leftSeperator . $extra . $rightSeperator;
                }
            }
            
            return $string;
        }
        
        public function getAttributeString($leftSeperator, $rightSeperator)
        {
            $string = "";
            $i = 0;
            $labels = $this->attributeLabels();
            $numOfAttributes = count($labels);
            foreach ($labels as $label) {
                $i++;
                if ($i == 1 || $i == $numOfAttributes) {
                    continue;
                }
                $string .= $leftSeperator  . $label . $rightSeperator ;
            }
            
            return $string;
        }
        
}
