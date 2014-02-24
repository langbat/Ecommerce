<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Profile'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Profile'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'username',
		'gender',
		'email',
		'password',
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
	),
)); ?>


</div>
</div>