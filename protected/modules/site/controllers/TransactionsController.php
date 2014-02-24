<?php
/**
 * Transactions Controller
 */
class TransactionsController extends SiteBaseController {
	function actionAddfund(){
        //$amount = floatval(str_replace(',', '.', $_POST['Transactions']['amount']));
        if(isset($_POST['Transactions']['amount'])){
            $amount = floatval(str_replace(',', '.', $_POST['Transactions']['amount']));
        } else if(isset($_GET['amount']) && isset($_GET['bonusHoliday']) && isset($_GET['bonusInpayment'])) {
            $amount = $_GET['amount'];
            $bonusHoliday = $_GET['bonusHoliday'];
            $bonusInpayment = $_GET['bonusInpayment'];
        }
        if ($amount == 0)
            $this->redirect('/profile/index');
            
        Yii::app()->session['addfund_amount'] = $amount;
        Yii::app()->session['addfund_bonusHoliday'] = isset($bonusHoliday)?$bonusHoliday:0;
        Yii::app()->session['addfund_bonusInpayment'] = isset($bonusInpayment)?$bonusInpayment:0;


		$paymentInfo['Order']['theTotal'] = number_format($amount, 2);
		$paymentInfo['Order']['description'] = Yii::t('global', 'Onecentdeal: Add fund');        
        
        Yii::app()->Paypal->returnUrl = Yii::app()->createAbsoluteUrl('/transactions/addfund_confirm');
        Yii::app()->Paypal->cancelUrl = Yii::app()->createAbsoluteUrl('/profile/index');
         
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
    function actionAddfund_confirm(){
	    $token = trim($_GET['token']);		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = number_format(Yii::app()->session['addfund_amount'], 2);

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				$error = $result['L_LONGMESSAGE0'];
			}
			Yii::app()->user->setFlash('error', $error);
            $this->redirect('/profile/index');
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
                $this->redirect('/profile/index');
			}else{
                $amount=array(
                    Yii::app()->session['addfund_amount']           =>  Transactions::TYPE_ADD_FUND,
                    Yii::app()->session['addfund_bonusHoliday']     =>  Transactions::TYPE_BONUS_HOLIDAY,
                    Yii::app()->session['addfund_bonusInpayment']   =>  Transactions::TYPE_BONUS_INPAYMENT
                );
               $this->saveTransaction($paymentResult['TRANSACTIONID'],$amount);

                Yii::app()->user->setFlash('success', Yii::t('global', 'Your fund added successfully!'));
                unset(Yii::app()->session['addfund_amount'],Yii::app()->session['addfund_bonusInpayment'],Yii::app()->session['addfund_bonusHoliday']);

                $this->redirect('/profile/index');
			}
		}
	}
    function  saveTransaction($paymentResult,$amounts){

        foreach($amounts as $amount=>$paymentType){
            if($amount >0){
                $transaction = new Transactions;
                $transaction->user_id = Yii::app()->user->id;
                $transaction->currency = 'EUR';
                $transaction->created = date('Y-m-d H:i:s');
                $transaction->payment_transaction = $paymentResult;
                $transaction->options = '';
                $transaction->payment_method_id = PaymentMethods::SYSTEM;
                $transaction->paymentstatus = Transactions::STATUS_APPROVED;
                $transaction->amount = $amount;
                $transaction->transactiontype = $paymentType;
                if($transaction->save()){
                    if($paymentType !=Transactions::TYPE_ADD_FUND){
                        $transaction->payment_transaction = $transaction->id;
                        $transaction->save();
                    }
                }
            }
        }
    }
    
    function actionCashback(){
	   
	}

}