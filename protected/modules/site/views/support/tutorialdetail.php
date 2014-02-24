<section class="bigPostItem indexPost" style="min-height: 550px;">
 
<div class="headTitle">
<h1><a href="/support/tutorialdetail?id=<?php echo $data->id?>" title="<?php echo $data->title ?>"><?php echo $data->title ?></a></h1>
</div>                                                         
<div class="imgThumb">
<a class="img_video_sup video" title="<?php echo $data->linkyoutube?>"  href="<?php echo $data->linkyoutube?>" title="<?php echo $data->title ?>">
<?php echo Support::model()->getImgFromVideo($data->linkyoutube)?> 
</a><br /><span><?php echo Yii::t('global','Posted').': '. $data->date_create?></span>
</div>
<p><?php echo $data->content;?> </p>
 
<div class="clear"></div>
</section>