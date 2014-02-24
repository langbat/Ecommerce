<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Products'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Products'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('products/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Products'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $catProducts = Categories::getAllCategory();
    $active_product = Products::getActiveProduct();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),

	'filter'=>$model,
	'columns'=>array(
		array(
            'header'=>Yii::t('global','Image'),
            'type' => 'raw',
            'value' => '$data->showAdminImage()',
            'htmlOptions'=>array('style'=>'width:80px;')
        ),
        array(
            'name'=>'is_active',
            'header'=>Yii::t('global','Active Product'),
            'type' => 'raw',
            'filter'=>$active_product,
            'value' => '$data->getStatusProduct($data->is_active)',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),
        array(
            'name'=>'id',
            'header'=>Yii::t('global','Product number'),
            'type' => 'raw',
            'value' => '$data->id',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),

        array(
            'name'=>'name',
            'header'=>Yii::t('global','Product name'),
            'type' => 'raw',
            'value' => '$data->name',
            'htmlOptions'=>array('style'=>'width:150px;')
        ),
        /*array(
            'name'=>'price',
            'type' => 'raw',
            'value' => '$data->price',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),*/
        array(
            'name'=>'direct_buy_price',
            'type' => 'raw',
            'value' => '$data->direct_buy_price."&euro;"',
            'htmlOptions'=>array('style'=>'width:50px;')
        ),
        array(
            'name'=>'category',
            'header'=>Yii::t('global', 'Category'),
            'type' => 'raw',
            'filter'=>$catProducts,
            'value' => '$data->getProductCategory($data->id)',
            'htmlOptions'=>array('style'=>'width:100px;')
        ),
		//'updated',
        array(
            'name'=>'producer_name',
            'header'=>Yii::t('global', 'Producer'),
            'type' => 'raw',
            'value' => '$data->producer->name',
            'htmlOptions'=>array('style'=>'width:80px;')
        ),
		/*
		'user_id',
		'short_desciption',
		'description',
		'shipping_immediately',*/
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array('style'=>'width:30px;'),
            'template'=>'{view}{update}{delete}',
		),
	),
)); ?>
</div>
</div></div>

<script type="text/javascript">$(document).ready(function(){$('.filters select').css('width', '100px')})</script>