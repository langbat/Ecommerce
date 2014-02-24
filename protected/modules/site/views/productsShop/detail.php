<script type="text/javascript" src="/themes/default/js/jquery.elevatezoom.js"></script>
<div id="myModal2" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Confirm message')?> </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php echo Yii::t('global','Product will be put in Shopping cart ')  ?>
            <div class="bnt_confirm">
                <button class="btn btn-warning agree_shop" type="button" id="btn-sgree"> <?php echo Yii::t('global','Yes')  ?></button>
                <button class="btn eject" type="button eject"> <?php echo Yii::t('global','No')  ?></button>
            </div>
        </p>
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
</div>

<div class="content" >
    <div class="row-fluid">
        <div id="wrapper_drop">
            <ul id="nav_drop">
               <li><a href="/shop/detail/<?php echo $this->membershop->id ?>">Home > </a></li> 
               <li><a href="/shop/category/<?php echo $this->membershop->id . '/'. $namecategory[0]['id'];?>"><?php echo $namecategory[0]['name'] ?></a>
                    <ul>
                    <?php foreach( $finalCategory as $item){ ?>
                        <li><a href="/shop/category/<?php echo $this->membershop->id . '/'. $item['id'];?> "><?php echo $item['name']; ?></a></li>
                    <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
      <div class="picture_detail">
            <?php if($productshopdetail[0]['image'] != null){?>
                <div class="img_large">
                    <img id="img_01" src="/uploads/product_shop/<?php echo $productshopdetail[0]['image']; ?>" data-zoom-image="/uploads/product_shop/<?php echo $productshopdetail[0]['image']; ?>" style="width: 360px;"/>
                </div>
            <?php }else{ ?>
                <div class="img_large add_attribute">
                    <img id="img_01"  src="/uploads/product_shop/no-images.jpg" alt="" />
                </div>
            <?php } ?>
            <div id="gallery_01" class="img_small"> 
              <?php
               if(count($productshopdetail) > 1 ){ ?>
                     <a href="#" data-image="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>" data-zoom-image="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>">
                        <img id="img_01" src="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>" />
                     </a>
                  <?php foreach($productshopdetail as $images){ 
                            if( isset( $images['filename'] ) ){ ?>
                          <a href="#" data-image="/uploads/product_gallery_shop/<?php echo $images['filename']; ?>" data-zoom-image="/uploads/product_gallery_shop/<?php echo $images['filename']; ?>">
                            <img id="img_01" src="/uploads/product_gallery_shop/<?php echo $images['filename']; ?>" />
                            </a>
                        
                  <?php   }
                    }
                }
              ?>
              
              
            
            </div>
            
            <script>
            $("#img_01").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active'});

            //pass the images to Fancybox
            $("#img_01").bind("click", function(e) {  
              var ez =   $('#img_01').data('elevateZoom');	
            	$.fancybox(ez.getGalleryList());
              return false;
            });


            </script>
            
            
            <?php /* if($productshopdetail[0]['image'] != null){?>
                <div class="img_large">
                    <img id="large_img" src="/uploads/product_shop/<?php echo $productshopdetail[0]['image']; ?>" data-zoom-image="/uploads/product_shop/<?php echo $productshopdetail[0]['image']; ?>" />
                </div>
            <?php }else{ ?>
                <div class="img_large add_attribute">
                    <img id="large_img"  src="/uploads/product_shop/no-images.jpg" alt="" />
                </div>
            <?php } ?>
            
            <?php
            if(count($productshopdetail) > 1 ){?>
                <div class="img_small">
                    <a class="active" data-zoom-image="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>" data-image="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>" data-id="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>"> <img id="large_img" src="/uploads/product_shop/<?php echo isset($productshopdetail[0]['image'])?$productshopdetail[0]['image']:''; ?>" /></a>
                    <?php foreach($productshopdetail as $images){
                        if( isset( $images['filename'] ) ){
                            echo '<a data-image="/uploads/product_gallery_shop/'.$images['filename'].'" data-zoom-image="/uploads/product_gallery_shop/'.$images['filename'].'" data-id="/uploads/product_gallery_shop/'.$images['filename'].'"> <img id="large_img" src="/uploads/product_gallery_shop/'.$images['filename'].'" /></a>';
                        }
                    }
                    ?>
                </div>
            <?php } */ ?>
        </div>
        <?php if($productshopdetail[0]['image'] != null){?>
            <div class="span7" id="span7-product">
            <?php }else{ ?>
            <div class="span7" id="span7-product_1">
            <?php }?>
            <div class="attributeSection" id="info-product">
                <div class="row">
                    <h4> <?php echo $productshopdetail[0]['name'] ?></h4>
                    <span>
                            <?php 
                                $this->widget('ext.dzRaty.DzRaty', array(
                                    'name' => 'my_rating_product_id_'.$productshopdetail[0]['id'],
                                    'value' => Ratings::model()->getRating($productshopdetail[0]['id'], 1 ),
                                    'options' => array(
                                            'half' => TRUE,
                                            	'click' => "js:function(score, evt){ ratings(score,".$productshopdetail[0]['id'].",1) }",
                
                                    ),
                                    'htmlOptions' => array(
                                    'class' => 'new-half-class'
                                    ),
                                ));
                                $this->renderPartial('../elements/rate_product',array('product_id'=>$productshopdetail[0]['id']));
                              ?>
                        </span>  
                        <span class='rating-total-detail'>( <?php Ratings::model()->totalRating( $productshopdetail[0]['id'], 1 ); ?> )  </span>
                    <div class="category-name"><?php // echo Yii::t('global',"Price") ?>
                        <span class="special-price"><?php echo Utils::number_format($productshopdetail[0]['direct_buy_price']); ?>€</span>
                    </div>
                    <div class="btn_like">
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/<?php echo (Yii::app()->language=='de')?'de_DE':'en_US' ?>/all.js#xfbml=1";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like" data-href="" data-width="45" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                    </div>
                    <div class="category-name"><?php echo Yii::t('global',"statt") ?>: 
                        <span class="pass-price"><?php echo Utils::number_format($productshopdetail[0]['price']); ?>€</span>
                    </div>
                    <div class="category-name-new"><?php echo Yii::t('global',"VAT tax (%)") ?>: 
                        <span class="shipping-fee"> <?php echo Yii::app()->settings->vat_tax; ?> </span>
                        - <?php echo Yii::t('global',"Shipping cost") ?>: 
                        <span class="shipping-fee"> <?php echo Utils::number_format($productshopdetail[0]['shipping_cost']); ?>€ </span>
                    </div>
                    <div class="category-name-new"><?php echo Yii::t('global',"Shipping fee ") ?>:
                        <span class="shipping-fee"><a href="#" class="description_shipping"> <?php echo Yii::t('global','Detail') ?></a> </span>
                    </div>
                    <div class="category-name-new"><?php echo Yii::t('global',"Shipping info ") ?>:
                        <span class="shipping-fee"><a href="#" class="shipping_info"> <?php echo Yii::t('global','Delivery time') ?></a> </span>
                    </div>
                    
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <input class="input-mini qty-pshop" type="text" value="1" name="quantity"/> 
                    <button class="add_to_cart btn_buy_shop btn" data-content="<?php echo $productshopdetail[0]['shop_id'] ?>" data-id="<?php echo $productshopdetail[0]['id']?>" type="button" id="btn-product"><?php echo Yii::t('global', 'ADD TO CART');?></button>
                </div>  
                <div class="pr-info" id="rating-shop-detail">
                        
                    <div class="comment_product" >
                        <?php echo Yii::t('global','Add comment') ?>
                        <input type="hidden" value="<?php echo ProductComments::TYPE_PRODUCT_SHOP ?>" class="type_comment" />
                        <input class="product_id_comment" type="hidden"  value="<?php echo $productshopdetail[0]['id'] ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
            <?php 
                if( $checkScheduleProduct['check'] == 1 ){
                    if(isset($checkScheduleProduct['video'])){
                    ?>
               
                    <div class="title-live-sale"> <?php echo Yii::t('global','Live Sale'); ?> </div>
                             
                <div class="around-product-lastest-new">
                    <div id="live-stream-new">
                    <script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>
                        <a href="/uploads/video/<?php echo $checkScheduleProduct['video']; ?>" class="player" id="huluPlayer"></a>  
                        <script type="text/javascript">
                            $f("huluPlayer", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf", {
                                clip: {
                                    autoPlay: true,
                                    autoBuffering: true
                                },
                                plugins: {
                                    controls: {
                                        all: false,
                                        timeColor: '#980118',
                                        play: true,
                                        mute: true,
                                        volume: true,
                                        fullscreen: true
                                    }
                                }
                            });
                        </script> 
                    </div>
                </div> 
              <?php  } 
              }
           ?>
         
    <div class="row-fluid" id="info_detail">
        <ul class="nav nav-tabs" id="tabs-detail">
            <li class="active"><a href="#beschreibung"><?php echo Yii::t('global','Description');?></a></li>
            <li><a href="#bewertungen"><?php echo Yii::t('global','Reviews');?></a></li>
            <li><a href="#verkauferinfo"><?php echo Yii::t('global','Seller Info');?></a></li> 
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="beschreibung">
                <div class="contact-name-tab">
                    <?php echo $productshopdetail[0]['short_desciption'] ?>
                </div>
            </div>
            
            <div class="tab-pane" id="bewertungen">
                <div class="title_rate"><?php echo Yii::t('global','Rating and Review') ?></div>
                <br />
                <div class="contact-name-tab">
                    <div class="pr-info">
                        <span class="rating-shop-detail"><?php 
                            $this->widget('ext.dzRaty.DzRaty', array(
                                'name' => 'my_rating_productshop_id_'.$productshopdetail[0]['id'],
                                'value' => Ratings::model()->getRating($productshopdetail[0]['id'], 1 ),
                                'options' => array(
                                        'half' => TRUE,
                                        	'click' => "js:function(score, evt){ ratings(score,".$productshopdetail[0]['id'].",1) }",
            
                                ),
                                'htmlOptions' => array(
                                'class' => 'new-half-class'
                                ),
                            ));
                             $this->renderPartial('../elements/rate_product',array('product_id'=>$productshopdetail[0]['id']));
                          ?>
                         </span>
                         <span class='rating-total-detail'>( <?php Ratings::model()->totalRating( $productshopdetail[0]['id'], 1 ); ?> )  </span>
                    </div>
                </div>
                <div class="content_rate fix_content_comment">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'comment-grid',
                        'dataProvider'=>$commentProductShop,
                        'summaryText'=>'',
                        'columns'=>array(
                            array(
                                'name'=>'content',
                                'header'=>false,
                            )
                        ),
                        ));
                    ?>
                </div>
            </div>
            <div class="tab-pane" id="verkauferinfo">
            <?php foreach ($infomembershop as $item){?>
                <div class="contact-name-tab"><h2><?php echo $item['name'] ?></h2>
                    <div><?php echo Yii::t('global', 'Email')?> : <a href="mailto:<?php echo $item['email'] ?>"><?php echo $item['email'] ?></a></div>
                    <div><?php echo Yii::t('global', 'Phone')?> : <?php echo $item['phone'] ?></div>
                    <div><?php echo Yii::t('global', 'Address')?>  : <?php echo $item['address'] ?></div>
                    <div><?php echo Yii::t('global', 'Slogan')?> : <?php echo $item['slogan'] ?></div>
                    <div><?php echo Yii::t('global', 'Description')?> : <?php echo $item['description'] ?></div>
                </div>
            <?php }  ?>
            </div> 
        </div> 
    </div>

</div>

    <div id="descritpionShipping" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="title">
            <h5 ><?php echo Yii::t('global', 'Description Shipping fee')?>
            </h5>
        </div>
        <div class="modal-body">
            <p class="fix_content_modal">
                <?php  $shipping_clause = ShippingClause::model()->findByAttributes(array('alias'=>'shipping_clause')) ;
                echo $shipping_clause->shipping_fee_clause_inside." </br>".$shipping_clause->shipping_fee_clause_outside
                ?>

            </p>

        </div>
        <div class="modal-footer fix-footer-popup">
            <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

    </div>
    
    <div id="shipping_info" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="title">
            <h5 ><?php echo Yii::t('global', 'Delivery time of product')?>
            </h5>
        </div>
        <div class="modal-body">
            <p class="fix_content_modal">
                <?php echo Yii::app()->settings->delivery_time; ?>

            </p>

        </div>
        <div class="modal-footer fix-footer-popup">
            <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

    </div>