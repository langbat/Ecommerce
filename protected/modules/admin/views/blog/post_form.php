<div class="page-header">
	<h1>Edit <small>Blog Post</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-text_document"></div>
			<h1><?php echo $label; ?></h1>                      
		</div>
		<div class="block-fluid" id="wysiwyg_container">
			<?php echo CHtml::form(); ?>
				
				<div class="row-form clearfix">
					<?php echo CHtml::activeLabel($model, 'title'); ?>
					<?php echo CHtml::activeTextField($model, 'title', array( 'class' => 'text-input medium-input' )); ?>
					<?php echo CHtml::error($model, 'title', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				</div>
				
				<div class="row-form clearfix">
					<?php echo CHtml::activeLabel($model, 'status'); ?>
					<?php echo CHtml::activeDropDownList($model, 'status', array( 0 => Yii::t('adminblog', 'Hidden (Draft)'), 1 => Yii::t('adminblog', 'Open (Published)') ), array( 'class' => 'text-input medium-input' )); ?>
					<?php echo CHtml::error($model, 'status', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				</div>
				
				<div class="row-form clearfix">
					<?php echo CHtml::activeLabel($model, 'content'); ?>
					<?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'content', 'editorTemplate' => 'full' )); ?>
					<?php echo CHtml::error($model, 'content', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				</div>
				
				<div class="footer tar">
					<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class'=>'btn', 'name'=>'submit')); ?>
				</div>
			
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>
</div>