<?php
class CartController extends SiteBaseController {
	
    function actionAdd(){
        ///unset(Yii::app()->session['cart']);

        // default cart[0] is product of tosello.
        $cart = isset(Yii::app()->session['cart_0'])?Yii::app()->session['cart_0']:array();
        $id = intval($_GET['id']);
        if ($id && Products::model()->findByPk($id)){
            if (isset($cart[$id]['qty'])){
                $cart[$id]['qty'] += 1;
            }
            else {
                $cart[$id]['qty'] = 1;
            }    
            $cart[$id]['added'] = time();
                
            Yii::app()->session['cart_0'] = $cart;
            $cart_all = isset(Yii::app()->session['cart'])?Yii::app()->session['cart']:array();
            $cart_all['name'] = isset($cart_all['name'])?$cart_all['name']:array();
            if(!in_array('cart_0',$cart_all['name'])){
                $cart_all['name'][]= 'cart_0';
            }
            if(isset($cart_all['qty'])){
                $cart_all['qty'] +=1;
            } else {
                $cart_all['qty'] =1;
            }
            Yii::app()->session['cart'] = $cart_all;
        }
    }

    function actionAddProduct(){
        ///unset(Yii::app()->session['cart']);

        $cart = isset(Yii::app()->session['cart'])?Yii::app()->session['cart']:array();
        var_dump($cart); exit();
        $auction_id = intval($_GET['auction_id']);
        $id = $_GET['id'];
        if ($auction_id && Auctions::model()->findByPk($auction_id)){
            if (isset($cart[$auction_id]['qty'])){
                $cart[$auction_id]['qty'] += 1;
            }
            else {
                $cart[$auction_id]['qty'] = 1;
            }
            $cart[$auction_id]['added'] = time();
            Yii::app()->session['cart'] = $cart;
            Bids::model()->updateByPk($id,array('is_confirm'=>1));
        }
    }
    function actionRemove(){
        $shop_id = $_GET['shop_id'];
        $id = intval($_GET['id']);
        $cart = isset(Yii::app()->session['cart_'.$shop_id])?Yii::app()->session['cart_'.$shop_id]:array();
        $old_qty = $cart[$id]['qty'];
        $qty = Yii::app()->session['cart']['qty'];
        if (isset($cart[$id])){
            unset($cart[$id]);
            Yii::app()->session['cart_'.$shop_id] = $cart;
        }
        if(isset(Yii::app()->session['cart_'.$shop_id]) && count(Yii::app()->session['cart_'.$shop_id])>0){
            echo $qty-$old_qty;
            Yii::app()->session['cart'] = array(
                'name'=>Yii::app()->session['cart']['name'],
                'qty'=>$qty-$old_qty
            );
        }else {
            $newCart = array_diff( Yii::app()->session['cart']['name'],array('cart_'.$shop_id));
            Yii::app()->session['cart'] = array(
                'name'=>$newCart,
                'qty'=>$qty-$old_qty
            );
        }

    }
    function actionAddCoupon(){
        $code = CouponCodes::model()->find("user_id IS NULL AND code='".$_GET['code']."'");
        
        if ($code && $code->isActive()){
            $this->renderPartial('cart-coupon-item', compact('code'));
        }
    }
    function actionState(){
        $shop_id = $_GET['shop_id'];
        echo json_encode(Orders::getCartResult($_POST,$shop_id));
    }
    
    function actionIndex(){
//        unset(Yii::app()->session['cart_shop']);
        unset(Yii::app()->session['shop_buy']);
        if (isset($_POST) && (isset($_POST['Auctions']) )){
            $shop_id = $_POST['typeShop'];
            Yii::app()->session['Order'] = array(
                'items' => $_POST
            );
            Yii::app()->session['shop_buy'] =$shop_id;
            $this->redirect('/cart/address');
        }
        $products = array();
        $product_shop = array();
        if (isset(Yii::app()->session['cart']['name']) && count(Yii::app()->session['cart']['name'])){
            foreach(Yii::app()->session['cart']['name'] as $cart_item){
                if($cart_item =='cart_0'){
                    $products = Products::model()->findAll("id IN (".implode(',', array_keys(Yii::app()->session[$cart_item])).") ");
                } else {
                    $product_shop[$cart_item]= ProductsShop::model()->findAll("id IN (".implode(',', array_keys(Yii::app()->session[$cart_item])).")  ORDER BY shop_id");
                }
            }
        }

        $is_has_item = count($products) + count($product_shop) > 0;
        $this->pageTitle[] = Yii::t('global', 'My Cart');
        $this->render('index', compact( 'products', 'is_has_item','product_shop'));
    }
    
