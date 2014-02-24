<div class="content">
<?php if(isset($productshop) && (count($productshop) > 0)){ ?>
    <div class="sort-product">
    <?php
        echo CHtml::dropDownList('sort','',array(
        'id DESC'=>"",
        'direct_buy_price ASC'=> Yii::t('global' ,'Price(Low->High)'),
        'direct_buy_price DESC'=>Yii::t('global' ,'Price(High->Low)'),
        'name ASC'=>Yii::t('global' ,'Name(A->Z)'),
        'name DESC'=>Yii::t('global' ,'Name(Z->A)')

        ),array('id'=>'sortDrop')); ?>
    </div>
    <div id="products">
    <?php 
        $this->widget('zii.widgets.CListView', array(
    	'dataProvider'=>$productshop,
    	'itemView'=>'../elements/product-shop-box-item',
        'id'=>'item',
        'afterAjaxUpdate' => 'updateRating',
        ));
    ?>
    <div class="clearfix"></div>
   </div>
   <?php }else{ ?>
        <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php echo Yii::t('global', 'No results found.')?>
        </div>
    <?php } ?>
</div>
<script>
  function updateRating(id, data) {
    //$('#sortDrop').val('');
    countdown();
      <?php  
          $totalProduct = count(ProductsShop::getProductShopByIdShop($_GET['shop_id']));
          $criteria =  new CDbCriteria;
          $criteria->condition = "shop_id =".$this->membershop->id;
          $productshop = new CActiveDataProvider('ProductsShop', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$totalProduct,
            ),
          ));
          $results = $productshop->getData();
          foreach ( $results as $result ){ ?>
                jQuery("#my_rating_product_id_"+<?php echo $result['id']; ?>+"-raty").raty({"half":true,"click":function(score, evt){ ratings(score,<?php echo $result['id']; ?>,1) },"score":<?php Ratings::model()->getRating($result['id'], 1, 1 ); ?>,"target":"#my_rating_product_id_"+<?php echo $result['id']; ?>+""});jQuery("#my_rating_product_id_"+<?php echo $result['id']; ?>+"").hide();
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