<?php  $highlight = Support::model()->getisHighlight();?>
	<div class="span3">
<div class="purple-box-sup">
										<div class="title">
											<h5><?php echo Yii::t('global','Highlight-Video');?></h5>
										</div>
										<div class="block" style="padding: 5px 5px 20px;height: 320px;">
                                            <?php if(!empty($highlight)){?>
											<div class="video_conten_sup">
												<p >
												<?php echo $highlight->title?>
												</p>
                                                <?php 
                                                $imgHighlight ='';
                                                                     if (preg_match('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$highlight->linkyoutube,$output) > 0)
                                                                
                                                                {
                                                               //var_dump($output); exit();
                                                                   // If it's in the video link format...
                                                                   $imgHighlight = "<img src='http://img.youtube.com/vi/".$output[4]."/0.jpg' alt=' ' />";
                                                                
                                                                }
                                                                
                                                                elseif (preg_match('(/embed/([a-z0-9A-Z]+))', $highlight->linkyoutube, $output) > 0)
                                                                
                                                                {
                                                                
                                                                   // Otherwise, it's in the embed format
                                                                   
                                                                  $imgHighlight = "<img src='http://img.youtube.com/vi/".$output[1]."/0.jpg' alt=' ' />";
                                                                
                                                                }
                                                                ?>
												<a class="video img_video_sup" href="<?php echo $highlight->linkyoutube?>" title="<?php echo $highlight->linkyoutube?>" ><?php echo $imgHighlight?></a>

											</div>
                                            <?php }?>
										</div>
									</div>
                                    </div>