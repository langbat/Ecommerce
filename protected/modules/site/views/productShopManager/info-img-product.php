
    <div class="span12">
     <div class="slider-box purple-grid">
                    <div class="title"><h5><i class="fa fa-picture-o"></i>  <?php echo Yii::t('global','Product images');?></h5></div>
                   <div class="info_profile fix-info-profile scroll-view">
                        <div class="content_rate fix_content_comment">
                        
                        
     
     
        <?php if ($model->id):?>
        <div class="block gallery clearfix">

            <a class="fancybox fix-fancybox" rel="group" <?php echo 'href="/uploads/product_shop/'.$model->image.'"' ?>><img src="/uploads/product_shop/<?php echo $model->image ?>" class="img-polaroid fix-height"/></a>
            <?php
            foreach($images as $image){
                echo '<a class="fancybox fix-fancybox" rel="group" href="/uploads/product_gallery_shop/'.$image->filename.'"><img src="/uploads/product_gallery_shop/'.$image->filename.'" class="img-polaroid fix-height"/></a>';
        }
            endif ?>
    </div>
    </div></div></div></div></div>