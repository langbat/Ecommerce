<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property integer $type
 * @property integer $is_active
 * @property string $filename
 * @property string $content
 * @property string $link
 * @property string $created
 */
class Banners extends CActiveRecord
{
    const POSITION_TOP = 1;
    const POSITION_RIGHT = 2;
    
    const TYPE_IMAGE = 1;
    const TYPE_FLASH = 2;
    const TYPE_CONTENT = 3;    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banners the static model class
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
		return 'banners';
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
			array('name, position, type', 'required'),
            array('filename', 'file','types'=>'jpg, gif, png, swf', 'allowEmpty'=>true),
			array('type, is_active', 'numerical', 'integerOnly'=>true),
			array('name, filename, link', 'length', 'max'=>512),
			array('position', 'length', 'max'=>32),
			array('content, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, position, type, is_active, filename, content, link, created', 'safe', 'on'=>'search'),
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
			'position' => Yii::t('global', 'Position'),
			'type' => Yii::t('global', 'Type'),
			'is_active' => Yii::t('global', 'Is Active'),
			'filename' => Yii::t('global', 'Filename'),
			'content' => Yii::t('global', 'Content'),
			'link' => Yii::t('global', 'Link'),
			'created' => Yii::t('global', 'Created'),
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
		$criteria->compare('position',$this->position,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function show(){
        $html = '';
        if ($this->type == self::TYPE_CONTENT){
            echo $this->content;
        }
        else if ($this->type == self::TYPE_IMAGE){
            if ($this->link) $html .= '<a href="'.$this->link.'" target="_blank">';
            $html .= '<img src="/uploads/banner/'.$this->filename.'" />';
            if ($this->link) $html .= '</a>';
            
            echo $html;
        }
        else{
            $source = Yii::app()->basePath."/../uploads/banner/$this->filename";
            list($width, $height) = getimagesize($source);
            
            if ($this->link) $html .= '<a href="'.$this->link.'" target="_blank">';
            $html .= '
                <object width="'.$width.'" height="'.$height.'" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
                    <param name="src" value="/uploads/banner/'.$this->filename.'" />
                    <embed src="/uploads/banner/'.$this->filename.'" width="'.$width.'" height="'.$height.'" />
                </object>';
            if ($this->link) $html .= '</a>';
            
            echo $html;
        }
    }

    public static function showPosition($position, $box_class = 'right-box'){
        $banners = Banners::model()->findAllByAttributes(array('position' => $position, 'is_active' => 1));
        foreach ($banners as $banner){
            if (!Yii::app()->user->isGuest && $banner->id == 3) continue;
            echo '<div class="'.$box_class.'">';
            $banner->show();
            echo '</div>';
        }
            
    }
    
    public function showAdvPosition( $position ){
        $banners = Banners::model()->findAllByAttributes(array('position'=>$position, 'is_active'=>1), array('order'=>'id ASC' ,'limit' => 2) );
        return $banners;
    }
}