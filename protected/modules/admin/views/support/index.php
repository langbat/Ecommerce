<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Supports'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Supports'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('support/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Support'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'support-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>Yii::t('global','id'),
            'type' => 'raw',
            'value' => '$data->id',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),
		
        array(
            'header'=>Yii::t('global','Title'),
            'type' => 'raw',
            'value' => '$data->title',
            'htmlOptions'=>array('style'=>'width:130px;')
        ),
	   array(
            'header'=>Yii::t('global','Description'),
            'type' => 'raw',
            'value' => '$data->description',
            'htmlOptions'=>array('style'=>'width:200px;')
        ),
         array(
            'header'=>Yii::t('global','Content'),
            'type' => 'raw',
            'value' => '$data->content',
            'htmlOptions'=>array('style'=>'width:180px;')
        ),
        array(
            'header'=>Yii::t('global','Linkyoutube'),
            'type' => 'raw',
            'value' => '$data->linkyoutube',
            'htmlOptions'=>array('style'=>'width:180px;')
        ),
		 array(
            'name'=>'categories',
            'filter'=>array('0'=>Yii::t('global', 'Media library'),'1'=>Yii::t('global', 'Blog video'),'2'=>Yii::t('global', 'Tutorial video'),'4'=>Yii::t('global', 'Dropdown top'),'5'=>Yii::t('global', 'Dropdown bottom')),
            'value'=>'($data->categories=="0")?Yii::t("global", "Media library"):(($data->categories=="1")?Yii::t("global", "Blog video"):(($data->categories=="2")?Yii::t("global", "Tutorial video"):(($data->categories=="4")?Yii::t("global", "Dropdown top"):(($data->categories=="5")?Yii::t("global", "Dropdown bottom"):""))))',
            'htmlOptions'=>array('style'=>'width:100px;')
        ),
		
        array(
            'name'=>'is_highlight',
            'filter'=>array('1'=>Yii::t('global', 'Yes'),'0'=>Yii::t('global', 'No')),
            'value'=>'($data->is_highlight=="1")?Yii::t("global", "Yes"):Yii::t("global", "No")',
            'htmlOptions'=>array('style'=>'width:50px;'),
        ),
	
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array('style'=>'width:50px;'),
		),
	),
)); ?>
</div>
</div></div>