<div class="name_product"><?php echo $product->name ?></div>
<div class="rate_product fix-rate">
    <?php
    $this->widget('ext.dzRaty.DzRaty', array(
        'name' => 'my_rating_field_1',
        'value' => Ratings::model()->getRating($product->id),
        'options' => array(
            'half' => TRUE,
            'click' => "js:function(score, evt){ ratings(score,".$product->id.") }",
            'mouseover' => "js:function(score, evt){ $('#score-info').html('Click a star! Current score: '+score); }",
        ),
        'htmlOptions' => array(
            'class' => 'new-half-class'
        ),
    ));
    ?>

    <div class="comment_product">
        <?php echo Yii::t('global','Add comment') ?>
        <input class="product_id_comment" type="hidden" value="<?php echo $product->id ?>"/>
    </div>
</div>
<div class="price_sale">
    <span><?php echo Yii::t('global','Reg.').' €'.Utils::number_format($product->price) ?> </span>
    <span><?php echo Yii::t('global','Was').' €'.Utils::number_format($product->direct_buy_price) ?></span>
    <span class="sale"><?php echo Yii::t('global','Sale').' €'.Utils::number_format($product->price-($product->price * $product->discount_percent)/100)." (€".Utils::number_format(($product->price-($product->price * $product->discount_percent)/100)/$product->value)." / ".$product->units." ) " ?> </span>
    <span class="vat-detail"><?php echo Yii::t('global','VAT tax (%)') ?>: <?php echo Yii::app()->settings->vat_tax; ?> </span>
    <span class="shipping-cost-detail"><?php echo Yii::t('global',"Shipping cost") ?>: <?php echo Utils::number_format($product->shipping_cost); ?>€ </span>
    <div class="shipping_fee"><?php echo Yii::t('global','Shipping fee.') ?> <a href="#" class="description_shipping"> <?php echo Yii::t('global','Detail') ?></a> </div>
     <div class="shipping_fee"><?php echo Yii::t('global','Shipping info.') ?> <a href="#" class="shipping_info"> <?php echo Yii::t('global','Delivery time') ?></a> </div>
</div>
<div class="extra_end_today"><?php echo Yii::t('global','EXTRA {percent}% OFF END TODAY!',array('{percent}'=>$product->discount_percent)) ?>  </div>
<div class="time_detail_countdown time_product">
    <div class="second_total" style="display: none"> <?php echo $checkSchedule['counttime'] ?></div>
    <div class="day time_size">00</div>
    <div class="hours time_size">00</div>
    <div class="minutes time_size">00</div>
    <div class="second time_size">00</div>
</div>
<div class="add_to_cart btn_buy" data-id="<?php echo $product->id?>"><span><?php echo Yii::t('global','ADD TO CART') ?></span></div>
<div class="free_shipping">
    <span class="freeshiping"><?php echo Yii::t('global',$product->type_shipping) ?></span>
        <span class="available">
            <?php echo Yii::t('global','Available to ship: '); echo Yii::t('global',$product->availble_ship) ?> <br/>
           <?php echo Yii::t('global','Available from pickup : '); echo Yii::t('global',$product->availble_pickup) ?>  <br/>
        </span>
</div>
<div class="view_more_item"> <a href="/"><?php echo Yii::t('global','View more items') ?></a> </div>
<div class="schedule">
    <div class="title"><?php echo Yii::t('global','Schedule') ?></div>
    <?php
       $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$schedule,
        'summaryText'=>'',
        'itemView'=>'../elements/schedule',
    )); ?>
    <div class="last_product_tv go-last-liveShow" >  <span class="text"> <?php echo Yii::t('global','LAST PRODUCT FROM TV') ?></span></div>

</div>
<div class="social">
    <div class="facebook" ><a href="http://www.facebook.com/sharer/sharer.php?u=http://tosello.toasternet-online.de/products/detail/<?php echo $product->id ?>"> <?php echo Yii::t('global','Share on Facebook')?></a></div>
    <div class="tweeter" ><a href="http://twitter.com/share?url=http://tosello.toasternet-online.de/products/detail/<?php echo $product->id ?>"><?php echo Yii::t('global','Tweet it!')?></a></div>
</div>