<?php

/**
 * This is the model class for table "messages_shop".
 *
 * The followings are the available columns in table 'messages_shop':
 * @property integer $id
 * @property integer $sender
 * @property integer $receiver
 * @property string $subject
 * @property string $message
 * @property string $sent
 * @property integer $status_message
 * @property integer $is_read
 */
class messagesShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return messagesShop the static model class
	 */
    public $sendername, $receivername;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages_shop';
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
        array('subject, message', 'required'),
			array('sender, receiver, status_message, is_read', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>300),
			array('message, sent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender, receiver, subject, message, sent, status_message, is_read, sendername, receivername', 'safe', 'on'=>'search'),
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
            'senderme' => array(self::BELONGS_TO, 'Members', 'sender'),
            'receiverme' => array(self::BELONGS_TO, 'Members', 'receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'sender' => Yii::t('global', 'Sender'),
			'receiver' => Yii::t('global', 'Receiver'),
			'subject' => Yii::t('global', 'Subject'),
			'message' => Yii::t('global', 'Message'),
			'sent' => Yii::t('global', 'Sent'),
			'status_message' => Yii::t('global', 'Status Message'),
			'is_read' => Yii::t('global', 'Is Read'),
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
        $criteria->together = true;
        $criteria->with=array('senderme','receiverme');
        
		$criteria->compare('t.id',$this->id);
        $criteria->compare('senderme.username',$this->sendername,true);
        $criteria->compare('receiverme.username',$this->receivername,true);
		//$criteria->compare('sender',$this->sender);
		//$criteria->compare('receiver',$this->receiver);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
        if ($this->sent)
		    $criteria->compare('sent',date('Y-m-d ', strtotime($this->sent)),true);
		$criteria->compare('status_message',$this->status_message);
		$criteria->compare('is_read',$this->is_read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
              'defaultOrder'=>'t.id DESC',
              'attributes'=>array(
                    'sendername'=>array(
                        'asc'=>'senderme.username',
                        'desc'=>'senderme.username DESC',
                    ),
                    'receivername'=>array(
                        'asc'=>'receiverme.username',
                        'desc'=>'receiverme.username DESC',
                    ),
                    '*',
                    ),
                ),
		));
	}
    public function getUserfrom($id){
        $member =  Members::model()->findByPk($id);
        return $member->username;
    }
    public function getNewMessage($id){
         $message =  messagesShop::model()->findAllByAttributes(array('receiver'=>$id,'is_read'=>0));
         return count($message);
    }
}