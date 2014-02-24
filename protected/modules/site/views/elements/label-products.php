  <div class="row-fluid">
        <div class="title-block"><?php echo Yii::t('global','Our top labels'); ?></div>
        <div class="content-block">
            <div id="logoCarousel" class="carousel slide"> 
                <!-- Carousel items -->
                <div class="carousel-inner">
                <?php 
                    $labelProducts  = ProductLabels::getProductLabel();
                    $totalLabel     = count($labelProducts);
                    $i              = 1;
                ?>
                     <div class="active item">
                        <ul class="thumbnails">
                         <?php foreach ( $labelProducts as $labelProduct ){ ?>
                            <li><a href="/products/label/<?php echo  $labelProduct['id']; ?>"><img src="/uploads/label/<?php echo $labelProduct['image']; ?>" alt="<?php echo $labelProduct['name']; ?>" style="height: 135px !important;"/></a></li>
                         <?php 
                         if( $i % 3 == 0 && $i != $totalLabel ){ ?>
                            </ul>
                            </div>  
                            <div class="item">
                           <ul class="thumbnails">    
                         <?php }
                         
                         $i++; } ?>
                        </ul>
                    </div>
                    
                </div>  
            </div> 
            <div class="clearfix"></div>
        </div>
  </div>