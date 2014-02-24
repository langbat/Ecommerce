<div class="span12">

	<h1><?php echo Yii::t('transactions', 'Earning'); ?></h1>

	<div class="row-fluid clearfix">
		<div class="span9">
			<p><?php echo Yii::t('transactions', 'Your total earning'); ?>: <?php echo $myearning; ?> USD</p>
			<p><?php echo Yii::t('transactions', 'Cashout'); ?>: <?php echo -$mycashout; ?> USD</p>
			<p><?php echo Yii::t('transactions', 'Your curent balance'); ?>: <?php echo $mybalance; ?> USD</p>
		</div>
		<div class="span3" style="text-align:right;">
			<?php if($cancashout) : ?>
				<input value="Request Cashout" type="submit" class="btn-submit" onclick="do_cashout();" />
				<script type="text/javascript">
					function do_cashout()
					{
						window.location.href="<?php echo $this->createUrl('transactions/cashout'); ?>";
					}
				</script>
			<?php else : ?>
				---
			<?php endif; ?>
		</div>
	</div>

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
						<td align="center"><?php echo $row->amount; ?> USD</td>
						<td align="center"><?php echo $row->paymentstatus == 2 ? 'Completed' : 'Pendding'; ?></td>
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