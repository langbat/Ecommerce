<section class="bigPostItem indexPost">
	<div class="headTitle">
		<h1><a href="/support/tutorialdetail?id=<?php echo $data->id?>" title="<?php echo $data->title ?>"><?php echo $data->title ?></a></h1>
	</div>
	<div class="imgThumb">
		<a class="img_video_sup video" href="<?php echo $data->linkyoutube?>" title="<?php echo $data->linkyoutube?>"> <?php echo Support::model()->getImgFromVideo($data->linkyoutube)?> </a>
		<br />
		<span><?php echo Yii::t('global','Posted').': '. $data->date_create?></span>
	</div>
	<div class="p">
		<?php echo (strlen($data->content))>1000? substr($data->content, 0, 1000).'[…] <a href="/support/tutorialdetail?id='.$data->id.'">&raquo;'.Yii::t('globle','Learn more').'</a>':$data->content;?>
	</div>
	<div class="clear"></div>
</section>