
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<label class="from"><?php echo Yii::t('global','Transactions from') ?> </label>
<?php $this->widget('CJuiDateTimePicker',array(
    'name'=>'from_time',
    'mode'=>'date',
    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
    'language' => Yii::app()->language=='en'?'':Yii::app()->language,
    'htmlOptions'=>array(
        'class'=>'from-time'
    ),
));
?>
<label class="to"><?php echo Yii::t('global',' to') ?></label>
<?php $this->widget('CJuiDateTimePicker',array(
    'name'=>'to_time',
    'mode'=>'date',
    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
    'language' => Yii::app()->language=='en'?'':Yii::app()->language,
    'htmlOptions'=>array(
        'class'=>'to-time'
    ),
));
?>

<?php echo CHtml::submitButton(Yii::t('global','Search'),array('class'=>'btn btn-primary search-time')); ?>

<?php $this->endWidget(); ?>
