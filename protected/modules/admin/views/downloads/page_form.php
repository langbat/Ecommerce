
<div class="page-header">
	<h1><?php echo $label; ?><small> <?php echo $model->name; ?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-download"></div>
			<h1><?php echo $label; ?></h1>                       
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form('', 'post', array('class'=>'frmcontact', 'id'=>'validation2', 'enctype'=>'multipart/form-data')); ?>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('admindownloads', 'Name'), ''); ?>
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
						<?php echo CHtml::label(Yii::t('admindownloads', 'Desc'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'desc', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'desc', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
                
                <div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('admindownloads', 'Category'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeDropDownList($model, 'cat_id', CHtml::listData( FileCats::model()->findAll(), 'id', 'name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'cat_id', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
                
                <div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('admindownloads', 'Plan'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeDropDownList($model, 'plan_id', CHtml::listData( Plans::model()->findAll(), 'id', 'name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'plan_id', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
                
               	<div class="row-form clearfix">
        			<div class="span3"><label for="file">File</label></div>
        			<div class="span7"><input type="file" name="file" id="file" class="text tooltipsy" title="Upload your photo"/></div>
					<div class="span2">
						<?php if($uploaded_file != '' && $uploaded_filename != '') : ?>
							<input type="hidden" name="uploaded_file" value="<?php echo $uploaded_file; ?>"/>
							<input type="hidden" name="uploaded_filename" value="<?php echo $uploaded_filename; ?>"/>
							Uploaded file: <?php echo $uploaded_filename; ?>
						<?php endif; ?>
					</div>
        		</div>         
				
                
				
				
				<?php /*
				<?php echo CHtml::label(Yii::t('adminmembers', 'Username'), ''); ?>
				<?php echo CHtml::activeTextField($model, 'username', array( 'class' => 'text-input medium-input' )); ?>
				<?php echo CHtml::error($model, 'username', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Email Address'), ''); ?>
				<?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text-input medium-input' )); ?>
				<?php echo CHtml::error($model, 'email', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Password'), ''); ?>
				<?php echo CHtml::activeTextField($model, 'password', array( 'class' => 'text-input medium-input' )); ?>
				<?php echo CHtml::error($model, 'password', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Default Role'), ''); ?>
				<?php echo CHtml::activeDropDownList($model, 'role', $items[ CAuthItem::TYPE_ROLE ], array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
				<?php echo CHtml::error($model, 'role', array( 'class' => 'input-notification errorshow png_bg' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Other Assigned Roles'), ''); ?>
				<?php echo CHtml::listBox('roles', isset($_POST['roles']) ? $_POST['roles'] : isset($items_selected[ CAuthItem::TYPE_ROLE ]) ? $items_selected[ CAuthItem::TYPE_ROLE ] : '', $items[ CAuthItem::TYPE_ROLE ], array( 'size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Other Assigned Tasks'), ''); ?>
				<?php echo CHtml::listBox('tasks', isset($_POST['tasks']) ? $_POST['tasks'] : isset($items_selected[ CAuthItem::TYPE_TASK ]) ? $items_selected[ CAuthItem::TYPE_TASK ] : '', $items[ CAuthItem::TYPE_TASK ], array( 'size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input' )); ?>
				
				<?php echo CHtml::label(Yii::t('adminmembers', 'Other Assigned Operations'), ''); ?>
				<?php echo CHtml::listBox('operations', isset($_POST['operations']) ? $_POST['operations'] : isset($items_selected[ CAuthItem::TYPE_OPERATION ]) ? $items_selected[ CAuthItem::TYPE_OPERATION ] : '', $items[ CAuthItem::TYPE_OPERATION ], array( 'size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input' )); ?>
				*/ ?>
				
				<div class="footer tar">
					<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array( 'name' => 'submit', 'class'=>'btn')); ?>
				</div>
				
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>                                
</div>