    <div class="row-fluid">
                            <div class="orange"><?php echo Yii::t('global','Recommend for you'); ?></div>
                            <div class="content-block">
                                <div id="EmpfeCarousel" class="carousel slide"> 
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                    <?php 
                                        $recommendProducts   = Products::model()->getProductRecommend(15);
                                        $totalProduct        = count($recommendProducts);
                                        $i                   = 1;
                                    ?>
                                    
                                        <div class="active item">
                                            <ul class="thumbnails">
                                               <?php foreach( $recommendProducts as $recommendProduct ){ ?>
                                                <li>
                                                    <a href="/products/detail/<?php echo $recommendProduct['id']; ?>"><img src="/uploads/product/<?php echo $recommendProduct['image']; ?>" alt="<?php echo $recommendProduct['name']; ?>" /></a>
                                                    <a href="/products/detail/<?php echo $recommendProduct['id']; ?>"><?php echo $recommendProduct['name']; ?></a>
                                                    <div class="info"><b><?php echo Utils::number_format($recommendProduct['price'] - ($recommendProduct['price'] * $recommendProduct['discount_percent'])/100); //Utils::number_format($recommendProduct['price']); ?> €</b></div>
                                                    <a href="/products/detail/<?php echo $recommendProduct['id']; ?>"><button class="btn btn-success" type="button"><?php echo Yii::t('global','Go to product'); ?></button></a>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <?php 
                                                 if( $i % 5 == 0 && $i != $totalProduct ){ ?>
                                                    </ul>
                                                    </div>  
                                                    <div class="item">
                                                   <ul class="thumbnails">
                                               <?php } 
                                                 $i++; 
                                                 } ?>
                                            </ul>
                                        </div>
                                 
                                 
                                    </div>
                                    <?php if( $totalProduct > 5 ){ ?>
                                    <a class="carousel-control left" href="#EmpfeCarousel" data-slide="prev">&lsaquo;</a>
                                    <a class="carousel-control right" href="#EmpfeCarousel" data-slide="next">&rsaquo;</a>
                                    <?php } ?>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
                        </div>