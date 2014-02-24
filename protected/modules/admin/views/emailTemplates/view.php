<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Email templates'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Email templates'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array('name'=>'name','cssClass'=>'fix-null'),
        array('name'=>'alias','cssClass'=>'fix-null'),
        array('name'=>'language','cssClass'=>'fix-null'),
        array('name'=>'email_subject','cssClass'=>'fix-null'),
        array(
            'name' => 'email_content',
            'type' => 'html',
            'value'=> $model->email_content,
        ),
	),
)); ?>


</div>
</div>