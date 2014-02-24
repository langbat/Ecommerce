<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Countries'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Countries'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('countries/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Countries'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
    $countryStatus =Lookup::items('StatusCountry');

    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'countries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'iso2',
        array(
            'name'=>'short_name',
            'header'=> Yii::t('global', 'Short Name'),
            'value'=> '$data->getTranSlate($data->short_name,$data->is_active)',
            'type'=>'html'
        ),
        array(
            'name'=>'long_name',
            'header'=> Yii::t('global', 'Long Name'),
            'value'=> '$data->getTranSlate($data->long_name,$data->is_active)',
            'type'=>'html'
        ),
		//'iso3',
        array(
            'name'=>'numcode',
            'header'=> Yii::t('global', 'NumCode'),
        ),
		/*
		'un_member',
		'calling_code',
		'cctld',*/
        array(
            'name'=>'is_active',
            'header'=> Yii::t('global','Active'),
            'filter'=>$countryStatus,
            'value'=> '$data->getActiveCountry($data->is_active)',
            'type'=>'html'
        ),

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>