
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'user_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'user_id', array($model->user_id=>$model->user->username)); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
	</div>

    <div class="row-form clearfix">
		<div class="span3">
            <?php echo Yii::t('global', 'Name Shop'); ?>
        </div>
		<div class="span9">
		    <?php $nameshop = MemberShop::model() -> findAll();
 			 $list = CHtml::listData($nameshop, 'id', 'name');
 		 	echo $form::dropDownList($model,'shop_id', $list, array('empty'=> ""));
 		 ?>
 		 <?php echo $form->error($model,'id'); ?>
            
        </div>
	</div>
    
    <div class="row-form clearfix">
		<div class="span3">
            <?php echo Yii::t('global', 'Email'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>512, 'value'=>Members::model()->getEmails($model->user_id))); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
	</div>
    
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'billing_fullname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'billing_fullname',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'billing_fullname'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'billing_address'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'billing_address',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'billing_address'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->