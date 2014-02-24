<?php error_reporting(0) ?>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Customer Shop'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Customer Shop'); ?></h1>      
    <ul class="buttons">
 
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
    $columns = array(

    );
    $status = OrderStatus::getStatusOrder();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->getCustomerShop(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
        array(
            'name'=>'id',
            'header'=>Yii::t("global","Order number"),
            'htmlOptions'=>array('style'=>'text-align:center; width:30px;'),
            'value'=>'$data->id'
        ),
        array(
            'name' => 'shop_name',
            'header'=>Yii::t('global','Name Shop'),
            'value' => '$data->shop->name',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'width:100px;'),
        ),

        array(
            'name' => 'username',
            'header'=>Yii::t('global','Name Customer'),
            'value' => '$data->user->username',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'width:100px;'),
        ),
        array(
            'name'=>'shop_email',
            'header'=>Yii::t('global','Email'),
            'value' => '$data->user->email',
            'type' => 'raw',
        ),
		'billing_fullname',
        'shipping_address',
		array(
		'class'=>'CButtonColumn',
        'template'=>'{view}{update}{delete}',
        'buttons'=>array(
            'view' => array(
                'label'=>Yii::t("global","View Customer"),
                'url'=>'Yii::app()->createUrl("admin/orders/vi_customer", array("id"=>$data->id))',
            ),
            'update' => array(
                'label'=>Yii::t('global','Update Customer'),
                'url'=>'Yii::app()->createUrl("admin/orders/up_customer", array("id"=>$data->id))',
            ),
            'delete' => array(
                'label'=>Yii::t('global','Delete Customer'),
                'url'=>'Yii::app()->createUrl("admin/orders/delete", array("id"=>$data->id))',
            ),
        ),
	),
	),
)); ?>
</div>
</div></div>