<?php $bidtime = date("G:i",strtotime($data->start_time)); ?>
<?php $bidday = date("F j",strtotime($data->start_time)); ?>
<!--date("F j, Y, g:i a");  -->
<li><span class="activedate"><b><?php echo $bidday; ?></b><?php echo $bidtime; ?></span> <a href="/auctions/detail/<?php echo $data->id;?>"><?php echo $data->product->name; ?></a></li>