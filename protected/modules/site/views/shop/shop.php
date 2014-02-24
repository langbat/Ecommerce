<div id="myModalRate_shop" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div id="myModalRated_shop" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<?php Yii::app()->session['ip_address'] = $_SERVER['REMOTE_ADDR']; ?>
<div class="pull-left col-left">
<?php if (isset($allshop) && ($allshop->itemCount) > 0) { ?>
    <div class="sort-product" style="margin-left: 575px;">
        <?php
        echo CHtml::dropDownList('sortshop', '', array(
            '' => "",
            'id ASC' => Yii::t('global', 'ID(Low->High)'),
            'id DESC' => Yii::t('global', 'ID(High->Low)'),
            'member_shop.name ASC' => Yii::t('global', 'Name(A->Z)'),
            'member_shop.name DESC' => Yii::t('global', 'Name(Z->A)')),
        array('id' => 'sortDropshop'));
        ?>
    </div>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $allshop,
            'itemView' => '../elements/shop_style',
            'id' => 'item',
            'afterAjaxUpdate' => 'updateRating',
        ));
        ?>
            <div class="clearfix"></div>
    </div><!--#end product-wrapper-->	
       <?php } else { ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::t('global', 'No results found.') ?>
            </div>
        <?php } ?>
        
</div><!--#end col-left-->

<div class="pull-left col-right">
    <?php if (Yii::app()->user->isGuest) { ?>   
        <?php $this->renderPartial('/elements/tested-safety'); ?>
        <?php $this->renderPartial('/elements/news-box'); ?>
    <?php } else { ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu') ?>
    </div>
        <?php $this->renderPartial('/elements/tested-safety'); ?>
        <?php $this->renderPartial('/elements/news-box'); ?>
    <?php } ?>
</div><!--#end col-right-->
<script>
  function updateRating(id, data) {
      <?php 
        $sqlcount = "SELECT COUNT(ab.id) AS total_id FROM (";
        $sql = "SELECT member_shop.*, 
                COUNT(products_shop.id) AS totals FROM products_shop 
                INNER JOIN member_shop ON products_shop.shop_id = member_shop.id
                GROUP BY member_shop.id";
        $sqlcount .= $sql . " ) AS ab WHERE ab.totals > 0";

        $count = Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $allshop = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'sort' => array('attributes' => array(
                    'member_shop.id' => array(
                        'asc' => 'member_shop.id', 
                        'desc' => 'member_shop.id'
                    ),
                    'member_shop.name' => array(
                        'asc' => 'member_shop.name', 
                        'desc' =>'member_shop.name'
                        ),
                    ), 
            ),
            'pagination' => array(
                'pageSize' => $count
            ),
            ));
        $results = $allshop->getData();
        foreach ($results as $result) { ?>
                jQuery("#my_rating_shop_id_"+<?php echo $result['id']; ?>+"-raty").raty({"half":true,"click":function(score, evt){ shop_ratings(score,<?php echo $result['id']; ?>) },"score":<?php echo ShopRatings::model()->getRatingShop($result['id']) + 0.01 ?>,"target":"#my_rating_shop_id_"+<?php echo $result['id']; ?>+""});jQuery("#my_rating_shop_id_"+<?php echo $result['id']; ?>+"").hide();
        <?php } ?>   
            }
            
</script>
<script>
    $('#myModalRate_shop').bind('hide', function() {
        location.reload(true);
        }); 
     $('#myModalRated_shop').bind('hide', function() {
        location.reload(true);
        }); 
    /*Function count down */   
    var nextDay  = new Date();
    var target_date = new Date();
    nextDay.setHours(24);
    nextDay.setMinutes(0);
    nextDay.setSeconds(0);
    target_date.setDate(target_date.getDate() + 1);
    target_date.setTime(nextDay.getTime());
    /*variables for time units*/
    var days, hours, minutes, seconds;
 
    /*get tag element*/
    var countdown = document.getElementById("countdown");
 
    /*update the tag with id "countdown" every 1 second*/
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
</script>