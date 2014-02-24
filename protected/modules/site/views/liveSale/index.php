
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Live Sales'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
<!--
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Live Sales'); ?></h1>      
                      
</div>-->
<a href="<?php echo $this->createUrl('LiveSale/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'LiveSale'); ?>"><div class="btn" id="choice-product"><?php echo Yii::t('global', 'Add Live Sale'); ?></div></a> 
<div class="block-fluid table-sorting"> 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'live-sale-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'summaryText'=>'',
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array('width'=>'75'),
            'value'=>'$data->id'
        ),
		array(
            'name'=>'shopname',
            'header'=>Yii::t('global','Name Shop'),
            'htmlOptions'=>array('style'=>'width:150px;'),
            'value'=>'$data->shop->name'
        ),
		'name',
        array(
            'header'=>Yii::t('global', 'Products'),
            'type' => 'raw',
            'value' => 'ProductsShop::getProductShopByList(isset($data->list_product_id)?$data->list_product_id:0, 1)',
            'htmlOptions'=>array('style'=>'width:250px;')
        ),
        array(
            'name' => 'start',
            'header'=>Yii::t("global","Start"),
            'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'start',
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
            'name' => 'end',
            'header'=>Yii::t("global","End"),
            'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'end',
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
		
		/*
		'media',
		'created',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>
