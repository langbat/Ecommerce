<?php
$id = isset(Yii::app()->user->id)?Yii::app()->user->id:Yii::app()->session['guest_acount'];
$member = Members::model()->findByPk($id);
/*$tmp_member = new Members;
$tmp_member->attributes=$order['address']['Members'];
if ($order['address']['billing_address'] == 1){*/
    $billing_fullname = $member->getFullname();
    $billing_address = $member->getBillingAddress();
/*}
else{
    $billing_fullname = $tmp_member->getFullname();
    $billing_address = $tmp_member->getBillingAddress();
}
if ($order['address']['shipping_address'] == 1){*/
    $shipping_fullname = $member->getShippingFullname();
    $shipping_address = $member->getShippingAddress();
/*}
else{
    $shipping_fullname = $tmp_member->getShippingFullname();
    $shipping_address = $tmp_member->getShippingAddress();
}*/
?>
<div class="box" style="height: 90px;">
	<div class="derek fix-cart-derek"><b><?php echo Yii::t('global', 'Address Information')?></b></div>
    
    <div class="span2"><strong><?php echo Yii::t('global', 'Billing Address')?></strong>: </div>
    <div class="span5"><?php echo $billing_fullname?> - <?php echo $billing_address?> </div>
    
    <div class="span2"><strong><?php echo Yii::t('global', 'Shipping Address')?></strong>: </div>
    <div class="span5"><?php echo $shipping_fullname?> - <?php echo $shipping_address?> </div>
    
</div>