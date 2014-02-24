 <?php
                                    $news= Blog::model()->findByAttributes(array('language' => Yii::app()->language), array('order' => 'id DESC', 'limit' => 1)); 
                                        //var_dump($news);exit();
                                ?>
                                <?php if(count($news)){?>
										<div class="span6">
                                    <div class="purple-box-sup">
										<div class="title">
											<h5><?php echo $news->title ?></h5>
										</div>
										<div class="block new" >

											<p style="text-align:left; font-weight: bold; margin-bottom:30px;">
												<?php echo $news->description ?>
											</p>
											<a href="/blog/view/<?php echo $news->alias?>"><img width="300px" style="padding-left: 100px;"  src="/uploads/blog/<?php echo $news->image; ?>"/><br />
											<i class="fa fa-angle-double-right"></i><?php echo Yii::t('global','Learn more') ?></a>

										</div>

									</div>
                                    	</div>
                                    <?php }?>