    function actionAddress(){
        if(isset(Yii::app()->session['shop_buy'])){
            $order = Yii::app()->session['Order'];
            $this->_checkOrder(Yii::app()->session['shop_buy']);

            if (isset($_POST['Members'])){
                Members::model()->updateAddress($_POST['Members']);
                Yii::app()->session['Order'] = array(
                    'items' => $order['items'],
                    'address' => $_POST
                );
                $this->redirect('/cart/methodpayment');
            }
            if(isset( Yii::app()->session['guest_acount'] )){
                $this->redirect('/cart/buywithguest');
            } else {
                $this->render('address', compact('order'));
            }
        } else {
            $this->redirect('/cart');
        }

    }

    function actionBuyWithGuest(){
        if(isset(Yii::app()->session['shop_buy'])){
            $order = Yii::app()->session['Order'];
            $this->_checkOrder(Yii::app()->session['shop_buy']);
            if(isset( Yii::app()->session['guest_acount'] )){
                $model = Members::model()->findByPk( Yii::app()->session['guest_acount'] );
            } else {
                $model =new Members();
            }
            if (isset($_POST['Members'])){
                if($_POST['billing_select'] == 0){
                    Members::model()->saveGuestMember($_POST['Members']);
                } else {
                    Members::model()->saveGuestMemberWithShipping($_POST['Members']);
                }
                Yii::app()->session['Order'] = array(
                    'items' => $order['items'],
                    'address' => $_POST
                );

                $this->redirect('/cart/methodpayment');
            }
            $this->render('address_guest', compact('order','model'));
        } else {
            $this->redirect('/cart');
        }

    }
    
    function actionMethodPayment(){
        if(isset(Yii::app()->session['shop_buy'])){
            $order = Yii::app()->session['Order'];
            $this->_checkOrder(Yii::app()->session['shop_buy']);

            if (isset($_POST['Members'])){
                Yii::app()->session['Order'] = array(
                    'items' => $order['items'],
                    'address' => $_POST
                );
                $this->redirect('/cart/review');
            }
            $this->render('method-payment', compact('order'));
        } else {
            $this->redirect('/cart');
        }
    }
    
    function actionShipping(){
        $order = Yii::app()->session['Order'];
        if (!is_array($order) || !isset($order['address']))
            $this->redirect('/cart');
        
        if (is_array($_POST) && count($_POST)){
            $this->redirect('/cart/review');
        }

        $this->render('shipping', compact('order'));
    }
    function actionReview(){
        if(isset(Yii::app()->session['shop_buy'])){
            $order = Yii::app()->session['Order'];
            $this->_checkOrder(Yii::app()->session['shop_buy']);
            if (!is_array($order) || !isset($order['address']))
                $this->redirect('/cart');

            if (is_array($_POST) && count($_POST)){
                $this->redirect('/cart/finished');
            }

            if (isset($order['items']['Auctions'])){
                if(Yii::app()->session['shop_buy'] ==0){
                    $products = Products::model()->findAll("id IN (".implode(',', array_keys($order['items']['Auctions']['qty_'.Yii::app()->session['shop_buy']])).")");
                } else{
                    $products = ProductsShop::model()->findAll("id IN (".implode(',', array_keys($order['items']['Auctions']['qty_'.Yii::app()->session['shop_buy']])).")");
                }
            }
            $this->render('review', compact('order', 'products'));
        }else {
            $this->redirect('/cart');
        }


    }
    function actionFinished(){
        if (isset($_GET['token'])){
            $this->_confirmed();
        }
        else{
            $this->_buy();
        }
    }


    function _buy(){
        $order_data = Yii::app()->session['Order'];
        $result = Orders::getCartResult($order_data['items'],Yii::app()->session['shop_buy'], false);
		// set 
		$paymentInfo['Order']['theTotal'] = number_format($result['grand_total'], 2);
		$paymentInfo['Order']['description'] = Yii::t('global', 'Tosello Order');
        //$paymentInfo['Items'] = $this->_getPaymentItems();

		Yii::app()->Paypal->returnUrl = Yii::app()->createAbsoluteUrl('/cart/finished');
        Yii::app()->Paypal->cancelUrl = Yii::app()->createAbsoluteUrl('/cart/');
         
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === 1){
				$error = 'We were unable to process your request. Please try again later';
			}else{
				$error = $result['L_LONGMESSAGE0'];
			}
			
