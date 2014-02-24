  <?php 
        $productspecial = Products::model()->findByAttributes( array('is_special'=>1,'is_active'=>1 ) ,array('order'=> 'id DESC', 'limit'=> 1 ) );
          if($productspecial){
            $schedule       = ScheduleShows::model()->getSchedule( $productspecial->id );
        $checkSchedule  = ScheduleShows::model()->checkSchedule( $productspecial->id );
     
  ?>
   <div class="row-fluid">  
                            <div class="span4">
                                <ul id="timeZone">
                                    <li><span style="font-weight: bold;"> <?php echo Yii::t('global','Schedule'); ?> </span></li>
                                      <?php
                                           $this->widget('zii.widgets.CListView', array(
                                            'dataProvider'=>$schedule,
                                            'summaryText'=>'',
                                            'itemView'=>'../elements/schedule-home',
                                        )); ?>
                                </ul>
                                <ul id="lastProduct">
                                    <li><?php echo Yii::t('global','Last products on TV'); ?></li>
                                    <li class="name-product-last-tv"><a href="/products/detail/<?php echo $productdetail->id; ?>"> <?php echo $productdetail->name; ?> </a></li>
                                    <li><a href="/products/detail/<?php echo $productdetail->id; ?>">  <img src="/uploads/product/<?php echo $productdetail->image ?>" alt="" class="img-product-last-tv"/></a> <?php echo  Utils::number_format($productdetail->price - ($productdetail->price * $productdetail->discount_percent)/100); //Utils::number_format($productdetail->direct_buy_price); ?> € </li>
                                </ul>
                            </div>
                            <div class="span8">
                                <div class="orange"><?php echo Yii::t('global',"Today's special"); ?>
									<ul id="icon-social" class="white">
										<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://tosello.toasternet-online.de/products/detail/<?php echo $productspecial->id ?>','facewindow','width=800,height=400');return false;" href=""><i class="fa fa-facebook"></i></a></li>
										<li><a  onclick="window.open('http://twitter.com/share?url=http://tosello.toasternet-online.de/products/detail/<?php echo $productspecial->id ?>','tweetwindow','width=800,height=400');return false;" href=""><i class="fa fa-twitter"></i></a></li>
									</ul>
								</div> 
                                <div class="content-block">
                                    <div class="span4">
                                        <div id="myCarousel" class="carousel slide">
                                            <ol class="carousel-indicators">
                                                <?php 
                                                $i = 0;
                                                $gallery = ProductGalleries::model()->findAll(array(
                                                'select'=>'*, rand() as rand',
                                                'condition' => 'product_id=:product_id',
                                                'params'    => array('product_id' => $productspecial->id),
                                                'limit'=>'3',
                                                'order'=>'rand',
                                                ));
                                                // $gallery = ProductGalleries::model()->findAllByAttributes(array('product_id'=>$productspecial->id));
                                                 foreach($gallery as $images){ ?>
                                                  <li data-target="#myCarousel" data-slide-to = "<?php echo $i; ?>" <?php if( $i == 0 ){ echo 'class="active"'; } ?> ><img src="/uploads/product_gallery/<?php echo $images['filename']; ?>" alt="<?php echo $productspecial->name; ?>"/></li>
                                                      <?php  
                                                     $i++;
                                                     }
                                                    ?>
                                            </ol>
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                <?php 
                                                    $j = 0;
                                                    foreach ( $gallery as $img ){ ?>
                                                 <div class="<?php if( $j == 0 ) echo 'active'; ?> item"><img src="/uploads/product_gallery/<?php echo $img['filename']; ?>" alt=""/></div>       
                                               <?php  
                                               $j++;
                                                    }
                                                ?>
                                            </div> 
                                        </div> 
                                    </div> 
                                    <div class="span8">
                                        <h4><a href="/products/detail/<?php echo $productspecial->id; ?>" ><?php echo $productspecial->name; ?></a></h4>
                                        <hr/>
                                        <div style="float: left;" class="rating-decscription-new">
                                            <span class="rating-shop">
                                               <?php 
                                                  $this->widget('ext.dzRaty.DzRaty', array(
                                                        'name' => 'my_rating_field_rating_shop',
                                                        'value' => Ratings::model()->getRating($productspecial->id),
                                                        'options' => array(
                                                                'half' => TRUE,
                                                                	'click' => "js:function(score, evt){ ratings(score,".$productspecial->id.") }",
                            
                                                        ),
                                                        'htmlOptions' => array(
                                                        'class' => 'new-half-class'
                                                        ),
                                                    ));
                                                    $this->renderPartial('../elements/rate_product');
                                                ?>
                                                  <span class="rating-total">( <?php Ratings::model()->totalRating( $productspecial->id ); ?> ) </span>
                                        </span>
                                        <?php if( $productspecial->short_desciption != '' ) { ?>
                                        <ul id="info-product">
                                            <li><?php echo Utils::short_description( $productspecial->short_desciption, 155 ); ?></li>
                                        </ul>
                                        <?php } ?>
                                        </div>
                                        <div class="colmn-right" style="float: right;">
                                            <h3>Angebote windev in</h3>
										<div class="hours-new"> 
											<h4>
                                            <span class="time_detail_countdown">
                                                <div class="second_total" style="display: none"> <?php echo $checkSchedule['counttime'] ?></div>
                                                <span class="day">00 </span> : 
                                                <span class="hours"> 00 </span> : 
                                                <span class="minutes">00 </span> : 
                                                <span class="second" > 00 </span>
                                            </span></h4>
											<ul id="days">
												<li><?php echo Yii::t('global','Days'); ?></li>
												<li><?php echo Yii::t('global','Hours'); ?></li>
												<li><?php echo Yii::t('global','Minutes'); ?></li>
												<li><?php echo Yii::t('global','Seconds'); ?></li>
											</ul>
											 
											<p class="total">Etiam eu magna<br/><b><?php echo Utils::number_format($productspecial->direct_buy_price); ?> € *</b></p>
											<p class="part">Etiam eu magna<br/><?php echo Utils::number_format($productspecial->price); ?> € *</p> 
										</div>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div> 
                            </div>
                        </div>
   <?php }?>                 