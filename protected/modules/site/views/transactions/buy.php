<div class="span12">

	<h1><?php
		if($myplan->dayleft == 0) echo Yii::t('transactions', 'Buy a plan');
		else  echo Yii::t('transactions', 'Upgrade your plan');
	?></h1>
	<p><?php echo Yii::t('transactions', 'Please select a plan.'); ?></p>
	
	<div class="row-fluid" style="padding-bottom: 20px;">
		<?php if(count($plans))
		{
			foreach($plans as $plan)
			{ ?>
				<div class="span1"></div>
				<div class="span4 plan-item">
					
					<div class="plan-info">		
						<img class="hidden-tablet" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/thumbnail.png" alt="thumbnail" width="50" height="50">
						<div class="information">
							<p><a><?php echo $plan->name; ?></a></p>
							<p><span><?php echo $plan->desc; ?></span></p>
						</div>
					</div>
					<img class="preview" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/preview.png" alt="preview">
					<div class="plan-spot"><span><?php echo $plan->permonth; ?> downloads per month</span></div>
					<div class="plan-spot"><span><?php echo $plan->price; ?> USD per month</span></div>
					<div class="plan-spot" style="border-bottom: 0px none; text-align:center;">
						<?php echo CHtml::form($this->createUrl('transactions/buyplan'), 'post', array('class'=>'frmcontact')); ?>
						<input type="hidden" name="plan_id" value="<?php echo $plan->id; ?>"/>
						<?php echo CHtml::submitButton(Yii::t('global', 'Buy now'), array('class'=>'btn-submit', 'name'=>'submit')); ?>
						<?php echo CHtml::endForm(); ?>
					</div>
				</div>
				<div class="span1"></div>
			<?php }
		} ?>
	</div>
	
</div>