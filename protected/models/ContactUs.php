<?php

/**
 * This is the model class for table "contactus".
 *
 * The followings are the available columns in table 'contactus':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $content
 * @property integer $postdate
 * @property integer $sread
 */
class Contactus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contactus the static model class
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
		return 'contactus';
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
			array('postdate, sread', 'numerical', 'integerOnly'=>true),
			array('name, email, subject', 'length', 'max'=>55),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, subject, content, postdate, sread', 'safe', 'on'=>'search'),
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
			'email' => Yii::t('global', 'Email'),
			'subject' => Yii::t('global', 'Subject'),
			'content' => Yii::t('global', 'Content'),
			'postdate' => Yii::t('global', 'Postdate'),
			'sread' => Yii::t('global', 'Sread'),
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('postdate',$this->postdate);
		$criteria->compare('sread',$this->sread);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
	 * Get topics for the subject drop down
	 */
	public function getTopics()
	{
		$topics = array();
		$topics[''] = Yii::t('contactus', '-- Choose --');
		if( isset(Yii::app()->params['contactustopics']) && Yii::app()->params['contactustopics'] )
		{
			$explode = explode("\n", Yii::app()->params['contactustopics']);
			
			// Loop to translate
			foreach($explode as $topic)
			{
				$topics[ $topic ] = Yii::t('contactus', $topic);
			}
		}
		
		return $topics;
	}
    
    /**
	 * Before save method
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->postdate = time();
		}
		
		return parent::beforeSave();
	}
}