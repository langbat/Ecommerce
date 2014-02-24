
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row-form clearfix">
		<div class="span3">
            <?php /*echo $form->labelEx($model,'username'); */?>
        </div>
		<div class="span9">
            <?php /*echo $form->textField($model,'username',array('size'=>60,'maxlength'=>155)); */?>
            <?php /*echo $form->error($model,'username'); */?>
        </div>
	</div>-->

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'role'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'role',array('size'=>30,'maxlength'=>30)); ?>
            <?php echo $form->error($model,'role'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'fname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'fname',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'fname'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'lname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'lname',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'lname'); ?>
        </div>
	</div>
    
    <div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'birthday'); ?>
        </div>
		<div class="span9">
        <?php
	
        	$this->widget('CJuiDateTimePicker',array(
        		'name'=>'Members[birthday]', 
        		//'model'=>$buzzer,
        		'id'=>'birthday' ,
        		'options' => array(
                              'mode'=>'focus',
                              'dateFormat'=>'d MM, yy',
                              ),
        		'language' => Yii::app()->language=='en'?'':Yii::app()->language,
        		'htmlOptions'=>array(
        			'style'=>'',
        			'class'=>'span9',
        			'placeholder'=> Yii::t('global','Birthday'),
        		),
        	));
        ?>
            <?php echo $form->error($model,'lname'); ?>
        </div>
	</div>
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'street'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'street'); ?>
        </div>
	</div>
    
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'nr'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'nr',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'nr'); ?>
        </div>
	</div>
    
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'postcode'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'postcode',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'postcode'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'city'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'city'); ?>
        </div>
	</div>
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'country_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'country', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
            <?php echo $form->error($model,'country_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'phone'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'phone',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->