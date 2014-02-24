<?php
    Yii::app()->clientScript->registerScript('specialSort','
    $("body").on("change","#sortDrop",function(){
            $.fn.yiiListView.update("item",{data:{sort:$(this).val()},type:"POST"})
        });
    ');
?>
<div class="pull-left col-left">
    <h5 class="left-10"><?php echo Yii::t('global', $category->name)?></h5>
    <?php 
    if($products->itemCount != 0){ ?>
    <div class="sort-product" style="margin-left: 610px; margin-top: -40px;">
    <?php
        echo CHtml::dropDownList('sort_category','',array(
        'created DESC'=>"",
        'id ASC'=> Yii::t('global' ,'ID(Low->High)'),
        'id DESC'=>Yii::t('global' ,'ID(High->Low)'),
        'direct_buy_price ASC'=> Yii::t('global' ,'Price(Low->High)'),
        'direct_buy_price DESC'=>Yii::t('global' ,'Price(High->Low)'),
        'name ASC'=>Yii::t('global' ,'Name(A->Z)'),
        'name DESC'=>Yii::t('global' ,'Name(Z->A)')

        ),array('id'=>'sortDrop')); ?>
    </div>
    <?php } ?>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$products,
        	'itemView'=>'../elements/product-box-item',
            'id'=>'item',
            'afterAjaxUpdate' => 'updateRatingCategory',
        ));
        ?>
        
        <div class="clearfix"></div>
    </div><!--#end product-wrapper-->	
</div><!--#end col-left-->

<div class="pull-left col-right">
    <?php if(Yii::app()->user->isGuest){ ?>   
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php }else{ ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
    </div>
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php } ?>
</div><!--#end col-right-->
<script>
  function updateRatingCategory() {
    countdown();
      <?php 
        foreach ( $product_ids as $result ){ ?>
            jQuery("#my_rating_field_label_product_"+<?php echo $result; ?>+"-raty").raty({"half":true,"click":function(score, evt){ ratings(score,<?php echo $result; ?>,1) },"score":<?php Ratings::model()->getRating( $result, 0, 1 ); ?>,"target":"#my_rating_field_label_product_"+<?php echo $result; ?>+""});jQuery("#my_rating_field_label_product_"+<?php echo $result; ?>+"").hide();
      <?php } ?>   
         $('#myModalRate').bind('hide', function() {
            location.reload(true);
            }); 
         $('#myModalRated').bind('hide', function() {
            location.reload(true);
            }); 
        }
        function countdown(){
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
        }
</script>
