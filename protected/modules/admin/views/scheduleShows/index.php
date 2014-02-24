<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Schedule shows'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Schedule shows'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('scheduleShows/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'ScheduleShows'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'schedule-shows-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
     'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('style'=>'width: 30px'),
        ),
		array(
            'name' => 'start_time',
            'header'=>Yii::t('global', 'Start Time'),
            'headerHtmlOptions'=> array('style' => 'text-align: center; width:200px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'start_time',
                    'mode'=>'date',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                    'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_due_date',
                        'size' => '10',
                        'style' => 'text-align: center; border-right: 1px solid #dddddd;'
                    ),
                ),
                true)
        ),
    	array(
        'name' => 'end_time',
        'header'=>Yii::t('global', 'End Time'),
        'headerHtmlOptions'=> array('style' => 'text-align: center; width:200px;'),
        'filter' => $this->widget('CJuiDateTimePicker', array(
                'model'=>$model,
                'attribute'=>'end_time',
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
            'name'=>'product_name',
            'header'=>Yii::t('global','Product name'),
            'type'=>'raw',
            'value'=>'CHtml::link($data->product->name,array("/admin/products/view","id"=>$data->product->id))'
        ),
		'content',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>