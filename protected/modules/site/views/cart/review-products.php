<div class="derek fix-cart-derek"><b><?php echo Yii::t('global', 'Provider')?> <span class="shop_name"></span> </b></div>
<table class="table introduce">	
    <tr>
		<th></th>
		<th><?php echo Yii::t('global', 'Product')?></th>
		<th><?php echo Yii::t('global', 'Unit Price')?></th>
		<th><?php echo Yii::t('global', 'Quantity')?></th>
		<th><?php echo Yii::t('global', 'Subtotal')?></th>
        <!--<th><?php /*echo Yii::t('global', 'Credit')*/?></th>-->
	</tr>	
    <?php
    $cart =  Yii::app()->session['cart_'.Yii::app()->session['shop_buy']];
     global $shop_name ;
    foreach ($products as $product):
        if(Yii::app()->session['shop_buy'] ==0){
            $shop_name= "Tosello";
        } else {
            $shop_name = $product->shop->name;
        }
        foreach ($cart as $product_id => $item){
            if ($product->id == $product_id){
                break;
            }
        }
        if(!isset($item)) continue;
        $price =(Yii::app()->session['shop_buy'] !=0)?$product->direct_buy_price:$product->price -(($product->price * $product->discount_percent)/100);
    ?>
	<tr class="product">
        <?php if(Yii::app()->session['shop_buy'] ==0){ ?>
            <td><a href="/products/detail/<?php echo $product->id?>"><img <?php echo 'src="/uploads/product/'.$product->image.'"' ?>    /></a></td>
            <td><p class="fix-title fix-line-menu fix_height_product_name" ><a href="/products/detail/<?php echo $product->id?>"><?php echo $product->name?></a></p>
        <?php } else { ?>
            <td><a href="/productsshop/detail/<?php echo Yii::app()->session['shop_buy']."/". $product->id?>"><img <?php echo 'src="/uploads/product_shop/'.$product->image.'"' ?>    /></a></td>
            <td><p class="fix-title fix-line-menu" ><a href="/products/detail/<?php echo $product->id?>"><?php echo $product->name?></a></p>
        <?php } ?>
        <br/><p style="float: left;width: 100%;"><?php echo Yii::t('global', 'Added')?>: <?php echo Utils::date_format($item['added']) ?></p></td>
		<td><b><?php echo Utils::number_format($price)?> &euro;</b></td>
		<td style="text-align: center;">
            <?php echo $order['items']['Auctions']['qty_'.Yii::app()->session['shop_buy']][$product->id]?>
		</td>
		<td><b id="product-price-<?php echo $product->id?>"><?php echo Utils::number_format($price*$item['qty'])?> &euro;</b></td>

	</tr>
    <?php endforeach;?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.shop_name').html('<?php echo $shop_name ?>');
        })
    </script>
</table>
