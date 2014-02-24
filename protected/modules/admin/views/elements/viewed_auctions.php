<div class="item clearfix">
	<div class="image"><a href="/auctions/detail/<?php echo $data->id; ?>"><img class="product" <?php echo 'src="/uploads/product/'.$data->auction->product->image.'"'; ?> alt="<?php echo $data->auction->product->name; ?>" width="32" /></a></div>
    
	<div class="info">
        <a href="/auctions/detail/<?php echo $data->auction->id;?>" class="name"><?php echo $data->auction->product->name?></a>                              
		<span></span>
		<div class="controls">                    
            <a href="<?php echo $this->createUrl('/admin/auctionviews/delete',array('id'=>$data->id, 'returnUrl'=>$_SERVER['REQUEST_URI'])); ?>" class="icon-remove" ></a>
       	</div>                                      
	</div>                                
</div>  