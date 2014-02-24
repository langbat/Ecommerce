
<div class="page-header">
	<h1><?php echo $label; ?><small><?php echo $model->name; ?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-list"></div>
			<h1><?php echo $label; ?></h1>                       
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('adminfilecats', 'Name'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'name', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'name', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('adminfilecats', 'Description'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'desc', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'desc', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
                
				<div class="footer tar">
					<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array( 'name' => 'submit', 'class'=>'btn')); ?>
				</div>
				
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>                                
</div>