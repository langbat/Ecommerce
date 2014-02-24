<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'LiveSale'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'LiveSale'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'Shop Name',
            'type'=>'raw',
            'value'=>'shop.name',
        ),
		'name',
		array(
            'name'=>'start',
            'type'=>'raw',
            'value'=>$model->start,
            'cssClass'=>'fix-null'
        ),
        array(
            'name'=>'end',
            'type'=>'raw',
            'value'=>$model->end,
            'cssClass'=>'fix-null'
        ),
        array(
            'name'=>'list_product_id',
            'type'=>'raw',
            'value'=>ProductsShop::getProductShopByList($model->list_product_id),
            'cssClass'=>'fix-null'
        ),
        array(
            'name'=>'media',
            'type'=>'raw',
            'value'=>$model->media,
            'cssClass'=>'fix-null'
        ),
		'created',
		'updated',
	),
)); ?>


</div>
</div>