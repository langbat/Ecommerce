<div class="span12">

	<h1><?php echo Yii::t('transactions', 'Select Payment Methods'); ?></h1>
	
	<div>
		Your selected plan:
	</div>
	<div class="web-info">
		<p><a>Plan type: <?php
			if($myplan->id > 0) echo 'Upgrade';
			else echo 'New plan';
		?></a></p>
		<p><a><?php echo $plan->name; ?></a></p>
		<p><span><?php echo $plan->desc; ?></span></p>
		
		<div class="web-spot"><span><?php echo $plan->permonth; ?> downloads per month</span></div>
		<div class="web-spot"><span><?php echo $plan->price; ?> USD per month</span></div>
		
	</div>
	
	<div class="row-fluid">
		<div class="span6" style="text-align:center;">
			<?php echo CHtml::form($this->createUrl('transactions/buyplan'), 'post', array('class'=>'frmcontact')); ?>
			<input type="hidden" name="paymentmethod" value="manual"/>
			<input type="hidden" name="dopayment" value="<?php echo md5($plan->id); ?>"/>
			<?php echo CHtml::submitButton(Yii::t('global', 'Manual'), array('class'=>'btn-submit', 'name'=>'submit')); ?>
			<?php echo CHtml::endForm(); ?>
		</div>
		<div class="span6" style="text-align:center;">
			<?php echo CHtml::form($this->createUrl('transactions/buyplan'), 'post', array('class'=>'frmcontact')); ?>
			<input type="hidden" name="paymentmethod" value="paypal"/>
			<input type="hidden" name="dopayment" value="<?php echo md5($plan->id); ?>"/>
			<?php echo CHtml::submitButton(Yii::t('global', 'Paypal'), array('class'=>'btn-submit', 'name'=>'submit')); ?>
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>
	
</div>