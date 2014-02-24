
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-shop-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); 
$UserShops = Members::model()->getUsernameShop();

foreach ( $UserShops as $UserShop ){
    $MemArray[$UserShop['id']] = $UserShop['username'];
}
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'user_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'user_id', $MemArray); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'slogan'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'slogan',array('size'=>60,'maxlength'=>25)); ?>
            <?php echo $form->error($model,'slogan'); ?>
        </div>
	</div>
    
    <div class="row-form clearfix">
     <div class="span3">
            <?php echo $form->labelEx($model,'is_special'); ?>
        </div>
        <div class="span9">
            <?php echo $form->checkBox($model,'is_special'); ?>
            <?php echo $form->error($model,'is_special'); ?>
        </div>
   	</div>
        
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		 <div class="span3">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/logoshop/'.$model->image.'"'?> style="height: 50px;"/>
                </a>
            <?php endif;?>
        </div>
	</div>
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'banner'); ?>
        </div>
		 <div class="span3">
            <?php echo $form->fileField($model,'banner'); ?>
            <?php echo $form->error($model,'banner'); ?>
            <?php if ($model->banner):?>
                <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->banner.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/logoshop/'.$model->banner.'"'?> style="height: 50px;"/>
                </a>
            <?php endif;?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'description'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description'); ?>
        </div>
	</div>
    
    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'apiUsername'); ?>
        </div>
        <div class="span9">
            
            <?php echo $form->textArea($model,'apiUsername',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiUsername'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'apiPassword'); ?>
        </div>
        <div class="span9">
            <?php echo $form->textArea($model,'apiPassword',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiPassword'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'apiSignature'); ?>
        </div>
        <div class="span9">
            <?php echo $form->textArea($model,'apiSignature',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiSignature'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'apiLive'); ?>
        </div>
        <div class="span9">
            <?php echo $form->textField($model,'apiLive'); ?>
            <?php echo $form->error($model,'apiLive'); ?>
        </div>
    </div>
	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->