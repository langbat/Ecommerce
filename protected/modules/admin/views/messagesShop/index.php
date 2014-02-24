<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Messages Shops'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Messages Shops'); ?></h1>      
                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messages-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
	   array(
            'name' => 'id',
            'header'=>Yii::t('global','Id'),
            'value' => '$data->id',
            'htmlOptions'=>array('width'=>'35'),
        ),
        array(
            'name' => 'sendername',
            'header'=>Yii::t('global','Sender'),
            'value' => '$data->senderme->username',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),
          array(
            'name' => 'receivername',
            'header'=>Yii::t('global','Receiver'),
            'value' => '$data->receiverme->username',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),
		
		'subject',
		'message',
        	array(
                'name' => 'sent',
                'header'=>Yii::t('global', 'Create'),
                'filter' => $this->widget('CJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'sent',
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
		/*
		'status_message',
		'is_read',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>