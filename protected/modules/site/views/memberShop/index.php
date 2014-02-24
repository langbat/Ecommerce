<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="wrapper_profile">
            <div class="slider-box purple-grid fix-boder">
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php
                } else { ?>
                    <div class="title">
                        <h5><?php echo Yii::t('global', 'My shops'); ?></h5>
                    </div>
                    <div class="product-wrapper show-grid">
                    <?php if ((isset($membershop)) && ($membershop != null)) { 
                                foreach($membershop as $value){ ?>
                                <div class="wrapper-active">
                                    <div class="span2 product-content fix-content">
                                        <div class="product-image">
                                            <a href="/shop/detail/<?php echo $value['id']; ?>"><img class="product" <?php echo 'src="/uploads/logoshop/' . $value['image'] . '"' ?> alt="<?php echo $value['name'] ?>" /></a>
                                        </div>
                                        <p class="fix-title" id="name-shop-index"><a href="/shop/detail/<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></p>
                                        <div class="clearfix"></div>
                                        <?php /*if(Yii::app()->user->id){*/ ?>
                                        <a href="/shop/detail/<?php echo $value['id'] ?>" data-id="<?php echo $value['id'] ?>" class="btn-kaufen"><?php echo Yii::t('global', 'Detail') ?></a>
                                        <p class="nur"><strong><?php echo Yii::t('global','') ?> <span class="big"><?php echo $value['slogan'] ?></span></strong></p>
                                                <ul style="list-style: none; ">
                                                    <li>
                                                        <span class="rating_new_shop">
                                                            <?php $this->widget('ext.dzRaty.DzRaty', array(
                                                                'name' => 'my_rating_shop_id_' . $value['id'],
                                                                'value' => ShopRatings::model()->getRatingShop($value['id']),
                                                                'options' => array(
                                                                    'half' => true,
                                                                    'click' => "js:function(score, evt){ shop_ratings(score," . $value['id'] .
                                                                        ") }",
                                                    
                                                                    ),
                                                                'htmlOptions' => array('class' => 'new-half-class'),
                                                                ));
                                                            $this->renderPartial('../elements/rate_product');
                                                            ?>
                                                        <div class="count-rating-final" >( <?php ShopRatings::model()->totalRatingShop( $value['id']); ?> )</div>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </p>
                                        <p class="nur">
                                        <?php echo $numberproduct .' '. Yii::t('global', 'Product'); ?></p>
                                    </div>
                                </div>
                               <?php  } } else { ?>
                                 <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                     <?php echo Yii::t('global', 'No results found.')?>
                                 </div>
                                <?php }
                            } ?>
                             </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
    </div>

    <div class="pull-left col-right">
        <?php if (Yii::app()->user->isGuest) { ?>
            <?php $this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php $this->renderPartial('/elements/tested-safety'); ?>
            <?php $this->renderPartial('/elements/news-box'); ?>
        <?php } else { ?>
            <div class="right-box">
                <?php $this->renderPartial('/elements/profile-menu') ?>
            </div>
            <?php //$this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php //$this->renderPartial('/elements/tested-safety'); ?>
            <?php //$this->renderPartial('/elements/news-box'); ?>
        <?php } ?>
    </div><!--#end col-right-->

    <div class="clearfix"></div>
</div>

