
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'countries-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'iso2'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'iso2',array('size'=>2,'maxlength'=>2)); ?>
            <?php echo $form->error($model,'iso2'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global','Short Name')); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'short_name',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'short_name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,Yii::t('global','Long Name')); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'long_name',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'long_name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'iso3'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'iso3',array('size'=>3,'maxlength'=>3)); ?>
            <?php echo $form->error($model,'iso3'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,Yii::t('global','Numcode')); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'numcode',array('size'=>6,'maxlength'=>6)); ?>
            <?php echo $form->error($model,'numcode'); ?>
        </div>
	</div>

	<!--<div class="row-form clearfix">
		<div class="span3">
            <?php //echo $form->labelEx($model,'un_member'); ?>
        </div>
		<div class="span9">
            <?php //echo $form->textField($model,'un_member',array('size'=>12,'maxlength'=>12)); ?>
            <?php //echo $form->error($model,'un_member'); ?>
        </div>
	</div>-->

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,Yii::t('global','Calling Code')); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'calling_code',array('size'=>8,'maxlength'=>8)); ?>
            <?php echo $form->error($model,'calling_code'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'cctld'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'cctld',array('size'=>5,'maxlength'=>5)); ?>
            <?php echo $form->error($model,'cctld'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,Yii::t('global','Active')); ?>
        </div>
		<div class="span9">
            <?php
            $countryStatus =Lookup::items('StatusCountry');
            echo $form->dropDownList($model,'is_active',$countryStatus); ?>
            <?php echo $form->error($model,'is_active'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->