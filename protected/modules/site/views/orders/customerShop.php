<?php error_reporting(0) ?>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Orders'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Orders'); ?></h1>      
        <ul class="buttons">
            
        </ul>                        
    </div>
    
    <div class="block-fluid table-sorting">
        <?php $status = OrderStatus::getStatusOrder();
            $this->widget('zii.widgets.grid.CGridView', array(
        	'id'=>'orders-grid',
        	'dataProvider'=>$model,
            'afterAjaxUpdate' => 'reinstallDatePicker',
        	'columns'=>array(
                array(
                    'name'=>'id',
                    'header'=>Yii::t("global","Order number"),
                    'htmlOptions'=>array('width'=>'30'),
                    'value'=>'$data->id'
                ),
                
                array(
                    'name'=>'product_name',
                    'header'=>Yii::t('global','Products'),
                    'value' => '$data->showItems()',
                    'type' => 'raw'
                ),
                array(
                    'name'=>'members.email',
                    'header'=>Yii::t('global','Email'),
                    'value' => '$data->members->email',
                    'type' => 'raw'
                ),
                
        		'billing_fullname',
                'billing_address',
        
        		array(
        			'class'=>'CButtonColumn',
        		),
        	),
        )); ?>
    </div>
</div>
</div>