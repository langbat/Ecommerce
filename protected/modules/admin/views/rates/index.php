
<div class="page-header">
	<h1>Commission <small>Rates</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<?php echo CHtml::form(); ?>

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-settings"></div>
			<h1>Commission Rates</h1>                   
		</div>
		<div class="block-fluid">
			
				<?php if( count($rates) ): ?>
					<?php foreach ($rates as $row): ?>
						<div class="row-form clearfix">
							<div class="span3">
								<span<?php if( CHtml::encode($row->desc) ): ?> class="tipb" data-original-title='<?php echo CHtml::encode($row->desc); ?>'<?php endif; ?>>
									<?php echo CHtml::encode($row->name); ?>
								</span>
							</div>
							<div class="span7">
								<input class="text-input medium-input" name="rates[<?php echo $row->id; ?>]" value="<?php echo $row->rate; ?>"/>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td style='text-align:center;'><?php echo Yii::t('adminsetings', 'No item found.'); ?></td>
					</tr>
				<?php endif; ?>
			<?php if( count($rates) ): ?>
			<div class="footer tar">
				<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Save'), array( 'name' => 'submit', 'class'=>'btn')); ?>
			</div>
			<?php endif; ?>
			
		</div>
	</div>                                
</div>

<?php echo CHtml::endForm(); ?>