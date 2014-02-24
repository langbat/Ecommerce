<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Product Comments'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Product Comments'); ?></h1>      
    <ul class="buttons">
       
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-comments-grid',
	'dataProvider'=>$model->getProductname(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
        array(
            'name'=>'id',
            'type'=>'raw',
            'headerHtmlOptions'=> array('style' => 'width:40px;'),
        ),
        array(
            'name'=>'product_name',
            'header'=>Yii::t("global","Product name"),
            'type'=>'raw',
            'value'=>'CHtml::link($data->product->name,array("/admin/products/view","id"=>$data->product->id))'
        ),
		'content',
		array(
            'name' => 'created',
            'header'=>Yii::t("global","Created"),
            'headerHtmlOptions'=> array('style' => 'text-align: center; width:200px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'created',
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
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>