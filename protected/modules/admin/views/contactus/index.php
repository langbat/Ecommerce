<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Contact Uses'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Contact Uses'); ?></h1>                             
</div>
<div class="block-fluid table-sorting">

<?php 

$columns = array('name', 'email', 'subject');
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