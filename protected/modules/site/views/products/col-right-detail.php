<div class="text">
    <span class="bold-tab fix-size-font"><?php  echo Yii::t('global','Direct purchasing'); ?></span>
    <p><?php  echo Yii::t('global','Buy this product online now. Our price'); ?></p>
    <span class="nur bold-tab"><?php  echo Yii::t('global','only'); ?></span>
    <span class="bold-tab"> <?php echo Utils::number_format($product->direct_buy_price)?> &euro;</span>
    <p>
        (<?php  echo Yii::t('global','statt'); ?>
        <span class="statt"><?php echo Utils::number_format($product->price)?> &euro; )</span>
    </p>
    <div class="product-content"><a class="btn-kaufen pull-left fix-bid btn_buy" href="javascript:void(0)" data-id="<?php echo $product->id?>"><?php  echo Yii::t('global','Buy'); ?></a></div>
    <div class="clearfix"></div>
</div>

<div id="myModal2" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Confirm message')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php echo Yii::t('global','Product will be put in Shopping cart ')  ?>
            <div class="bnt_confirm">
                <button class="btn btn-warning agree" type="button"> <?php echo Yii::t('global','Yes')  ?></button>
                <button class="btn " type="button eject"> <?php echo Yii::t('global','No')  ?></button>
            </div>

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>
