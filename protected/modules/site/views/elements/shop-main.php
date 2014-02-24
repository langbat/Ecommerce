<?php 
    $ProductShop = MemberShop::model()->with('productsShops')->findByAttributes( array( 'is_special'=> 1, 'delFlag'=> 0 ), array( 'order' => 'id DESC', 'limit' => 1 ) );
?>      
<div class="row-fluid wrap_shop">
                            <div class="blue"><?php echo Yii::t('global','Shop this week'); ?></div> 
                            <div class="row-fluid shop_dewoche">
                                <div class="span3">
                                    <a href="/shop/detail/<?php echo $ProductShop->id; ?>"><img src="/uploads/logoshop/<?php echo $ProductShop->image; ?>" alt="<?php echo $ProductShop->name; ?>" title="<?php echo $ProductShop->name; ?>" /></a>
                                </div>
                                <div class="span6">
                                    <h4><a href="/shop/detail/<?php echo $ProductShop->id; ?>"><?php echo $ProductShop->name; ?></a></h4>
                                    <div class="text-info">
                                         <?php echo $ProductShop->description; ?>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="row img_right">
                                        <div class="row-fluid show_img_shop">
                                             <?php  
                                                $productviews = ProductsShop::model()->GetProductByShop( $ProductShop->id, 6);
                                                if( isset( $productviews ) ){
                                                foreach ( $productviews as $productview ){
                                            ?>
                                            <div class="span4">
                                                <a href="/productsshop/detail/<?php echo $ProductShop->id; ?>/<?php echo $productview->id; ?>"><img src="/uploads/product_shop/<?php echo $productview->image; ?>" alt="<?php echo $productview->name; ?>" title="<?php echo $productview->name; ?>" /></a>
                                            </div>
                                            <?php 
                                                    }
                                             } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>