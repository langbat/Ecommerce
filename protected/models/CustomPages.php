<?php
/**
 * custom pages model
 */
class CustomPages extends CActiveRecord
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
		return 'custompages';
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
			'author' => array(self::BELONGS_TO, 'Members', 'authorid'),
			'lastauthor' => array(self::BELONGS_TO, 'Members', 'last_edited_author'),
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
			'title' => Yii::t('admincustompages', 'Title'),
			'alias' => Yii::t('admincustompages', 'Alias'),
			'content' => Yii::t('admincustompages', 'Content'),
			'tags' => Yii::t('admincustompages', 'Tags'),
			'language' => Yii::t('admincustompages', 'Language'),
			'metadesc' => Yii::t('admincustompages', 'Meta Description'),
			'metakeys' => Yii::t('admincustompages', 'Meta Keywords'),
			'visible' => Yii::t('admincustompages', 'Visibility'),
			'status' => Yii::t('admincustompages', 'Status'),
		);
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->dateposted = time();
			$this->authorid = Yii::app()->user->id;
		}
		else
		{
			$this->last_edited_date = time();
			$this->last_edited_author = Yii::app()->user->id;
		}
		
		// Fix the language, tags and visibility
		$this->visible = ( is_array( $this->visible ) && count( $this->visible ) ) ? implode(',', $this->visible) : $this->visible;
		$this->language = ( is_array( $this->language ) && count( $this->language ) ) ? implode(',', $this->language) : $this->language;
		
		// Alias
		$this->alias = str_replace(' ', '-', $this->alias);
		
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
			array('title, alias, content', 'required' ),
			array('alias', 'CheckUniqueAlias'),
			array('title, alias', 'length', 'min' => 3, 'max' => 55 ),
			array('alias', 'match', 'allowEmpty'=>false, 'pattern'=>'/^[A-Za-z0-9_-]+$/'),
			array('metadesc, metakeys, visible, status, tags, language', 'safe' ),
            array('id, title, alias, content, dateposted, authorid, last_edited_date, last_edited_author, tags, language, metadesc, metakeys, visible, status', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Check alias and language combination
	 */
	public function CheckUniqueAlias()
	{
		if( $this->isNewRecord )
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND language = :lang', array(':alias' => $this->alias, ':lang' => $this->language ) ) )
			{
				$this->addError('alias', Yii::t('custompages', 'There is already a page with that alias and language combination.'));
			}
		}
		else
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND language = :lang AND id!=:id', array( ':id' => $this->id, ':alias' => $this->alias, ':lang' => $this->language ) ) )
			{
				$this->addError('alias', Yii::t('custompages', 'There is already a page with that alias and language combination.'));
			}
		}
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('dateposted',$this->dateposted);
        $criteria->compare('authorid',$this->authorid);
        $criteria->compare('last_edited_date',$this->last_edited_date);
        $criteria->compare('last_edited_author',$this->last_edited_author);
        $criteria->compare('tags',$this->tags,true);
        $criteria->compare('language',Yii::app()->language,true);
        $criteria->compare('metadesc',$this->metadesc,true);
        $criteria->compare('metakeys',$this->metakeys,true);
        $criteria->compare('visible',$this->visible,true);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    function languageButton($lang){
        $model = self::model()->findByAttributes(array(
            'alias' => $this->alias, 
            'language' => $lang
        ));
        if ($model){
            return '<a href="'.Yii::app()->createUrl('admin/custompages/update', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'Edit').'">
                <img src="/assets/images/update.png" />
            </a><a href="'.Yii::app()->createUrl('admin/custompages/view', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'View').'">
                <img src="/assets/images/view.png" />
            </a>';
        }
        else{
            return '<a href="'.Yii::app()->createUrl('admin/custompages/create', array('alias' => $this->alias, 'language'=> $lang)).'" class="tipb" data-original-title="'.Yii::t('global', 'Add').'">
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
		  $this->alias = self::model()->getAlias( $this->title );
        	
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
    public function getNotification(){
        $sql = "SELECT * FROM custompages WHERE id = 19";
        $notification = CustomPages::model()->findAllbySql($sql);
        return $notification;
    }
    public function getNotificationDetail($alias){
        $sql = "SELECT * FROM custompages WHERE alias = ".$alias."";
        $notification = CustomPages::model()->findAllbySql($sql);
        return $notification;
    }
}