<div class="wrapper-active">
    <div class="span2 product-content fix-content  <?php echo ($index%4 == 3)?' last-column':''?>">
        <div class="product-image">
            <a href="/products/detail/<?php echo $data->id?>"><img class="product" <?php echo 'src="/uploads/product/'.$data->image.'"'?> alt="<?php echo $data->name?>" /></a>
        </div>
        <p class="fix-title"><a href="/products/detail/<?php echo $data->id?>"><?php echo $data->name?></a></p>
        <div class="text_shipping">
            <?php if ($data->shipping_immediately ==1){
                echo "<div class='delivery_im'>".Yii::t('global','Delivery immediately')."</div>";
            } if($data->shipping_cost ==''||$data->shipping_cost =0  ) {
                echo "<div class='delivery_im'>".Yii::t('global','Shipping cost free')."</div>";
            }?>
        </div>
        <div class="clearfix"></div>
            <div class="rating_new_shop">
             <div class="rating-label">
                 <span class="rating_new_shop_label">
                   <?php 
                
                    
                      $this->widget('ext.dzRaty.DzRaty', array(
                            'name' => 'my_rating_field_label_product_'.$data->id,
                            'value' => Ratings::model()->getRating($data->id),
                            'options' => array(
                                    'half' => TRUE,
                                    	'click' => "js:function(score, evt){ ratings(score,".$data->id.") }",
    
                            ),
                            'htmlOptions' => array(
                            'class' => 'new-half-class'
                            ),
                        ));
                        $this->renderPartial('../elements/rate_product');
                    ?></span>
                    <span class="number_rating_category">( <?php Ratings::model()->totalRating( $data->id ); ?> ) </span>
                
            </div>
            </div> 
         <div class="clearfix"></div>
        <a href="/products/detail/<?php echo $data->id?>" data-id="<?php echo $data->id?>" class="btn-kaufen"><?php echo Yii::t('global', 'Buy')?></a>
      
        <p class="nur"><strong><?php echo Yii::t('global', 'only')?> <span class="big"><?php echo Utils::number_format($data->direct_buy_price)?> &euro;</span></strong></p>
        <p class="statt">(<?php echo Yii::t('global', 'instead')?> <?php echo Utils::number_format($data->price)?> &euro;)</p>
    </div>
</div>
