<div class="span12">

	<h1><?php echo Yii::t('usermessages', 'Messages'); ?></h1>
	
	<p>
		<input type="checkbox" id="msg_inbox" value="1" checked="checked"/><label for="msg_inbox">Show only inbox messages</label>
		<input type="checkbox" id="msg_read" value="1" checked="checked"/><label for="msg_read">Show only unread messages</label>
	</p>
	<table cellspacing="0" cellpadding="0" style="width:100%" class="table adslist">
		<tbody>
			<tr>
				<th width="15%"><?php echo Yii::t('usermessages', 'From'); ?></th>
				<th width="15%"><?php echo Yii::t('usermessages', 'To'); ?></th>
				<th width="30%"><?php echo Yii::t('usermessages', 'Subject'); ?></th>
				<th width="30%"><?php echo Yii::t('usermessages', 'Message'); ?></th>
				<th width="10%"><?php //echo $sort->link('created', Yii::t('usermessages', 'Created'), array( 'class' => 'tooltip', 'title' => Yii::t('usermessages', 'Sort messages by date') ) ); ?><?php echo Yii::t('usermessages', 'Created'); ?></th>		
			</tr>
			
			<?php if( is_array($rows) && count($rows) ):
				foreach($rows as $row){ ?>
					<tr<?php
						$class = $row->to_user == $my->id ? 'inbox' : 'outbox';
						if($class=='inbox') :
							$class .= $row->read ? ' read' : ' unread';
						endif;
						
						echo ' class="' . $class . '"';
					?>>
						<td align="center"><?php echo CHtml::encode($row->fromuser->username); ?></td>
						<td align="center"><?php echo CHtml::encode($row->touser->username); ?></td>
						<td><a href="<?php echo $this->createUrl('usermessages/viewmessage', array('id'=>$row->id)); ?>" title="<?php echo Yii::t('usermessages', 'View message'); ?>"><?php echo $row->subject; ?></a></td>
						<td><?php
							$message = strip_tags($row->message);
							if(strlen($message) > 50) $message = substr($message, 0, 50) . '...';
							echo $message;
						?></td>
						<td align="center"><?php echo Yii::app()->dateFormatter->formatDateTime($row->created, 'long', 'short'); ?></td>
					</tr>
				<?php //$i++;
				}
			else: ?>
				<tr>
					<td colspan="4" align="center"><?php echo Yii::t('users','There are no message yet'); ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<?php $this->widget('widgets.MyPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>

</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		filtermsg();
		
		$('#msg_inbox, #msg_read').click(function(){
			filtermsg();
		});
		
		function filtermsg()
		{
			if($('#msg_read').is(':checked'))
				{
					$('tr.inbox, tr.outbox').hide();
					$('tr.inbox.unread').show();
				}
				else
				{
					if($('#msg_inbox').is(':checked'))
					{
						$('tr.outbox').hide();
						$('tr.inbox').show();
					}
					else
					{
						$('tr.inbox, tr.outbox').show();
					}
				}
		}
	});
</script>
<?php /*
<td><h4><a href="<?php echo $this->createUrl('usermessages/outbox', array('id'=>$row->id)); ?>" title="<?php echo Yii::t('usermessages', 'View Outbox'); ?>" style="font-size: 20px; font-family: Arial; font-weight: lighter; color:white; background:#666633; padding:5px 40px 5px 40px; float:left;">View Outbox</a></h4></td>
<td><h4><a href="<?php echo $this->createUrl('usermessages/sendmessage', array('id'=>$row->id)); ?>" title="<?php echo Yii::t('usermessages', 'Send New Message'); ?>" style="font-size: 20px; font-family: Arial; font-weight: lighter; color:white; background:#116060; padding:5px 40px 5px 40px; float:left;margin-left: 10px;;">Send New Message</a></h4></td>
*/ ?>