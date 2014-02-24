<div class="row-fluid dropdown2_sup">
								<div class="btn-group dropdown" >
                             <?php $support = Support::model()->findByAttributes(array('categories' => '5'), array('limit' => 1)); ?>
								<a class="btn btn_sup btn_style_sup"  href="#"><h4 ><?php echo Yii::t('dropdown',$support->title );?></h4></a>

								<a href="#" class="btn dropdown-toggle btn_style_sup"  role="button" data-toggle="dropdown"><b class="caret"></b></a>
                               
								<div  class="dropdown-menu dropdown_sup" aria-labelledby="drop1">
									<h5 > <?php echo Yii::t('dropdown',$support->title )?></h5>
									<p >
										<?php echo Yii::t('dropdown',$support->description)  ?><a href="<?php echo $support->linkyoutube ?>" title="<?php echo $support->linkyoutube?>"  class="video"> &raquo; <?php echo Yii::t('support-page','Visit us!') ?></a>
									</p>
								</div>

							</div>
							</div>