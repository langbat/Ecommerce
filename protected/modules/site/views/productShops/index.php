<div class="content-block">
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
                    <div class="title">
                        <h5><?php echo Yii::t('global','Products Shops');?></h5>
                        <div class="create_link"><a class="isw-plus tipb" href="/productsShop/create" title="<?php echo Yii::t('global','Create Products Shop') ?>"></a> </div>
                    </div>
                    <div class="info_profile1 fix-info-profile">
                        <?php
                         $catProducts = CategoriesShop::getAllCategoryShop();
                         $active_product = Products::model()->getActiveProduct();
                         $productShops = ProductsShop::getProductShopByShopId(1);
                         //var_dump($model);exit();
                         
                        $this->widget('zii.widgets.grid.CGridView', array(
                           	'id'=>'products-shop-grid',
                        	'dataProvider'=>$model->search(),
                             'summaryText'=>'',
                            'filter'=>$model,
                            	'columns'=>array(
                            array(
                                'name'=>'id',
                                'htmlOptions'=>array('style'=>'width:50px;')
                            ),
                            array(
                                'name'=>'is_active',
                                'header'=>Yii::t('global','Active Product'),
                                'type' => 'raw',
                                'filter'=>$active_product,
                                'value' => 'Products::model()->getStatusProduct($data->is_active)',
                                'htmlOptions'=>array('style'=>'width:100px;')
                            ),
                    		'name',
                            array(
                                'name'=>'categoryname',
                                'type'=>'raw',
                                'filter'=>$catProducts,
                                'value'=>'ProductsShop::model()->getProductCategoryShop( $data->id )',
                                'htmlOptions'=>array('style'=>'width:150px;')
                            ),
                            array(
                                'name'=>'price',
                                'htmlOptions'=>array('style'=>'width:100px;')
                            ),
                    		//'price_purchase',
                    		//'direct_buy_price',
                    		array(
                                'header'=>Yii::t('global','Image'),
                                'type' => 'raw',
                                'value' => '$data->showAdminImageShop()',
                                'htmlOptions'=>array('style'=>'width:80px;')
                            ),
                          
                    		/*
                    		'short_desciption',
                    		'description',
                    		'shipping_cost',
                    		'category_id',
                    		'is_active',
                    		'created',
                    		'updated',
                		*/
                                array(
                                    'class'=>'CButtonColumn',
                                    'template'=> '{update}{delete}',
                                     'htmlOptions'=>array('style'=>'width:20px;')
                                ),
                            ),
                        ));
                        Yii::app()->clientScript->registerScript('re-install-date-picker', "
                        function reinstallDatePicker(id, data) {
                            $('#Orders_created').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['".(Yii::app()->language=='en'?'':Yii::app()->language)."'], {'dateFormat':'".Yii::app()->locale->getDateFormat('medium_js')."'}));
                        }");
                        ?>
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





