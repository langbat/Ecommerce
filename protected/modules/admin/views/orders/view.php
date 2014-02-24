<div class="page-header">
    <h1><?php error_reporting(0);echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Orders'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span6">
        <div class="head clearfix">
            <div class="isw-text_document"></div>
            <h1><?php echo Yii::t('global', 'Orders'); ?> #<?php echo $model->id; ?></small></h1>
            <ul class="buttons">
                <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global','Back')?>"></a></li>
            </ul> 
        </div>
        <?php $this->widget('zii.widgets.CDetailView', array(
        	'data'=>$model,
        	'attributes'=>array(
        		'id',
        		array(
                    'name' => 'user',
                    'type' => 'raw',
                    'value'=> '<a href="/admin/members/view/id/'.$model->user->id.'">'.$model->user->username.'</a>',
                ),
                
        		'created',
        		array('name'=>'remaining_date','cssClass'=>'fix-null'),
        		'amount',
        		'billing_fullname',
        		'billing_address',
        		array('name'=>'shipping_fullname','cssClass'=>'fix-null'),
        		array('name'=>'shipping_address','cssClass'=>'fix-null'),
        		'shipped',
        		
        		array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value'=> Orders::getStatusTrans($model->orderStatus->name),
                ),
        	),
        )); ?>
    </div>
    
    <div class="span6">
        
        <div class="head clearfix">
            <div class="isw-list"></div>
            <h1><?php echo Yii::t('global', 'Items'); ?> </small></h1>
        </div>
        
        <div>    
            <?php 
            $items=new OrderItems('search');
            $items->unsetAttributes();  // clear any default values
            $_GET['OrderItems']['order_id'] =$model->id;
            $items->attributes=$_GET['OrderItems'];
        
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'order-items-grid',
                'dataProvider'=>$items->search(),
                'filter'=>null,
                'enableSorting' => false,
                'summaryText'=>'',
                'htmlOptions' => array('class' => 'sOrders'),
                'columns'=>array(
                    'id',
                    array(
                        'name'=> 'item_id',
                        'value' => '$data->showItem('.$model->shop_id.')',
                        'type' => 'raw'
                    ),
                    array(
                        'name'=> 'type',
                        'value' => 'Orders::GetOrderItemType( Lookup::item("OrderItemType", $data->type) )',
                    ),
                    'qty',
                    array(
                        'name' => 'unit_price',
                        'value' => 'Utils::number_format($data->unit_price)." &euro;"',
                        'type' => 'raw'
                    )
                ),
            )); ?>
        </div>
        
    </div>
    
    
</div>