<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Profiles'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Profiles'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('profile/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Profile'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profile-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'parent_id',
		'username',
		'gender',
		'email',
		'password',
		/*
		'comment',
		'coupon',
		'joined',
		'data',
		'passwordreset',
		'role',
		'ipaddress',
		'seoname',
		'fbuid',
		'fbtoken',
		'fname',
		'lname',
		'birthday',
		'photo',
		'address',
		'phone',
		'vericode',
		'current_plan',
		'street',
		'nr',
		'ext_information',
		'postcode',
		'city',
		'country_id',
		'shipping_street',
		'shipping_nr',
		'shipping_ext_information',
		'shipping_postcode',
		'shipping_city',
		'shipping_country_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>