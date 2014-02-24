<?php

/**
 * This is the model class for table "product_comments".
 *
 * The followings are the available columns in table 'product_comments':
 * @property integer $id
 * @property integer $product_id
 * @property integer $type
 * @property string $content
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class ProductComments extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductComments the static model class
     */
    const TYPE_PRODUCT = 1;
    const TYPE_PRODUCT_SHOP = 0;
    const TYPE_SHOP = 2;
    public $product_name, $productshop_name;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'product_comments';
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
            array('product_id, type, content', 'required'),
            array('product_id, type', 'numerical', 'integerOnly'=>true),
            array('content, created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_id, type, productshop_name, content, created, product_name', 'safe', 'on'=>'search'),
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
            'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
            'productshop' => array(self::BELONGS_TO, 'ProductsShop', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'product_id' => Yii::t('global', 'Product'),
            'type' => Yii::t('global', 'Type'),
            'content' => Yii::t('global', 'Content'),
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
        $criteria->compare('product_id',$this->product_id);
        $criteria->compare('type',$this->type);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('product.name',$this->product_name);
        $criteria->compare('productshop.name',$this->productshop_name);
        if ($this->created)
		    $criteria->compare('created',date('Y-m-d ', strtotime($this->created)),true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC'
                ),
        ));
    }

    public function getCommentProduct($id){
        $criteria =  new CDbCriteria();
        $criteria->condition = " product_id = ".$id." AND type=".self::TYPE_PRODUCT;
        $criteria->order = 'created DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function getCommentProductShop($id){
        $criteria =  new CDbCriteria();
        $criteria->condition = " product_id = ".$id." AND type=".self::TYPE_PRODUCT_SHOP;
        $criteria->order = 'created DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>5
        ),

        ));
    }
    public function getAllTyprComment(){
        $sql = "SELECT TYPE FROM product_comments GROUP BY type";
        $type =  Yii::app()->db->createCommand($sql)->queryAll();
		return $type;
    }
    
    public function getProductname(){
        $criteria=new CDbCriteria;
        $criteria->with ="product";
        
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('product.name',$this->product_name,true);
        if ($this->created)
		    $criteria->compare('t.created',date('Y-m-d ', strtotime($this->created)),true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC'
                ),
        ));
    }
    public function getProductShopname(){
        $criteria=new CDbCriteria;
        $criteria->with ="productshop";
        
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('productshop.name',$this->productshop_name,true);
        if ($this->created)
		    $criteria->compare('t.created',date('Y-m-d ', strtotime($this->created)),true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC'
                ),
        ));
    }
}