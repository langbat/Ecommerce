<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Product Shop Comments'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Product Shop Comments'); ?></h1>                           
</div>
<div class="block-fluid table-sorting">

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-comments-grid',
	'dataProvider'=>$model->getProductShopname(),
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'type'=>'raw',
            'headerHtmlOptions'=> array('style' => 'text-align: center; width:40px;'),
        ),
        array(
            'name'=>'productshop_name',
            'header'=>Yii::t("global","Product name"),
            'type'=>'raw',
            'value'=>'CHtml::link($data->productshop->name,array("/admin/productsShop/view","id"=>$data->productshop->id))'
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
        'template'=>'{view}{update}{delete}',
        'buttons'=>array(
            'view' => array(
                'label'=>Yii::t("global","View"),
                'url'=>'Yii::app()->createUrl("admin/productComments/view_2", array("id"=>$data->id))',
            ),
            'update' => array(
                'label'=>Yii::t('global','Update'),
                'url'=>'Yii::app()->createUrl("admin/productComments/update_shop", array("id"=>$data->id))',
            ),
            'delete' => array(
                'label'=>Yii::t('global','Delete'),
                'url'=>'Yii::app()->createUrl("admin/productComments/delete", array("id"=>$data->id))',
            ),
        ),
	),
	),
)); ?>
</div>
</div></div>