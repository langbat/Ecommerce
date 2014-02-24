<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Product Labels'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Product Labels'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
         array(
            'name' => 'image',
             'cssClass'=>'fix-null-img',
            'type'=>'raw',
            'value' => '<a class="fancybox" href="/uploads/label/'.$model->image.'" rel="group"><img src="/uploads/label/'.$model->image.'" style="height: 90px;"></a>'
        ),
		//'image',
		'created',
		'updated',
	),
)); ?>


</div>
</div>