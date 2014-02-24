<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Products Shops'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Products Shops'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('productsShop/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'ProductsShop'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php 
    error_reporting(0);
    $catProducts = CategoriesShop::getAllCategoryShop();
    $active_product = Products::model()->getActiveProduct();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),
        array(
            'name'=>'is_active',
            'header'=>Yii::t('global','Active Product'),
            'type' => 'raw',
            'filter'=>$active_product,
            'value' => 'Products::model()->getStatusProduct($data->is_active)',
            'htmlOptions'=>array('style'=>'width:30px;')
        ),
		'name',
        array(
            'name'=>'categoryname',
            'header'=>Yii::t('global','Category name'),
            'type'=>'raw',
            'filter'=>$catProducts,
            'value'=>'ProductsShop::model()->getProductCategoryShop( $data->id )',
            'htmlOptions'=>array('style'=>'width:150px;')
        ),
        array(
            'name'=>'price',
            'htmlOptions'=>array('style'=>'width:100px;')
        ),
		//'price_purchase',
		//'direct_buy_price',
		array(
            'header'=>Yii::t('global','Image'),
            'type' => 'raw',
            'value' => '$data->showAdminImageShop()',
            'htmlOptions'=>array('style'=>'width:80px;')
        ),
        array(
            'name'=>'shopname',
            'header'=>Yii::t('global','Name Shop'),
            'htmlOptions'=>array('style'=>'width:150px;'),
            'value'=>'$data->shop->name'
        ),
		/*
		'short_desciption',
		'description',
		'shipping_cost',
		'category_id',
		'is_active',
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