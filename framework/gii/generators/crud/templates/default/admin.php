<?php
$label=$this->pluralize($this->class2name($this->modelClass));
?>
<div class="page-header">
    <h1><?php echo "<?php echo Yii::t('global', '".$label."'); ?>"; ?></h1>
</div>


<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
