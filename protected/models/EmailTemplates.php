<?php

/**
 * This is the model class for table "email_templates".
 *
 * The followings are the available columns in table 'email_templates':
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $language
 * @property string $email_subject
 * @property string $email_content
 */
class EmailTemplates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailTemplates the static model class
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
		return 'email_templates';
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
			array('name, alias, email_subject', 'length', 'max'=>512),
            array('alias', 'CheckUniqueAlias'),
			array('language', 'length', 'max'=>3),
			array('email_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, alias, language, email_subject, email_content', 'safe', 'on'=>'search'),
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
			'alias' => Yii::t('global', 'Alias'),
			'language' => Yii::t('global', 'Language'),
			'email_subject' => Yii::t('global', 'Email Subject'),
			'email_content' => Yii::t('global', 'Email Content'),
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
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',Yii::app()->language,true);
		$criteria->compare('email_subject',$this->email_subject,true);
		$criteria->compare('email_content',$this->email_content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    
    /**
	 * Check alias and language combination
	 */
	public function CheckUniqueAlias()
	{
		if( $this->isNewRecord )
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND language=:language', array(':alias' => $this->alias, ':language' => $this->language) ) ){
				$this->alias .= '-1';
                $this->CheckUniqueAlias();
			}
		}
		else
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND language=:language AND id!=:id', array( ':id' => $this->id, ':alias' => $this->alias, ':language' => $this->language ) ) )			{
                $this->alias .= '-1';
				$this->CheckUniqueAlias();
			}
		}
	}
    //need copy
    function languageButton($lang){
        $model = self::model()->findByAttributes(array(
            'alias' => $this->alias, 
            'language' => $lang
        ));
        if ($model){
            return '<a href="'.Yii::app()->createUrl('admin/'.lcfirst(get_class($this)).'/update', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'Edit').'">
                <img src="/assets/images/update.png" />
            </a><a href="'.Yii::app()->createUrl('admin/'.lcfirst(get_class($this)).'/view', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'View').'">
                <img src="/assets/images/view.png" />
            </a>';
        }
        else{
            return '<a href="'.Yii::app()->createUrl('admin/'.lcfirst(get_class($this)).'/create', array('alias' => $this->alias, 'language'=> $lang)).'" class="tipb" data-original-title="'.Yii::t('global', 'Add').'">
                <i class="icon-plus"></i>
            </a>';
        }
    }
    /**
	 * Before validate operations
	 */
	public function beforeValidate()
	{
        if (trim($this->alias) == '')	   
		  $this->alias = self::model()->getAlias( $this->name );
        	
		return parent::beforeValidate();
	}
    public function afterDelete()
	{
        self::model()->deleteAll("alias = '{$this->alias}'");
		return parent::afterDelete();
	}
    public function getAlias( $alias=null )
	{
		return Yii::app()->func->makeAlias( $alias !== null ? $alias : $this->alias );
	}
    //end copy
    
    
    function getTemplate($alias){
        return self::model()->findByAttributes(array('alias' => $alias, 'language' => Yii::app()->language));
    }
}