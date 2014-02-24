<div class="page-header">
	<h1>Viewing <small>User Message</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo Yii::t('usermessages', 'Message "{subject}" ', array( '{subject}' => $usermessage->subject )); ?></strong> (<?php echo Yii::t('usermessages', 'From : '); ?><?php echo CHtml::encode($usermessage->fromuser->username); ?>&nbsp;&nbsp; <?php echo Yii::t('usermessages', '   To : '); ?><?php echo CHtml::encode($usermessage->touser->username); ?>) (<?php echo Yii::t('usermessage', 'Message at : '); ?><?php echo Yii::app()->dateFormatter->formatDateTime($usermessage->created); ?>)</h1>
   
		</div>
		<div class="block-fluid">
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
						<th><?php echo CHtml::encode($usermessage->message); ?></th>
					</tr>
				</thead>
			</table>
			
		</div>
	</div>                                
</div>


