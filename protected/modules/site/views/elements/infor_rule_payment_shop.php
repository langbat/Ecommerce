<div id="home-boxes">
	<!-- Begin Box -->
	<div class="box first">
		<div class="box-title">
			<img alt="First Box Image" src="/themes/default/img/box-img1.png">
			<h4><?php echo Yii::t('global','About us'); ?></h4>
			<div class="cl">&nbsp;</div>
		</div>
		<div class="box-entry">
			<p><span class="infor-shop"> <?php echo Yii::t('global','Name') ?> </span>: <?php echo $this->membershop->name; ?></p>
			<p><span class="infor-shop"><?php echo Yii::t('global','Slogan') ?> </span>: <?php echo $this->membershop->slogan; ?></p>
            <p><span class="infor-shop"><?php echo Yii::t('global','Email') ?> </span>: <?php echo $this->membershop->email; ?></p>
            <p><span class="infor-shop"><?php echo Yii::t('global','Reviews') ?> </span>  : </p> <span class="rating-shop-infor"><?php 
                $this->widget('ext.dzRaty.DzRaty', array(
                    'name' => 'my_rating_shop_id_'.$this->membershop->id,
                    'value' => ShopRatings::model()->getRatingShop($this->membershop->id),
                    'options' => array(
                            'half' => TRUE,
                            	'click' => "js:function(score, evt){ shop_ratings(score,".$this->membershop->id.") }",
        
                    ),
                    'htmlOptions' => array(
                    'class' => 'new-half-class'
                    ),
                ));
                $this->renderPartial('../elements/rate_product');
                ?>
            <span class="rating-total-infor">( <?php echo ShopRatings::model()->totalRatingShop( $this->membershop->id ); ?> )</span></span>
		</div>
	</div>
	<!-- End Box -->
	<!-- Begin Box -->
	<div class="box">
		<div class="box-title">
			<img alt="Second Box Image" src="/themes/default/img/box-img2.png">
			<h4><?php echo Yii::t('global','Welcome'); ?></h4>
			<div class="cl">&nbsp;</div>
		</div>
		<div class="box-entry">
			<p>
             <?php 
             echo ( isset( $this->membershop->welcome ) )?$this->membershop->welcome:Yii::t('global','Welcome to our store! If you have questions, please call us or write to us. We look forward to your call and advise you!');
             ?>
             </p>
		</div>
	</div>
	<!-- End Box -->
	<!-- Begin Box -->
	<div class="box">
		<div class="box-title">
			<img alt="Third Box Image" src="/themes/default/img/box-img3.png">
			<h4><?php echo Yii::t('global','Service & consulting'); ?></h4>
			<div class="cl">&nbsp;</div>
		</div>
		<div class="box-entry">
		     <div id="service">
                <?php 
                    if ( isset( $this->membershop->service ) ) 
                        echo $this->membershop->service; 
                    else {
                ?>
                     <div class="phone"><i></i>+49 (0)2924-996868</div>
                     <div class="phone_hours"><span><span>Mo-Fr</span> 09.00 Uhr - 19.00 Uhr</span><span><span>Sa</span> 09.00 Uhr - 19.00 Uhr</span><span><span>So</span> 11.00 Uhr - 18.00 Uhr</span></div>
                <?php } ?>
             </div>
		</div>
	</div>
	<!-- End Box -->
	<!-- Begin Box -->
	<div class="box">
		<div class="box-title">
			<img alt="Fourth Box Image" src="/themes/default/img/box-img4.png">
			<h4><?php echo Yii::t('global','Payment'); ?></h4>
			<div class="cl">&nbsp;</div>
		</div>
		<div class="box-entry">
			<div class="wgt payment"><a><img alt="Vorkasse" src="/themes/default/img/payments/payment_prepaid.png"></a><a><img alt="Rechnung" src="/themes/default/img/payments/payment_invoice.png"></a><a><img alt="PayPal" src="/themes/default/img/payments/payment_paypal.png"></a><a><img alt="sofortüberweisung" src="/themes/default/img/payments/payment_sofortueberweisung.png"></a>
            <a><img alt="Lastschrift" src="/themes/default/img/payments/payment_debit-card.png"></a><a><img alt="giropay" src="/themes/default/img/payments/payment_giropay.png"></a><a><img alt="American Express" src="/themes/default/img/payments/payment_amex.png"></a><a><img alt="MasterCard" src="/themes/default/img/payments/payment_mastercard.png"></a><a><img alt="Visa" src="/themes/default/img/payments/payment_visa.png"></a><a><img alt="ClickandBuy" src="/themes/default/img/payments/payment_clickandbuy.png"></a></div>
		</div>
	</div>
	<!-- End Box -->
	<div class="cl">&nbsp;</div>
</div>