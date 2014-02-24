<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Banners'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Banners'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('banners/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Banners'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
    $BannerPosition = Lookup::items('BannerPosition');
    $BannerType = Lookup::items('BannerType');
    
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'banners-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'headerHtmlOptions'=>array('width'=>'50px'),
        ),
		'name',
        array(
            'name'=>'position',
            'filter'=>$BannerPosition,
            'value' => 'Lookup::item("BannerPosition", $data->position)'
        ),
		array(
            'name'=>'type',
            'filter'=>$BannerType,
            'value' => 'Lookup::item("BannerType", $data->type)'
        ),
        array(
            'name'=>'is_active',
            'filter'=>array('1'=>Yii::t('global', 'Yes'),'0'=>Yii::t('global', 'No')),
            'value'=>'($data->is_active=="1")?Yii::t("global", "Yes"):Yii::t("global", "No")'
        ),
		//'filename',
		/*
		'content',
		'link',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>
