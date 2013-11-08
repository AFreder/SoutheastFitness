<?php

/**
 * This is the model class for table "competitor".
 *
 * The followings are the available columns in table 'competitor':
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property integer $event_id
 * @property integer $id
 * @property string $shirt_size
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Competitor the static model class
	 */
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(						
			array('id, competitor_id', 'numerical', 'integerOnly'=>true),
			array('token', 'length', 'max'=>250),
			array('status', 'length', 'max'=>25),			
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
			'id' => 'Transaction ID',
			'status' => 'Status',
			'token' => 'Token',
		);
	}
}