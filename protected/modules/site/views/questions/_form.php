
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
        <?php echo(Yii::app()->user->isGuest)? $form->textField($model,'name',array('size'=>60,'maxlength'=>100)):$form->textField($model,'name',array('size'=>60,'maxlength'=>100,'value'=>Yii::app()->user->name,'readonly'=>'true'));?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'emails'); ?>
        </div>
		<div class="span9">
            <?php echo(Yii::app()->user->isGuest)? $form->textField($model,'emails',array('size'=>60,'maxlength'=>100)):$form->textField($model,'emails',array('size'=>60,'maxlength'=>100,'value'=>Yii::app()->user->email,'readonly'=>'true')); ?>
            <?php echo $form->error($model,'emails'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'questions'); ?>
        </div>
		<div class="span9">
        	<?php // $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'questions', 'editorTemplate' => 'full' )); ?>
           <?php echo $form->textArea($model,'questions',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'questions'); ?>
        </div>
	</div>

	

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'datequestion'); ?>
        </div>
		<div class="span9">
           <?php echo date('d-m-Y'); ?>
        </div>
	</div>



	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Send') : Yii::t('global','Send'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->