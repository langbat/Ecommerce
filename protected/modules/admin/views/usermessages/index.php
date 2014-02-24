<div class="page-header">
	<h1>Manage <small>User Message</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo Yii::t('adminusermessages', 'User Messages'); ?>(<?php echo Yii::app()->format->number($count); ?>)</h1>
			<ul class="buttons">
			
			</ul>                        
		</div>
		<div class="block-fluid">

			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
								
					   <th style='width: 20%;'><?php echo $sort->link('from_user', Yii::t('adminusermessages', 'From User'), array( 'class' => 'tooltip', 'title' => Yii::t('adminusermessages', 'Sort user list by From User') ) ); ?>From User</th>
					   <th style='width: 25%;'><?php echo $sort->link('to_user', Yii::t('adminusermessages', 'To User'), array( 'class' => 'tooltip', 'title' => Yii::t('adminusermessages', 'Sort user list by To User') ) ); ?>To User</th>
					   <th style='width: 10%;'><?php echo $sort->link('subject', Yii::t('adminusermessages', 'Subject'), array( 'class' => 'tooltip', 'title' => Yii::t('adminusermessages', 'Sort user list by Subject') ) ); ?>Subject</th>
					   <th style='width: 20%;'><?php echo $sort->link('created', Yii::t('adminusermessages', 'Created'), array( 'class' => 'tooltip', 'title' => Yii::t('adminusermessages', 'Sort user list by Created Date') ) ); ?>Created Date</th>
					</tr>
				</thead>
				<tbody>
					<?php if ( count($rows) ): ?>
						<?php foreach ($rows as $row): ?>
							<tr>
										
								<td><?php echo CHtml::encode($row->fromuser->username); ?></td>
								<td><?php echo CHtml::encode($row->touser->username); ?></td>
                                <td><a href="<?php echo $this->createUrl('usermessages/viewmessage', array('id'=>$row->id)); ?>" title="<?php echo Yii::t('usermessages', 'View file'); ?>"><?php echo $row->subject; ?></a></td>
								<td class="tipb"><span><?php echo Yii::app()->dateFormatter->formatDateTime($row->created, 'short', 'short'); ?></span></td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>	
						<tr>
							<td colspan='7' style='text-align:center;'><?php echo Yii::t('adminusermessages', 'No message found.'); ?></td>
						</tr>
					<?php endif; ?>                               
				</tbody>
			</table>
			
		</div>
	</div>                                
</div>

<?php $this->widget('widgets.MyADPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>