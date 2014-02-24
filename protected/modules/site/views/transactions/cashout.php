<div class="span12">

	<h1><?php echo Yii::t('transactions', 'Request Cashout'); ?></h1>

	<div class="row-fluid clearfix">
		<div class="span9">
			<p><?php echo Yii::t('transactions', 'Your curent balance'); ?>: <?php echo $mybalance; ?> USD</p>
			<p><?php echo Yii::t('transactions', 'Cashout min'); ?>: <?php echo Transactions::CASHOUT_MIN; ?> USD</p>
			<p><?php echo Yii::t('transactions', 'Cashout max'); ?>: <?php echo $mymaxcashout; ?> USD</p>
			<p><?php echo Yii::t('transactions', 'Cashout fee'); ?>: <?php echo Transactions::CASHOUT_FEE ; ?> USD</p>
		</div>
		<div class="span3" style="text-align:right;">
			<?php if($cancashout) : ?>
				
			<?php else : ?>
				---
			<?php endif; ?>
		</div>
	</div>

	<?php echo CHtml::form($this->createUrl('transactions/cashout'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>

		<div class="row-fluid clearfix" style="padding-bottom: 20px;">
			<p><?php echo Yii::t('transactions', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
		</div>
		
		<?php if($model->hasErrors()): ?>
			<p class="error">
				<?php echo Yii::t('transactions', 'Please fix the following input errors.'); //CHtml::errorSummary($model); ?>
			</p>
		<?php endif; ?>
		
		<div class="row-fluid"><div class="span12">
		
			<div class="row-form clearfix" style="border-bottom: 0px none;">
				<div class="span2 bold"><?php echo CHtml::activeLabel($model, 'amount'); ?> *</div>
				<div class="span4"><?php echo CHtml::activeTextField($model, 'amount', array( 'class' => 'text tooltipsy validate[required,custom[integer],min['.Transactions::CASHOUT_MIN.'],max['.$mymaxcashout.']]', 'title' => Yii::t('transactions', 'Enter the amount') )); ?></div>
				<?php echo CHtml::error($model, 'amount', array( 'class' => 'span6 error' )); ?>
			</div>
			
			<div class="row-form clearfix" style="border-bottom: 0px none;">
				<div class="span2 bold"><?php echo CHtml::activeLabel($model, 'verifyCode'); ?> *</div>
				<div class="span4">
					<?php echo CHtml::activeTextField($model, 'verifyCode', array( 'class' => 'text tooltipsy validate[required]', 'title' => Yii::t('transactions', 'Enter the text displayed in the image below') )); ?>
					<br/><?php $this->widget('CCaptcha', array('buttonLabel'=>'Get a new code', 'buttonOptions'=>array('class'=>'btnRefresh', 'title'=>'Get a new code'))); ?>
				</div>
				<?php echo CHtml::error($model, 'verifyCode', array( 'class' => 'span6 error' )); ?>
			</div>
			
			<div class="row-form">
				<?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn-submit', 'name'=>'submit')); ?>
			</div>
			
		</div></div>
		
	<?php echo CHtml::endForm(); ?>
	
</div>