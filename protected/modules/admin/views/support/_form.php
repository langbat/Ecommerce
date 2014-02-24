<div class="block-fluid">

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'support-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
	'enctype' => 'multipart/form-data',
	),
	)); ?>

	<?php echo $form->errorSummary($model); ?>

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
			<?php echo $form->labelEx($model,'categories'); ?>
		</div>
		<div class="span9">
			<?php echo $form->dropDownList($model,'categories',array('0'=>Yii::t('global', 'Media library'),'1'=>Yii::t('global', 'Blog video'),'2'=>Yii::t('global', 'Tutorial video'),'4'=>Yii::t('global', 'Dropdown top'),'5'=>Yii::t('global', 'Dropdown bottom'))); ?>
			<?php echo $form->error($model,'categories'); ?>
		</div>
	</div>
	<div class="row-form clearfix">
		<div class="span3">
			<?php echo $form->labelEx($model,'description'); ?>
		</div>
		<div class="span9">
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
	<div class="row-form clearfix">
		<div class="span3">
			<?php echo $form->labelEx($model,'content'); ?>
		</div>
		<div class="span9">
			<?php echo $form->htmlArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'content'); ?>
		</div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
			<?php echo $form->labelEx($model,'linkyoutube'); ?>
		</div>
		<div class="span8 fix_video">
			<div class="options_video">
				<select name="options_video" class="select_video">
					<option value="link"><?php echo Yii::t('global','Choose video from website ') ?></option>
					<option value="upload"><?php echo Yii::t('global','Upload from your computer') ?></option>
				</select>
				<div class="text_link_video">
					<?php echo $form->textField($model,'linkyoutube', array('title'=>Yii::t('global','Please type url video'),'class'=>'video_from_url')); ?>
					<?php echo $form->error($model,'linkyoutube'); ?>
				</div>
				<div class="file_upload_video">
					<?php echo $form->fileField($model,'video',array('class'=>'fix_input_upload')); ?>
				</div>

			</div>
			<?php if ($model->linkyoutube):?>
			<?php
			error_reporting(0);
			echo Products::getVideo($model->linkyoutube); ?>
			<?php endif;?>
		</div>

		<!--
		<div class="span9">
		<?php //echo $form->textArea($model,'linkyoutube',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'linkyoutube'); ?>
		</div> -->

	</div>

	<div class="row-form clearfix">
		<div class="span3">
			<?php echo $form->labelEx($model,'is_highlight'); ?>
		</div>
		<div class="span9">

			<?php echo $form->checkBox($model,'is_highlight'); ?>
			<?php echo $form->error($model,'is_highlight'); ?>
		</div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
	$('.select_video').change(function() {
		var type = $('.select_video').val();
		if (type == 'link') {
			$('.file_upload_video').css('display', 'none');
			$('.text_link_video').css('display', 'block');
		} else {
			$('.fix_input_upload').parent().css('display', 'block');
			$('.text_link_video').css('display', 'none');
			$('.file_upload_video').css('display', 'block');
		}
	}); 
</script>