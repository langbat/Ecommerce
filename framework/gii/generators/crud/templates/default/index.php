<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="page-header">
    <h1><?php echo "<?php echo Yii::t('global', 'Manage'); ?>" ?> 
    <small><?php echo "<?php echo Yii::t('global', '".$this->pluralize($this->class2name($this->modelClass))."'); ?>"; ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo "<?php echo Yii::t('global', '".$this->pluralize($this->class2name($this->modelClass))."'); ?>"; ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo "<?php echo \$this->createUrl('".$this->class2id($this->modelClass)."/create') ?>" ?>" data-original-title="<?php echo "<?php echo Yii::t('global', 'Create'); ?>" ?> <?php echo "<?php echo Yii::t('global', '".$this->modelClass."'); ?>"; ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>