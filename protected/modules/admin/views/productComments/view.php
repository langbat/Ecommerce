<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Product Comments'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Product Comments'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array(
            'name'=>'product_name',
            'label'=>Yii::t('global','Product name'),
            'type'=>'raw',
            'value'=> '<a href="/admin/products/view/id/'.$model->product_id.'">'.Products::model()->getNameProduct($model->product_id).'</a>',
        ),
		'content',
		'created',
	),
)); ?>


</div>
</div>