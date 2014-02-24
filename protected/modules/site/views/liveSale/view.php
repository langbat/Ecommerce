<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'LiveSale'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="purple-grid">
         <div class="title"><h5><?php echo Yii::t('global','View Live Sale');?></h5></div>
                     <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
    
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'shop.name',
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
            'value'=>ProductsShop::getProductShopByList( $model->list_product_id, 1 ),
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
</div>