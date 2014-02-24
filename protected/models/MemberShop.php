<?php

/**
 * This is the model class for table "member_shop".
 *
 * The followings are the available columns in table 'member_shop':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $slogan
 * @property string $email
 * @property string $image
 * @property string $description
 * @property string $created
 * @property string $updated
 * @property integer $is_special
 * @property string $welcome
 * @property string $service
 * @property string $apiUsername
 * @property string $apiPassword
 * @property string $apiSignature
 * @property integer $apiLive
 * @property string $banner
 * 
 * The followings are the available model relations:
 * @property CategoriesShop[] $categoriesShops
 * @property Members $user
 * @property ProductsShop[] $productsShops
 */
class MemberShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberShop the static model class
	 */
    const SPECIAL_ACTIVE    = 1;
    const SPECIAL_INACTIVE  = 0;
    public $username, $totals,$countProduct;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member_shop';
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
			array('user_id, name, apiUsername, apiPassword, apiSignature, apiLive', 'required'),
			array('user_id, delFlag, is_special, apiLive', 'numerical', 'integerOnly'=>true),
			array('name, slogan, email, banner', 'length', 'max'=>255),
			array('image', 'length', 'max'=>355),
			array('description, service, welcome, created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, slogan, email, image, description, created, updated,username, delFlag, is_special , apiUsername, apiPassword, apiSignature, apiLive, banner', 'safe', 'on'=>'search'),
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
            'categoriesShops' => array(self::HAS_MANY, 'CategoriesShop', 'shop_id'),
			'user' => array(self::BELONGS_TO, 'Members', 'user_id'),
            'productsShops' => array(self::HAS_MANY, 'ProductsShop', 'shop_id'),
            'order' => array(self::HAS_MANY, 'Orders', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'user_id' => Yii::t('global', 'User'),
			'name' => Yii::t('global', 'Name'),
			'slogan' => Yii::t('global', 'Slogan'),
			'email' => Yii::t('global', 'Email'),
			'image' => Yii::t('global', 'Image'),
			'description' => Yii::t('global', 'Description'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
            'is_special' => Yii::t('global', 'Special'),
            'welcome' => Yii::t('global', 'Welcome'),
            'service' => Yii::t('global', 'Service '),
            'apiUsername' => Yii::t('global', 'Api Username'),
            'apiPassword' => Yii::t('global', 'Api Password'),
            'apiSignature' => Yii::t('global', 'Api Signature'),
            'apiLive' => Yii::t('global', 'Api Live'),
            'banner' => Yii::t('global', 'Banner'),
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
        $criteria->with     = array('user');
        $criteria->compare('t.id',$this->id);
		$criteria->compare('user_id',$this->user_id);
 	    $criteria->compare('user.username',$this->username);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slogan',$this->slogan,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
        $criteria->compare('apiUsername',$this->apiUsername,true);
        $criteria->compare('apiPassword',$this->apiPassword,true);
        $criteria->compare('apiSignature',$this->apiSignature,true);
        $criteria->compare('apiLive',$this->apiLive);
        if ($this->created)
            $criteria->compare('DATE(created)',date('Y-m-d', strtotime($this->created)),true);
		 if ($this->updated)
            $criteria->compare('DATE(updated)',date('Y-m-d', strtotime($this->updated)),true);
        $criteria->compare('delFlag',$this->delFlag);
        $criteria->compare('is_special',$this->is_special);
        $criteria->compare('welcome',$this->welcome);
        $criteria->compare('service',$this->service);
        $criteria->compare('banner',$this->banner,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                'attributes'=>array(
                    'username'=>array(
                        'asc'=>'user.username',
                        'desc'=>'user.username DESC',
                    ),
                    '*',
                ),
            ),
		));
	}
    
    function getStatusProductShop($status){
        if($status==self::SPECIAL_ACTIVE)
            return Yii::t('global','active');
        return Yii::t('global','Inactive');
    }
    
    function showAdminImage(){
        return '<a class="fancybox" href="/uploads/logoshop/'.$this->image.'" rel="group">
                    <img class="img-polaroid fix_image_products" src="/uploads/logoshop/'.$this->image.'" style="height: 40px;"/>
                </a>';
    }
    
    function getNameShop(  ){
        $tableMemberShop = $this->tableName();
        return Yii::app()->db->createCommand()
                                        ->select('id,name')
                                        ->from($tableMemberShop)
                                        ->queryAll();
    }
    public function getMemberShopByIdMember($id){
        $result = MemberShop::model()->find(array(
                'select'=>'*',
                'condition'=>'user_id=:id',
                'params'=>array(':id'=>$id),
        ));
        return $result;
    }
    public function getMemberShop(){
        $MemberShop = MemberShop::model()->findAll();
        return $MemberShop;
    }
    public function getMemberShopById($id){
        $MemberShop = MemberShop::model()->findByPk($id);
        return $MemberShop;
    }

    public function getInforMembershop($id_shop){
        $sql = "SELECT member_shop.*, username, gender, joined, address, phone  FROM member_shop INNER JOIN members
        ON member_shop.user_id = members.id where member_shop.id = ".$id_shop. "";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    public function getMemberShopByIdMemberShop($id_user){
        $result = MemberShop::model()->find(array(
            'select'=>'*',
            'condition'=>'user_id=:user_id',
            'params'=>array(':user_id'=>$id_user),
        ));
        return $result;
    }
   
    public function getIdShop($id_user){
        $result = MemberShop::model()->find(array(
            'select'=>'id',
            'condition'=>'user_id=:user_id',
            'params'=>array(':user_id'=>$id_user),
        ));
        return $result['id'];
    }
    public function checkMember($shop_id, $user_id){
        $sql = "SELECT members.id, member_shop.id, member_shop.name, member_shop.user_id FROM member_shop
        INNER JOIN members ON member_shop.user_id = members.id
        WHERE member_shop.id = ". $shop_id ." AND member_shop.user_id =".$user_id."";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function getSettings($shop_id){
        $method = MemberShop::model()->findByPk($shop_id);
        $result=array();
        if($method){
            $result = array(
                'apiUsername'=>$method->apiUsername,
                'apiPassword'=>$method->apiPassword,
                'apiSignature'=>$method->apiSignature,
                'apiLive'=>$method->apiLive
            );
        }

        return $result;
    }
    public function getNameShops($id){
       $result = MemberShop::model()->find(array(
                    'select'=>'name',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$id ) )
            );

          return  $result['name'];
    }
    
    function getNameShopById( $id ){
        $tableMemberShop = $this->tableName();
        return Yii::app()->db->createCommand()
                                        ->select('id,name')
                                        ->from($tableMemberShop)
                                        ->where( 'id=:id', array(':id'=>$id) )
                                        ->queryAll();
    }
    public function getAllShop($sort){
        $criteria = new CDbCriteria();
        $criteria->order = $sort;
        $sqlcount = "SELECT COUNT(ab.id) AS total_id FROM (";
        $sql = "SELECT member_shop.*, 
                COUNT(products_shop.id) AS totals FROM products_shop 
                INNER JOIN member_shop ON products_shop.shop_id = member_shop.id
        GROUP BY member_shop.id";
        if( $sort != '' ){
            $sql .= " ORDER BY ".$sort." ";
        }
        $sqlcount .= $sql." ) AS ab WHERE ab.totals > 0";
      
        $count = Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $allshop = new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
                'attributes'=>array(
                        'member_shop.id' => array(
                           'asc' => 'member_shop.id',
                           'desc' => 'member_shop.id' 
                      ),
                      'member_shop.name' => array(
                           'asc' => 'member_shop.name',
                           'desc' => 'member_shop.name' 
                      ),
                    ),
            ),
            'pagination'=>array(
                'pageSize'=>12,
            ),
        ));
        return $allshop; 
        
    } 
    public function checkUser($user_id){
        $memberShop = MemberShop::model()->find(array(
            'select'=>'*',
            'condition'=>'user_id=:user_id',
            'params'=>array(':user_id'=>$user_id),
        ));
        //findAllByAttributes(array('user_id'=>$user_id));
        if($memberShop == null){
            return false;
        }else{
            return $memberShop;
        }
    }
    
    public function getTotalShop()
	{
		return Yii::app()->db->createCommand("SELECT COUNT(*) FROM member_shop")->queryScalar();
	}
    
}