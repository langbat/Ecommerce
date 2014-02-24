<div class="span12 contain-blog-video-box">
    <div class="span3">
        <h5 ><?php echo $data->title?></h5>          
        <a class="img_video_sup video" title="<?php echo $data->linkyoutube?>"  href="<?php echo $data->linkyoutube?>"><?php echo Support::model()->getImgFromVideo($data->linkyoutube)?></a><br /><span><?php echo Yii::t('global','Posted').': '. $data->date_create?></span>
    </div>
    <div class="span9">
        <p><?php  echo (strlen($data->content))>1000? substr($data->content, 0, 1000).'[…] <a href="/support/blogdetail?id='.$data->id.'">&raquo;'.Yii::t('globle','Learn more').'</a>':$data->content;?></p>
    </div>
</div>
<div class="clearfix"></div>