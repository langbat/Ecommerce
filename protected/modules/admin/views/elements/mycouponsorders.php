<?php $ordertime = date("G:i",strtotime($data->Orders->created)); ?>
<?php $orderday = date("F j",strtotime($data->Orders->created)); ?>
<?php if(isset($data->Coupons->id))
    { ?>
    <tr>
    	<td><span class="date"><?php echo $orderday; ?> </span><span class="time"><?php echo $ordertime; ?></span></td>
    	<td><a href="#"><?php echo $data->Coupons->title ; ?></a></td>
        <td><?php echo Lookup::item('OrderItemType', $data->type); ?></td>
	</tr>
   <?php }
   
?>
