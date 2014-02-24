<div class="pull-left col-left">    
        <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid ">
            <?php $this->renderPartial('steps', array('step' => 1))?>
            <?php if (!$is_has_item):?>
            <div class="vote-content fix-cart">
                <?php echo Yii::t('global', 'You have no items in your shopping cart.')?>
                
                <div>
					<a class="bt_colo" href="/"><?php echo Yii::t('global', 'Continue shopping')?></a>
				</div>
            </div>
            <?php else: ?>
            <?php //echo CHtml::form('', 'post', array('id' => 'cart-form')); ?>
            <div class="vote-content">
                <?php
                if (is_array($products) && count($products))
                    $this->renderPartial('cart-products', compact('products'));
                if (is_array($product_shop) && count($product_shop)){
                    foreach($product_shop as $key=> $product_shop_item){
                        $this->renderPartial('cart-products_shop', array('products'=>$product_shop_item,'session_name'=>$key));
                    }

                }
                    //$this->renderPartial('cart-result', compact('products'));
                ?>
				<div>
					<a class="bt_colo" href="/"><?php echo Yii::t('global', 'Continue shopping')?></a>
                    <?php /*if ($is_has_item):*/?><!--
					   <input class="btn-kaufen fix-checkout" type="submit" value="<?php /*echo Yii::t('global', 'Checkout')*/?>" />
                    --><?php /*endif; */?>
				</div>
                <div class="clearfix"></div> 
           
                <div class="clearfix"></div>
            </div>
            <?php //echo CHtml::endForm(); ?>
            <?php endif;?>          
        </div>
    </div><!--#end vote-wrapper-->

</div><!--#end col-left-->

<div class="pull-left col-right">
     <?php if(!Yii::app()->user->isGuest){ ?>
        <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
        </div>
     <?php } ?>
     <div class="right-box">
        <?php $this->renderPartial('/elements/tested-safety');?>
    </div>
</div><!--#end col-right-->
<script type="text/javascript">


function removeCouponItem(obj){
    $(obj).parent().parent().fadeOut('slow', function(){
        $(this).remove();
        cartState();
        if ($('#coupons table.table tr').length == 1){
            $('#coupons').hide();
        }
    });
}


</script>