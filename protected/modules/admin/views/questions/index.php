<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Questions'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Questions'); ?></h1>      
                            
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'questions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
                array(
                        'name'=>'id',
                        'htmlOptions'=>array('style'=>'width:40px;word-break: break-word;')
                    ),
                    array(
                        'name'=>'name',
                        'htmlOptions'=>array('style'=>'width:130px;word-break: break-word;')
                    ),
                     array(
                        'name'=>'emails',
                        'htmlOptions'=>array('style'=>'width:130px;word-break: break-word;')
                    ),
                     array(
                        'name'=>'questions',
                        'type'=>'raw',
                        'htmlOptions'=>array('style'=>'width:250px;word-break: break-word;')
                    ),
                    array(
                        'name'=>'answers',
                        'type'=>'raw',
                        'htmlOptions'=>array('style'=>'width:250px;word-break: break-word;')
                    ),
		              	array(
                        'name' => 'datequestion',
                        //'header'=>Yii::t("global","Created"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'datequestion',
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
                        'name' => 'dateanswer',
                        //'header'=>Yii::t("global","Created"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'dateanswer',
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
		         // array(
//                        'name'=>'datequestion',
//                        'htmlOptions'=>array('style'=>'width:100px;word-break: break-word;')
//                    ),
//                    array(
//                        'name'=>'dateanswer',
//                        'htmlOptions'=>array('style'=>'width:100px;word-break: break-all;')
//                    ),
	
		
		
		/*
		'dateanswer',
		*/
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array('style'=>'width:65px;'),
		),
	),
)); ?>
</div>
</div></div>