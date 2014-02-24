<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Countries'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Countries'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'iso2',
        array(
            'label'=>Yii::t('global','Short Name'),
            'value'=>$model->short_name,
        ),
        array(
            'label'=>Yii::t('global','Long Name'),
            'value'=>$model->long_name,
        ),
		'iso3',
        array(
            'label'=>Yii::t('global','Numcode'),
            'value'=>$model->numcode,
        ),
		//'un_member',
         array(
            'label'=>Yii::t('global','Calling Code'),
            'value'=>$model->calling_code,
        ),
		'cctld',
         array(
            'label'=>Yii::t('global','Active'),
            'value'=>$model->is_active,
        ),
	),
)); ?>


</div>
</div>