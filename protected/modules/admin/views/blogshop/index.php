<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Blog Shop'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Blog Shop'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('blogshop/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Blogshop'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'blogshop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('width'=>'50'),
            'value'=>'$data->id'
        ),
       	'title',
        array(
            'name'=>'category_name',
            'header'=>Yii::t('global','Category name'),
            'htmlOptions'=>array('style'=>'width:150px;'),
            'value'=>'$data->shop->name'
        ),
		array(
            'name'=>'shopname',
            'header'=>Yii::t('global','Name Shop'),
            'htmlOptions'=>array('style'=>'width:150px;'),
            'value'=>'$data->shop->name'
        ),
 	     array(
            'header'=>Yii::t('global','Image'),
            'type' => 'raw',
            'value' => '$data->showAdminImage()',
            'htmlOptions'=>array('style'=>'width:80px;')
        ),
		/*'description',
		'content',
		'alias',
		'language',
		'metadesc',
		'metakeys',
		'views',
		'rating',
		'totalvotes',
		'status',
		'authorid',
		'postdate',
		'last_updated_date',
		'last_updated_author',
		'image',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>