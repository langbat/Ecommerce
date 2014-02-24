<?php

/**
 * This is the model class for table "shop_newsletter".
 *
 * The followings are the available columns in table 'shop_newsletter':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $joined
 * @property integer $shop_id
 */
class ShopNewsletter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopNewsletter the static model class
	 */
     public $shopid;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_newsletter';
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
			array('shop_id, name, email', 'required'),
			array('joined, shop_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, joined, shop_id', 'safe', 'on'=>'search'),
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
            'shop' => array(self::BELONGS_TO, 'MemberShop', 'shop_id'),
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
			'joined' => Yii::t('global', 'Joined'),
			'shop_id' => Yii::t('global', 'Shop'),
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
        
        $criteria->together = true;
        $criteria->with     = array( 'shop');
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('joined',$this->joined);
		$criteria->compare('shop_id',$this->shop_id);
        $criteria->compare('shop.id',$this->shopid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getNewletterByIdShop($shop_id){
        $criteria=new CDbCriteria;
        $criteria->condition =  "shop_id = ". $shop_id;
        $newletter=new CActiveDataProvider('ShopNewsletter', array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC',
                 'attributes'=>array(
                    'id'=>array(
                        'asc'=>'id',
                        'desc'=>'id DESC',
                    ),
                    'name'=>array(
                        'asc'=>'name',
                        'desc'=>'name DESC',
                    ),
                    'email'=>array(
                        'asc'=>'email',
                        'desc'=>'email DESC',
                    ),
                    'joined'=>array(
                        'asc'=>'joined',
                        'desc'=>'joined DESC',
                    ),
                    '*',
                ),
            ),
        ));
        return $newletter;
    }
    public function countNewletter($shop_id)
    {
        $sql = "SELECT COUNT(id) as totals from shop_newsletter WHERE shop_id =".$shop_id."";
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    public function getNewletter($shop_id)
    {
        $sql = "select * from shop_newsletter where shop_id = ".$shop_id ."";
        $newsletter = ShopNewsletter::model()->findAllbySql($sql);
        return $newsletter;
    }
    public function checkShopNewletter( $id_shop , $id_newletter){
        $sql =  "SELECT * FROM shop_newsletter WHERE id = ".$id_newletter." AND shop_id = ".$id_shop."";
        $shopnewletter = Yii::app()->db->createCommand($sql)->queryAll();
        if($shopnewletter == null){
            return false;
        }else{
            return true;
        }
    }
}