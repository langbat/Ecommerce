<div class="box fix_box_result">
	<!--<div class="box_left">
		<div class="span1"><?php echo Yii::t('global', 'Add coupon')?></div>
		<div class="span2 fiel">
			<form>
			  <fieldset>
					<input type="text" name="coupon" id="coupon" placeholder="<?php echo Yii::t('global', 'Coupon-Number')?>" />
				</fieldset>
			</form>
		</div>
		<button class="buttom" id="add-coupon"><?php echo Yii::t('global', 'Add')?> <img src="/themes/default/img/icon.png" /></button>
		
	</div> -->
    
	<div class="box_right cart-result fix_box_right">
		<div class="span2"><b><?php echo Yii::t('global', 'Subtotal')?></b></div>
		<div class="span1"><b id="<?php echo $shop_id ?>_subtotal">00,00 &euro;</b></div>
        
        <div style="display: none;" id="frm_credit_products">
    		<div class="span2 colo"><b><?php echo Yii::t('global', 'Credit products')?></b></div>
    		<div class="span1 colo"><b id="credit_products">-00,00 &euro;</b></div>
        </div>
        
        <div style="display: none;" id="frm_credit_balance">
            <div class="span2 colo"><b><?php echo Yii::t('global', 'Credit on bid acccount')?></b></div>
    		<div class="span1 colo">+<b id="credit_balance">+00,00 &euro;</b></div>
        </div>
        
        
        <div class="span2"><b><?php echo Yii::t('global', 'Shipping cost')?></b></div>
		<div class="span1"><b id="<?php echo $shop_id ?>_shipping_cost">00,00 &euro;</b></div>
		<div class="span2 font"><b><?php echo Yii::t('global', 'Grand total')?></b></div>
		<div class="span1 fonts"><b id="<?php echo $shop_id ?>_grand_total">00,00 &euro;</b></div>
		<div class="span2"><b><?php echo Yii::t('global', 'Total excluding')?></b>:</div>
		<div class="span1"><b id="<?php echo $shop_id ?>_total_excluding">00,00 &euro;</b></div>
		 <div class="clearfix"></div>
		<div class="span2"><b><?php echo Yii::t('app', '+ {vat}% VAT',    array('{vat}'=>Yii::app()->settings->vat_tax))?>:</b></div>
		<div class="span1"><b id="<?php echo $shop_id ?>_vat_tax">00,00 &euro;</b></div>
		<div class="span2"></div>
	</div>
        <input class="btn-kaufen fix-checkout" type="submit" value="<?php echo Yii::t('global', 'Checkout')?>" />
</div>