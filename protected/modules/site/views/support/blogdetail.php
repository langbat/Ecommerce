<div class="contain-detail">
	<div class="span12 contain-blog-video-box">
		<div class="span3">
			<h5 ><?php echo $data->title?></h5>
			<a class="img_video_sup video" title="<?php echo $data->linkyoutube?>"  href="<?php echo $data->linkyoutube?>"><?php echo Support::model()->getImgFromVideo($data->linkyoutube)?></a>
			<br />
			<span><?php echo Yii::t('global','Posted').': '. $data->date_create?></span>
		</div>
		<div class="span9">
			<p>
				<?php echo $data->content;?>
			</p>
		</div>
	</div>
	<div class="clearfix"></div>
</div>