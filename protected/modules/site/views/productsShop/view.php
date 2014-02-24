<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="wrapper_profile">
            <div class="slider-box purple-grid fix-boder">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="title"><h5><?php echo Yii::t('global','View Products Shops');?></h5></div>
                    <div class="info_profile fix-info-profile">
                        <?php $this->widget('zii.widgets.CDetailView', array(
                            	'data'=>$model,
                        	'attributes'=>array(
                        		'name',
                                 array(
                                    'label'=>Yii::t('global','Price'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>Utils::number_format($model->price)." €",
                                    ),
                                 array(
                                    'label'=>Yii::t('global','Price purchase'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>Utils::number_format($model->price_purchase)." €",
                                    ),
                                 array(
                                    'label'=>Yii::t('global','Direct buy price'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>Utils::number_format($model->direct_buy_price)." €",
                                    ),
                                 'shop.name', 
                                array(
                                    'label'=>Yii::t('global', 'Category'),
                                    'type'=>'raw',
                                    'value'=>$model->getProductCategoryShop( $model->id ),
                                ),                   
                                array(
                                    'name' => 'image',
                                     'cssClass'=>'fix-null-img',
                                    'type'=>'raw',
                                    'value' => '<a class="fancybox" href="/uploads/product_shop/'.$model->image.'" rel="group"><img src="/uploads/product_shop/'.$model->image.'" style="height: 90px;"></a>'
                                ),
                        		
                        		'short_desciption',
                        		//'description',
                        		array(
                                                    'label'=>Yii::t('global','Shipping cost'),
                                                    'type'=>'raw',
                                                    'cssClass'=>'fix-null',
                                                    'value'=>Utils::number_format($model->shipping_cost)." €",
                                    ),   
                                 array(
                                                    'name'=>'is_active',
                                                    'type'=>'raw',
                                                    'value'=>Products::model()->getStatusProduct($model->is_active),
                                                    'cssClass'=>'fix-null'
                                                ),
                        		'created',
                        		'updated',
                        	),
                        )); ?>
                    </div><!--#end info-->
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
    </div><!--#end col-left-->

    <div class="pull-left col-right">
        <?php if(Yii::app()->user->isGuest){ ?>
            <?php $this->renderPartial('/elements/right-ads');?>
            <?php //$this->renderPartial('/elements/auction-finished');?>
            <?php $this->renderPartial('/elements/tested-safety');?>
            <?php $this->renderPartial('/elements/news-box');?>
        <?php }else{ ?>
            <div class="right-box">
                <?php $this->renderPartial('/elements/profile-menu')?>
            </div>
            <?php //$this->renderPartial('/elements/right-ads');?>
            <?php //$this->renderPartial('/elements/auction-finished');?>
            <?php //$this->renderPartial('/elements/tested-safety');?>
            <?php //$this->renderPartial('/elements/news-box');?>
        <?php } ?>
    </div><!--#end col-right-->

    <div class="clearfix"></div>
</div>






