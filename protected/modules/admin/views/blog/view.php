<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Blog'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Blog'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'title',
        array(
            'name' => 'description',
            'type'=>'raw',
            'cssClass'=>'fix-null',
            'value' => $model->description
        ),
		array(
            'name' => 'content',
            'type'=>'raw',
            'cssClass'=>'fix-null',
            'value' => $model->content
        ),

		/*'authorid',*/
        array(
            'name' => Yii::t('global','Postdate'),
            'cssClass'=>'fix-null',
            'value' => date ("Y-m-d H:i:s", $model->postdate)
        ),
       /* array(
            'name' => Yii::t('blog','Last Updated Date'),
            'cssClass'=>'fix-null-name-long',
            'value' => date ("Y-m-d H:i:s", $model->last_updated_date)
        ),*/
/*        array(
            'name' => Yii::t('blog','Last Updated Author'),
            'cssClass'=>'fix-null-name-long',
            'value' => $model->last_updated_author
        ),*/
        array(
            'name' => 'image',
             'cssClass'=>'fix-null-img',
            'type'=>'raw',
            'value' => '<a class="fancybox" href="/uploads/blog/'.$model->image.'" rel="group"><img src="/uploads/blog/'.$model->image.'" style="height: 90px;"></a>'
        ),
	),
)); ?>


</div>
</div>