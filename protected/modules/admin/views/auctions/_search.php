<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_price'); ?>
		<?php echo $form->textField($model,'max_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bid_price'); ?>
		<?php echo $form->textField($model,'bid_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'countdown'); ?>
		<?php echo $form->textField($model,'countdown'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bid_quote'); ?>
		<?php echo $form->textField($model,'bid_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_featured'); ?>
		<?php echo $form->textField($model,'is_featured'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'as_banner'); ?>
		<?php echo $form->textField($model,'as_banner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_bid'); ?>
		<?php echo $form->textField($model,'special_bid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_bid_start_time'); ?>
		<?php echo $form->textField($model,'special_bid_start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_bid_end_time'); ?>
		<?php echo $form->textField($model,'special_bid_end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_bid_start_quote'); ?>
		<?php echo $form->textField($model,'special_bid_start_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_bid_end_quote'); ?>
		<?php echo $form->textField($model,'special_bid_end_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'half_price_bid'); ?>
		<?php echo $form->textField($model,'half_price_bid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'half_price_bid_start_quote'); ?>
		<?php echo $form->textField($model,'half_price_bid_start_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'half_price_bid_end_quote'); ?>
		<?php echo $form->textField($model,'half_price_bid_end_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'free_bid'); ?>
		<?php echo $form->textField($model,'free_bid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'free_bid_start_quote'); ?>
		<?php echo $form->textField($model,'free_bid_start_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'free_bid_end_quote'); ?>
		<?php echo $form->textField($model,'free_bid_end_quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joker_bid_price'); ?>
		<?php echo $form->textField($model,'joker_bid_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joker_bid_code'); ?>
		<?php echo $form->textField($model,'joker_bid_code',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joker_position_from'); ?>
		<?php echo $form->textField($model,'joker_position_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joker_position_to'); ?>
		<?php echo $form->textField($model,'joker_position_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cashback_position_2'); ?>
		<?php echo $form->textField($model,'cashback_position_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cashback_position_3'); ?>
		<?php echo $form->textField($model,'cashback_position_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comfort_bid_credit'); ?>
		<?php echo $form->textField($model,'comfort_bid_credit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'win_bid_id'); ?>
		<?php echo $form->textField($model,'win_bid_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_paid'); ?>
		<?php echo $form->textField($model,'is_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->