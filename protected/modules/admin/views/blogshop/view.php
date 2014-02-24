<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Blogshop'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Blogshop'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		array(
            'name'=>'category_name',
            'label'=>Yii::t('global', 'Category name'),
            'type' => 'raw',
            ),
		'shop.name',
		array('name'=>'title','cssClass'=>'fix-null'),
		array('name'=>'description','cssClass'=>'fix-null'),
 	    array(
            'name'=>'content',
            'cssClass'=>'fix-null',
            'type'=>'html',
        ),
		/*'alias',
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
		'last_updated_author', */
        array(
            'name' => 'image',
             'cssClass'=>'fix-null-img',
            'type'=>'raw',
            'value' => '<a class="fancybox" href="/uploads/blogshop/'.$model->image.'" rel="group"><img src="/uploads/blogshop/'.$model->image.'" style="height: 90px;"></a>'
        ),
        //'image',
	),
)); ?>


</div>
</div>