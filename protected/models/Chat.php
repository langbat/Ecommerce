<?php

/**
 * This is the model class for table "chat".
 *
 * The followings are the available columns in table 'chat':
 * @property string $id
 * @property string $from
 * @property string $to
 * @property string $message
 * @property string $sent
 * @property string $recd
 */
class Chat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chat the static model class
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
		return 'chat';
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
			array('message', 'required'),
			array('from, to', 'length', 'max'=>255),
			array('recd', 'length', 'max'=>10),
			array('sent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from, to, message, sent, recd', 'safe', 'on'=>'search'),
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
			'from' => Yii::t('global', 'From'),
			'to' => Yii::t('global', 'To'),
			'message' => Yii::t('global', 'Message'),
			'sent' => Yii::t('global', 'Sent'),
			'recd' => Yii::t('global', 'Recd'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('sent',$this->sent,true);
		$criteria->compare('recd',$this->recd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    function getUsername(){
        if(Yii::app()->user->isGuest){
            if (!isset(Yii::app()->session['guest_username']))
                Yii::app()->session['guest_username'] = Yii::t('global', 'Guest').rand(1000, 9999);
            
            return Yii::app()->session['guest_username'] ;
        }
            
        return Yii::app()->user->username;
    }
}