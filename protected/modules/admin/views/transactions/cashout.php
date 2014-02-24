<div class="page-header">
	<h1>Manage <small>Cashout</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-users"></div>
			<h1><?php echo Yii::t('transactions', 'Cashout'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h1>                     
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
						<th style='width: 5%;'>#</th>			
					   <th style='width: 15%;'><?php echo $sort->link('created', Yii::t('transactions', 'Date'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by date') ) ); ?>Date</th>
					   <th style='width: 15%;'><?php echo $sort->link('user_id', Yii::t('transactions', 'User'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by user') ) ); ?>User</th>
					   <th style='width: 35%;'><?php echo Yii::t('transactions', 'Details');?></th>
					   <th style='width: 10%;'><?php echo $sort->link('amount', Yii::t('transactions', 'Amount'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by amount') ) ); ?>Amount</th>
					   <th style='width: 10%;'><?php echo $sort->link('paymentstatus', Yii::t('transactions', 'Status'), array( 'class' => 'tooltip', 'title' => Yii::t('transactions', 'Sort list by status') ) ); ?>Status</th>
					   <th style='width: 10%;'><?php echo Yii::t('transactions', 'Options'); ?></th>						
					</tr>
				</thead>
			
				<tbody>
					<?php if ( count($rows) ): $i=1; ?>
						<?php foreach ($rows as $row): ?>
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td><?php echo $row->created; ?></td>
								<td><a target="_blank" href="<?php echo $this->createUrl('/'.$row->user->id.'-'.$row->user->seoname, array( 'lang' => false )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'View this user'); ?>"><?php echo $row->user->getDisplayName(); ?></td>
								<td><?php echo $row->options; ?></td>
								<td align="center"><?php echo -$row->amount; ?> USD</td>
								<td align="center"><?php echo $row->paymentstatus == 2 ? 'Completed' : ($row->paymentstatus == 1 ? 'Pendding' : 'Cancelled'); ?></td>
								<td>
									<?php if($row->paymentstatus == 1): ?>
										<a href="<?php echo $this->createUrl('transactions/approvecashout', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Approve this cashout'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Approve" /></a>
										<a href="<?php echo $this->createUrl('transactions/cancelcashout', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Cancel this cashout'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/cross.png" alt="Cancel" /></a>
									<?php endif; ?>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan='7' style='text-align:center;'><?php echo Yii::t('transactions', 'No item found.'); ?></td>
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
