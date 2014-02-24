<div id="slider_support">
	<a href="" id="hotline"><i class="fa fa-phone fa-3x " ></i>
	<br/><?php echo Yii::t('global','Hotline');?></a>
	<a href="" class="support-chat-box"><i class="fa fa-comments fa-3x "></i>
	<br />
	<?php echo Yii::t('global','Chat');?></a>
	<a href="<?php echo Yii::app()->homeUrl?>shop" ><i class="fa fa-shopping-cart fa-3x"></i>
	<br />
	<?php echo Yii::t('global','Shops');?></a>
</div>

<div id="myModalHotline" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title" id="ico-hotline">
        <h5 ><?php echo Yii::t('global', 'Telephone support and advice')?>
        </h5>
    </div>
    <div class="modal-body" id="bg-hotline">
        <p class="fix_content_modal" style="background: url();">
            <i class="fa fa-phone-square "></i> <?php echo Settings::model()->findByAttributes(array('title'=>'Hotline'))->value; ?>

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#hotline').click(function(){
      
    $('#myModalHotline').modal('show');
    return false;
        
     });});
</script>