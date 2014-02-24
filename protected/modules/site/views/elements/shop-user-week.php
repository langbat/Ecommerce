<div class="row-fluid">
                            <?php /*<div class="span4 full_img">
                                <div class="blue"><?php echo Yii::t('global','Shop this week'); ?></div>
                                <?php 
                                    $ProductShop = MemberShop::model()->with('productsShops')->findByAttributes(array( 'delFlag'=> 0 ), array( 'order' => 'id DESC', 'limit' => 1 ) );
                                ?>
                                <a href=""><img src="/uploads/logoshop/<?php echo $ProductShop->image; ?>" alt="<?php echo $ProductShop->name; ?>" title="<?php echo $ProductShop->name; ?>" style="height: 260px !important;"/></a>
                            </div> */ ?>
                            
                             <?php 
                                    //$ProductShop = MemberShop::model()->with('productsShops')->findByAttributes(array( 'delFlag'=> 0 ), array( 'order' => 'id ASC', 'limit' => 1 ) );
                                ?>
                            <div class="span12">
                                <?php 
                                    $categoryShops = Categories::model()->getAllCategoryByProduct();
                                    if( isset( $categoryShops ) ){
                                ?>
                                <div class="blue"><?php echo Yii::t('global','Next offers'); ?>
									<div class="cat_product">Aus dem Bereich
										
                                        <select id="option-category-shop" name="option-category-shop">
                                        <?php 
                                           
                                           foreach ( $categoryShops as $categoryShop ){
                                               echo "<option value='".$categoryShop['id']."'>".$categoryShop['name']."</option>";
                                           }
                                        ?>
										</select>
									</div>
									<div class="clearfix"></div>
								</div>
                                <?php 
                                     }
                                     $category_id = isset($categoryShops[0]['id'])?$categoryShops[0]['id']:0;
                                     $productviews = Products::model()->getProductByCate( $category_id, 5);
                                     if( isset( $productviews ) ){
                                ?>
                                <div class="content-block" id="new-content-product">
                                <?php  
                               
                                  ?>
                                    <div id="Agenbote" class="carousel_pause slide">
                                        <ol class="carousel-indicators">
                                          <?php 
                                            $i = 0;
                                            foreach ( $productviews as $productview ){ ?>
                                          <li data-target="#Agenbote" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo 'class="active"'; ?> ><div class="bullet"></div><?php echo $productview['name']; ?></li>      
                                          <?php $i++; }
                                          ?>
                                          
                                        </ol>
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                          <?php 
                                            $j = 0;
                                            foreach ( $productviews as $detailproduct ){
                                          ?>
                                          
                                          <div class="<?php if($j == 0) echo 'active'; ?> item">
                                                 
                                                  
												<ul id="icon-social" class="black">
                                                    <li> <span class="rating_new"><?php 
                                                    $this->widget('ext.dzRaty.DzRaty', array(
                                                        'name' => 'my_rating_product_id_'.$detailproduct['id'],
                                                        'value' => Ratings::model()->getRating($detailproduct['id']),
                                                        'options' => array(
                                                                'half' => TRUE,
                                                                	'click' => "js:function(score, evt){ ratings(score,".$detailproduct['id'].") }",
                            
                                                        ),
                                                        'htmlOptions' => array(
                                                        'class' => 'new-half-class'
                                                        ),
                                                    ));
                                                    $this->renderPartial('../elements/rate_product');
                                                  ?>
                                                 </span> </li>
                                                    <li> <span class='text-rating-new'>( <?php Ratings::model()->totalRating( $detailproduct['id'] ); ?> )  </span> </li>
													<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://tosello.toasternet-online.de/products/detail/<?php echo $detailproduct['id']; ?>','facewindow','width=800,height=400');return false;" href=""><i class="fa fa-facebook"></i></a></li>
													<li><a  onclick="window.open('http://twitter.com/share?url=http://tosello.toasternet-online.de/products/detail/<?php echo $detailproduct['id']; ?>','tweetwindow','width=800,height=400');return false;" href=""><i class="fa fa-twitter"></i></a></li>
													<?php /*<li><a href="#"><i class="fa fa-youtube-play"></i></a></li>*/ ?>
												</ul>
                                                <h4><a href="/products/detail/<?php echo $detailproduct['id']; ?>"><?php echo $detailproduct['name']; ?></a></h4> 
												<div class="info-shop">
													<div style="float: left; width:45%;"><a href="/products/detail/<?php echo $detailproduct['id']; ?>"><img src="/uploads/product/<?php echo $detailproduct['image']; ?>" alt=""/></a></div>
                                                    <div style="width:5%;"></div>
                                                    <div style="float: right; width:50%;">
											        <div class="text-name-product-new"> <?php echo Yii::t('global','Only for today'); ?></div>
                                                    <div class="text-name-product-price"> <?php echo Utils::number_format($detailproduct['price']-( $detailproduct['price'] * $detailproduct['discount_percent'])/100) ?> € </div>
													<div class="text-statt-product-new"> <?php echo Yii::t('global','statt'); ?>: <em><b><span class="statt"> <?php echo Utils::number_format(($detailproduct['price'] * $detailproduct['discount_percent'])/100) ?>  </span> <span class="coin"><?php echo Yii::t('global','Euro'); ?>  </span></b></em>  </span></div>
                                                    <div class="button-product-detail"><a href="/products/detail/<?php echo $detailproduct['id']; ?>"> <button class="btn" type="button"><?php echo Yii::t('global','Detail product'); ?></button> </a> </div>
                                                    </div>
												</div>
                                            </div>
                                   
                                        
                                          
                                          
                                          <?php $j++; } ?>
                                            
									
                                        </div> 
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                                
                                
                            </div>
                        </div>
<script type="text/javascript">
$('#option-category-shop').live('change',function(){
    $('#new-content-product div').empty();
     var url = 'id=' + this.value;
		$.ajax({
			type: "GET",
			url: "/products/loadProductByCate",
			data: url,
			success: function(html){
				$("#new-content-product").html(html);
			}
		});
        return false;
})
</script>
