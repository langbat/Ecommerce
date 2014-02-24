<?php error_reporting(0) ?>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Orders'); ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Orders'); ?></h1>      
            <ul class="buttons">
                <li><!-- <a class="isw-plus tipb" href="<?php //echo $this->createUrl('orders/create') ?>" data-original-title="<?php //echo Yii::t('global', 'Create'); ?> <?php //echo Yii::t('global', 'Orders'); ?>"></a>--></li>
            </ul>                        
        </div>
        <div class="block-fluid table-sorting">

            <?php
                $status = OrderStatus::getStatusOrder();
                $this->widget('zii.widgets.grid.CGridView', array(
            	'id'=>'orders-grid',
            	'dataProvider'=>$model->search(),
            	'filter'=>$model,
                'afterAjaxUpdate' => 'reinstallDatePicker',
            	'columns'=>array(
                    array(
                        'name'=>'id',
                        'header'=>Yii::t("global","Order number"),
                        'htmlOptions'=>array('width'=>'30'),
                        'value'=>'$data->id'
                    ),
                    array(
                        'name' => 'created',
                        'header'=>Yii::t("global","Order Date"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center; width:100px;'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'created',
                                'mode'=>'date',
                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_due_date',
                                    'size' => '10',
                                    'style' => 'text-align: center; border-right: 1px solid #dddddd;'
                                ),
                            ),
                            true)
                    ),
                    array(
                        'name'=>'status',
                        'header'=>Yii::t("global","Order Status"),
                        'filter'=>$status,
                        'value' => '$data->getStatusTrans($data->orderStatus->name)',
                    ),
                    array(
                        'name' => 'remaining_date',
                        'header'=>Yii::t("global","Remaining Date"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center; width:100px;'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'remaining_date',
                                'mode'=>'date',
                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_due_date_last',
                                    'size' => '10',
                                    'style' => 'text-align: center; border-right: 1px solid #dddddd;'
                                ),
                            ),
                            true)
                    ),
                    //array(
            //            'name'=>'product_number',
            //            'header'=>Yii::t('global','Products number'),
            //            'value' => 'count($data->items)',
            //            'type' => 'raw'
            //        ),
                    array(
                        'name'=>'product_name',
                        'header'=>Yii::t('global','Products'),
                        'value' => '$data->showItems()',
                        'type' => 'raw'
                    ),
                    
                    array(
                        'name' => 'username',
                        'header'=>Yii::t('global','User'),
                        'value' => '$data->user->username',
                        'type' => 'raw',
                        'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
                    
                    array(
                        'name' => 'amount',
                        'header'=>Yii::t('global','Total amount'),
                        'value' => 'Utils::number_format($data->amount)." &euro;"',
                        'type' => 'raw',
                        'htmlOptions'=>array('width'=>'60'),
                    ),
            		'billing_fullname',
                    'shipping_address',
            		/*'billing_address',		
            		'shipping_fullname',
            		'shipping_address',
            		'shipped',
            		'data',
            		'status',
            		*/
            		array(
            			'class'=>'CButtonColumn',
                        
            		),
            	),
            )); ?>
        </div>
    </div>
</div>