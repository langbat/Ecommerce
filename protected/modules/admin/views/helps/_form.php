
<div class="block-fluid">

<?php
    $HelpTopic =  Lookup::items('HelpTopic');
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'helps-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'question'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'question',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'question'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'answer'); ?>
        </div>
		<div class="span9">
            <?php echo $form->htmlArea($model,'answer',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'answer'); ?>
        </div>
	</div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'topic'); ?>
        </div>
        <div class="span9">
            <?php echo $form->dropDownList($model,'topic',$HelpTopic); ?>
            <?php echo $form->error($model,'topic'); ?>
        </div>
        <div class="add_topic"><a href="/admin/help/createTopic> <?php echo Yii::t('global','Add New Topic') ?></a></div>
    </div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->