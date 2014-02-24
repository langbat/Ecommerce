<?php
/**
 * custom pages model
 */
class UserMessages extends CActiveRecord
{	
	/**
	 * @return object
	 */
	public static function model()
	{
		return parent::model(__CLASS__);
	}
	
	/**
	 * @return string Table name
	 */
	public function tableName()
	{
		return 'usermessages';
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	/**
	 * Relations
	 */
	public function relations()
	{
		return array(
			'fromuser' => array(self::BELONGS_TO, 'Members', 'from_user'),
			'touser' => array(self::BELONGS_TO, 'Members', 'to_user'),
		);
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'subject' => Yii::t('adminusermessages', 'Subject'),
			'message' => Yii::t('adminusermessages', 'Message'),
			'created' => Yii::t('adminusermessages', 'Created'),
            'from_user' => Yii::t('adminusermessages', 'From User'),
            'to_user' => Yii::t('adminusermessages', 'To User'),
			
		);
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->created = date('Y-m-d H:i:s');
		}
		
		return parent::beforeSave();
	}
	
	/**
	 * after save method
	 */
	public function afterSave()
	{
		Yii::app()->urlManager->clearCache();
		
		return parent::afterSave();
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('subject, from_user, to_user, message', 'required' ),
			array('subject', 'length', 'min' => 3, 'max' => 100 ),
			array('message', 'length', 'min' => 0 ),
		);
	}
	
	/**
	 * Check alias and language combination
	 */
	
}