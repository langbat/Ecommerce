<div class="content">
<?php if((isset($product)) && ($product->itemCount) > 0){ ?>
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
    	'dataProvider'=>$product,
    	'itemView'=>'../elements/product-shop-box-item',
        'id'=>'item',
        'afterAjaxUpdate' => 'updateRating',
        ));
    ?>
   </div>
   <?php } else{ ?>
        <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php echo Yii::t('global', 'No results found.')?>
        </div>
   <?php } ?>
</div>
<script>
  function updateRating(id, data) {
      <?php 
          $totalProduct = count(ProductsShop::getProductShopByIdShop($_GET['shop_id']));
          $criteria =  new CDbCriteria;
          $criteria->condition = "shop_id =".$this->membershop->id;//." and name like '".$_GET['condition']."'"
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