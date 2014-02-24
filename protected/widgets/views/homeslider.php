<?php
$featuredlimit = Yii::app()->params['homeslider_limit'] ? intval(Yii::app()->params['homeslider_limit']) : 0;
if($featuredlimit <= 0) $featuredliimit = 20;

if( Yii::app()->params['homeslider_type'] == '1')
	$featured = Videos::model()->byDate()->findAll(array("condition" => "status=1 AND featured=1", "limit" => $featuredlimit));
else $featured = Videos::model()->byViews()->findAll(array("condition" => "status=1", "limit" => $featuredlimit));

if(count($featured)): ?>

	<section class="section section-intro section-padded">
		<div class="container-fluid">
			<div class="flexslider fadein-links" data-flex-animation="slide" data-flex-controls="hide" data-flex-directions-position="outside" data-flex-directions-type="fancy" data-flex-itemwidth="150" data-flex-slideshow="false" id="intro">
			  <ul class="slides">
			  <?php
				foreach($featured as $video)
				{ ?>
					<li>
						<?php
						echo CHtml::link(
							'<img alt="'.CHtml::encode($video->name).'" src="'.Yii::app()->homeUrl.'uploads/cover/t_'.$video->id.'_'.$video->cover.'"/>',
							array('videos/index', 'id'=>$video->id, 'alias'=>$video->alias)
						); ?>
					</li><?php
				}?>
			  </ul>
			</div>
		</div>
	</section>
	
<?php endif; ?>