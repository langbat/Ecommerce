<div class="top_ct fix-size-img">

    <div id="gallery">
        <div id="slides">
            <div class="slide">
                <img <?php echo 'src="/uploads/product/'.$product->image.'"'?>  stalt="<?php echo $product->name?>"   />
            </div>
            <?php $images = ProductGalleries::model()->findAllByAttributes(array('product_id' => $product->id));
            if ($images)
                foreach ($images as $image){
                    echo ' <div class="slide"> <img   src="/uploads/product_gallery/'.$image->filename.'"/> </div>';
                }
            ?>
        </div>
        <div id="menu">
            <div id="myCarousel" class="carousel slide fix-carousel">
                <ul class="itemSmall carousel-inner">
                    <div class="carousel-inner ">
                        <span class="item active">
                            <li class="sliderItem menuItem ">
                                <a href=""><img <?php echo 'src="/uploads/product/'.$product->image.'"' ?>  alt="thumbnail" /></a>
                            </li>
                        <?php $images = ProductGalleries::model()->findAllByAttributes(array('product_id' => $product->id ));
                        if ($images)
                            foreach ($images as $key=>$image){
                              if($key == 3){
                                  echo '</span><span class="item">';
                                  for($i=$key-3; $i<=$key-1;$i++){
                                      echo '<span class="menuItem"></span>';
                                  }
                                  echo ' <li  class=" sliderItem menuItem"><a href=""><img  src="/uploads/product_gallery/'.$image->filename.'" alt="thumbnail" /></a></li>';
                              } else {
                                    echo ' <li  class="  sliderItem menuItem"><a href=""><img  src="/uploads/product_gallery/'.$image->filename.'" alt="thumbnail" /></a></li>';
                              }
                            }
                        ?>
                        </span>
                    </div>
                </ul>
                <?php $total = count($images);
                      if( $total > 3 ){
                 ?>
                <a class="carousel-control left fix-btn-slide" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right fix-btn-slide" href="#myCarousel" data-slide="next">&rsaquo;</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="in_sp">
        <p class="sp_left"><?php echo Yii::t('global','Click on each picture for bigger displaying.');   ?></p>
        <a href="#description" class="sp_right"><?php  echo Yii::t('global','Go to description'); ?></a>
    </div>
    <div class="clearfix"></div>
</div>