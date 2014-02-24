<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Blogs'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Blogs'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('blog/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Blog'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php 

$columns = array('id', 'title','alias');
$columns[] = array(
    'header' => Yii::t('global', 'Category'),
    'name' => 'category.title'
);
foreach( Yii::app()->params['languages'] as $key => $value ){
    $columns[]  = array(
        'header' => '<div align="center"><img src="/assets/images/languages/'.$key.'.png" /></div>',
        'value' => '$data->languageButton("'.$key.'")' ,
        'type' => 'raw',
        'htmlOptions'=>array( 'style'=>'text-align: center' )
    );
}
$columns[] = array(
 'class'=>'CButtonColumn',
 'template'=>'{delete}',
);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'widgets-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> $columns
)); ?>
</div>
</div></div>