<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Member Shops'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Member Shops'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'user_id',
        	array(
                    'name' => 'user',
                    'type' => 'raw',
                    'value'=> '<a href="/admin/members/view/id/'.$model->user->id.'">'.$model->user->username.'</a>',
                ),
		'name',
		array(
            'name' => 'slogan',
            'cssClass'=>'fix-null-img',
        ),
        array(
            'name' => 'email',
            'cssClass'=>'fix-null-img',
        ),
         array(
            'name' => 'image',
            'cssClass'=>'fix-null-img',
            'type'=>'raw',
            'value' => '<a class="fancybox" href="/uploads/logoshop/'.$model->image.'" rel="group"><img src="/uploads/logoshop/'.$model->image.'" style="height: 90px;"></a>'
        ),
        array(
            'name' => 'banner',
            'cssClass'=>'fix-null-img',
            'type'=>'raw',
            'value' => '<a class="fancybox" href="/uploads/logoshop/'.$model->banner.'" rel="group"><img src="/uploads/logoshop/'.$model->banner.'" style="height: 90px;"></a>'
        ),
        array( 
            'name' => 'is_specials',
            'label'=>Yii::t('global', 'Is Special'),
            'cssClass'=>'fix-null-img',
            'value'=>MemberShop::model()->getStatusProductShop( $model->id ),
        ),
        array(
            'name' => 'description',
            'cssClass'=>'fix-null-img',
        ),
        
		'created',
		'updated',
        array(
            'name' => 'apiUsername',
            'cssClass'=>'fix-null-img',
        ),
        array(
            'name' => 'apiPassword',
            'cssClass'=>'fix-null-img',
        ),
        array(
            'name' => 'apiSignature',
            'cssClass'=>'fix-null-img',
        ),
        array(
            'name' => 'apiLive',
            'cssClass'=>'fix-null-img',
        ),
	),
)); ?>


</div>
</div>