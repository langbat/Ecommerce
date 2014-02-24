<?php echo CHtml::form('', 'post', array('id' => 'cart-form-'.$session_name)); ?>
    <div>
        <div class="derek fix-cart-derek "><b><?php echo Yii::t('global', 'Provider ');  ?><a class="shop_name_<?php echo $session_name ?>" href=""> </a> </b></div>
        <table class="table introduce introduce_<?php echo $session_name ?>">
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
            $cart =  Yii::app()->session[$session_name];
            
            $shop_name ='';
            $shop_id='';
            foreach ($products as $product):
                $shop_name = $product->shop->name;
                $shop_id = $product->shop->id;
                foreach ($cart as $product_id => $item){
                    if ($product->id == $product_id){
                        break;
                    }
                }
                ?>
                <tr class="product product_<?php echo $product_id ?>">
                    <input type="hidden" class="typeShop" name="typeShop" value="<?php echo $shop_id ?>"/>
                    <td><a href="/productsshop/detail/<?php echo $shop_id?>/<?php echo $product->id?>"><img <?php echo 'src="/uploads/product_shop/'.$product->image.'"'?> /></a></td>
                    <td><p class="fix-title fix-line-menu fix_height_product_name"><a href="/productsshop/detail/<?php echo $shop_id?>/<?php echo $product->id?>" ><?php echo $product->name?></a></p>
                        <p style="float: left;width: 100%;"><?php echo Yii::t('global', 'Added')?>: <?php echo Utils::date_format($item['added']) ?></p></td>
                    <td><b><?php echo Utils::number_format($product->direct_buy_price)?> &euro;</b></td>
                    <td>
                        <input class="numberic_only product-qty product-qty_<?php echo $shop_id ?>" name="Auctions[qty_<?php echo $shop_id?>][<?php echo $product->id?>]" value="<?php echo $item['qty']?>" maxlength="3" style="width: 30px;" />
                    </td>
                    <td><b id="<?php echo $shop_id ?>_product-price-<?php echo $product->id?>"><?php echo Utils::number_format($product->direct_buy_price*$item['qty'])?> &euro;</b></td>

                    <td class="imgs"><a href="javascript:void(0)" onclick="removeCartItemShop<?php echo $shop_id ?>(this, <?php echo $product->id?>)"><img src="/themes/default/img/close.png" /></a></td>
                </tr>

            <?php endforeach;?>
        </table>
        <?php  $this->renderPartial('cart-result', compact('products','shop_id')); ?>

    </div>
<script type="text/javascript">
    $(document).ready(function(){
       $('.shop_name_<?php echo $session_name ?>').html(' <?php echo $shop_name ?>');
       $('.shop_name_<?php echo $session_name ?>').attr('href','/shop/detail/<?php echo $shop_id ?>');
    });
</script>
<?php echo CHtml::endForm(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.product-qty_<?php echo $shop_id ?>').change(function(){cartState<?php echo $shop_id ?>()});
       // $('.bid-item, .product-opt').click(function(){cartState()});
        cartState<?php echo $shop_id ?>();
    });
    function cartState<?php echo $shop_id ?>(){
        $.ajax( {
            type: "POST",
            url: '/cart/state?shop_id=<?php echo $shop_id ?>',
            data: $('#cart-form-<?php echo $session_name ?>').serialize(),
            success: function(data) {
                //$('.cart-wrapper').html(data);
                data = eval('(' + data + ')');
                //var shop_id = <?php echo $shop_id ?>;
                $.each(data, function(key, value){
                    $('#<?php echo $shop_id ?>_' + key).html(value + ' &euro;');
                });

                $('.cart_count').text(data.cart_count);

                if (parseInt(data.credit_products) != 0) $('#frm_credit_products').show();
                else  $('#frm_credit_products').hide();

                if (parseInt(data.credit_balance) != 0) $('#frm_credit_balance').show();
                else  $('#frm_credit_balance').hide();
            }
        })
    }

    function removeCartItemShop<?php echo $shop_id ?>(obj, id){
        $(obj).parent().parent().fadeOut('slow', function(){
            $(this).remove();
            cartState<?php echo $shop_id ?>();
        });
        var n = $(obj).parent().parent().parent().find('.product').size();
        if((n-1)==0){
            //$('.product_'+id).parent().parent().parent().html('');
            $('.introduce_<?php echo $session_name ?>').parent().html('');
        }
        $.get('/cart/remove?id='+id+'&shop_id=<?php echo $shop_id ?>');
    }
</script>