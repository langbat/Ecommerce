
<div class="wrapper-active">
    <div class="span2 product-content fix-content  <?php echo ($index%4 == 3)?' last-column':''?>">
        <div class="product-image">
            <a href="/shop/detail/<?php echo $data->id?>"><img class="product" <?php echo 'src="/uploads/logoshop/'.$data->image.'"'?> alt="<?php echo $data->name?>" /></a>
        </div>
        <p class="fix-title"><a href="/shop/detail/<?php echo $data->id?>"><?php echo $data->name?></a></p>
        <p class="nur"><span class="big"><?php echo $data->slogan?> </span></p>
        <div class="clearfix"></div>
        <a href="/shop/detail/<?php echo $data->id?>" data-id="<?php echo $data->id?>" class="btn-kaufen"><?php echo Yii::t('global', 'Detail')?></a>
        <p class="nur">
        <ul style="list-style: none; ">
        <li>
    <span class="rating_new_shop"><?php 
        $this->widget('ext.dzRaty.DzRaty', array(
            'name' => 'my_rating_shop_id_'.$data->id,
            'value' => ShopRatings::model()->getRatingShop($data->id),
            'options' => array(
                    'half' => TRUE,
                    	'click' => "js:function(score, evt){ shop_ratings(score,".$data->id.") }",

            ),
            'htmlOptions' => array(
            'class' => 'new-half-class'
            ),
        ));
        $this->renderPartial('../elements/rate_product');
      ?>
    <div class="count-rating">( <?php ShopRatings::model()->totalRatingShop( $data->id ); ?> )</div></span>
        </li></ul>
        </p>
    </div>

</div>
