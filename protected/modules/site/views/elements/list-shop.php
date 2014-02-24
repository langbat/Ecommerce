<div class="span2 product-content fix-content">
        <div class="product-image">
            <a href="/shop/detail/<?php echo $item->id?>"><img class="product" <?php echo 'src="/uploads/logoshop/'.$item->image.'"'?> alt="<?php echo $item->name?>" /></a>
        </div>
        <p class="fix-title"><a href="/shop/detail/<?php echo $item->id?>"><?php echo $item->name?></a></p>
        <p class="nur"><span class="big"><?php echo $item->slogan?> </span></p>
        <div class="clearfix"></div>
        <a href="/shop/detail/<?php echo $item->id?>" data-id="<?php echo $item->id?>" class="btn-kaufen"><?php echo Yii::t('global', 'Detail')?></a>
        <p class="nur">
        <ul style="list-style: none; ">
        <li>

    <span class="rating_new_shop"><?php 
        $this->widget('ext.dzRaty.DzRaty', array(
            'name' => 'my_rating_shop_id_'.$item->id,
            'value' => ShopRatings::model()->getRatingShop($item->id),
            'options' => array(
                    'half' => TRUE,
                    	'click' => "js:function(score, evt){ shop_ratings(score,".$item->id.") }",

            ),
            'htmlOptions' => array(
            'class' => 'new-half-class'
            ),
        ));
        $this->renderPartial('../elements/rate_product');
      ?>
    <div class="count-rating" id="number_rating">( <?php ShopRatings::model()->totalRatingShop( $item->id ); ?> )</div></span>
        </li></ul>
        </p>
        <p><?php echo $countproduct['totals']. ' ' .Yii::t('global','Product'); ?></p>
    </div>