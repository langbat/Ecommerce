<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Tokbox Archives'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Tokbox Archives'); ?></h1>      
                      
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tokbox-archive-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'filter'=>$model,
	'columns'=>array(
		/*'id',*/
        array(
            'name'=>'username',
            'value'=>'$data->user->username'
        ),
        array(
            'name'=>'created',
            'value' =>'Utils::date_format24h($data->created)',
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'created',
                    'mode'=>'date',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => false),
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
			'class'=>'CButtonColumn',
            
		),
	),
)); ?>
</div>
</div></div>