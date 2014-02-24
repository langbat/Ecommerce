<?php error_reporting(0) ?>

<div id="myModalRate" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 style="text-align: left;"><?php echo Yii::t('global', 'Notice')?>
        </h5>
    </div>
    <div class="modal-body" >
        <p class="sms" style="text-align: center; font-size: 12px;">
        <?php echo Yii::t('global','Thank you rating')  ?>
        </p>
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>

<div id="myModalRated" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title" style="background: #E54E3E;" >
        <h5 style="text-align: left;"><i class="fa fa-exclamation-triangle" style="color: #fff902;" >&nbsp;</i><?php echo Yii::t('global', 'Notice')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal" id="countdown">
            

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>


<div id="myModalComment_<?php echo $product_id ?>" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Add comment')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <textarea class="comment_for_product comment_for_product_<?php echo $product_id ?>"></textarea>
        </p>
        <div class="submit_comment">
            <div class="btn btn-warning btn_comment_<?php echo $product_id ?>"><?php echo Yii::t('global','Save') ?></div>
            <div class="btn btn_cancel_comment"><?php echo Yii::t('global','Cancel') ?></div>
        </div>
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>  

<script type="text/javascript">
    $(document).ready(function(){
       $('.btn_comment_<?php echo $product_id ?>').click(function(){
        var type = $('.type_comment').val();
        var content = $('.comment_for_product_<?php echo $product_id ?>').val();
        if(type == <?php echo ProductComments::TYPE_PRODUCT_SHOP ?>){
           $.get('/productsshop/addComment?id=<?php echo $product_id ?>&content='+content,function(){
               $('.modal-body').html(' <?php echo Yii::t("global","Add comment successful") ?>');
           }); 
        } else{
           $.get('/products/addComment?id=<?php echo $product_id ?>&content='+content,function(){
               $('.modal-body').html(' <?php echo Yii::t("global","Add comment successful") ?>');
           }); 
        }
 
       });
       $('#myModalComment_<?php echo $product_id ?>').bind('hide', function() {
            location.reload(true);
       });
       $('#myModalRated').bind('hide', function() {
            location.reload(true);
       });
        $('.btn_cancel_comment').click(function(){
            $('#myModalComment_<?php echo $product_id ?>').modal('hide');
        })
        
        
    ////Function count down    
        
        // set the date we're counting down to
        var nextDay  = new Date();
        var target_date = new Date();
        nextDay.setHours(24);
        nextDay.setMinutes(0);
        nextDay.setSeconds(0);
//nextDay = new Date(example);
    target_date.setDate(target_date.getDate() + 1);
    target_date.setTime(nextDay.getTime())

 
// variables for time units
var days, hours, minutes, seconds;
 
// get tag element
var countdown = document.getElementById("countdown");
 
// update the tag with id "countdown" every 1 second
setInterval(function () {
 
    // find the amount of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;
 
    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
     
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
     
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
     
    // format countdown string + set tag value
    countdown.innerHTML = "<?php echo Yii::t("global","Today you've already rated. please try to rate again in next day!"); ?></br> </br><b>"+days + "</b> <?php echo Yii::t('global','Day'); ?> : " + "<b>"+hours + "</b> <?php echo Yii::t('global','Hours'); ?>  : "
    +"<b>"+ minutes + "</b> <?php echo Yii::t('global','Minutes'); ?>  : " +"<b>"+ seconds + "</b> <?php echo Yii::t('global','Seconds'); ?> ";  
 
}, 1000);
    });
</script>
