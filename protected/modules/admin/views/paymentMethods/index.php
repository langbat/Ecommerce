<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Payment methods'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Payment methods'); ?></h1>
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('paymentMethods/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'PaymentMethods'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-methods-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'configuration',
		'is_active',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>