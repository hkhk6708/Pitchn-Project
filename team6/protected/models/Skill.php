<?php

/**
 * This is the model class for table "pvms.Skill".
 *
 * The followings are the available columns in table 'pvms.Skill':
 * @property integer $id
 * @property integer $accounting
 * @property integer $advertising
 * @property integer $branding
 * @property integer $businessStrategy
 * @property integer $communications
 * @property integer $copywriting
 * @property integer $design
 * @property integer $education
 * @property integer $entrepreneurship
 * @property integer $eventPlanning
 * @property integer $finance
 * @property integer $fundraising
 * @property integer $humanResources
 * @property integer $legal
 * @property integer $marketing
 * @property integer $multimedia
 * @property integer $onlineMarketing
 * @property integer $photography
 * @property integer $projectManagement
 * @property integer $publicRelations
 * @property integer $sales
 * @property integer $socialMedia
 * @property integer $technology
 * @property integer $webDevelopment
 * @property string $other
 */
class Skill extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pvms.Skill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('accounting, advertising, branding, businessStrategy, communications, copywriting, design, education, entrepreneurship, eventPlanning, finance, fundraising, humanResources, legal, marketing, multimedia, onlineMarketing, photography, projectManagement, publicRelations, sales, socialMedia, technology, webDevelopment', 'numerical', 'integerOnly'=>true),
			array('other', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, accounting, advertising, branding, businessStrategy, communications, copywriting, design, education, entrepreneurship, eventPlanning, finance, fundraising, humanResources, legal, marketing, multimedia, onlineMarketing, photography, projectManagement, publicRelations, sales, socialMedia, technology, webDevelopment, other', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'accounting' => 'Accounting',
			'advertising' => 'Advertising',
			'branding' => 'Branding',
			'businessStrategy' => 'Business Strategy',
			'communications' => 'Communications',
			'copywriting' => 'Copywriting',
			'design' => 'Design',
			'education' => 'Education',
			'entrepreneurship' => 'Entrepreneurship',
			'eventPlanning' => 'Event Planning',
			'finance' => 'Finance',
			'fundraising' => 'Fundraising',
			'humanResources' => 'Human Resources',
			'legal' => 'Legal',
			'marketing' => 'Marketing',
			'multimedia' => 'Multimedia',
			'onlineMarketing' => 'Online Marketing',
			'photography' => 'Photography',
			'projectManagement' => 'Project Management',
			'publicRelations' => 'Public Relations',
			'sales' => 'Sales',
			'socialMedia' => 'Social Media',
			'technology' => 'Technology',
			'webDevelopment' => 'Web Development',
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
		$criteria->compare('accounting',$this->accounting);
		$criteria->compare('advertising',$this->advertising);
		$criteria->compare('branding',$this->branding);
		$criteria->compare('businessStrategy',$this->businessStrategy);
		$criteria->compare('communications',$this->communications);
		$criteria->compare('copywriting',$this->copywriting);
		$criteria->compare('design',$this->design);
		$criteria->compare('education',$this->education);
		$criteria->compare('entrepreneurship',$this->entrepreneurship);
		$criteria->compare('eventPlanning',$this->eventPlanning);
		$criteria->compare('finance',$this->finance);
		$criteria->compare('fundraising',$this->fundraising);
		$criteria->compare('humanResources',$this->humanResources);
		$criteria->compare('legal',$this->legal);
		$criteria->compare('marketing',$this->marketing);
		$criteria->compare('multimedia',$this->multimedia);
		$criteria->compare('onlineMarketing',$this->onlineMarketing);
		$criteria->compare('photography',$this->photography);
		$criteria->compare('projectManagement',$this->projectManagement);
		$criteria->compare('publicRelations',$this->publicRelations);
		$criteria->compare('sales',$this->sales);
		$criteria->compare('socialMedia',$this->socialMedia);
		$criteria->compare('technology',$this->technology);
		$criteria->compare('webDevelopment',$this->webDevelopment);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Skill the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function setSkillString($string, $notSelected)
        {
            $labels = $this->attributeLabels();
            $skillArray = explode(',',$string);
            $skillArrayKeyVal = array();
            foreach ($skillArray as $entry) {
                $skillArrayKeyVal[strtolower($entry)] = $entry; 
            }

            foreach ($labels as $key=>$val) {
                $lowerCaseVal = strtolower($val);
                
                if (array_key_exists($lowerCaseVal, $skillArrayKeyVal)) {        
                    unset($skillArrayKeyVal[$lowerCaseVal]);
                    $this->$key = 1;
                } else {

                    if ($key !== 'id' && $key !== 'other') {
                        $this->$key = $notSelected;

                    }
                }
            }

            $this->other = implode(',',$skillArrayKeyVal);

            if ($notSelected !== null) {
                if ($this->isNewRecord) {
                    $this->save();
                } else {
                    $this->update();
                }
            }
        }
        
        
        public function getSelectedSkillString($leftSeperator, $rightSeperator) 
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
