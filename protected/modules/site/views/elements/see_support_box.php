<?php
$Allsupport = Support::model()->getAllSupport();
// var_dump($Allsupport);exit();
$array_support = array();
?>
<div class="span9">
	<div class="purple-box-sup">
		<div class="title">
			<h5><?php echo Yii::t('global','See TS-Expert');?></h5>
		</div>
		<div class="block" style="height: 320px;">
			<div class="span8">
				<?php
				$totalSupport        = count($Allsupport);
				$i                   = 1;
				// echo '+'.$totalSupport; exit();
				if( $Allsupport !== ""){
				?>
				<div id="myCarousel" class="carousel slide slide-sup">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="active item">
							<?php
							$count=0;

							foreach( $Allsupport as $recommendSupport){
							$input = $recommendSupport->linkyoutube;
							$img = '';

							?>
							<div class="span6">
								<p>
									<?php echo $recommendSupport->title;
									?>
								</p>
								<a href="<?php  echo $recommendSupport->linkyoutube;?>" title="<?php echo $recommendSupport->linkyoutube;?>" class="img_video_sup video"><?php echo Support::model()->getImgFromVideo($recommendSupport->linkyoutube)?></a>
							</div>
							<?php
							if( $i % 2 == 0 && $i != $totalSupport ){ ?>

						</div>
						<div class="item">
							<?php }
							$i++;
							}
							?>

						</div>

					</div>
					<!-- Carousel nav -->
					<?php if( $totalSupport > 2 ){ ?>
					<a class="carousel-control left carousel-left" href="#myCarousel"  data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right carousel-right" href="#myCarousel"  data-slide="next">&rsaquo;</a>
					<?php }?>
				</div>
				<?php } ?>
			</div>
			<div class="span4 library_box_contain_sup">
				<div class="library_box_sup">
					<p>
						<?php echo Yii::t('support-page','this and other TS- Experts video, you\'ll find in TS-Experts Mediathek');?>
					</p>
					<a class="btn btn-info" href="/support/medialibrary" > <?php echo Yii::t('support-page','Go to Mediathek');?></a>
				</div>

			</div>
		</div>
	</div>
</div>
