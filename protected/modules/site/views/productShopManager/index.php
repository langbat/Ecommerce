
        <div class="wrapper_profile">
            <div class="slider-box purple-grid">
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
                        <div class="create_link"><a class="isw-plus tipb" href="/productShopManager/create" title="<?php echo Yii::t('global','Create Products Shop') ?>"></a> </div>
                    </div>
                    <div class="info_profile1 fix-info-profile">
                        <?php
                         $catProducts = CategoriesShop::getAllCategoryShop();
                         $active_product = Products::model()->getActiveProduct();
                        // $productShops = ProductsShop::getProductShopByShopId(1);
                        //var_dump($model);exit();
                         
                        $this->widget('zii.widgets.grid.CGridView', array(
                           	'id'=>'products-shop-grid',
                        	'dataProvider'=>$model->search(),
                            'summaryText'=>'',
                            'filter'=>$model,
                            	'columns'=>array(
                            array(
                                'name'=>'id',
                                'htmlOptions'=>array('style'=>'width:60px;')
                            ),
                            array(
                                'name'=>'is_active',
                                'header'=>Yii::t('global','Active Product'),
                                'type' => 'raw',
                                'filter'=>$active_product,
                                'value' => 'Products::model()->getStatusProduct($data->is_active)',
                                'htmlOptions'=>array('style'=>'width:130px;')
                            ),
                    		'name',
                            array(
                                'name'=>'categoryname',
                                'header'=>Yii::t('global','Category name'),
                                'type'=>'raw',
                                'filter'=>$catProducts,
                                'value'=>'ProductsShop::model()->getProductCategoryShopBE( $data->id )',
                                'htmlOptions'=>array('style'=>'width:150px;')
                            ),
                            array(
                                'name'=>'price',
                                'value'=>'Utils::number_format($data->price)." €"',
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


                                array(
                                    'class'=>'CButtonColumn',
                                    'template'=> '{view}{update}{delete}',
                                    'htmlOptions'=>array('style'=>'width:50px;')
                                ),
                            ),
                        ));
                        Yii::app()->clientScript->registerScript('re-install-date-picker', "
                        function reinstallDatePicker(id, data) {
                            $('#Orders_created').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['".(Yii::app()->language=='en'?'':Yii::app()->language)."'], {'dateFormat':'".Yii::app()->locale->getDateFormat('medium_js')."'}));
                        }");
                        ?>
                    </div><!--#end info-->
                  
                <?php } ?>
            </div>
        </div>
    






