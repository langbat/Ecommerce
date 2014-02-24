
<div class="page-header">
	<h1><?php echo Yii::t('global', 'Configure')?> <small><?php echo Yii::t('global', 'Settings')?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<?php echo CHtml::form(); ?>

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-settings"></div>
			<h1><?php echo Yii::t('global', 'General Settings')?></h1>                   
		</div>
		<div class="block-fluid">			
				<?php if( count($cat1) ): ?>
					<?php foreach ($cat1 as $row): ?>
						<div class="row-form clearfix">
							<div class="span3">
								<span<?php if( CHtml::encode($row->description) ): ?> class="tipb" data-original-title='<?php echo Yii::t('global', $row->description); ?>'<?php endif; ?>>
									<?php echo Yii::t('global', $row->title); ?>
								</span>
								<?php if( $row->value && $row->default_value != $row->value ): ?><span style='color:red;'><?php echo Yii::t('adminsettings', '(Setting Changed)'); ?></span><?php endif; ?>
							</div>
							<div class="span7">
								<?php $this->parseSetting( $row ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td style='text-align:center;'><?php echo Yii::t('adminsetings', 'No Settings Added Yet.'); ?></td>
					</tr>
				<?php endif; ?>
			<?php if( count($cat1) ): ?>
			<div class="footer tar">
				
			</div>
			<?php endif; ?>
			
		</div>
	</div>                                
</div>

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-settings"></div>
			<h1><?php echo Yii::t('global', 'System Settings')?></h1>                   
		</div>
		<div class="block-fluid">
			
				<?php if( count($cat3) ): ?>
					<?php foreach ($cat3 as $row): ?>
						<div class="row-form clearfix">
							<div class="span4">
								<span<?php if( CHtml::encode($row->description)): ?> class="tipb" data-original-title='<?php echo CHtml::encode($row->description); ?>'<?php endif; ?>>
									<?php echo Yii::t('global', $row->title); ?>
								</span>
								<?php if( $row->value && $row->default_value != $row->value ): ?><span style='color:red;'><?php echo Yii::t('adminsettings', '(Setting Changed)'); ?></span><?php endif; ?>
							</div>
							<div class="span6">
								<?php $this->parseSetting( $row ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td style='text-align:center;'><?php echo Yii::t('adminsetings', 'No Settings Added Yet.'); ?></td>
					</tr>
				<?php endif; ?>
			<?php if( count($cat1) ): ?>
			<div class="footer tar">
				
			</div>
			<?php endif; ?>
			
		</div>
	</div>                                
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
            <div class="isw-settings"></div>
            <h1><?php echo Yii::t('global', 'Settings Shipping Clause')?></h1>
        </div>
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global','Shipping fee Inside') ?></div>
                <div class="span9">
                    <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'name' => 'shipping_fee_inside', 'value' => $shipping_clause->shipping_fee_clause_inside, 'editorTemplate' => 'full' )); ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global','Shipping fee Outside') ?></div>
                <div class="span9">
                    <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'name' => 'shipping_fee_outside', 'value' => $shipping_clause->shipping_fee_clause_outside, 'editorTemplate' => 'full' )); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Save'), array( 'name' => 'submit', 'class'=>'btn')); ?>

<?php echo CHtml::endForm(); ?>