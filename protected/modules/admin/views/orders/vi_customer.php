<div class="page-header">
    <h1><?php error_reporting(0);echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Customer Shop'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span6">
        <div class="head clearfix">
            <div class="isw-text_document"></div>
            <h1><?php echo Yii::t('global', 'Customer Shop'); ?> #<?php echo $model->id; ?></small></h1>
            <ul class="buttons">
                <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title=<?php echo Yii::t('global','Back')?>></a></li>
            </ul> 
        </div>
        <?php 
        $this->widget('zii.widgets.CDetailView', array(
        	'data'=>$model,
        	'attributes'=>array(
        		//'id',
        		array(
                    'name' => 'Name Shop',
                    'label'=>Yii::t('global', 'Name Shop'),
                    'type' => 'raw',
                    'value'=> MemberShop::model()->getNameShops($model->shop_id),
                ),
                array(
                    'name' => 'Name Customer',
                    'label'=>Yii::t('global', 'Name Customer'),
                    'type' => 'raw',
                    'value'=> '<a href="/admin/members/view/id/'.$model->user->id.'">'.$model->user->username.'</a>',
                ),
                array(
                    'name' => 'Email',
                    'label'=>Yii::t('global', 'Email'),
                    'type' => 'raw',
                    'value'=> Members::model()->getEmails($model->user_id),
                ),
        		'billing_fullname',
        		'billing_address',
        	),
        )); ?>
    </div>
    
</div>