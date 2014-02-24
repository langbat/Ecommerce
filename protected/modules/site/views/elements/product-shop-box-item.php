<div class="product">
    <div class="infor-product-name-link">
        <a href="/productsshop/detail/<?php echo $this->membershop->id ?>/<?php echo $data->id; ?>" ><?php echo $data->name; ?></a> 
    </div>
    <a href="/productsshop/detail/<?php echo $this->membershop->id ?>/<?php echo $data->id?>">
        <?php if($data->image != null){ ?>
            <img <?php echo 'src="/uploads/product_shop/'.$data->image.'"'?> alt="<?php echo $data->name; ?>"/>
        <?php }else{ ?>
            <img <?php echo 'src="/uploads/product_shop/no-images.jpg"'?>/>
        <?php } ?>
    </a>
    <div class="pr-info">
        <span class="rating-shop"><?php 
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
          ?>
         </span>
         <span class='rating-total'>( <?php Ratings::model()->totalRating( $data->id, 1 ); ?> )  </span>
        <p class="infor-staff">statt: <span class="infor-price-staff-product"> <?php echo Utils::number_format($data->price)?> €</span></p>
        <span class="pr-price"><span>€</span><?php echo Utils::number_format($data->direct_buy_price)?><sup></sup></span>
    </div>
</div>