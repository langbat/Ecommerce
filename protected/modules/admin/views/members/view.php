<?php error_reporting(0); ?>
<div class="workplace">
    <div class="page-header">
        <h1><?php echo Yii::t('global','User info'); ?> <small><?php echo $model->username; ?></small></h1>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <div class="row-fluid">
                <div class="span3">
                    <div class="ucard clearfix">
                        <div class="right">
                            <h4><?php echo $model->username; ?></h4>
                            <ul class="control">
                                <li><span class="icon-pencil"></span><a href="<?php echo $this->createUrl('/admin/members/update',array('id'=>$model->id)); ?>"> <?php echo Yii::t('global','Edit'); ?></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="span9" >
                    <div class="block-fluid ucard">
                        <div class="info">
                            <ul class="rows" >
                                <li class="heading"><?php echo Yii::t('global','User info'); ?></li>
                                <div class="block-fluid scrollBox withList">
                                    <div class="scroll mCustomScrollbar _mCS_1">
                                        <div id="mCSB_1" class="mCustomScrollBox1">
                                            <div class="mCSB_container" style="position:relative; top:0;">

                                                <?php $this->widget('zii.widgets.CDetailView', array(
                                                    'data'=>$model,
                                                    'attributes'=>array(
                                                        array('name'=>'fname','cssClass'=>'fix-null'),
                                                        array('name'=>'lname','cssClass'=>'fix-null'),
                                                        'email',
                                                        array('name'=>'street','cssClass'=>'fix-null'),
                                                        array('name'=>'nr','cssClass'=>'fix-null'),
                                                        array('name'=>'postcode','cssClass'=>'fix-null'),
                                                        array('name'=>'city','cssClass'=>'fix-null'),
                                                        array('name'=>'phone','cssClass'=>'fix-null'),
                                                        array(
                                                            'label'=>Yii::t('global','Joined'),
                                                            // here's a parameter that disable HTML escaping by Yii
                                                            'value'=>date("F j",strtotime($model->joined)),

                                                        ),
                                                        array(
                                                            'label'=>Yii::t('global','Country'),
                                                            'value'=>$model->country->short_name,
                                                        ),
                                                    ),
                                                )); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="span6">
            <div class="head clearfix">
                <div class="isw-calc"></div>
                <h1><?php echo Yii::t('global','My orders'); ?></h1>
            </div>
            <div class="block-fluid">
                <?php
                $statuses = OrderStatus::getStatusOrder();
                $orders = new Orders('search');
                $orders->unsetAttributes();  // clear any default values
                $orders->user_id = $_GET['id'];
                if(isset($_GET['Orders']))
                    $orders->attributes=$_GET['Orders'];
                 
                $this->widget('zii.widgets.grid.CGridView', array(
                	'id'=>'orders-grid-order',
                    'summaryText'=>'',
                	'dataProvider'=>$orders->search(),
                	'filter'=>$orders,
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'enablePagination' => true,
                    'enableSorting' => true,
                    'columns'=>array(
                		//'id',
                    array(
                        'name' => 'created',
                        'header'=>Yii::t("global","Date/Time"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$orders,
                                'attribute'=>'created',
                                'mode'=>'date',
                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                                'htmlOptions' => array('id' => 'datepicker_for_due_date'),
                            ),
                            true)
                    ),
                    array(
                        'header' => Yii::t('global','Product'),
                        'value' => 'CHtml::link(OrderItems::model()->getInfoProductOrder($data->id,$data->shop_id),array("orders/view/","id"=>"$data->id"))',
                        'type' => 'raw',
                        'htmlOptions'=> array('style' => 'text-align: left')
                    ),
                    array(
                        'name' => 'amount',
                        'value' => 'Utils::number_format($data->amount)." &euro;"',
                        'type' => 'raw',
                        'htmlOptions'=> array('style' => 'text-align: center')
                    ),

            		array(
                        'name' => 'status',
                        'filter'=>$statuses,
                        'value' => '$data->getStatusTrans($data->orderStatus->name)'
                            ),
                    //array(
//                        'htmlOptions'=> array('class' => 'detail_order'),
//                        'type' => 'html',
//                        'value' => 'CHtml::link("<i class=\"icon-zoom-in\"></i>",array("orders/view/","id"=>"$data->id"))'
//                    ),

                	),
                ));
                
                ?>
            </div>

        </div>
   
        
    </div>
    <div class="dr"><span></span></div>
</div>