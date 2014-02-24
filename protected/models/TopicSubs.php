<?php
/**
 * Topic Subscription Model
 */
class TopicSubs extends CActiveRecord
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
		return 'topic_subscription';
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
			'user' => array(self::BELONGS_TO, 'Members', 'userid'),
			'topic' => array(self::BELONGS_TO, 'ForumTopics', 'topicid'),
		);
	}
	
	/**
	 * Subscribe a user to the topic
	 *
	 */
	public function subscribeUser( $topicId, $userId )
	{
		$model = new self;
		$model->topicid = $topicId;
		$model->userid = $userId;
		$model->save();
	}
}