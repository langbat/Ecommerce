<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Tags'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Tags'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('tags/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Tags'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tags-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		array(
            'name' => 'id',
            'header'=>Yii::t('global','Id'),
            'value' => '$data->id',
            'htmlOptions'=>array('width'=>'30'),
        ),
		'name',
		'slug',
		'weight',
		array(
                'name' => 'created',
                'header'=>Yii::t('global', 'Create'),
                'filter' => $this->widget('CJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'created',
                        'mode'=>'date',
                        'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                        'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                            'style' => 'text-align: center'
                        ),
                    ),
                    true)
            ),
		array(
            'name' => 'updated',
            'header'=>Yii::t("global","Update"),
            //'headerHtmlOptions'=> array('style' => 'text-align: center; width:100px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'updated',
                    'mode'=>'date',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                    'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_due_date_last',
                        'size' => '10',
                        'style' => 'text-align: center; border-right: 1px solid #dddddd;'
                    ),
                ),
                true)
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>