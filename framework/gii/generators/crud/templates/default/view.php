<div class="page-header">
    <h1><?php echo "<?php echo Yii::t('global', 'View'); ?>" ?> 
    <small><?php echo "<?php echo Yii::t('global', '".$this->modelClass."'); ?> #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo "<?php echo Yii::t('global', '".$this->modelClass."'); ?> #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('adminglobal', 'Back'); ?>"></a></li>
        </ul> 
    </div>
    
<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>


</div>
</div>