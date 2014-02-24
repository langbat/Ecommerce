<!-- Begin Slider -->
<div id="products">
<?php 
if(($this ->productshop) != ""){
foreach ($this->productshop as $item){?>
	         
            <div class="product">
              <div class="infor-product-name-link"> <a href="/productsshop/detail/<?php echo $membershop['id'] ?>/<?php echo $item['id']?>" >
              <?php echo $item['name']?></a> </div>
            <a href="/productsshop/detail/<?php echo $membershop['id'] ?>/<?php echo $item['id']?>"><img <?php echo 'src="/uploads/product_shop/'.$item['image'].'"'?> alt="<?php echo $item['name']?>"/></a>
            
            <div class="pr-info">
            <span class="rating-shop"><?php 
                $this->widget('ext.dzRaty.DzRaty', array(
                    'name' => 'product_id_'.$item['id'],
                    'value' => Ratings::model()->getRating($item['id'], 1 ),
                    'options' => array(
                            'half' => TRUE,
                            	'click' => "js:function(score, evt){ ratings(score,".$item['id'].",1) }",
                    ),
                    'htmlOptions' => array(
                    'class' => 'new-half-class'
                    ),
                ));
                $this->renderPartial('../elements/rate_product');
              ?>
             </span> <span class='rating-total'>( <?php Ratings::model()->totalRating( $item['id'], 1 ); ?> )  </span>
            <p class="infor-staff">statt: <span class="infor-price-staff-product"> <?php echo Utils::number_format($item['direct_buy_price'])?> €</span></p>
            <span class="pr-price"><span>€</span><?php echo Utils::number_format($item['price'])?><sup></sup></span>
            </div>
            </div>				
			<!-- End Post -->
            <?php }}else{?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo Yii::t('global', 'No Product')?>
    </div>
 
   <?php 
}?>
   </div>
