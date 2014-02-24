<div id="Agenbote" class="carousel_pause slide">
                                        <ol class="carousel-indicators">
                                          <?php 
                                            Yii::app()->clientScript->registerCoreScript('jquery');
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
                                                        'name' => 'rating_product_id_ajax_'.$detailproduct['id'].'_cate_'.$cate_id.'_nb',
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
                                                    <li> <span class='text-rating-new'>( <?php Ratings::model()->totalRating( $detailproduct['id']); ?> )  </span> </li> 
													<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://tosello.toasternet-online.de/products/detail/<?php echo $detailproduct['id']; ?>','facewindow','width=800,height=400');return false;" href=""><i class="fa fa-facebook"></i></a></li>
													<li><a  onclick="window.open('http://twitter.com/share?url=http://tosello.toasternet-online.de/products/detail/<?php echo $detailproduct['id']; ?>','tweetwindow','width=800,height=400');return false;" href=""><i class="fa fa-twitter"></i></a></li>
													<?php /*<li><a href="#"><i class="fa fa-youtube-play"></i></a></li> */ ?>
												</ul>
                                                <h4><a href="/products/detail/<?php echo $detailproduct['id']; ?>"><?php echo $detailproduct['name']; ?></a></h4> 
												<div class="info-shop">
													<div style="float: left; width:45%;"><a href="/products/detail/<?php echo $detailproduct['id']; ?>"><img src="/uploads/product/<?php echo $detailproduct['image']; ?>" alt=""/></a></div>
                                                    <div style="width:5%;"></div>
                                                    <div style="float: right; width:50%;">
											        <div class="text-name-product-new"> <?php echo Yii::t('global','Only for today'); ?></div>
                                                    <div class="text-name-product-price"> <?php echo Utils::number_format($detailproduct['direct_buy_price']); ?> €</div>
													<div class="text-statt-product-new"> <?php echo Yii::t('global','statt'); ?>: <em><b><span class="statt"> <?php echo Utils::number_format($detailproduct['price']) - Utils::number_format($detailproduct['direct_buy_price']); ?> </span> <span class="coin"><?php echo Yii::t('global','Euro'); ?>  </span></b></em>  </span></div>
                                                    <div class="button-product-detail"><a href="/products/detail/<?php echo $detailproduct['id']; ?>"><button class="btn" type="button"><?php echo Yii::t('global','Detail product'); ?></button></a> </div>
                                                    </div>
												</div>
                                            </div>
                                   
                                        
                                          
                                          
                                          <?php $j++; } ?>
                                            
									
                                        </div> 
                                    </div>
                                    <div class="clearfix"></div>
<script type="text/javascript">
jQuery(function($) {
<?php foreach ( $productviews as $detailproductnew ){ ?>
jQuery('#rating_product_id_ajax_'+<?php echo $detailproductnew['id']; ?>+'_cate_'+<?php  echo $cate_id; ?>+'_nb-raty').raty({'half':true,'click':function(score, evt){ ratings(score,<?php echo $detailproductnew['id']; ?>) },"score":<?php Ratings::model()->getRating( $detailproductnew['id'], 0 , 1 ); ?>,'target':'#rating_product_id_ajax_'+<?php echo $detailproductnew['id']; ?>+'_cate_'+<?php  echo $cate_id; ?>+'_nb'});jQuery('#rating_product_id_ajax_'+<?php echo $detailproductnew['id']; ?>+'_cate_'+<?php  echo $cate_id; ?>+'_nb').hide();
<?php } ?>
});
</script>                                   