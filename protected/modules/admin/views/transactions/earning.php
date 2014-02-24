<div class="page-header">
	<h1>View <small>Earnings</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-users"></div>
			<h1><?php echo Yii::t('transactions', 'Earnings'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h1>                     
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
						<th style='width: 5%;'>#</th>			
					   <th style='width: 20%;'><?php echo $sort->link('created', Yii::t('transactions', 'Date'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by date') ) ); ?>Date</th>
					   <th style='width: 20%;'><?php echo $sort->link('user_id', Yii::t('transactions', 'User'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by user') ) ); ?>User</th>
					   <th style='width: 40%;'><?php echo Yii::t('transactions', 'Details');?></th>
					   <th style='width: 15%;'><?php echo $sort->link('amount', Yii::t('transactions', 'Amount'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by amount') ) ); ?>Amount</th>
					</tr>
				</thead>
			
				<tbody>
					<?php if ( count($rows) ): $i=1; ?>
						<?php foreach ($rows as $row): ?>
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td><?php echo $row->created; ?></td>
								<td><a target="_blank" href="<?php echo $this->createUrl('/'.$row->user->id.'-'.$row->user->seoname, array( 'lang' => false )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'View this user'); ?>"><?php echo $row->user->getDisplayName(); ?></td>
								<td><?php echo str_replace("your ", "", $row->options); ?></td>
								<td align="center"><?php echo $row->amount; ?> USD</td>
							</tr>
						<?php $i++; endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan='5' style='text-align:center;'><?php echo Yii::t('transactions', 'No item found.'); ?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="footer tar">
            </div>
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>                                
</div>

<?php $this->widget('widgets.MyPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>
