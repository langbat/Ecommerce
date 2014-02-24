<?php
/**
 * UserPlans model
 */
class UserPlans extends CActiveRecord
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
		return 'userplans';
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
			'user' => array(self::BELONGS_TO, 'Members', 'user_id'),
			'plan' => array(self::BELONGS_TO, 'Plans', 'plan_id'),
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
		);
	}
	
	/**
	 * Scopes
	 */
	public function scopes()
	{
		return array(
		            'byDate'=>array(
		                'order'=>'created DESC',
		            ),
					'byDateAsc'=>array(
		                'order'=>'created ASC',
		            ),
		        );
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		return parent::beforeSave();
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('user_id, plan_id, start_date, end_date', 'required' ),
		);
	}
}