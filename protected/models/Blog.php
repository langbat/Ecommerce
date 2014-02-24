<?php
/**
 * Blog Posts model
 *

 */
class Blog extends CActiveRecord
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
		return 'blogposts';
	}
	
	/**
	 * Relations
	 */
	public function relations()
	{
		return array(
		    'category' => array(self::BELONGS_TO, 'BlogCats', 'catid'),
			'author' => array(self::BELONGS_TO, 'Members', 'authorid'),
			'comments' => array(self::HAS_MANY, 'BlogComments', 'postid'),
			'lastauthor' => array(self::BELONGS_TO, 'Members', 'last_updated_author'),
			'commentscount' => array(self::STAT, 'BlogComments', 'postid'),
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
            'id' => Yii::t('blog', 'ID'),
			'catid' => Yii::t('blog', 'Category'),
			'title' => Yii::t('blog', 'Title'),
			'description' => Yii::t('blog', 'Description'),
			'content' => Yii::t('blog', 'Content'),
			'alias' => Yii::t('blog', 'Alias'),
			'language' => Yii::t('blog', 'Language'),
			'metadesc' => Yii::t('blog', 'Meta Description'),
			'metakeys' => Yii::t('blog', 'Meta Keywords'),
			'status' => Yii::t('blog', 'Post Approved'),
            'image' => Yii::t('global', 'Image'),
		);
	}
	
	/**
	 * Make sure we delete any comments
	 */
	public function beforeDelete()
	{
		foreach($this->comments as $comment)
		{
			$comment->delete();
		}
		
		return parent::beforeDelete();
	}
	
	/**
	 * Work the rating and return
	 */
	public function getRating()
	{
		return $this->rating ? ceil($this->rating/$this->totalvotes) : 0;
	}
	
	/**
	 * Grab posts from the database by categories
	 */
	public function grabPostsByCats( $cats, $limit=10 )
	{
		// Grab the language data
		$criteria = new CDbCriteria;
		if( is_array($cats) && count($cats) )
		{
			$criteria->addInCondition('catid', $cats);
		}
		else
		{
			$criteria->addCondition('catid='.intval($cats));
			
		}
		
		// Can we see hidden posts?
		if( !Yii::app()->user->checkAccess('op_blog_manage') )
		{
			$criteria->addCondition('t.status=1');
		}
		
		// Order by post date
		$criteria->order = 'postdate DESC';
		
		
		$count = self::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = $limit;
		
		$pages->applyLimit($criteria);
		
		$posts = self::model()->byLang()->with(array('commentscount', 'author', 'category'))->findAll($criteria);
		
		return array( 'posts' => $posts, 'pages' => $pages );
	}
	
	/**
	 * Scopes
	 */
	public function scopes()
	{
		return array(
		            'byDate'=>array(
		                'order'=>'postdate DESC',
		            ),
					'limitIndex'=>array(
						'limit' => 10,
					),
					'byLang'=>array(
						'condition' => 't.language = :lang',
						'params' => array(':lang'=>Yii::app()->language),
					),
		        );
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->postdate = time();
			$this->authorid = Yii::app()->user->id;
		}
		else
		{
			$this->last_updated_date = time();
			$this->last_updated_author = Yii::app()->user->id;
		}
		
		if( $this->isNewRecord )
		{
			if( !$this->language )
			{
				$this->language = Yii::app()->language;
			}
		}
		
		// Don't post to a category that is readonly
		if( $this->catid )
		{
			$find = BlogCats::model()->findByPk($this->catid);
			
			if( ( $find && $find->readonly ) )
			{
				$this->addError('catid', Yii::t('blog', 'Sorry, That category is readonly.'));
				return;
			}
		}
		
		$this->language = ( is_array($this->language) && count($this->language) ) ? implode(',', $this->language) : $this->language;
		
		return parent::beforeSave();
	}
	
	/**
	 * Check if a user can edit a post
	 */
	public function canEditPost( $model )
	{
		if( Yii::app()->user->checkAccess('op_blog_manage') )
		{
			return true;
		}
		
		if( Yii::app()->user->id == $model->authorid )
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * Get alias after clean
	 */
	public function getAlias( $alias=null )
	{
		return Yii::app()->func->makeAlias( $alias !== null ? $alias : $this->alias );
	}
	
	/**
	 * Get link to blog post
	 */
	public function getLink( $name, $alias, $htmlOptions=array() )
	{
		return CHtml::link( CHtml::encode($name), array('/blog/view/' . $alias, 'lang'=>false), $htmlOptions );
	}
	
	/**
	 * Get link to blog post
	 */
	public function getModelLink( $htmlOptions=array() )
	{
		return $this->getLink( $this->title, $this->alias , $htmlOptions );
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('title, catid', 'required' ),
			array('title', 'length', 'min'=>3, 'max'=>88),
			array('catid, status', 'numerical'),
			array('alias', 'safe'),
            array('alias', 'CheckUniqueAlias'),
			//array('title', 'match', 'allowEmpty'=>false, 'pattern'=>'/[A-Za-z0-9\x80-\xFF]+$/'),
            array('image', 'length', 'max'=>150),
			array('metadesc, metakeys', 'length', 'max'=>200),
			array('language', 'safe'),
            array('id, parentid, title, alias, description, language, position, metadesc, metakeys, readonly, viewperms, addpostsperms, addcommentsperms, addfilesperms, autoaddperms', 'safe', 'on'=>'search'),

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
		$criteria->compare('catid',$this->catid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',Yii::app()->language,true);
		$criteria->compare('metadesc',$this->metadesc,true);
		$criteria->compare('metakeys',$this->metakeys,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('totalvotes',$this->totalvotes);
		$criteria->compare('status',$this->status);
		$criteria->compare('authorid',$this->authorid);
		$criteria->compare('postdate',$this->postdate);
		$criteria->compare('last_updated_date',$this->last_updated_date);
		$criteria->compare('last_updated_author',$this->last_updated_author);
        $criteria->compare('image',$this->image,true);
        
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
            return '<a href="'.Yii::app()->createUrl('admin/blog/update', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'Edit').'">
                <img src="/assets/images/update.png" />
            </a><a href="'.Yii::app()->createUrl('admin/blog/view', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'View').'">
                <img src="/assets/images/view.png" />
            </a>';
        }
        else{
            return '<a href="'.Yii::app()->createUrl('admin/blog/create', array('alias' => $this->alias, 'language'=> $lang)).'" class="tipb" data-original-title="'.Yii::t('global', 'Add').'">
                <i class="icon-plus"></i>
            </a>';
        }
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
				$this->addError('alias', Yii::t('blog', 'There is already a news with that alias and language combination.'));
			}
		}
		else
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND language = :lang AND id!=:id', array( ':id' => $this->id, ':alias' => $this->alias, ':lang' => $this->language ) ) )
			{
				$this->addError('alias', Yii::t('blog', 'There is already a news with that alias and language combination.'));
			}
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
}