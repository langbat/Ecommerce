<div class="content" id="blogdetail">
<?php 
if( (isset($blogshop)) && ($blogshop->getData() != null)) { ?>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$blogshop,
        	'itemView'=>'../elements/blog-shop-box-item',
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