<?php 

$cart_count = isset(Yii::app()->session['cart']['qty'])?Yii::app()->session['cart']['qty']:0;
//var_dump(Yii::app()->session['cart']);exit();

/*$cart = isset(Yii::app()->session['cart'])?Yii::app()->session['cart']:array();
$cart_shop = isset(Yii::app()->session['cart_shop'])?Yii::app()->session['cart_shop']:array();

if (count($cart))
foreach ($cart as $auction_id => $number){
    $cart_count += $number['qty'];
}
if (count($cart_shop))
foreach ($cart_shop as $product_id => $number){
    $cart_count += $number['qty'];
}*/
/*if (is_array(Yii::app()->session['win_bids']))
    $cart_count += count(Yii::app()->session['win_bids']);
*/?>
<div class="cart-box pull-right">
    <div class="top-box cart-box-icon"><h5 class="text-purple text-shadow"><a class="text-cart" href="/cart"><?php echo Yii::t('global', 'My Cart') ?></a></h5></div>
    <div class="bottom-box">
        <p class="text-grey"><?php echo Yii::t('global', 'Now in shopping cart') ?>:</p>
        <p class="text-purple"><a class="text-cart" href="/cart"><span class="cart_count"><?php echo $cart_count?></span> <?php echo Yii::t('global', 'Product') ?></a></p>
    </div>
</div><!--#end cart-box-->