
<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Product Comments'); ?></h1>      
    <ul class="buttons">
        
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php 
$comments = new ProductComments('search');
$comments->type = 1;
$comments->product_id = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-comments-grid',
	'dataProvider'=>$comments->search(),
	'filter'=>$comment,
	'columns'=>array(
		'id',
        array(
            'name'=>'content',
            'type'=>'raw',
            'value'=>'CHtml::link($data->content,array("/admin/productComments/view","id"=>$data->id))'
        ),
		'created',
        array(
		'class'=>'CButtonColumn',
        'template'=>'{view}{update}{delete}',
		 'buttons'=>array(
            'view' => array(
                'label'=>'View Commment',
                'url'=>'Yii::app()->createUrl("admin/productComments/view", array("id"=>$data->id))',
            ),
            'update' => array(
                'label'=>'Update Commment',
                'url'=>'Yii::app()->createUrl("admin/productComments/update", array("id"=>$data->id))',
            ),
            'delete' => array(
                'label'=>'Delete Commment',
                'url'=>'Yii::app()->createUrl("admin/productComments/delete", array("id"=>$data->id))',
            ),
        ),
        ),
	),
)); ?>
</div>
</div></div>