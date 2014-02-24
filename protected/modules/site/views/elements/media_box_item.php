<div class="item_media">
    <h5 ><?php echo $data->title?></h5>
    <a class="img_video_sup video" title="<?php echo $data->linkyoutube?>" href="<?php echo $data->linkyoutube?>"><?php echo Support::model()->getImgFromVideo($data->linkyoutube)?></a>
</div>
                                            