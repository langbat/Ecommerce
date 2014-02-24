<?php

/**
 * This is the model class for table "products_shop".
 *
 * The followings are the available columns in table 'products_shop':
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property double $price_purchase
 * @property double $direct_buy_price
 * @property string $image
 * @property integer $shop_id
 * @property string $short_desciption
 * @property string $description
 * @property double $shipping_cost
 * @property integer $category_id
 * @property integer $is_active
 * @property string $created
 * @property string $updated
 * @property string $description_shipping_fee
 * @property integer shipping_immediately
 * @property string $units
 * @property double $value
 *
 * The followings are the available model relations:
 * @property MemberShop $shop
 */
class ProductsShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductsShop the static model class
	 */
    const STATUS_ACTIVE =1;
    const STATUS_INACTIVE =0;
    public $shopname,$categoryname,$totals;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products_shop';
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
			array('name, price, price_purchase, direct_buy_price ,short_desciption, units, value', 'required'),
			array('shop_id, is_active,shipping_immediately', 'numerical', 'integerOnly'=>true),
			array('price, price_purchase, direct_buy_price, shipping_cost,discount_percent', 'numerical'),
			array('name, image', 'length', 'max'=>255),
			array('short_desciption', 'length', 'max'=>1024),
			array('description, created, updated, description_shipping_fee, units, value, shipping_immediately,quantity', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, price, price_purchase, direct_buy_price, image, shop_id, short_desciption, description, shipping_cost, category_id, is_active, created, updated, shopname, categoryname, units, value,shipping_immediately,quantity', 'safe', 'on'=>'search'),
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
            'productCategoriesShop' => array(self::HAS_MANY, 'ProductCategoriesShop', 'product_id'),
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
			'price' => Yii::t('global', 'Price'),
			'price_purchase' => Yii::t('global', 'Price Purchase'),
			'direct_buy_price' => Yii::t('global', 'Direct Buy Price'),
			'image' => Yii::t('global', 'Image'),
			'shop_id' => Yii::t('global', 'Shop'),
			'short_desciption' => Yii::t('global', 'Short Desciption'),
			'description' => Yii::t('global', 'Description'),
            'discount_percent' => Yii::t('global', 'Discount Percent (%)'),
			'shipping_cost' => Yii::t('global', 'Shipping Cost'),
			'category_id' => Yii::t('global', 'Category'),
			'is_active' => Yii::t('global', 'Is Active'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
            'description_shipping_fee' => Yii::t('global', 'Description Shipping Fee'),
            'units' => Yii::t('global', 'Units (kg/m³...)'),
            'value' => Yii::t('global', 'Value'),
            'quantity' => Yii::t('global', 'Quantity'),
            'shipping_immediately' => Yii::t('global', 'Shipping Immediately'),
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
        $criteria->with     = array( 'shop', 'productCategoriesShop.category' );
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('price_purchase',$this->price_purchase);
		$criteria->compare('direct_buy_price',$this->direct_buy_price);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('short_desciption',$this->short_desciption,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('shipping_cost',$this->shipping_cost);
		$criteria->compare('category.id',$this->categoryname);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
        $criteria->compare('shop.name',$this->shopname);
        $criteria->compare('description_shipping_fee',$this->description_shipping_fee,true);
        $criteria->compare('units',$this->units,true);
        $criteria->compare('value',$this->value,true);
        $criteria->compare('shipping_immediately',$this->shipping_immediately,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                 'attributes'=>array(
                    'shopname'=>array(
                        'asc'=>'shop.name',
                        'desc'=>'shop.name DESC',
                    ),
                    'categoryname'=>array(
                        'asc'=>'category.name',
                        'desc'=>'category.name DESC',
                    ),
                    '*',
                ),
            ),
		));
	}
    public function getCategoriesShopId(){
        if ($this->id){        
            $models = ProductCategoriesShop::model()->findAllByAttributes(array('product_id' => $this->id)); 
            $arr = array();
            foreach ($models as $model)
                $arr[] = $model->category_id;
                
            return $arr;
        }
        return array();
    }
    
    function GetProductByShop( $shop_id = 0, $limit = 10 ){
        return self::model()->findAllByAttributes( array('shop_id'=>$shop_id), array('order'=> 'id DESC', 'limit'=> $limit ) );
    }
    
    function getCategoryByShop( $shop_id ){
        $sql = "SELECT categories_shop.id, categories_shop.name, categories_shop.alias
                FROM products_shop 
                INNER JOIN product_categories_shop
                ON products_shop.id = product_categories_shop.product_id
                INNER JOIN categories_shop 
                ON  product_categories_shop.category_id = categories_shop.id
                WHERE products_shop.shop_id = ".$shop_id." AND is_active = 1
                GROUP BY categories_shop.id";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
     function getProductCategoryShop( $id ){
        $catProducts    = ProductCategoriesShop::model()->findAllByAttributes(array('product_id' => $id));
        $listCatProduct = "";
        foreach($catProducts as $catProduct){
            $listCatProduct .= "<label class='catProduct'> <a href=".Yii::app()->createUrl('admin/categoriesShop/view/?id='.$catProduct['category']['id']).">".$catProduct['category']['name']."</a></label>";
        }
        return $listCatProduct;
    }
      function getProductCategoryShopBE( $id ){
        $catProducts    = ProductCategoriesShop::model()->findAllByAttributes(array('product_id' => $id));
        $listCatProduct = "";
        foreach($catProducts as $catProduct){
            $listCatProduct .= "<label class='catProduct'> <span>".$catProduct['category']['name']."</span></label>";
        }
        return $listCatProduct;
    }
    public function getCategoryProductByShop( $shop_id ){
        $sql = "SELECT products_shop.*, categories_shop.*
                FROM products_shop 
                INNER JOIN product_categories_shop
                ON products_shop.id = product_categories_shop.product_id
                INNER JOIN categories_shop 
                ON  product_categories_shop.category_id = categories_shop.id
                WHERE products_shop.shop_id = ".$shop_id;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
      public function getProductShopByShopId( $shop_id){
        if ($this->id){        
            $models = ProductsShop::model()->findAllByAttributes(array('shop_id' => $shop_id)); 
        return $models;
        }
    }
    
    function getStatusProduct($status){
        if($status==self::STATUS_ACTIVE)
            return Yii::t('global','active');
        return Yii::t('global','Inactive');
    }

    
    function getProductByCateShop( $shop_id, $cate_id, $limit = 0 ){
         $sql = "SELECT products_shop.*
                FROM products_shop 
                INNER JOIN product_categories_shop
                ON products_shop.id = product_categories_shop.product_id
                WHERE products_shop.shop_id = ".$shop_id." AND is_active = 1 AND product_categories_shop.category_id = ".$cate_id." ORDER BY id DESC";
         if( $limit > 0 )
            $sql .= " LIMIT ".$limit;
         return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function showAdminImageShop(){
        return '<a class="fancybox" href="/uploads/product_shop/'.$this->image.'" rel="group">
                    <img class="img-polaroid fix_image_products" src="/uploads/product_shop/'.$this->image.'" style="height: 40px;"/>
                </a>';
    }
    
    public function getProductsShopByNotExitst( $id_shop, $listproduct){
        $sql = "SELECT * FROM products_shop WHERE shop_id = " . $id_shop . " AND id NOT IN (".$listproduct.") ORDER BY id DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function checkProductsShop($id_shop){
        $criteria->condition = "shop_id=".$id_shop ;
        $dataProvider=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                     'id', 'name', 'price', 'price_purchase', 'direct_buy_price', 'shop_id', 'category_id'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>9,
            ),
        ));
        return $dataProvider;
    }
    public function getProductShopByPrice($id_shop, $price, $sort){
        $criteria = new CDbCriteria();
        if(is_numeric($price) == false){
             $criteria->condition = 'shop_id ='.$id_shop.' AND direct_buy_price > 1000';
         }else{
             $criteria->condition = 'shop_id ='.$id_shop.' AND direct_buy_price <= '.$price.'';
         }
         $criteria->order = 'id DESC';
         $criteria->order = $sort;
         $dataProvider = new CActiveDataProvider('ProductsShop', array(
             'criteria'=>$criteria,
             'pagination'=>array(
                 'pageSize'=>9,
             ),
         ));
        return $dataProvider;
    }
    
    public function getProductShopByStar($id_shop, $star, $sort){
        $results = array();
        $product = ProductsShop::model()->getProductShopByIdShop($id_shop);
        if((is_numeric($star) == false)){
            $productshop = ProductsShop::model()->getAllProductShop($id_shop, $sort);
        }else{
            foreach ($product as $id){
                $temp = (int)Ratings::model()->getRating($id['id'], 1 );
                if($temp == $star){
                    $results[]  = $id['id'];
                }
            }
            $criteria = new CDbCriteria();
            $criteria->condition = "id IN (".implode(',' , ($results)? $results: array(0)).")";
            $criteria->order = 'id DESC';
            $criteria->order = $sort;
            $productshop = new CActiveDataProvider('ProductsShop', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>9,
                ),
            ));
        }
        return $productshop;
    }
    function getIdsOfCategoryShop($category_id, $shop_id){
        $sql = "SELECT * FROM product_categories_shop INNER JOIN products_shop
                ON product_categories_shop.product_id = products_shop.id
                WHERE product_categories_shop.category_id =".$category_id." 
                AND products_shop.shop_id =".$shop_id."";
        $results = array();
        $ids = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($ids as $id){
            $results[]  = $id['product_id'];
        }
        return $results;
    }
    public function getProductShopDetail($id_product){
        $sql = "SELECT * FROM product_galleries_shop INNER JOIN products_shop
                ON products_shop.id = product_galleries_shop.product_shop_id
                WHERE products_shop.id = ".$id_product."";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    public function getProductShopByIdProductShop($id_product){
        $result = ProductsShop::model()->find(array(
                'select'=>'*',
                'condition'=>'id=:product_id',
                'params'=>array(':product_id'=>$id_product)
            ));
         return $result;   
    }
    public function getNameCategory($shop_id, $id_product){
        $sql = "SELECT categories_shop.id, categories_shop.name 
                FROM product_categories_shop INNER JOIN products_shop
                ON product_categories_shop.product_id = products_shop.id
                INNER JOIN categories_shop ON categories_shop.id = product_categories_shop.category_id
                WHERE products_shop.shop_id = ".$shop_id. " and products_shop.id= ".$id_product." 
                GROUP BY categories_shop.id";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function getProductShopByIdShop($shop_id){
        $sql = "SELECT * FROM products_shop WHERE shop_id = ". $shop_id ." ORDER BY id DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
        
    }

    public function getCountProductMemberShop($id){
        $criteria               =  new CDbCriteria();
        $criteria->with         = "shop";
        $criteria->select       = " COUNT(t.id) as totals";
        $criteria->condition    = "shop.id =".$id;
        $total = ProductsShop::model()->find($criteria);
        return $total->totals;
    }
    
    public function countProductByIdMember($id){
        $sql ="SELECT COUNT(products_shop.id) as total FROM members INNER JOIN member_shop
                ON member_shop.user_id = members.id
                INNER JOIN products_shop ON products_shop.shop_id = member_shop.id
                WHERE member_shop.user_id = ".$id ."";
        return  Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
    public function ProductShopDetailNew( $id ){
        $sql = "SELECT products_shop.*,product_galleries_shop.filename 
                FROM products_shop 
                LEFT JOIN product_galleries_shop 
                ON products_shop.id = product_galleries_shop.product_shop_id 
                WHERE products_shop.id = ".$id;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function getProductsShopExists( $id_shop, $listproduct ){
        $sql = "SELECT * FROM products_shop WHERE shop_id = " . $id_shop . " AND id IN (".$listproduct.") ORDER BY id DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function getTotalProductsShop($id_shop){
        $sql = "SELECT count(*) FROM products_shop WHERE shop_id = " . $id_shop;
        return  Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
    function getProductShopByList( $list_product_id, $option = 0 ){
        $sql            = "SELECT * FROM products_shop WHERE id IN (".$list_product_id.") ORDER BY id DESC";
        $Products       = Yii::app()->db->createCommand($sql)->queryAll();
        $listProduct    = "";
        if( $option == 1 ){
            foreach($Products as $Product){
                $listProduct .= "<label class='catProduct'> <a href=".Yii::app()->createUrl('productShopManager/view?id='.$Product['id'])." target='_blank'> - ".$Product['name']."</a></label>";
            }
        }
        else{
            foreach($Products as $Product){
                $listProduct .= "<label class='catProduct'> <a href=".Yii::app()->createUrl('admin/productsShop/view/?id='.$Product['id'])."> - ".$Product['name']."</a></label>";
            }
        }
        return $listProduct;
    }
    
    public function getProductShopByCategory($shop_id, $category_id, $sort){
        $categoryshop_tmp = ProductCategoriesShop::model()->findByAttributes(array('category_id' => $category_id));
        $product_shop_ids = ProductsShop::getIdsOfCategoryShop($categoryshop_tmp->category_id, $shop_id);
        $productcategotyshop = new CActiveDataProvider('ProductsShop', array(
            'criteria' => array(
                'order' => $sort,
                'condition' => "id IN (".implode(',' , ($product_shop_ids)? $product_shop_ids: array(0)).")",
            ),
            'pagination'=>array(
                'pageSize'=>9,
            )
        ));
        return $productcategotyshop;
    }
    public function getAllProductShop($shop_id, $sort){
        $criteria = new CDbCriteria();
        $criteria->condition = "shop_id =".$shop_id;
        $criteria->order = $sort;
        $productshop=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>9,
            ),
        ));
        return $productshop;
    }
    public function getAllProductShopByLikeName($name){
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name',$name);
        $productshop=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>9,
            ),
        ));
        return $productshop;
    }
    
    public function getTotalProductShop()
	{
	   $sql = "SELECT COUNT(*) FROM products_shop WHERE is_active = '1'";
       return Yii::app()->db->createCommand($sql)->queryScalar();
	}
    public function getNameProductShop($product_id){
        $result = ProductsShop::model()->find(array(
                    'select'=>'name',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$product_id ) )
            );
          return  $result['name'];
    }
    public function getAllProductsShopByLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price){
        
        $criteria = new CDbCriteria();
        $sort     = 'id DESC'; 
        $product_ids = ProductsShop::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price);
         if(isset($_POST['sort']))
           Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort'])?Yii::app()->session['sort']:$sort;
        $criteria->order = $sort;
          if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
         if($category!=''&&$category!='null'){
             $criteria->join="JOIN product_categories_shop ON t.id = product_categories_shop.product_id";
             $category = " AND product_categories_shop.category_id=".$category;
         }elseif($category!='null'){
            $criteria->join="JOIN product_categories_shop ON t.id = product_categories_shop.product_id";
            $category = " AND product_categories_shop.category_id=0";
         }else{
            $category='';
         }
         if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
             //var_dump($min,$max);exit();
         }
           
        $criteria->condition = "t.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$category.$price;
        
        $products=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
        ));
        return $products;
    }
    public function getIdsOfProductsShopLikeName($name,$free_shipping,$reduced,$in_stock,$price){
        $results = array();
         if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
        $product_ids = ProductsShop::model()->getIdsOfProductByLikeName($name);
        $join = '';
         if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
             //var_dump($min,$max);exit();
         }
         $sql = "SELECT * FROM products_shop  WHERE products_shop.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$price;         
                  
        $ids = Yii::app()->db->createCommand($sql)->queryAll();       
        foreach ($ids as $id){
                $results[]  = $id['id'];  
        }
        return $results;
    }
    public function getSearchProductShop($shop_id, $name, $sort){
        $criteria = new CDbCriteria();
        $criteria->condition = "shop_id = ".$shop_id." and name like '%".$name."%'";
        $criteria->order = $sort;
        $productshop=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>9,
            ),
        ));
        return $productshop;
    }
    public function getSearchProductShopByName($name){
        $criteria = new CDbCriteria();
        $criteria->condition = "name like '%".$name."%'";
        $productshop=new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>12,
            ),
        ));
        return $productshop;
    }
    public function getProductShopAll(){
        $productshop=new CActiveDataProvider('ProductsShop');
        return $productshop;
    }
      public function getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price){
        $product_ids = ProductsShop::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price);
        //var_dump($category,$product_ids);
        $join = '';
        if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
         if($category!=''&&$category!='null'){
             $join="INNER JOIN product_categories_shop ON products_shop.id = product_categories_shop.product_id";
             $category = " AND product_categories_shop.category_id=".$category;
         }elseif($category!='null'){
            $join="INNER JOIN product_categories_shop ON products_shop.id = product_categories_shop.product_id";
            $category = " AND product_categories_shop.category_id=0";
         }else{
            $category='';
         }
         if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
             //var_dump($min,$max);exit();
         }
        $results = ProductsShop::model()->findAllBySql("SELECT * FROM products_shop ".$join." WHERE products_shop.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$category.$price);
        return $results;
    }
    public function getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price){
        $results = array();
         if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
        $product_ids = ProductsShop::model()->getIdsOfProductByLikeName($name);
        $join = '';
         if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
             //var_dump($min,$max);exit();
         }
         $sql = "SELECT * FROM products_shop  WHERE products_shop.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$price;         
                  
        $ids = Yii::app()->db->createCommand($sql)->queryAll();       
        foreach ($ids as $id){
                $results[]  = $id['id'];  
        }
        return $results;
    }
     public function getIdsOfProductByLikeName($name){
        $results = array();
        $ids = ProductsShop::model()->findAllBySql("SELECT * FROM products_shop WHERE `name` LIKE '%".$name."%'");
        foreach ($ids as $id){
            $results[]  = $id->id;
        }
        return $results;
    }
}