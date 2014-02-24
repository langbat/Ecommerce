
<div class="page-header">
	<h1><?php echo $label; ?><small> <?php echo $model->username; ?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo $label; ?></h1>                       
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'username'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'username', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'username', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'email'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'email', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'password'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'password', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'password', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'fname'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'fname', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'fname', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'lname'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'lname', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'lname', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'address'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'address', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'address', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'city'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'city', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'city', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::activeLabel($model, 'phone'); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeTextField($model, 'phone', array( 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'phone', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				<?php /*
				<div class="row-form clearfix">
					<div class="span3">
						<?php echo CHtml::label(Yii::t('adminmembers', 'Default Role'), ''); ?>
					</div>
					<div class="span7">
						<?php echo CHtml::activeDropDownList($model, 'role', $items[ CAuthItem::TYPE_ROLE ], array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
					</div>
					<div class="span2">
						<?php echo CHtml::error($model, 'role', array( 'class' => 'input-notification errorshow png_bg' )); ?>
					</div>
				</div>
				
				
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