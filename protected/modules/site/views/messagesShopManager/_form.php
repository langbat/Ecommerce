
<div class="block-fluid">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'messages-shop-form',
    'enableAjaxValidation' => false,
    )); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Sender') . ':'); ?>
        </div>
		<div class="">
            <?php echo MessagesShop::model()->getUserfrom(Yii::app()->user->id); ?>
            
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Receiver') . ':'); ?>
        </div>
		<div class="">
            <?php echo MessagesShop::model()->getUserfrom($_GET['id']); ?>
           <?php //echo $form->error($model,'to'); ?>
        </div>
	</div>
    	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Subject') .
':<span style="color: red;">*</span>'); ?>
        </div>
		<div class="">
            <?php echo $form->textField($model, 'subject', array('value' => '[' .
Yii::t('global', 'Reply') . '] ')); ?>
            <span style="color: red;"> <?php echo $form->error($model, 'subject'); ?></span>
        </div>
	</div>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Message') .
':<span style="color: red;">*</span>'); ?>
        </div>
		<div class="">
            <?php echo $form->textArea($model, 'message', array('rows' => 6,
'cols' => 50)); ?>
           <span style="color: red;"> <?php echo $form->error($model, 'message'); ?></span>
        </div>
	</div>
    <div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Date created') .
':'); ?>
        </div>
		<div class="">
            <?php echo date('d-m-Y'); ?>
            
        </div>
	</div>
   

	

	<div class="footer tar pull-right button-top">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Send') :
Yii::t('global', 'Save'), array('class' => 'btn pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

