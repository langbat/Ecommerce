<div class="wrapper-active">
    <div class="span2 product-content fix-content  <?php echo ($index%4 == 3)?' last-column':''?>">
        <div class="product-image">
             <a href="/productsshop/detail/<?php echo $data->shop_id ?>/<?php echo $data->id?>">
        <?php if($data->image != null){ ?>
            <img <?php echo 'src="/uploads/product_shop/'.$data->image.'"'?> alt="<?php echo $data->name; ?>"/>
        <?php }else{ ?>
            <img <?php echo 'src="/uploads/product_shop/no-images.jpg"'?>/>
        <?php } ?>
    </a>
        </div>
        <p class="fix-title"><a href="/products/detail/<?php echo $data->id?>"><?php echo $data->name?></a></p>
        <div class="clearfix"></div>
            <div class="rating_new_shop">
             <div class="rating-label">
                 <span class="rating_new_shop_label">
                   <?php 
                      $this->widget('ext.dzRaty.DzRaty', array(
                        'name' => 'my_rating_product_id_'.$data->id,
                        'value' => Ratings::model()->getRating($data->id, 1 ),
                        'options' => array(
                                'half' => TRUE,
                                	'click' => "js:function(score, evt){ ratings(score,".$data->id.",1) }",
                        ),
                        'htmlOptions' => array(
                        'class' => 'new-half-class'
                        ),
                    ));
                    $this->renderPartial('../elements/rate_product');
                    ?></span>
                    <span class="number_rating_category">( <?php Ratings::model()->totalRating( $data->id, 1); ?> ) </span>
                
            </div>
            </div> 
         <div class="clearfix"></div>
        <a href="/productsshop/detail/<?php echo $data->shop_id ?>/<?php echo $data->id?>" data-id="<?php echo $data->id?>" class="btn-kaufen"><?php echo Yii::t('global', 'Buy')?></a>
      
        <p class="nur"><strong><?php echo Yii::t('global', 'only')?> <span class="big"><?php echo Utils::number_format($data->direct_buy_price)?> &euro;</span></strong></p>
        <p class="statt">(<?php echo Yii::t('global', 'instead')?> <?php echo Utils::number_format($data->price)?> &euro;)</p>
    </div>
</div>

