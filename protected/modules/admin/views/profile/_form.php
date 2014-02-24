
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'parent_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'parent_id'); ?>
            <?php echo $form->error($model,'parent_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'username'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'gender'); ?>
        </div>
		<div class="span9">
            <?php echo $form->radioButtonList($model,'gender',array('1'=>Yii::t('global','Male'),'0'=>Yii::t('global','Female')),array('separator'=>'','class'=>'validate[required]','template'=>'{input}<span>{label}</span>')); ?>
            <?php echo $form->error($model,'gender'); ?>
        </div>
	</div>
    
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
            <?php echo $form->labelEx($model,'password'); ?>
        </div>
		<div class="span9">
            <?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'comment'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'comment'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'coupon'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'coupon'); ?>
            <?php echo $form->error($model,'coupon'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'joined'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'joined'); ?>
            <?php echo $form->error($model,'joined'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'data'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'data'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'passwordreset'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'passwordreset',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'passwordreset'); ?>
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
            <?php echo $form->labelEx($model,'ipaddress'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'ipaddress',array('size'=>30,'maxlength'=>30)); ?>
            <?php echo $form->error($model,'ipaddress'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'seoname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'seoname',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'seoname'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'fbuid'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'fbuid'); ?>
            <?php echo $form->error($model,'fbuid'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'fbtoken'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'fbtoken',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'fbtoken'); ?>
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
                echo $form->dropDownList($model, 'bday', DateHelper::getDays(), array('prompt' => Yii::t('global','Day')));
                echo $form->dropDownList($model, 'bmonth', DateHelper::getMonths(), array('prompt' => Yii::t('global','Month')));
                echo $form->dropDownList($model, 'byear', DateHelper::getYears(), array('prompt' => Yii::t('global','Year')));
            ?>
            <?php echo $form->error($model,'birthday'); ?>
        </div>
	</div>

    

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'photo'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'photo'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'address'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'address'); ?>
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

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'vericode'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'vericode',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'vericode'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'current_plan'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'current_plan'); ?>
            <?php echo $form->error($model,'current_plan'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'street'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'street'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'nr'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'nr',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'nr'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'ext_information'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'ext_information',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'ext_information'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'postcode'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'postcode'); ?>
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
            <?php echo $form->labelEx($model,'shipping_street'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_street',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'shipping_street'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_nr'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_nr',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'shipping_nr'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_ext_information'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_ext_information',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'shipping_ext_information'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_postcode'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_postcode'); ?>
            <?php echo $form->error($model,'shipping_postcode'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_city'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_city',array('size'=>60,'maxlength'=>155)); ?>
            <?php echo $form->error($model,'shipping_city'); ?>
        </div>
	</div>

    
    <div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_country_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'shipping_country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
            <?php echo $form->error($model,'shipping_country_id'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->