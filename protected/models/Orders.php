<?php

/**
 * This is the model class for table "Orders".
 *
 * The followings are the available columns in table 'Orders':
 * @property integer $id
 * @property integer $user_id
 * @property string $created
 * @property string $remaining_date
 * @property double $amount
 * @property string $billing_fullname
 * @property string $billing_address
 * @property string $shipping_fullname
 * @property string $shipping_address
 * @property integer $shipped
 * @property string $data
 * @property integer $status
 * @property integer $type
 * @property integer $delivery_way
 * @property integer $shop_id
 */
class Orders extends CActiveRecord
{
    const CREDIT_PRODUCT = 1;
    const CREDIT_BALANCE = 2;
    const PREPAYMENT_METHOD = 1;
    const PAYPAL_METHOD = 2;
    const DELIVERY_WAY_AUTO = 1;
    const DELIVERY_WAY_HERMES = 2;
    const ORDER_TOSELLO = 0;
    const ORDER_SHOP_TOSELLO = 1;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Orders the static model class
     */

    public $username, $product_number, $product_name, $shop_name, $shop_email;

    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'orders';
    }
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' =>
                    'ext.DateTimeI18NBehavior'));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'user_id, shipped, status, type, delivery_way, shop_id',
                'numerical',
                'integerOnly' => true),
            //array('amount', 'numerical'),
            array(
                'amount',
                'length',
                'max' => 10),
            array(
                'billing_fullname, billing_address, shipping_fullname, shipping_address',
                'length',
                'max' => 512),
            array(' data,shop_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, user_id, created ,shop_name, type, shop_email, delivery_way, amount,username, billing_fullname, billing_address, shipping_fullname, shipping_address, shipped, data, status, product_number, remaining_date, product_name, shop_id',
                'safe',
                'on' => 'search'),
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
            'user' => array(
                self::BELONGS_TO,
                'Members',
                'user_id'),
            'shop' => array(
                self::BELONGS_TO,
                'MemberShop',
                'shop_id'),
            'items' => array(
                self::HAS_MANY,
                'OrderItems',
                'order_id'),
            'orderStatus' => array(
                self::BELONGS_TO,
                'OrderStatus',
                'status'),
            'orderProcesses' => array(
                self::HAS_MANY,
                'OrderProcess',
                'order_id'),
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
            'created' => Yii::t('global', 'Date'),
            'remaining_date' => Yii::t('global', 'Remaining Date'),
            'amount' => Yii::t('global', 'Amount'),
            'billing_fullname' => Yii::t('global', 'Billing Fullname'),
            'billing_address' => Yii::t('global', 'Billing Address'),
            'shipping_fullname' => Yii::t('global', 'Shipping Fullname'),
            'shipping_address' => Yii::t('global', 'Shipping Address'),
            'shipped' => Yii::t('global', 'Shipped'),
            'status' => Yii::t('global', 'Status'),
            'type' => Yii::t('global', 'Type'),
            'delivery_way' => Yii::t('global', 'Delivery Way'),
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
        $criteria = new CDbCriteria;
        $criteria->together = true;

        $criteria->with=array('user','items.Products', 'shop', 'items');
        $amount = floatval(str_replace(',','.',str_replace('.','',$this->amount)));
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('user.username',$this->username);
        $criteria->compare('user.email',$this->shop_email);
        $criteria->compare('shop.name',$this->shop_name, true);
        if ($this->created)
            $criteria->compare('t.created', date('Y-m-d ', strtotime($this->created)), true);
        if ($this->remaining_date)
            $criteria->compare('t.remaining_date', date('Y-m-d ', strtotime($this->
                remaining_date)), true);

        if ($this->amount != '')
            $criteria->addCondition('amount = ' . $amount . ' OR amount = -' . $amount);
        $criteria->compare('billing_fullname', $this->billing_fullname, true);
        $criteria->compare('billing_address', $this->billing_address, true);
        $criteria->compare('shipping_fullname', $this->shipping_fullname, true);
        $criteria->compare('shipping_address', $this->shipping_address, true);
        $criteria->compare('shipped', $this->shipped);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.type', $this->type);
        $criteria->compare('delivery_way', $this->delivery_way);
        if ($this->product_name) {
            $sql = 'SELECT od.id FROM orders od JOIN order_items odi ON od.id= odi.order_id JOIN products pd ON odi.item_id = pd.id WHERE pd.name like "%' .
                $this->product_name . '%"';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();
            foreach ($data as $d)
                $result[] = $d['id'];
            $criteria->addCondition("t.id IN (" . implode(',', ($result) ? $result : array(0)) .
                ")");
        }
        if ($this->shop_id == self::ORDER_TOSELLO) {
            $criteria->compare('t.shop_id', 0);
        }else {
            $criteria->addCondition("t.shop_id !=0 ");
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id DESC', 'attributes' => array('*')),
            ));
    }

    ////////////////////////////////////////////////////////////////////////////////////
    function getCartResult($data, $shop_id, $is_format_value = true)
    {
        //update cart
        $session_name = 'cart_' . $shop_id;
        $order_data = Yii::app()->session['Order'];
        $cart = isset(Yii::app()->session[$session_name]) ? Yii::app()->session[$session_name] :
            array();
        $cart_count = 0;
        $old_qty = 0;
        if (isset($data['Auctions']))
            foreach ($data['Auctions']['qty_' . $shop_id] as $id => $qty) {
                $old_qty += $cart[$id]['qty'];
                if (intval($qty) == 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['qty'] = $qty;
                    $cart_count += $qty;
                }
            }
        Yii::app()->session[$session_name] = $cart;
        //Yii::app()->session['cart']['qty'] += $cart_count;

        Yii::app()->session['cart'] = array('name' => Yii::app()->session['cart']['name'],
                'qty' => (Yii::app()->session['cart']['qty'] - $old_qty) + $cart_count);

        Yii::app()->session['Order'] = $order_data;
        //
        $balance = Members::getBalance();
        $result = array(
            'subtotal' => 0,
            'shipping_cost' => 0,
            'grand_total' => 0,
            'total_excluding' => 0,
            'vat_tax' => 0,
            'cart_count' => Yii::app()->session['cart']['qty'],
            'credit_products' => 0,
            'credit_balance' => 0);
        //direct buy
        //var_dump($data['Auctions']['qty_0']);
        if (isset($data['Auctions']['qty_' . $shop_id]) && count($data['Auctions']['qty_' .
            $shop_id])) {

            if ($shop_id == 0) {
                $products = Products::model()->findAll("id IN (" . implode(',', array_keys($data['Auctions']['qty_' .
                    $shop_id])) . ")");
            } else {
                $products = ProductsShop::model()->findAll("id IN (" . implode(',', array_keys($data['Auctions']['qty_' .
                    $shop_id])) . ")");
            }
            foreach ($products as $product) {
                $price = ($shop_id == 0) ? ($product->price - (($product->price * $product->
                    discount_percent) / 100)) : $product->direct_buy_price;
                $product_total = $price * $data['Auctions']['qty_' . $shop_id][$product->id];
                $result['product-price-' . $product->id] = $product_total;
                $result['product-unit_price-' . $product->id] = $price;
                $result['shipping_cost'] = (($result['shipping_cost'] - $product->shipping_cost) >=
                    0) ? $result['shipping_cost'] : $product->shipping_cost;
                $result['subtotal'] += $product_total;
            }
        }

        //caculate final
        $result['grand_total'] = $result['subtotal'] + $result['shipping_cost'] + $result['credit_products'];
        $result['total_excluding'] = $result['grand_total'] / (1 + Yii::app()->settings->
            vat_tax / 100);
        $result['vat_tax'] = $result['total_excluding'] * (Yii::app()->settings->
            vat_tax / 100);

        if ($is_format_value) {
            foreach ($result as $key => $value)
                $result[$key] = Utils::number_format($value);
        }
        $result['cart_count'] = intval($result['cart_count']);

        return $result;
    }

    function saveOrder($data, $result)
    {
        $id = isset(Yii::app()->user->id) ? Yii::app()->user->id : Yii::app()->session['guest_acount'];
        $member = Members::model()->findByPk($id);
        /*$tmp_member = new Members;
        $tmp_member->attributes=$data['address']['Members'];*/

        $order = new Orders;
        $order->user_id = $member->id;
        $order->amount = $result['grand_total'];
        $order->data = serialize($data);
        $order->shipped = 0;
        $order->type = self::PAYPAL_METHOD;
        $order->shop_id = Yii::app()->session['shop_buy']; // add shop id
        //if ($data['address']['billing_address'] == 1){
        $order->billing_fullname = $member->getFullname();
        $order->billing_address = $member->getBillingAddress();
        /* }
        else{
        $order->billing_fullname = $tmp_member->getFullname();
        $order->billing_address = $tmp_member->getBillingAddress();
        }*/

        //if ($data['address']['shipping_address'] == 1){
        $order->shipping_fullname = $member->getShippingFullname();
        $order->shipping_address = $member->getShippingAddress();
        /* }
        else{
        $order->shipping_fullname = $tmp_member->getShippingFullname();
        $order->shipping_address = $tmp_member->getShippingAddress();
        }*/
        if ($order->save()) {

            self::saveProcess($order->id);

            if (isset($data['items']['Auctions'])) {
                $products = array_keys($data['items']['Auctions']['qty_' . Yii::app()->session['shop_buy']]);
                foreach ($products as $item_id) {
                    self::saveItem($order->id, $item_id, OrderItems::DIRECT_BUY, $data['items']['Auctions']['qty_' .
                        Yii::app()->session['shop_buy']][$item_id], $result['product-unit_price-' . $item_id]);
                }

            }
            /*************Send email order for customer guest account*************/
            if (isset(Yii::app()->session['guest_acount'])) {
                $email = EmailTemplates::model()->findByAttributes(array('alias' =>
                        'buy_with_guest'));
                $userGuest = Members::model()->findByPk(Yii::app()->session['guest_acount']);
                $orderGuest = OrderItems::model()->findAll('order_id=:id', array(':id' => $order->
                        id));

                $detailOrder = '';
                $sub_total = $cost_fee = 0;
                foreach ($orderGuest as $item) {
                    $sub_total += $item->unit_price;
                    $cost_fee = ($cost_fee > $item->Products->shipping_cost) ? $cost_fee : $item->
                        Products->shipping_cost;
                    $detailOrder .= "<tr>";
                    $detailOrder .= "<td>" . $item->qty . "</td>";
                    $detailOrder .= "<td>" . $item->Products->name . "</td>";
                    $detailOrder .= "<td>" . $item->unit_price . "</td>";
                    $detailOrder .= "</tr>";
                }
                $price_no_tax = ($sub_total + $cost_fee) / 1.19;
                $tax = $price_no_tax * 0.19;
                $total = $price_no_tax + $tax;
                Utils::sendMail(Yii::app()->params['emailout'], $userGuest->email, $email->
                    email_subject, str_replace(array(
                    '{time}',
                    '{order_id}',
                    '{fullname}',
                    '{order_detail}',
                    '{sub_total}',
                    '{cost_fee}',
                    '{price_no_tax}',
                    '{tax}',
                    '{total}'), array(
                    $order->created,
                    $order->id,
                    $userGuest->fname . " " . $userGuest->lname,
                    $detailOrder,
                    Utils::number_format($sub_total) . " €",
                    Utils::number_format($cost_fee) . " €",
                    Utils::number_format($price_no_tax) . " €",
                    Utils::number_format($tax) . " €",
                    Utils::number_format($total) . " €"), $email->email_content));
            }

            unset(Yii::app()->session['Order']);

            return true;
        }
        return false;
    }


    function saveItem($order_id, $item_id, $type, $qty, $unit_price)
    {
        $item = new OrderItems;
        $item->order_id = $order_id;
        $item->item_id = $item_id;
        $item->type = $type;
        $item->qty = $qty;
        $item->unit_price = $unit_price;
        $item->save();
        /*$product_id = Auctions::model()->findBySql('SELECT product_id FROM auctions WHERE id ='.$item_id);*/
        if (Yii::app()->session['shop_buy'] == 0) {
            self::updateProduct($item_id, $unit_price, $qty);
        }

    }

    public function updateProduct($id, $amount, $qty)
    {
        $product = Products::model()->findByPk($id);
        $sell_amount = $amount + $product->sell_amount;
        $sell_qty = $product->sell_qty + $qty;
        Products::model()->updateByPk($id, array('sell_amount' => $sell_amount,
                'sell_qty' => $sell_qty));
    }

    function saveProcess($order_id)
    {
        $item = new OrderProcess;
        $item->order_id = $order_id;
        $item->status = OrderStatus::WAIT_FOR_PAYMENT;
        $item->save();

    }
    function GetOrderItemType($type)
    {
        return Yii::t("global", "$type");
    }
    //function getOrderByshopId($id){
    //        return Orders::model()->findAllByAttributes(array('shop_id'=>$id));
    //    }

    function getMyOrders($member_id)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('user');
        $criteria->together = true;
        $criteria->compare('t.user_id', $member_id);
        //$criteria->compare('t.auction_id','auction_id');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 5),
            ));
    }


    function showItems($shop_id = 0)
    {
        $html = array();
        foreach ($this->items as $item) {
            $html[] = $item->showItem($shop_id);
        }
        return implode('<br />', $html);
    }


    function getStatusTrans($status)
    {
        return Yii::t('global', $status);
    }

    /**
     *     public function getOrderShop(){
     *         $criteria=new CDbCriteria;
     *         $criteria->condition = 'shop_id !=0' ;
     *         return new CActiveDataProvider($this, array(
     *             'criteria'=>$criteria,
     *         ));
     *     }
     */

    public function getOrderShopMan()
    {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('user', 'items.Products');
        $amount = floatval(str_replace(',', '.', str_replace('.', '', $this->amount)));
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('user.username', $this->username, true);
        $criteria->compare('user.email', $this->shop_email);

        $criteria->compare('t.shop_id', $this->shop_id);
        if ($this->created)
            $criteria->compare('t.created', date('Y-m-d ', strtotime($this->created)), true);
        if ($this->remaining_date)
            $criteria->compare('t.remaining_date', date('Y-m-d ', strtotime($this->
                remaining_date)), true);

        if ($this->amount != '')
            $criteria->addCondition('amount = ' . $amount . ' OR amount = -' . $amount);
        $criteria->compare('billing_fullname', $this->billing_fullname, true);
        $criteria->compare('billing_address', $this->billing_address, true);
        $criteria->compare('shipping_fullname', $this->shipping_fullname, true);
        $criteria->compare('shipping_address', $this->shipping_address, true);
        $criteria->compare('shipped', $this->shipped);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('type', $this->type);
        $criteria->compare('delivery_way', $this->delivery_way);
        if ($this->product_name) {
            $sql = 'SELECT od.id FROM orders od JOIN order_items odi ON od.id= odi.order_id JOIN products_shop pd ON odi.item_id = pd.id WHERE pd.name like "%' .
                $this->product_name . '%"';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();
            foreach ($data as $d)
                $result[] = $d['id'];
            $criteria->addCondition("t.id IN (" . implode(',', ($result) ? $result : array(0)) .
                ")");
        }
        $shop_id = MemberShop::model()->findByAttributes(array('user_id' => Yii::app()->
                user->id));
        $criteria->compare('t.shop_id', $shop_id->id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id DESC', 'attributes' => array('*', )),
            ));
    }
    public function totalCustomerShop($shop_id)
    {
        $sql = "SELECT shop_id, COUNT(id) AS total FROM orders
            WHERE shop_id = " . $shop_id;
        $totals = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($totals as $total) {
            return $total['total'];
        }
    }
    public function getCustomerByShopId()
    {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('user', 'items.Products');
        $amount = floatval(str_replace(',', '.', str_replace('.', '', $this->amount)));
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('user.username', $this->username);
        $criteria->compare('user.email', $this->shop_email);

        $criteria->compare('t.shop_id', $this->shop_id);
        $criteria->compare('billing_fullname', $this->billing_fullname, true);
        $criteria->compare('billing_address', $this->billing_address, true);

        $shop_id = MemberShop::model()->findByAttributes(array('user_id' => Yii::app()->
                user->id));
        $criteria->compare('t.shop_id', $shop_id->id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id DESC', 'attributes' => array('*', )),
            ));
    }
    public function getCustomerShop()
    {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array(
            'user',
            'items.Products',
            'shop');
        $amount = floatval(str_replace(',', '.', str_replace('.', '', $this->amount)));
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('user.username', $this->username);
        $criteria->compare('user.email', $this->shop_email);
        $criteria->compare('shop.name', $this->shop_name);

        $criteria->compare('billing_fullname', $this->billing_fullname, true);
        $criteria->compare('billing_address', $this->billing_address, true);
        $criteria->compare('shipping_fullname', $this->shipping_fullname, true);
        $criteria->compare('shipping_address', $this->shipping_address, true);
        if ($this->product_name) {
            $sql = 'SELECT od.id FROM orders od JOIN order_items odi ON od.id= odi.order_id JOIN products pd ON odi.item_id = pd.id WHERE pd.name like "%' .
                $this->product_name . '%"';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();
            foreach ($data as $d)
                $result[] = $d['id'];
            $criteria->addCondition("t.id IN (" . implode(',', ($result) ? $result : array(0)) .
                ")");
        }
        $criteria->addCondition("t.shop_id != 0 ");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id DESC', 'attributes' => array('*', )),
            ));
    }
    public function checkCustomer($is_shop, $id_order)
    {
        $sql = "SELECT * FROM orders WHERE id = " . $id_order . " AND shop_id = " . $is_shop .
            "";
        $checkcustomer = Yii::app()->db->createCommand($sql)->queryAll();
        if ($checkcustomer == null) {
            return false;
        } else {
            return true;
        }
    }
    public function getProuductNameShop()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
        $criteria->together = true;
        $criteria->with=array('user','items.Products', 'shop');
        $amount = floatval(str_replace(',','.',str_replace('.','',$this->amount)));
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('user.username',$this->username);
        $criteria->compare('user.email',$this->shop_email);
        $criteria->compare('shop.name',$this->shop_name, true);
        if ($this->created)
		    $criteria->compare('t.created',date('Y-m-d ', strtotime($this->created)),true);
        if ($this->remaining_date)
            $criteria->compare('t.remaining_date',date('Y-m-d ', strtotime($this->remaining_date)),true);

        if($this->amount !='')
            $criteria->addCondition('amount = '.$amount.' OR amount = -'.$amount);
		$criteria->compare('billing_fullname',$this->billing_fullname,true);
		$criteria->compare('billing_address',$this->billing_address,true);
		$criteria->compare('shipping_fullname',$this->shipping_fullname,true);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('shipped',$this->shipped);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('delivery_way',$this->delivery_way);
        if($this->product_name){
            $sql = 'SELECT od.id FROM orders od JOIN order_items odi ON od.id= odi.order_id JOIN products_shop pd ON odi.item_id = pd.id WHERE pd.name like "%'.$this->product_name.'%"';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();
            foreach ($data as $d)
                $result[] = $d['id'];
            $criteria->addCondition("t.id IN (".implode(',', ($result)? $result : array(0) ).")");
        }
        if($this->shop_id == self::ORDER_SHOP_TOSELLO){
            $criteria->compare('t.shop_id',0);
        } else {
            $criteria->addCondition("t.shop_id !=0 ");
        }

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=> 't.id DESC',
                'attributes'=>array(
                    '*',)
            ),
        ));
	}
}
