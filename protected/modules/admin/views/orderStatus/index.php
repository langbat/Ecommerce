<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Order Statuses'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Order Statuses'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('orderStatus/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'OrderStatus'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        array(
            'name'=>'name',
            'header'=>Yii::t('global', 'Name'),
            'type' => 'raw',
            'value' => Yii::t('global', '$data->name'),
        ),
        array(
            'name'=>'description',
            'header'=>Yii::t('global', 'Description'),
            'type' => 'raw',
            'value' => Yii::t('global', '$data->description'),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>