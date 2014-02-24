 <?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property double $price_purchase
 * @property double $direct_buy_price
 * @property string $image
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property string $short_desciption
 * @property string $description
 * @property double $shipping_cost
 * @property integer $producer_id
 * @property integer $is_active
 * @property string $video
 * @property integer $ordered_count
 * @property string $start_time
 * @property string $end_time
 * @property integer $label_id
 * @property integer $is_special
 * @property string $type_shipping
 * @property string $availble_ship
 * @property string $availble_pickup
 * @property integer shipping_immediately
 * @property string $description_shipping_fee
 * @property string $units
 * @property double $value
 * @property double $quantity
 */
class Products extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Products the static model class
     */
    const STATUS_ACTIVE =1;
    const STATUS_INACTIVE =0;
    public $producer_name,$category,$average;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'products';
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
            array('name, price,  direct_buy_price,units,value,  short_desciption,type_shipping, availble_ship, availble_pickup', 'required'),
            array('user_id, producer_id, is_active, sell_qty, ordered_count, label_id, is_special, shipping_immediately', 'numerical', 'integerOnly'=>true),
            array('price, price_purchase, direct_buy_price, shipping_cost, sell_amount, discount_percent', 'numerical'),
            array('name, image, video, type_shipping, availble_ship, availble_pickup', 'length', 'max'=>255),
            array('short_desciption', 'length', 'max'=>1024),
            array('created, updated, description,type_shipping, availble_ship, availble_pickup, description_shipping_fee,units,value,quantity', 'safe'),
            array('video', 'file', 'allowEmpty'=>true, 'types'=>'avi, 3gp, m4v, mov, wmv, mpeg, mp4','allowEmpty' => true, 'maxSize' => 1024 * 1024 * 50, 'tooLarge' => 'The file was larger than 50MB. Please upload a smaller file.'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, price, price_purchase, direct_buy_price, image, created, updated, user_id, short_desciption, description, shipping_cost, producer_id, is_active, sell_amount, sell_qty, video, ordered_count, start_time, end_time, label_id, tag, is_special, discount_percent, type_shipping, availble_ship, availble_pickup, shipping_immediately,units,value,quantity', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'Members', 'user_id'),
            /*'productCategories' => array(self::HAS_MANY, 'ProductCategories', 'auction_id'),*/
            'productCategories' => array(self::HAS_MANY, 'ProductCategories', 'product_id'),
            'productGalleries' => array(self::HAS_MANY, 'ProductGalleries', 'auction_id'),
            'producer' => array(self::BELONGS_TO, 'Producers', 'producer_id'),
            'productTags' => array(self::HAS_MANY, 'ProductTags', 'product_id'),
            'scheduleShows' => array(self::HAS_MANY, 'ScheduleShows', 'product_id'),
            'productComments' => array(self::HAS_MANY, 'ProductComments', 'product_id'),
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
            'price' => Yii::t('global', 'Reg'),
            'direct_buy_price' => Yii::t('global', 'Was'),
            'image' => Yii::t('global', 'Image'),
            'created' => Yii::t('global', 'Created'),
            'updated' => Yii::t('global', 'Updated'),
            'user_id' => Yii::t('global', 'User'),
            'short_desciption' => Yii::t('global', 'Short Desciption'),
            'description' => Yii::t('global', 'Description'),
            'producer_id' => Yii::t('global', 'Producer'),
            'is_active' => Yii::t('global', 'Is Active'),
            'shipping_cost' => Yii::t('global', 'Shipping cost'),
            'price_purchase' => Yii::t('global', 'Sale'),
            'discount_percent' => Yii::t('global', 'Discount Percent (%)'),
            'video' => Yii::t('global', 'Product Video'),
            'ordered_count' => Yii::t('global', 'Ordered Count'),
            'start_time' => Yii::t('global', 'Start Time'),
            'end_time' => Yii::t('global', 'End Time'),
            'label_id' => Yii::t('global', 'Label'),
            'is_special' => Yii::t('global', 'Is Special'),
            'type_shipping' => Yii::t('global', 'Type Shipping'),
            'availble_ship' => Yii::t('global', 'Availble Ship'),
            'availble_pickup' => Yii::t('global', 'Availble from Pickup'),
            'shipping_immediately'=>Yii::t('global', 'Shipping Immediately'),
            'description_shipping_fee' => Yii::t('global', 'Description Shipping Fee'),
            'units' => Yii::t('global', 'Units (kg/m³...)'),
            'value' => Yii::t('global', 'Value'),
            'quantity' =>Yii::t('global', 'Quantity'),
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
        $criteria->with = array('producer','productCategories.category');
        $amount = floatval(str_replace(',','.',str_replace('.','',$this->average)));
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.price',$this->price);
        $criteria->compare('direct_buy_price',$this->direct_buy_price);
        $criteria->compare('t.image',$this->image,true);
        $criteria->compare('t.created',$this->created,true);
        $criteria->compare('t.updated',$this->updated,true);
        $criteria->compare('t.user_id',$this->user_id);
        $criteria->compare('short_desciption',$this->short_desciption,true);
        $criteria->compare('t.description',$this->description,true);
        $criteria->compare('producer_id',$this->producer_id);
        $criteria->compare('is_active',$this->is_active);
        $criteria->compare('shipping_cost',$this->shipping_cost);
        $criteria->compare('producer.name',$this->producer_name);
        $criteria->compare('category.id',$this->category);
        $criteria->compare('price_purchase',$this->price_purchase);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('ordered_count',$this->ordered_count);
        $criteria->compare('label_id',$this->label_id);
        $criteria->compare('is_special',$this->is_special);
        $criteria->compare('type_shipping',$this->type_shipping,true);
        $criteria->compare('availble_ship',$this->availble_ship,true);
        $criteria->compare('availble_pickup',$this->availble_pickup,true);
        $criteria->compare('units',$this->units,true);
        $criteria->compare('value',$this->value,true);
        $criteria->compare('quantity',$this->quantity,true);
        $criteria->compare('shipping_immediately',$this->shipping_immediately);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                'attributes'=>array(
                    'producer_name'=>array(
                        'asc'=>'producer.name',
                        'desc'=>'producer.name DESC',
                    ),
                    'category'=>array(
                        'asc'=>'category.name',
                        'desc'=>'category.name DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }
    
    public function getCategoriesId(){
        if ($this->id){        
            $models = ProductCategories::model()->findAllByAttributes(array('product_id' => $this->id)); 
            $arr = array();
            foreach ($models as $model)
                $arr[] = $model->category_id;
                
            return $arr;
        }
        return array();
    }
    
    function GetProductNew( $limit ){
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    } 
    
    function showAdminImage(){
        return '<a class="fancybox" href="/uploads/product/'.$this->image.'" rel="group">
                    <img class="img-polaroid fix_image_products" src="/uploads/product/'.$this->image.'" style="height: 40px;"/>
                </a>';
    }
    
    function getIdsOfCategory($category_id){
        $results = array();
        $ids = ProductCategories::model()->findAllByAttributes(array('category_id' => $category_id));
        foreach ($ids as $id){
            $results[]  = $id->product_id;
        }
        return $results;
    }
    
    static function subtractQty($product_id, $qty){
        
    }
    
    function canDelete(){
        //return $this->auction_count == 0;
    }

    function getProductCategory($id){
        $catProducts = ProductCategories::model()->findAllByAttributes(array('product_id' => $id));
        $listCatProduct ="";
        foreach($catProducts as $catProduct){
            $listCatProduct .= "<label class='catProduct'> <a href=".Yii::app()->createUrl('admin/categories/view/?id='.$catProduct['category']['id']).">".$catProduct['category']['name']."</a></label>";
        }
        return $listCatProduct;
    }
    function getStatusProduct($status){
        if($status==self::STATUS_ACTIVE)
            return Yii::t('global','Active');
        return Yii::t('global','Inactive');
    }

    function getActiveProduct(){
        $active_product = array(
          Yii::t('global','Inactive'),
          Yii::t('global','Active')
        );
        return $active_product;
    }


    function getInfoVideo( $url ){
        $image_url = parse_url($url);
        if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
            $array = explode("&", $image_url['query']);
            $getcontent = file_get_contents("http://gdata.youtube.com/feeds/api/videos/".substr($array[0], 2)."?v=2&alt=jsonc");
            $result = json_decode($getcontent,true);
            //var_dump($result);
            return $inforvideo = array("<img src=http://img.youtube.com/vi/".substr($array[0], 2)."/default.jpg width=90px>",$result['data']['title'],$result['data']['description'],$result['data']['content'][5]);
        } else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
            //var_dump($hash);
            return $inforvideo = array( "<img src=".$hash[0]["thumbnail_small"]." width=90px>", $hash[0]['title'], $hash[0]['description'] );
        }
    }

    function getVideo($url){
        $image_url = parse_url($url);
        $result = '';
        if (isset($image_url ) ){
            if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
                $videoUrl = "http://www.youtube.com/oembed?url=" . $url. "&format=json";
                $object = self::getObjectVideo($videoUrl);
                $video = json_decode($object, true);
                $result =  $video['html'];
            }
            else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
                $oembed_endpoint = 'http://vimeo.com/api/oembed';
                $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($url) . '&width=640';
                $oembed = simplexml_load_string(self::getObjectVideo($xml_url));
                $result = html_entity_decode($oembed->html);
            } else {
                $result='<div id="content" class="jwplayer novideo" style="margin: 0px auto">'/*.Yii::t('global','No video')*/.'</div>';
                $result.="<script type='text/javascript'>";
                $result.='jwplayer("content").setup({';
                $result.='volume: "100", menu: "true", allowscriptaccess: "always", wmode: "opaque",';
                $result.='file: "/uploads/video/'.$url.'",';
                $result.='width: "490", height: "257", skin: "/uploads/video/six.xml", });</script>';
            }
        }
        return $result;
    }

    function getObjectVideo($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }

    function getTags($id){
        $tags = ProductTags::model()->getTagById($id);
        return "<label>".implode(' , ',$tags).'</label>';
    }
    
    function GetIdVideoLastest( ){
        $tableProduct = Products::tableName();
        $sql = "SELECT id FROM ".$tableProduct. " WHERE is_active = 1 ORDER BY id DESC LIMIT 1 ";
        $IdProducts = Yii::app()->db->createCommand( $sql )->queryAll();
        foreach( $IdProducts as $IdProduct ){
            $idLastest = $IdProduct['id'];
        }
        return $idLastest;
    }
    
    function getProductByCate( $cate_id, $limit = 0 ){
         $tableProduct = Products::tableName();
         $sql = "SELECT products.*
                FROM products 
                INNER JOIN product_categories
                ON products.id = product_categories.product_id
                WHERE is_active = 1 AND product_categories.category_id = ".$cate_id." ORDER BY id DESC";
         if( $limit > 0 )
            $sql .= " LIMIT ".$limit;
         return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function getTotalProduct()
	{
		return Yii::app()->db->createCommand("SELECT COUNT(*) FROM products WHERE is_active = '1'")->queryScalar();
	}
    
    function getProductRecommend( $limit = 10 ){
        $table_product = self::tableName();
        return Yii::app()->db->createCommand()
                                            ->select('*')
                                            ->from( $table_product )
                                            ->where('is_active=1')
                                            ->order('id DESC')
                                            ->limit( $limit )
                                            ->queryAll();
    }   
    public function getNameProduct($product_id){
        $result = Products::model()->find(array(
                    'select'=>'name',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$product_id ) )
            );

          return  $result['name'];
    } 
    
    function getVideoFrontEnd($url){
        $image_url = parse_url($url);
        $result = '';
        if (isset( $image_url ) ){
            $checkVideo = isset($image_url['host'])?$image_url['host']:'';
            if($checkVideo == 'www.youtube.com' || $checkVideo == 'youtube.com'){    
                $result=" <script type='text/javascript' src='http://player.longtailvideo.com/jwplayer.js'></script><div id='mediaspace'></div>
                            <script type='text/javascript'>
                            jwplayer('mediaspace').setup({
                            flashplayer: 'http://player.longtailvideo.com/player.swf',
                            file: '".$url."',
                            width: '730',
                            height: '480',
                            autostart: 'true',
                            });
                        </script>";
                //$videoUrl = "http://www.youtube.com/oembed?url=" . $url. "&format=json";
//                $object = self::getObjectVideo($videoUrl);
//                $video = json_decode($object, true);
//                $result =  $video['html'];
            }
            else if($checkVideo == 'www.vimeo.com' || $checkVideo == 'vimeo.com'){
                $oembed_endpoint = 'http://vimeo.com/api/oembed';
                $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($url) . '&width=100%&height=480';
                $oembed = simplexml_load_string(self::getObjectVideo($xml_url));
                $result = html_entity_decode($oembed->html);
            } else {
                $result='<a href="uploads/video/'.$url.'" class="player" id="huluPlayer"></a>';
                $result.="<script type='text/javascript'>";
                $result.='$f("huluPlayer", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf", {
                                        clip: {
                                            autoPlay: true,
                                            autoBuffering: true
                                        },
                                        plugins: {
                                            controls: {
                                                all: false,
                                                timeColor: "#980118",
                                                play: true,
                                                mute: true,
                                                volume: true,
                                                fullscreen: true
                                }
                            }
                        });';
                $result.='</script>';
            }
        }
        return $result;
    }
    //,$reduced,$in_stock
    public function getAllProductsByLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price){
        //var_dump($free_shipping);exit();
         $criteria = new CDbCriteria();
         $sort     = 'id DESC'; 
        if(isset($_POST['sort']))
           Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort'])?Yii::app()->session['sort']:$sort;
        $product_ids = Products::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price);
        $criteria->order = $sort;
        if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
        if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
         }
         if($category!=''&&$category!='null'){
             $criteria->join="JOIN product_categories ON t.id = product_categories.product_id";
             $category = " AND product_categories.category_id=".$category;
         }elseif($category!='null'){
            $criteria->join="JOIN product_categories ON t.id = product_categories.product_id";
            $category = " AND product_categories.category_id=0";
         }else{
            $category='';
         }
        $criteria->condition = "t.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$category.$price;
        $products=new CActiveDataProvider('Products', array(
            'criteria'=>$criteria,
        ));
        return $products;
        
        
    }
     public function getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price){
        $product_ids = Products::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price);
          $join = '';
         if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
        if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
         }
         if($category!=''&&$category!='null'){
             $join="INNER JOIN product_categories ON products.id = product_categories.product_id";
             $category = " AND product_categories.category_id=".$category;
         }elseif($category!='null'){
            $join="INNER JOIN product_categories ON products.id = product_categories.product_id";
            $category = " AND product_categories.category_id=0";
         }else{
            $category='';
         }
        $results = Products::model()->findAllBySql("SELECT * FROM products ".$join." WHERE products.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$category.$price);
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
        $product_ids = Products::getIdsOfProductByLikeName($name);
        $join = '';
         if($price!=''){
            $min = strstr($price, '-',true);
            $max = substr(strrchr($price, "-"), 1);
            $price = " AND price_purchase BETWEEN $min AND $max";
         }
         $sql = "SELECT * FROM products  WHERE products.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock.$price;
        $ids = Yii::app()->db->createCommand($sql)->queryAll();       
        foreach ($ids as $id){
                $results[]  = $id['id'];  
        }
        return $results;
    }
     public function getIdsOfProductByLikeName($name){
        $results = array();
        $ids = Products::model()->findAllBySql("SELECT * FROM products WHERE `name` LIKE '%".$name."%'");
        foreach ($ids as $id){
            $results[]  = $id->id;
        }
        return $results;
    }
    public function countProductBetweenPrice($product_ids,$productshop_ids,$min,$max,$free_shipping,$reduced,$in_stock,$category,$categoryShop){
         if($free_shipping!='')
            $free_shipping = "AND shipping_cost=0";
        if($reduced!='')
            $reduced = "AND discount_percent!=0";
        if($in_stock!='')
            $in_stock = "AND shipping_immediately=1";
        $join = '';
         if($category!=''&&$category!='null'){
             $join="INNER JOIN product_categories ON products.id = product_categories.product_id";
             $category = " AND product_categories.category_id=".$category;
         }elseif($category!='null'){
           $join="INNER JOIN product_categories ON products.id = product_categories.product_id";
            $category = " AND product_categories.category_id=0";
         }else{
            $category='';
         }
          $joinshop = '';
          //var_dump($categoryShop);
        if($categoryShop!=''&&$categoryShop!='null'){
             $joinshop="INNER JOIN product_categories_shop ON products_shop.id = product_categories_shop.product_id";
             $categoryShop = " AND product_categories_shop.category_id=".$categoryShop;
         }elseif($categoryShop==''){
           $joinshop="INNER JOIN product_categories_shop ON products_shop.id = product_categories_shop.product_id";
            $categoryShop = " AND product_categories_shop.category_id=0";
         }else{
            $categoryShop='';
         }   
         $sql = "SELECT * FROM products ".$join." WHERE products.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock." AND  price_purchase BETWEEN ".$min." AND ".$max.$category;         
         $sql2 = "SELECT * FROM products_shop ".$joinshop." WHERE products_shop.id IN (".implode(',' , ($productshop_ids)? $productshop_ids: array(0)).")".$free_shipping." ".$reduced." ".$in_stock." AND  price_purchase BETWEEN ".$min." AND ".$max.$categoryShop;                 
         $ids = Yii::app()->db->createCommand($sql)->queryAll();   
         $idsshop = Yii::app()->db->createCommand($sql2)->queryAll();    
         return count($ids)+count($idsshop);
    }
    public function getSearchProductByName($name){
        $criteria = new CDbCriteria();
        $criteria->condition = "name like '%".$name."%'";
        $productshop=new CActiveDataProvider('Products', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>12,
            ),
        ));
        return $productshop;
    }
    public function getProductAll(){
        $products = new CActiveDataProvider('Products');
        return $products;
    }
    
    
}