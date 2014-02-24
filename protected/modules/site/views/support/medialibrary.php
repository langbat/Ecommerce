						
							<div class="row-fluid row_conten_sup"  style="margin-top: 0px;">
								<div class="span12">
							

                                	<div class="purple-box-sup">
										<div class="title">
											<h5><?php echo Yii::t('global', 'Media Library'); ?> </h5>
										</div>
										<div class="block containmedia">
											
                                                    <?php

                                                        if ($this->Allsupport !== "") {
                                                        
                                                        
                                                            $this->widget('zii.widgets.CListView', array(
                                                                'dataProvider' => $dataProvider,
                                                                'itemView' => '../elements/media_box_item',
                                                                'id' => 'clearfix',
                                                                'afterAjaxUpdate' =>'fancybox-again',

                                                            ));

                                                        } ?>
											

											
										</div>
                                        <div class="clearfix"></div>
									</div>
								</div>
							
							</div>
					