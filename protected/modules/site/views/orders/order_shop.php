<div class="content-block">
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
                    <h5><?php echo Yii::t('global','Orders shop');?></h5>
                    
                </div>
                <div class="info_profile1 fix-info-profile">
            <?php
                $columns = array();
                //var_dump($dataProvider);exit();
                $status = OrderStatus::getStatusOrder();
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'orders-grid',
                    'dataProvider' => $model->getOrderShopMan(),
                    'filter' => $model,
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'summaryText' => '',
                    'columns' => array(
                        array(
                            'name' => 'id',
                            'header' => Yii::t("global", "Order number"),
                            'htmlOptions' => array('width' => '110px'),
                            'value' => '$data->id'),
                        array(
                            'name' => 'created',
                            'header' => Yii::t("global", "Order Date"),
                            'headerHtmlOptions' => array('style' => 'text-align: center; width:120px;'),
                            'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model' => $model,
                                'attribute' => 'created',
                                'mode' => 'date',
                                'options' => array("dateFormat" => Yii::app()->locale->getDateFormat('medium_js'),
                                        'ampm' => true),
                                'language' => Yii::app()->language == 'en' ? '' : Yii::app()->language,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_due_date',
                                    'size' => '10',
                                    'style' => 'text-align: center; border-right: 1px solid #dddddd;'),
                                ), true)),
                        array(
                            'name' => 'status',
                            'header' => Yii::t("global", "Order Status"),
                            'filter' => $status,
                            'value' => '$data->getStatusTrans($data->orderStatus->name)',
                            ),
            
                        array(
                            'name' => 'product_name',
                            'header' => Yii::t('global', 'Products'),
                            'value' => '$data->showItems($data->shop_id)',
                            'type' => 'raw',
                            'htmlOptions' => array('width' => '210px'),
                            ),
            
                        /*    array(
                        'name' => 'shop_name',
                        'header'=>Yii::t('global','Shop'),
                        'value' => '$data->shop->name',
                        'type' => 'raw',
                        'htmlOptions'=>array('style'=>'text-align:center'),
                        ),
                        */
            
                        array(
                            'name' => 'username',
                            'header' => Yii::t('global', 'User'),
                            'value' => '$data->user->username',
                            'type' => 'raw',
                            'htmlOptions' => array('style' => 'text-align:center'),
                            ),
            
                        array(
                            'name' => 'amount',
                            'header' => Yii::t('global', 'Total amount'),
                            'value' => 'Utils::number_format($data->amount)." &euro;"',
                            'type' => 'raw',
                            'htmlOptions' => array('width' => '110px','style' => 'text-align:center'),
                            ),
                        array(
                            'name' => 'billing_fullname',
                            'type' => 'raw',
                           'htmlOptions' => array('width' => '120px'),
                        ),
                        array('class' => 'CButtonColumn', ),
                        ),
                    )); ?>
                  </div><!--#end info-->
              
            <?php } ?>
        </div>
    </div>
</div>