<?php

/**
 * This is the model class for table "widget".
 *
 * The followings are the available columns in table 'widget':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property string $language
 */
class Widgets extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Widget the static model class
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
		return 'widgets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias, content', 'required'),
			array('alias', 'CheckUniqueAlias'),
			array('alias', 'match', 'allowEmpty'=>false, 'pattern'=>'/^[A-Za-z0-9_-]+$/'),
			array('title, alias', 'length', 'max'=>100),
            array('id,title,alias','safe', 'on'=>'search'),
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
            'title' => Yii::t('global', 'Title'),
            'alias' => Yii::t('global', 'Alias'),
            'content' => Yii::t('global', 'Content'),
            'language' => Yii::t('global', 'Language'),
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

    public static function show($alias, $return = false){
        $model = self::model()->findByAttributes(array('alias' => trim($alias), 'language' => Yii::app()->language));
        $html = '';
        if (!$model) return '';
        //parse page link
        preg_match_all('/\[page\](.+?)\[\/page\]/i', $model->content, $matches);
        
        if (is_array($matches[1]) && count($matches[1])){
            foreach ($matches[1] as $i=>$page_alias){
                $customPages = CustomPages::model()->findByAttributes(array('alias' => $page_alias,'language'=> Yii::app()->language));
            
                if($customPages){
        			$model->content = str_replace(
                        $matches[0][$i],
                        CHtml::link( $customPages->title, array('custompages/index', 'alias'=>$page_alias)),
                        $model->content                        
                    );
        		}
                else{
                    $model->content = str_replace(
                        $matches[0][$i], 
                        '',
                        $model->content
                    );
                }
            }
        }      
        
        if ($model->title){
            $html = '<p><strong>'.$model->title.'</strong></p>'.$model->content;    
        }
        else   $html = $model->content;
        
        if ($return) return $html;
        
        echo $html;
        
    }
    public static function showCustomSupport($alias, $return = false){
        $model = self::model()->findByAttributes(array('alias' => trim($alias), 'language' => Yii::app()->language));
        $html = '';
        if (!$model) return '';
        //parse page link
        preg_match_all('/\[page\](.+?)\[\/page\]/i', $model->content, $matches);
       // var_dump($matches);exit();
        if (is_array($matches[1]) && count($matches[1])){
            foreach ($matches[1] as $i=>$page_alias){
               // var_dump($page_alias);
                $customSupportPages = CustomSupportPages::model()->findByAttributes(array('alias' => $page_alias,'language'=> Yii::app()->language ,'status'=>'1'));
            //var_dump($customSupportPages); 
                if($customSupportPages){
        			$model->content = str_replace(
                        $matches[0][$i],
                        CHtml::link( $customSupportPages->title, array('customsupportpages/index', 'alias'=>$page_alias)),
                        $model->content                        
                    );
        		}
                else{
                    $model->content = str_replace(
                        $matches[0][$i], 
                        '',
                        $model->content
                    );
                }
            }
        }      
        
      //  if ($model->title){
          //  $html = '<p><strong>'.$model->title.'</strong></p>'.$model->content;    
       // }
       // else   
       $html = $model->content;
        
        if ($return) return $html;
       // var_dump($html);
        echo $html;
        
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('language',Yii::app()->language,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
    //end copy
    
    
    
}