   <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Orders'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Orders'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('orders/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Orders'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'remaining_date',
		'created',
		'amount',
		'billing_fullname',
        'shop_id',
		/*
		'billing_address',
		'shipping_fullname',
		'shipping_address',
		'shipped',
		'data',
		'status',
		'type',
		'delivery_way',
		'shop_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>
<?php }?>