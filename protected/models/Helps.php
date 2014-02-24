<?php

/**
 * This is the model class for table "helps".
 *
 * The followings are the available columns in table 'helps':
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property string $alias
 * @property string $language
 * @property integer $topic
 * @property integer $rank
 */
class Helps extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Helps the static model class
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
		return 'helps';
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
            array('question, answer, alias', 'required'),
            array('alias', 'CheckUniqueAlias'),
            array('topic', 'numerical', 'integerOnly'=>true),
            array('question', 'length', 'max'=>512),
            array('alias', 'length', 'max'=>255),
            array('language', 'length', 'max'=>6),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, question, answer, alias, language, topic', 'safe', 'on'=>'search'),
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
            'question' => Yii::t('global', 'Question'),
            'answer' => Yii::t('global', 'Answer'),
            'alias' => Yii::t('global', 'Alias'),
            'language' => Yii::t('global', 'Language'),
            'topic' => Yii::t('global', 'Topic'),
            'rank' => Yii::t('global', 'Rank'),
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
        $criteria->compare('question',$this->question,true);
        $criteria->compare('answer',$this->answer,true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('language',Yii::app()->language,true);
        $criteria->compare('topic',$this->topic);
        $criteria->compare('rank',$this->rank);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
	}
    
    
    //need copy
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
    public function getAlias( $alias=null )
    {
        return Yii::app()->func->makeAlias( $alias !== null ? $alias : $this->alias );
    }

	public function beforeValidate()
	{
        if (trim($this->alias) == '')	   
		  $this->alias = self::model()->getAlias( $this->question );
        	
		return parent::beforeValidate();
	}
    public function afterDelete()
	{
        self::model()->deleteAll("alias = '{$this->alias}'");
		return parent::afterDelete();
	}
    //end copy
}