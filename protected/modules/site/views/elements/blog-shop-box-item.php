<div class="folder-news">
    <?php if($data->image != null){ ?>
    <div class="left-fnews">
        <a class="aImg130" href="/blogshop/blog/<?php echo $this->membershop->id .'/'.$data->id?>">
            <img class="img-subject" <?php echo 'src="/uploads/blogshop/'.$data->image.'"'?>/>
            <div class="frame130_120 png"></div>
        </a>
    </div>
    <?php } ?>
    <div class="right-fnews">
        <h5 class="h2Title-14">
           <a class="link-title14" href="/blogshop/blog/<?php echo $this->membershop->id . '/'.  $data->id?>">
           <?php echo $data->title ?> </a>
        </h5>
        <p class="pDateTime">                        
            <?php echo $data->created_blog;?>
        </p>
        <h3 class="h3Lead">
            <?php echo $data->description; ?>                  
        </h3>
    </div>                                                
</div>