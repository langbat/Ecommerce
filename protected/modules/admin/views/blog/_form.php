<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'catid'); ?>
            
        </div>
		<div class="span9">
            <?php echo CHtml::activeDropDownList($model, 'catid', CHtml::listData( BlogCats::model()->findAll(), 'id', 'title' )); ?>
            <?php echo $form->error($model,'catid'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'title'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
	</div>
    <div class="row-form clearfix">
      <div class="span3">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		<div class="span9">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" href="/uploads/blog/<?php echo $model->image?>" rel="group">
                    <img class="img-polaroid" src="/uploads/blog/<?php echo $model->image?>" style="height: 50px;"/> 
                </a>
            <?php endif;?>
        </div>
     </div>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'description'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'description',array('rows'=>4, 'cols'=>40, 'maxlength'=>255)); ?>
            <?php echo $form->error($model,'description'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php echo $form->htmlArea($model,'content',array('rows'=>6, 'cols'=>50 )); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->