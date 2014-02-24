
<div class="pull-left col-left">
    <h5 class="left-10"><?php echo Yii::t('global', 'Product Tosello')?></h5>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$product,
        	'itemView'=>'../elements/product-box-item',
            'id'=>'item',
            'afterAjaxUpdate' => 'updateRatingProduct',
        ));
        ?>
        <div class="clearfix"></div>
    </div><!--#end product-wrapper-->
    
    <h5 class="left-10"><?php echo Yii::t('global', 'Product Shop')?></h5>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$productshop,
        	'itemView'=>'../elements/view-search-product-shop',
            'id'=>'item1',
            'afterAjaxUpdate' => 'updateRatingProductShop',
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
  function updateRatingProduct() {
      <?php 
         
         $list_products = new CActiveDataProvider('Products', array(
            'criteria' => array(
                'order' => 'created DESC',
                'condition' => "name like '".$_GET['condition']."'",
            )
        ));
        $results = $list_products->getData();
        foreach ( $results as $result ){ ?>
            jQuery("#my_rating_field_label_product_"+<?php echo $result['id']; ?>+"-raty").raty({"half":true,"click":function(score, evt){ ratings(score,<?php echo $result['id']; ?>,1) },"score":<?php Ratings::model()->getRating( $result['id'], 0, 1 ); ?>,"target":"#my_rating_field_label_product_"+<?php echo $result['id']; ?>+""});jQuery("#my_rating_field_label_product_"+<?php echo $result['id']; ?>+"").hide();
      <?php } ?>   
         $('#myModalRate').bind('hide', function() {
            location.reload(true);
            }); 
        }
</script>
<script>
  function updateRatingProductShop(id, data) {
      <?php 
          $totalProduct = Yii::app()->db->createCommand("SELECT COUNT(*) FROM products_shop WHERE name like '".$_GET['condition']."'")->queryScalar();
          $criteria =  new CDbCriteria;
          $criteria->condition = "name like '".$_GET['condition']."'"; //"shop_id =".$this->membershop->id;//.
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
        }
</script>