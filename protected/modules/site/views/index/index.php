<div class="around-product-lastest">
    <div class="margin-product-lastest">
    <div class="detail_product">
        <?php 
        $productdetail = Products::model()->findByPk( Products::GetIdVideoLastest() );
        $criteria =  new CDbCriteria();
        $criteria->condition = 'item_id = '.Products::GetIdVideoLastest();
        $count_ordered = OrderItems::model()->findAll($criteria);
        $this->renderPartial('/elements/last_product', compact('productdetail', 'sessionId', 'token','count_ordered'));?>
    </div>
    </div>
</div>

        <?php  $this->renderPartial('/elements/today-specials', compact('productdetail') ); ?>    
        <?php $this->renderPartial('/elements/shop-products'); ?>             
        <?php $this->renderPartial('/elements/shop-user-week'); ?>
        <?php $this->renderPartial('/elements/adv-bottom'); ?>
        <?php $this->renderPartial('/elements/label-products'); ?>
        <?php $this->renderPartial('/elements/shop-main'); ?>
        <?php $this->renderPartial('/elements/news-shop'); ?>
        <?php //$this->renderPartial('/elements/tags'); ?>