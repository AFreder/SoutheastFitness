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
class CompetitorPending extends CActiveRecord
{
	public $verifyEmail;
	public $verifyCode;
	
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
		return 'competitor_pending';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('first_name, last_name, gender, email, verifyEmail', 'required'),
			array('first_name+last_name+email+event_id+gender', 'application.extensions.uniqueMultiColumnValidator'),
			array('event_id, team_number', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email', 'length', 'max'=>250),
			array('gender, actv_in', 'length', 'max'=>1),
			array('team_name', 'length', 'max'=>100),
			array('shirt_size, division', 'length', 'max'=>10),
			array('division, team_name, team_number, shirt_size', 'authenticate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('first_name, last_name, gender, email, event_id, id, shirt_size', 'safe', 'on'=>'search'),
			array('email, verifyEmail','email'),
			array('email','compare', 'compareAttribute'=>'verifyEmail', 'message'=>'Emails do not match.'),
		);
	}
	public function authenticate($attribute,$params)
    {        
        if(!is_null($this->division)&&$this->division == '')
            $this->addError('division','Please select a Division.');
        if(!is_null($this->team_name)&&$this->team_name == '')
            $this->addError('team_name','Please select a Team Name.');
        if(!is_null($this->team_number)&&$this->team_number == '')
            $this->addError('team_number','Please select a Team Number.');
        if(!is_null($this->shirt_size)&&$this->shirt_size == '')
            $this->addError('shirt_size','Please select a Shirt Size.');                
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
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'email' => 'Email',
			'event_id' => 'Event',
		    'verifyEmail' => 'Confirm Email',
			'id' => 'ID',
			'shirt_size' => 'Shirt Size',
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

		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('shirt_size',$this->shirt_size,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}