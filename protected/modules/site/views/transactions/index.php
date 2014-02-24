<div class="span12">

	<h1><?php echo Yii::t('transactions', 'Invoices'); ?></h1>

	<table cellspacing="0" cellpadding="0" style="width:100%" class="table adslist">
		<tbody>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Detail</th>
				<th>Amount</th>
				<th>Status</th>
			</tr>
			
			<?php if( is_array($rows) && count($rows) ):
				$i = 1;
				foreach($rows as $row){ ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row->created; ?></td>
						<td><?php echo $row->options; ?></td>
						<td align="center"><?php echo -$row->amount; ?> USD</td>
						<td align="center"><?php echo $row->paymentstatus == 2 ? 'Completed' : ($row->paymentstatus == 1 ? 'Pendding' : 'Cancelled'); ?></td>
					</tr>
				<?php $i++;
				}
			else: ?>
				<tr>
					<td colspan="5" align="center"><?php echo Yii::t('transactions','No item.'); ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<?php $this->widget('widgets.MyPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>

</div>