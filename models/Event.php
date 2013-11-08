<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $start_date
 * @property integer $start_hour
 * @property integer $start_minute
 * @property string $start_am_pm
 * @property string $end_date
 * @property integer $end_hour
 * @property integer $end_minute
 * @property string $end_am_pm
 * @property string $comments
 * @property string $image
 * @property string $fee_ind
 * @property string $fee_amount
 * @property string $tshirt_ind
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	
	public $fileName;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, venue, address, city, state, start_date, start_hour, start_minute, end_date, end_hour, end_minute, description, fee_ind, tshirt_ind, max_athletes', 'required'),			
			array('address, image, sponsor_logos', 'length', 'max'=>250),
			array('name', 'length', 'max'=>40),
			array('venue', 'length', 'max'=>50),
			array('start_hour, end_hour, start_minute, end_minute', 'length', 'max'=>2),
			array('city', 'length', 'max'=>100),
			array('state, start_am_pm, end_am_pm', 'length', 'max'=>2),
			array('start_hour, end_hour', 'numerical', 'integerOnly'=>true, 'min'=>1, 'max'=>12),
			array('start_minute, end_minute', 'numerical', 'integerOnly'=>true, 'min'=>0, 'max'=>59),
			array('fee_ind, tshirt_ind, team_ind, division_ind', 'length', 'max'=>1),
			array('fee_amount, unit', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, city, state, start_date, start_hour, start_minute, start_am_pm, end_date, end_hour, end_minute, end_am_pm, comments, image, fee_ind, fee_amount, tshirt_ind', 'safe', 'on'=>'search'),
			array('fileName', 'length', 'max'=>250),			
			array('comments', 'length', 'max'=>500),
            array('fileName', 'file', 'types'=>'jpg, png, jpeg, bmp', 'allowEmpty' => true),
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
			'name' => 'Event Name',
			'description' => 'Event Description',
			'venue' => 'Venue',
			'address' => 'Address',
			'city' => 'City',
			'state' => 'State',
			'start_date' => 'Start Date',
			'start_hour' => 'Start Hour',
			'start_minute' => 'Start Minute',
			'start_am_pm' => 'Start Am Pm',
			'end_date' => 'End Date',
			'end_hour' => 'End Hour',
			'end_minute' => 'End Minute',
			'end_am_pm' => 'End Am Pm',
			'comments' => 'Additional Comments',
			'image' => 'Image',
			'fee_ind' => 'Fee Ind',
			'fee_amount' => 'Fee Amount',
			'fileName' => 'Event Logo',
			'tshirt_ind' => 'Tshirt Ind',
			'max_athletes' => 'Maximum # of Athletes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('start_hour',$this->start_hour);
		$criteria->compare('start_minute',$this->start_minute);
		$criteria->compare('start_am_pm',$this->start_am_pm,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('end_hour',$this->end_hour);
		$criteria->compare('end_minute',$this->end_minute);
		$criteria->compare('end_am_pm',$this->end_am_pm,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('fee_ind',$this->fee_ind,true);
		$criteria->compare('fee_amount',$this->fee_amount,true);
		$criteria->compare('tshirt_ind',$this->tshirt_ind,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}