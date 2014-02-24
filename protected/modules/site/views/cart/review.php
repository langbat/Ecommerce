<div class="pull-left col-left">    
        <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 4))?>
            
            <?php echo CHtml::form('', 'post', array('id' => 'cart-form')); ?>
            <div class="vote-content">
                <?php 
                /*if (isset($bids) && count($bids))
                    $this->renderPartial('review-bids', compact('bids', 'order')); */
                if (isset($products) && count($products) && count(Yii::app()->session['cart']))
                    $this->renderPartial('review-products', compact('products', 'order'));


                /*if (isset($coupons) && count($coupons))
                    $this->renderPartial('review-coupons', compact('order', 'coupons')); */
                
                $this->renderPartial('review-address', compact('order', 'coupons')); 
                
                $this->renderPartial('review-result', compact('order')); 
                ?>
                
				<div>

                    <span class="paypal-info">
                        <img src="/themes/default/img/paypal.gif" />
                        <a href="https://www.paypal.com/<?php echo Yii::app()->language ?>/webapps/mpp/paypal-popup" target="_blank">
                            <?php echo Yii::t('global', 'What is PayPal?')?>
                        </a><br />                        
                        <?php echo Yii::t('global', 'You will be redirected to the PayPal website to Place Order.')?>
                    </span>

	               <input class="btn-kaufen fix-checkout" type="submit" name="submit" value="<?php echo Yii::t('global', 'Place Order')?>" />
				</div>
                <div class="clearfix"></div> 
            </div>
            <?php echo CHtml::endForm(); ?>  
               
        </div>
    </div><!--#end vote-wrapper-->

</div><!--#end col-left-->

<div class="pull-left col-right">
      <?php if(!Yii::app()->user->isGuest){ ?>
        <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
        </div>
     <?php } ?>
     <div class="right-box">
        <?php $this->renderPartial('/elements/tested-safety');?>
    </div>
</div><!--#end col-right-->

<script type="text/javascript">
var data = eval('(<?php echo json_encode(Orders::getCartResult($order['items'],Yii::app()->session['shop_buy']))?>)');

$.each(data, function(key, value){
    $('#<?php echo Yii::app()->session['shop_buy'] ?>_' + key).html(value + ' &euro;');
    

});
$('.product .my_balance').html(data.balance + ' &euro;');
if (data.coupon_discount != '0,00'){
    $('.coupon-info').show();
}
</script>