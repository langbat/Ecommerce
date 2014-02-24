
<div class="page-header">
	<h1>Configure <small>Settings</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo $category->title; ?></h1>      
			<ul class="buttons">
				<li>
					<a href="<?php echo $this->createUrl('settings/addsetting', array('cid' => $_GET['id'])); ?>" class="isw-text_document tipb" data-original-title="<?php echo Yii::t('adminsettings', 'Add Setting'); ?>"></a>
				</li>
			</ul>                        
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
				<?php if( count($settings) ): ?>
					<?php foreach ($settings as $row): ?>
						<div class="row-form clearfix">
							<div class="span3">
								<span<?php if( CHtml::encode($row->description) ): ?> class="tipb" data-original-title='<?php echo CHtml::encode($row->description); ?>'<?php endif; ?>>
									<?php echo CHtml::encode($row->title); ?>
								</span>
								<?php if( $row->value && $row->default_value != $row->value ): ?><span style='color:red;'><?php echo Yii::t('adminsettings', '(Setting Changed)'); ?></span><?php endif; ?>
							</div>
							<div class="span7">
								<?php $this->parseSetting( $row ); ?>
							</div>
							<div class="span2">
								<?php if( $row->value && $row->default_value != $row->value ): ?>
									<a href="<?php echo $this->createUrl('settings/revertsetting', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Revert setting value to the default value.'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/revert.png" alt="Revert" /></a>
								<?php endif; ?>
								 <a href="<?php echo $this->createUrl('settings/editsetting', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Edit this setting'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Edit" /></a>
								 <a href="<?php echo $this->createUrl('settings/deletesetting', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Delete this setting!'); ?> "><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/cross.png" alt="Delete" /></a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td style='text-align:center;'><?php echo Yii::t('adminsetings', 'No Settings Added Yet.'); ?></td>
					</tr>
				<?php endif; ?>
			<?php if( count($settings) ): ?>
			<div class="footer tar">
				<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Save'), array( 'name' => 'submit', 'class'=>'btn')); ?>
			</div>
			<?php endif; ?>
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>                                
</div>