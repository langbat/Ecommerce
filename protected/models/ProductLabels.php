<?php

/**
 * This is the model class for table "product_labels".
 *
 * The followings are the available columns in table 'product_labels':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Products[] $products
 */
class ProductLabels extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductLabels the static model class
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
		return 'product_labels';
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
			array('name', 'required'),
		    array('name, image', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, created, updated', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Products', 'label_id'),
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
			'image' => Yii::t('global', 'Image'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
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
		$criteria->compare('image',$this->image,true);
        if ($this->created)
            $criteria->compare('DATE(created)',date('Y-m-d', strtotime($this->created)),true);
		//$criteria->compare('created',$this->created,true);
		//$criteria->compare('updated',$this->updated,true);
        if ($this->updated)
            $criteria->compare('DATE(updated)',date('Y-m-d', strtotime($this->updated)),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
              'defaultOrder'=>'id DESC',
            )
		));
	}
    
      function showAdminImage(){
        return '<a class="fancybox" href="/uploads/label/'.$this->image.'" rel="group">
                    <img class="img-polaroid fix_image_products" src="/uploads/label/'.$this->image.'" style="height: 40px;"/>
                </a>';
    }
    
    function getProductLabel(){
        $table_label = self::tableName();
        return Yii::app()->db->createCommand()
                             ->select('*')
                             ->from($table_label)
                             ->order('id DESC')
                             ->queryAll();
        
    }
    
}