<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Support'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span6">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Support'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
      <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
        'categories',
            array(
            'name'=>'content',
            'type' => 'raw',
           
          
        ),
      
		'description',
		//'linkyoutube',
		'is_highlight',
	),
)); ?>

</div>
  <div class="span6">
                <div class="head clearfix">
                    <div class="isw-sound"></div>
                    <h1><?php echo Yii::t('global','Video'); ?></h1>
                </div>
                <div class="block scrollBox videoShow">
                 
                <?php 
                 error_reporting(0); 
                echo Products::getVideo($model->linkyoutube); ?>
                 </div>
  </div>
</div>