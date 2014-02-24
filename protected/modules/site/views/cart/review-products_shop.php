<?php
$cart =  Yii::app()->session['cart_'.Yii::app()->session['shop_buy']];
$shop_id = 0;
$i=0;
foreach ($products_shop as $product){
    if ($product->shop->id != $shop_id ){
        if($shop_id !=0) echo "</table>";  ?>
        <div class="derek fix-cart-derek "><b><?php echo Yii::t('global', 'Provider ');  ?><a href="/shop/detail/<?php echo $product->shop->id  ?>"> <?php echo $product->shop->name ?></a> </b></div>
        <table class="table introduce">
            <tr>
                <th></th>
                <th><?php echo Yii::t('global', 'Product')?></th>
                <th><?php echo Yii::t('global', 'Unit Price')?></th>
                <th><?php echo Yii::t('global', 'Quantity')?></th>
                <th><?php echo Yii::t('global', 'Subtotal')?></th>
            </tr>
    <?php }
        foreach ($cart as $product_id => $item){
        if ($product->id == $product_id){
            break;
        }
    }
            ?>
	<tr class="product">
		<td><a href="/products/detail/<?php echo $product->id?>"><img <?php echo 'src="/uploads/product_shop/'.$product->image.'"'?> /></a></td>
		<td><p class="fix-title fix-line-menu"><a href="/products/detail/<?php echo $product->id?>" ><?php echo $product->name?></a></p>
        <p style="float: left;width: 100%;"><?php echo Yii::t('global', 'Added')?>: <?php echo Utils::date_format($item['added']) ?></p></td>
		<td><b><?php echo Utils::number_format($product->direct_buy_price)?> &euro;</b></td>
        <td style="text-align: center;">
            <?php echo $order['items']['Shop']['qty_'.Yii::app()->session['shop_buy']][$product->id]?>
        </td>
		<td><b id="product-price-<?php echo $product->id?>"><?php echo Utils::number_format($product->direct_buy_price*$item['qty'])?> &euro;</b></td>
    </tr>

<?php
    if($product->shop->id != $shop_id && $shop_id !=0){
        echo "</table>";
    } else if(++$i ===count($products_shop)){
        echo "</table>";
    }
    $shop_id = $product->shop->id;
}
?>