<?php echo CHtml::form('', 'post', array('id' => 'cart-form-0')); ?>
<div>
<div class="derek fix-cart-derek"><b><?php echo Yii::t('global', 'Provider ')?> Tosello</b></div>
<table class="table introduce introduce_0 ?>">
    <tr>
		<th></th>
		<th><?php echo Yii::t('global', 'Product')?></th>
		<th><?php echo Yii::t('global', 'Unit Price')?></th>
		<th><?php echo Yii::t('global', 'Quantity')?></th>
		<th><?php echo Yii::t('global', 'Subtotal')?></th>
        <!--<th><?php /*echo Yii::t('global', 'Credit')*/?></th>-->
		<th></th>
	</tr>	
    <?php
    $cart =  Yii::app()->session['cart_0'];

    foreach ($products as $product):
        foreach ($cart as $product_id => $item){
            if ($product->id == $product_id){
                break;
            }
        }
    ?>
	<tr class="product ">
        <input type="hidden" class="typeShop" name="typeShop" value="0"/>

		<td><a href="/products/detail/<?php echo $product->id?>"><img <?php echo 'src="/uploads/product/'.$product->image.'"'?> /></a></td>
		<td><p class="fix-title fix-line-menu fix_height_product_name"><a href="/products/detail/<?php echo $product->id?>" ><?php echo $product->name?></a></p>
        <p style="float: left;width: 100%;"><?php echo Yii::t('global', 'Added')?>: <?php echo Utils::date_format($item['added']) ?></p></td>
		<td><b><?php echo Utils::number_format($product->price -(($product->price * $product->discount_percent)/100))?> &euro;</b></td>
		<td>
            <input class="numberic_only product-qty product_qty_0" name="Auctions[qty_0][<?php echo $product->id?>]" value="<?php echo $item['qty']?>" maxlength="3" style="width: 30px;" />
		</td>
		<td><b id="0_product-price-<?php echo $product->id?>"><?php echo Utils::number_format($product->price -(($product->price * $product->discount_percent)/100)*$item['qty'])?> &euro;</b></td>

		<td class="imgs"><a href="javascript:void(0)" onclick="removeCartItem(this, <?php echo $product->id?>)"><img src="/themes/default/img/close.png" /></a></td>
	</tr>
    <?php endforeach;?>
</table>
    <?php
    $shop_id = 0;
    $this->renderPartial('cart-result', compact('products','shop_id')); ?>

</div>

<?php echo CHtml::endForm(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.product_qty_0').change(function(){cartState0()});
        //$('.bid-item, .product-opt').click(function(){cartState()});
        cartState0();
    });
    function cartState0(){
        $.ajax( {
            type: "POST",
            url: '/cart/state?shop_id=0',
            data: $('#cart-form-0').serialize(),
            success: function(data) {
                //$('.cart-wrapper').html(data);
                data = eval('(' + data + ')');
                $.each(data, function(key, value){
                    $('#0_' + key).html(value + ' &euro;');
                });
                $('.cart_count').text(data.cart_count);
            }
        })
    }

    function removeCartItem(obj, id){
        $(obj).parent().parent().fadeOut('slow', function(){
            $(this).remove();
            cartState0();
        });
        var n = $(obj).parent().parent().parent().find('.product').size();
        if((n-1)==0){
            $('.introduce_0').parent().html('');

        }
        $.get('/cart/remove?id='+id+'&shop_id=0');
    }
</script>