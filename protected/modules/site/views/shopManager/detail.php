<div class="content-block"> 
    <div class="span12" id="content-product">
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global', 'Messages'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php echo Yii::t('global', 'You have ') .'<a href="/messagesShopManager">' . messagesShop::model()->getNewMessage(Yii::app()->user->id) . '</a> ' . Yii::t('global', 'new messages'); ?>
                    </div>
                    <div class="content_button">
                        <a class="btn btn-lg " href="/messagesShopManager"><?php echo Yii::t('global', 'Views Messages'); ?></a>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div>
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global','Add live sale show'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php echo Yii::t('global','The direct line to your customers. So simple selling has never been! Place for free with just a few clicks Live Channel on Sale.'); ?>
                    </div>
                    <div class="content_button">
                        <div class="icon-live-sale"></div>
                        <a class="btn btn-lg btn-primary" href="/liveSale"><span style="color: #FFF;"><?php echo Yii::t('global', 'Create Live Show Sale'); ?></span></a>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div> 
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global','Book advertising place:'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php echo Yii::t('global','Increase your revenue easy through booking attractive advertisment place tosello.tv'); ?>
                    </div>
                    <div class="content_button">
                       <a class="btn btn-lg " href="/custompages/detail/<?php echo$notify[0]['alias']; ?>"><?php echo Yii::t('global', 'Detail'); ?></a>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div>
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global', 'Orders'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php echo Yii::t('global', 'Since your last logging in,') .' <a href="/orders/orderShop">' . count($totalorder) . '</a> ' . Yii::t('global', 'orders in your shop is made'); ?>
                        </div>
                    <div class="content_button">
                        <a class="btn btn-lg " href="/orders/orderShop"><?php echo Yii::t('global', 'Detail'); ?></a> 
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div> 
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global', 'Rating'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php if ($totalrating == 0) {
                                echo Yii::t('global', 'Your shop was not rated.');
                            } else {
                                echo Yii::t('global', 'Your shop have ') . '<a href="/shopRatings/detail/' . $membershop->id . '">' . $totalrating .'</a>'. Yii::t('global', ' rated.'); ?>
                                <div class="content_button">
                                   <a class="btn btn-lg " href="/shopRatings/detail/<?php echo $membershop->id; ?>"><?php echo Yii::t('global', 'Detail'); ?></a>
                                </div>
                           <?php } ?>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div> 
        <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global', 'Customer'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                        <?php if ($totalcustomer > 0) {
                                echo Yii::t('global', 'Your shop have '); ?>
                                <a href="/orders/customer/<?php echo $membershop->id; ?>"><?php echo $totalcustomer ?></a>
                                <?php echo Yii::t('global', ' customer.'); ?>
                           <div class="content_button">
                                <a class="btn btn-lg" href="/orders/customer/<?php echo $membershop->id; ?>"><?php echo Yii::t('global', 'Detail'); ?></a>
                           </div>
                        <?php } else {
                            echo Yii::t('global', 'No Customer');
                        }?>
                </div> 
            </div>
            <div class="clearfix"></div> 
        </div> 
    </div>
      <div class="span4 article"> 
            <div class="block-product">
                <span class="headline"><?php echo Yii::t('global', 'Products'); ?><i class="fa fa-sort-down"></i></span>
                <div class="head-tab_bullet"></div>
                <div class="block-content"> 
                    <div class="description">
                          <?php if ($totalproducts == 0) {
                                echo Yii::t('global', 'Your shop was not products.');
                            } else {
                                echo Yii::t('global', 'Your shop have ');
                                echo ' <a href="/productShopManager/index">' . $totalproducts . '</a> ' . Yii::t('global', ' product') ;
                            } ?>
                          <div class="content_button">
                            <a class="btn btn-lg " href="/productShopManager/index"><?php echo Yii::t('global', 'Detail'); ?></a> 
                        </div>
                    </div>
            </div>
            <div class="clearfix"></div> 
        </div> 
    </div>
</div>