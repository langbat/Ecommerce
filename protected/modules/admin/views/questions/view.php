<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Questions'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Questions'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global','Back')?>"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'emails',
        array(
            'name' => 'questions',
            'type' => 'raw',
            'value'=> $model->questions,
        ),
        array(
            'name' => 'answers',
            'type' => 'raw',
            'value'=> $model->answers,
        ),
        
		
		'datequestion',
		'dateanswer',
	),
)); ?>


</div>
</div>