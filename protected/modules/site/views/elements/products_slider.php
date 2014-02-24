<?php
$product = ProductsShop::getProductShopByIdShop($_GET['shop_id']);
$totalProduct = count($product);
$i = 1;
if( isset($product) && ($totalProduct > 0)){ ?>
<div class="row-fluid">
    <div class="blue"><?php echo Yii::t('global','Recommend for you'); ?></div>
    <div class="content-block">
        <div id="EmpfeCarousel" class="carousel slide"> 
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="active item">
                    <ul class="thumbnails">
                       <?php foreach( $product as $recommendProduct ){?>
                        <li>
                            <a href="/productsshop/detail/<?php echo $this->membershop->id; ?>/<?php echo $recommendProduct['id']; ?>">
                                <?php if($recommendProduct['image'] != null){ ?>
                                    <img src="/uploads/product_shop/<?php echo $recommendProduct['image']; ?>" alt="<?php echo $recommendProduct['name']; ?>" />
                                <?php }else{ ?>
                                    <img src="/uploads/product_shop/no-images.jpg" />
                                <?php } ?>
                            </a>
                            <a href="/productsshop/detail/<?php echo $this->membershop->id; ?>/<?php echo $recommendProduct['id']; ?>">
                            <?php echo $recommendProduct['name']; ?></a>
                            <div class="info"><b><?php echo Utils::number_format($recommendProduct['direct_buy_price']); ?> €</b></div>
                            <a href="/productsshop/detail/<?php echo $this->membershop->id; ?>/<?php echo $recommendProduct['id']; ?>"><button class="btn btn-success" type="button"><?php echo Yii::t('global','Go to product'); ?></button></a>
                            <div class="clearfix"></div>
                        </li>
                        <?php if( $i % 5 == 0 && $i != $totalProduct ){ ?>
                    </ul>
                </div>  
                <div class="item">
                    <ul class="thumbnails">
                       <?php } $i++;  } ?>
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
<?php } ?>