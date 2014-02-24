<?php
class PaypalController extends SiteBaseController
{
	public function actionBuy(){
        $package = Packages::model()->findByPk($_POST['id']);
        if (!$package)
            $this->redirect('/users/upgrade');
        
        $member = Members::model()->findByPk(Yii::app()->user->id);
        if ($member->package->price >= $package->price){
            Yii::app()->user->setFlash('error', 'Please choose bigger package!');
            $this->redirect('/users/upgrade');
        }
        
        Yii::app()->session['package'] = $package;        
		// set 
		$paymentInfo['Order']['theTotal'] = $package->price;
		$paymentInfo['Order']['description'] = "UPGRADE - ".$package->name;
		$paymentInfo['Order']['quantity'] = '1';

		// call paypal 
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			Yii::app()->user->setFlash('error', $error);
            $this->redirect('/users/upgrade');
			
		}else { 
			// send user to paypal 
			$token = urldecode($result["TOKEN"]); 
			
			$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
			$this->redirect($payPalURL); 
		}
	}

	public function actionConfirm()
	{
        $package = Yii::app()->session['package'];
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = $package->price;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			Yii::app()->user->setFlash('error', $error);
            $this->redirect('/users/upgrade');
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				Yii::app()->user->setFlash('error', $error);
                $this->redirect('/users/upgrade');
				
			}else{
                $member = Members::model()->findByPk(Yii::app()->user->id);
                $member->package_id = $package->id;
                $member->update();
                
                Yii::app()->user->setFlash('success', Yii::t('global', 'Payment completed successfully!'));
                $this->redirect('/users/setting');				
			}
			
		}
	}
        
    public function actionCancel()	{
        Yii::app()->user->setFlash('warning', Yii::t('global', 'The payment was cancelled.'));
        $this->redirect('/users/upgrade');
	}
	
	public function actionDirectPayment(){ 
		$paymentInfo = array('Member'=> 
			array( 
				'first_name'=>'name_here', 
				'last_name'=>'lastName_here', 
				'billing_address'=>'address_here', 
				'billing_address2'=>'address2_here', 
				'billing_country'=>'country_here', 
				'billing_city'=>'city_here', 
				'billing_state'=>'state_here', 
				'billing_zip'=>'zip_here' 
			), 
			'CreditCard'=> 
			array( 
				'card_number'=>'number_here', 
				'expiration_month'=>'month_here', 
				'expiration_year'=>'year_here', 
				'cv_code'=>'code_here' 
			), 
			'Order'=> 
			array('theTotal'=>1.00) 
		); 

	   /* 
		* On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
		* [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
		*  
		* On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
		* [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
		* [L_SEVERITYCODE0]  
		*/ 
	  
		$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
		
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			
		}else { 
			//Payment was completed successfully, do the rest of your stuff
		}

		Yii::app()->end();
	} 
}