            Yii::app()->user->setFlash('error', $error);
            $this->redirect('/cart');
			
		}else { 
			// send user to paypal 
			$token = urldecode($result["TOKEN"]); 
			
			$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
			$this->redirect($payPalURL); 
		}
    }
    
    function _confirmed(){
        $order_data = Yii::app()->session['Order'];

        if (!is_array($order_data)){
            $this->redirect('/cart');
        }   
        $order_result = Orders::getCartResult($order_data['items'],Yii::app()->session['shop_buy'], false);

        //print_r($result);
        //print_r($order_data);die;
        
        
        $token = trim($_GET['token']);		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = number_format($order_result['grand_total'], 2);

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				$error = $result['L_LONGMESSAGE0'];
			}
			Yii::app()->user->setFlash('error', $error);
            $this->redirect('/');
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					$error = 'We were unable to process your request. Please try again later';
				}else{
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				Yii::app()->user->setFlash('error', $error);
                $this->redirect('/cart');
				
			}else{
                Orders::saveOrder($order_data, $order_result);
                Yii::app()->user->setFlash('success', Yii::t('global', 'Payment completed successfully!'));
                
                unset(Yii::app()->session['Order']);
                /* reset cart */
                $qty = Yii::app()->session['cart']['qty'];
                $cart_bought  = Yii::app()->session['cart_'.Yii::app()->session['shop_buy']];
                $old_qty = 0;

                foreach($cart_bought as $cart_item){
                    $old_qty += $cart_item['qty'];
                }

                $newCart = array_diff( Yii::app()->session['cart']['name'],array('cart_'.Yii::app()->session['shop_buy']));
                Yii::app()->session['cart'] = array(
                    'name'=>$newCart,
                    'qty'=>$qty-$old_qty
                );

                unset(Yii::app()->session['cart_'.Yii::app()->session['shop_buy']]);
                /* End reset cart*/
                unset(Yii::app()->session['guest_acount']);
                unset(Yii::app()->session['shop_buy']);
                Yii::app()->session['my_balance'] = Members::getBalance();

                $this->render('finished');				
			}
		}
    }
    
    function _getPaymentItems(){
        $count = 0;
        $result = array();
        $order_data = Yii::app()->session['Order'];
        
        if (isset($order_data['items']['Bids'])){
            $bids = Bids::model()->findAll("id IN (".implode(',', array_keys($order_data['items']['Bids'])).")");
            foreach ($bids as $bid){                
                $result['PAYMENTREQUEST_'.$count.'_AMT'] = $bid->getPrice();
                $result['PAYMENTREQUEST_'.$count.'_ITEMAMT'] = $bid->getPrice();
                $result['L_PAYMENTREQUEST_'.$count.'_NAME0'] = Yii::t('global', 'Win Auction').': '.$bid->auction->product->name;
                $result['L_PAYMENTREQUEST_'.$count.'_QTY0'] = 1;
                $result['L_PAYMENTREQUEST_'.$count.'_NUMBER0'] = $count+1;
                $count++;
            }
            
        }            
        if (isset($order_data['items']['Auctions'])){
            $products = Auctions::model()->findAll("id IN (".implode(',', array_keys($order_data['items']['Auctions']['opt'])).")");
            foreach ($products as $auction){            
                $result['PAYMENTREQUEST_'.$count.'_AMT'] = $auction->product->direct_buy_price;
                $result['PAYMENTREQUEST_'.$count.'_ITEMAMT'] = $auction->product->direct_buy_price;
                $result['L_PAYMENTREQUEST_'.$count.'_NAME0'] = Yii::t('global', 'Direct Buy').': '.$auction->product->name;
                $result['L_PAYMENTREQUEST_'.$count.'_QTY0'] = $order_data['items']['Auctions']['qty'][$auction->id];
                $result['L_PAYMENTREQUEST_'.$count.'_NUMBER0'] = $count+1;
                $count++;
            }
        }
        if (isset($order_data['items']['CouponCodes'])){
            $coupons = CouponCodes::model()->findAll("user_id IS NULL AND id IN (".implode(',', $order_data['items']['CouponCodes']).")");
        }
        
        return $result;
        
    }
    
    protected function _checkOrder($shop_id){
        $order = Yii::app()->session['Order'];
        $count_auction = 0;
        if (isset($order['items']['Auctions'])){
            foreach ($order['items']['Auctions']['qty_'.$shop_id] as $id=>$qty)
                $count_auction += $qty;
        }
        if ($count_auction == 0 && !isset($order['items']['Bids']) )
            $this->redirect('/cart');
    }
}