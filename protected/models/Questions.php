<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $id
 * @property string $name
 * @property string $emails
 * @property string $questions
 * @property string $answers
 * @property string $datequestion
 * @property string $dateanswer
 */
class Questions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questions the static model class
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
		return 'questions';
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
        	array('name, emails, questions', 'required'),
			array('name, emails', 'length', 'max'=>100),
			array('questions, answers, datequestion, dateanswer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, emails, questions, answers, datequestion, dateanswer', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('global', 'ID'),
			'name' => Yii::t('global', 'Name'),
			'emails' => Yii::t('global', 'Email'),
			'questions' => Yii::t('global', 'Question'),
			'answers' => Yii::t('global', 'Answer'),
			'datequestion' => Yii::t('global', 'Date question'),
			'dateanswer' => Yii::t('global', 'Date answer'),
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
		$criteria->compare('emails',$this->emails,true);
        $criteria->compare('questions',$this->questions,true);
		$criteria->compare('answers',$this->answers,true);
	//	$criteria->compare('datequestion',$this->datequestion,true);
        if ($this->datequestion)
		    $criteria->compare('datequestion',date('Y-m-d ', strtotime($this->datequestion)),true);
        if ($this->dateanswer)
		    $criteria->compare('dateanswer',date('Y-m-d ', strtotime($this->dateanswer)),true);
		//$criteria->compare('dateanswer',$this->dateanswer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}