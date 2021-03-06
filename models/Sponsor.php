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
class Sponsor extends CActiveRecord
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
		return 'sponsor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),			
			array('name, website', 'length', 'max'=>250),
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
			'name' => 'Sponsor Name',						
		);
	}
}