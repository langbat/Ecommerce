<?php

/**
 * This is the model class for table "product_galleries_shop".
 *
 * The followings are the available columns in table 'product_galleries_shop':
 * @property integer $id
 * @property integer $product_shop_id
 * @property string $filename
 *
 * The followings are the available model relations:
 * @property ProductsShop $productShop
 */
class ProductGalleriesShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductGalleriesShop the static model class
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
		return 'product_galleries_shop';
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
			array('filename', 'required'),
			array('product_shop_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_shop_id, filename', 'safe', 'on'=>'search'),
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
			'productShop' => array(self::BELONGS_TO, 'ProductsShop', 'product_shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'product_shop_id' => Yii::t('global', 'Product Shop'),
			'filename' => Yii::t('global', 'Filename'),
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
		$criteria->compare('product_shop_id',$this->product_shop_id);
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    function showImage(){
        return '<a class="fancybox" href="/uploads/product_gallery_shop/'.$this->filename.'" rel="group">
            <img class="img-polaroid" src="/uploads/product_gallery_shop/'.$this->filename.'" style="height: 50px;" />
            </a>';
    }
    
    
}