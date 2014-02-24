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
                    <div class="title"><h5><?php echo Yii::t('global','My orders');?></h5></div>
                    <div class="info_profile fix-info-profile">
                        <?php
                        $statuses = OrderStatus::getStatusOrder();
                        $this->widget('zii.widgets.grid.CGridView', array(
                        	'id'=>'orders-grid',
                            'summaryText'=>'',
                        	'dataProvider'=>$model->search(),
                        	'filter'=>$model,
                            'afterAjaxUpdate' => 'reinstallDatePicker',
                        	'columns'=>array(
                        		//'id',
                        		array(
                                    'name' => 'created',
                                    'htmlOptions'=> array('style' => 'text-align: center;max-width: 20%'),
                                    'filter' => $this->widget('CJuiDateTimePicker', array(
                                            'model'=>$model,
                                            'attribute'=>'created',
                                            'mode'=>'date',
                                            'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                            'language' => Yii::app()->language=='en'?'':Yii::app()->language
                                        ),
                                    true)
                                ),
                                //'shipping_address',
                                array(
                                    'header' => Yii::t('global','Product'),
                                    'value' => 'OrderItems::model()->getInfoProductOrder($data->id,$data->shop_id)',
                                    'type' => 'raw',
                                    'htmlOptions'=> array('style' => 'text-align: left;max-width: 20%')
                                ),
                        		array(
                                    'name' => 'amount',
                                    'value' => 'Utils::number_format($data->amount)." &euro;"',
                                    'type' => 'raw',
                                    'htmlOptions'=> array('style' => 'text-align: center;max-width: 20%')
                                ),

                        		array(
                                    'name' => 'status',
                                    'filter'=>$statuses,
                                    'value' =>'$data->getStatusTrans($data->orderStatus->name)',
                                    'htmlOptions'=> array('style' => 'max-width: 20%')
                                ),
                        		/*
                        		'shipped',
                        		*/
                                array(
                                    'htmlOptions'=> array('class' => 'detail_order','style' => 'max-width: 20%'),
                                    'type' => 'html',
                                    'value' => 'CHtml::link(Yii::t("global","Detail"),array("profile/order_view/","id"=>"$data->id"))'
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

