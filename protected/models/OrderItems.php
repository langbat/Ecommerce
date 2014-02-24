<?php

/**
 * This is the model class for table "order_items".
 *
 * The followings are the available columns in table 'order_items':
 * @property integer $id
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $type
 * @property integer $qty
 * @property double $unit_price
 */
class OrderItems extends CActiveRecord
{
    const DIRECT_BUY = 1;
    const WIN_AUCTION = 2;
    const COUPON = 3; 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderItems the static model class
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
		return 'order_items';
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
			array('order_id, item_id, type, qty', 'numerical', 'integerOnly'=>true),
			array('unit_price', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, item_id, type, qty, unit_price', 'safe', 'on'=>'search'),
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
            'Orders' => array(self::BELONGS_TO, 'Orders', 'order_id'),
            'Bids' => array(self::BELONGS_TO, 'Bids', 'item_id'),
            'Products' => array(self::BELONGS_TO, 'Products', 'item_id'),
            'ProductShop' => array(self::BELONGS_TO, 'ProductsShop', 'item_id'),
            'Coupons' => array(self::BELONGS_TO, 'Coupons', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'order_id' => Yii::t('global', 'Order'),
			'item_id' => Yii::t('global', 'Item'),
			'type' => Yii::t('global', 'Type'),
			'qty' => Yii::t('global', 'Qty'),
			'unit_price' => Yii::t('global', 'Unit Price'),
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unit_price',$this->unit_price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getMyOrderBids($order_id)
    {

        $criteria=new CDbCriteria;
        $criteria->with = array('Orders','Bids');//t.order_id = Orders.id
        $criteria->together = true;
        $criteria->condition="t.type = 1 AND t.order_id = ".$order_id;
        $criteria->group='Bids.id';
        //$criteria->compare('t.auction_id','auction_id');
        
        
        return  new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('pageSize' => 5),
        ));
    }
    
    public function getMyOrderAuctions($order_id)
    {   
        $criteria=new CDbCriteria;
        $criteria->with = array('Orders','Products');//t.order_id = Orders.id
        $criteria->together = true;
        $criteria->condition="t.type = 2 AND t.order_id = ".$order_id;
        $criteria->group='Products.id';

        
        //$criteria->compare('t.auction_id','auction_id');
        
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('pageSize' => 5),
        ));
    }
    
    public function getMyOrderCoupons($order_id)
    {   
        $criteria=new CDbCriteria;
        $criteria->with = array('Orders','Coupons');//t.order_id = Orders.id
        $criteria->together = true;
        $criteria->condition="t.type = 3 AND t.order_id = ".$order_id;
        $criteria->group='Coupons.id';
        //$criteria->compare('t.auction_id','auction_id');
        
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('pageSize' => 5),
        ));
    }    
    
    function showItem($shop_id){
//        if ($this->type == self::DIRECT_BUY ){
        if($shop_id ==0){
            $product = Products::model()->findByPk($this->item_id);
            if($product){
                return '<a class="description_purple" href="/products/detail/'.$product->id.'">'.$product->name.' '/*.$product->short_desciption*/.'</a>';
            }else{
                return '';
            }
            
        } else{
            $product = ProductsShop::model()->findByPk($this->item_id);
            if($product){
                 return '<a class="description_purple" href="/productsshop/detail/'.$shop_id.'/'.$product->id.'">'.$product->name.' '/*.$product->short_desciption*/.'</a>';
            }else{
                return '';
            }
           
        }

//        }
       /* else if ($this->type == self::WIN_AUCTION){
            $bid = Bids::model()->findByAttributes(array('auction_id'=>$this->item_id));
            return '<a class="description_purple" href="/products/detail/'.$bid->auction->id.'">'.$bid->auction->product->name.' '.$bid->auction->product->description.'</a>';
        }*/
        return '';
    }

    
    function GetIdOrderDashboard( $auction_id ){
        $OrderItems = Yii::app()->db->createCommand()
                                    ->select('order_id,status')
                                    ->from($this->tableName())
                                    ->join('orders','orders.id = '.$this->tableName().'.order_id')
                                    ->where('item_id=:item_id', array(':item_id'=>$auction_id))
                                    ->order('order_id DESC')
                                    ->limit('1')
                                    ->query();
        foreach($OrderItems as $OrderItem){
            return $OrderItem['order_id'].'-'.$OrderItem['status'];
        }
         
    }
    
    public function getInfoProductOrder($id,$shop_id){
        $orderItem = OrderItems::model()->findAllByAttributes(array('order_id'=>$id));
        if($orderItem){
            $result ="";
            foreach($orderItem as $order){
                if($shop_id ==0){
                    $result.= "<label class='product_name_order'>".$order->qty."x ".$order->Products['name']; //." - ".$order->Products['short_desciption']
                } else {
                    $result.= "<label class='product_name_order'>".$order->qty."x ".$order->ProductShop['name'];
                }

            }
            return $result;
        }

    }

    /*public function purchaseProduct($product_id){
        $purchase = OrderItems::model()->findAllBySql('SELECT id FROM order_items WHERE item_id IN (SELECT id FROM auctions WHERE product_id='.$product_id.') AND TYPE='.OrderItems::DIRECT_BUY);
        return count($purchase);
    }*/
    
    
}