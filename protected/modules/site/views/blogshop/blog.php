<div class="content" id="blogdetail">
    <div >
        <h3 class="blog_des" ><?php echo $blogshopdetail->title;  ?></h3>
    </div>
    <span id="time-blog-detail" >
         <?php echo Yii::app()->dateFormatter->formatDateTime($blogshopdetail->created_blog );?>
    </span>
    <div >
        <h5 class="blog_des" ><?php echo $blogshopdetail->description;  ?></h5>
    </div>
    <div class="blogdetail">
        <?php echo $blogshopdetail->content; ?>
    </div>
    <?php 
    if(count($allblog) > 1){ ?>
    <div class="recommen-blog">
        <?php echo Yii::t('global', 'Blog recommend for you.')?>
    </div>
    <ul class="li-recommend">
    
    <?php 
    $compare = $blogshopdetail->id;
    $temp = count($allblog);
    for($i = 0; $i < $temp; $i++){
        if($allblog[$i]['id'] != $compare){?>
            <li><a href="/blogshop/blog/<?php echo $allblog[$i]['shop_id'].'/'.$allblog[$i]['id']?>"><?php echo $allblog[$i]['title']; ?></a></li>
        <?php }
    }
     ?>
    </ul>
    <?php } ?>
</div>
