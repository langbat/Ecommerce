<div class="box">
	<div class="box_right cart-result">
		<div class="span2"><b><?php echo Yii::t('global', 'Subtotal')?></b></div>
		<div class="span1"><b id="<?php echo Yii::app()->session['shop_buy'] ?>_subtotal">00,00 &euro;</b></div>
        <div class="span2"><b><?php echo Yii::t('global', 'Shipping cost')?></b></div>
		<div class="span1"><b id="<?php echo Yii::app()->session['shop_buy'] ?>_shipping_cost">00,00 &euro;</b></div>
		<div class="span2 font"><b><?php echo Yii::t('global', 'Grand total')?></b></div>
		<div class="span1 fonts"><b id="<?php echo Yii::app()->session['shop_buy'] ?>_grand_total">00,00 &euro;</b></div>
		<div class="span2"><b><?php echo Yii::t('global', 'Total excluding')?></b>:</div>
		<div class="span1"><b id="<?php echo Yii::app()->session['shop_buy'] ?>_total_excluding">00,00 &euro;</b></div>
		 <div class="clearfix"></div>
		<div class="span2"><b><?php echo Yii::t('app', '+ {vat}% VAT',    array('{vat}'=>Yii::app()->settings->vat_tax))?>:</b></div>
		<div class="span1"><b id="<?php echo Yii::app()->session['shop_buy'] ?>_vat_tax">00,00 &euro;</b></div>
		<div class="span2"></div>
	</div>
    <div class="clearfix"></div>
    
    
</div>