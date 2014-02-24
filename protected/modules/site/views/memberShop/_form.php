<div class="block-fluid create_shop">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-shop-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); 
    $ismenbershop = MemberShop::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
?>
    
	<?php echo $form->errorSummary($model); 
    
        if(!isset($fl)||($fl!=1 && $fl!=0)){
    ?>


	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span8">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'text_shop')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'slogan'); ?>
        </div>
		<div class="span8">
            <?php echo $form->textField($model,'slogan',array('size'=>60,'maxlength'=>25,'class'=>'text_shop')); ?>
            <?php echo $form->error($model,'slogan'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
		<div class="span8">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'text_shop')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		 <div class="span4">
            <?php echo $form->fileField($model,'image', array('style'=>'float:right')) ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
            
                <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/logoshop/'.$model->image.'"'?> style="height: 50px;"/>
                </a>
             
            <?php endif;?>
        </div>
	</div>
    
   	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'banner'); ?>
        </div>
		 <div class="span4">
            <?php echo $form->fileField($model,'banner', array('style'=>'float:right')) ?>
            <?php echo $form->error($model,'banner'); ?>
            <?php if ($model->banner):?>
            
                <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->banner.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/logoshop/'.$model->banner.'"'?> style="height: 50px;"/>
                </a>
             
            <?php endif;?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'description'); ?>
        </div>
        <div class="<?php echo isset($ismenbershop)?"span10":"span7" ?>">
           <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'description', 'editorTemplate' => 'full' )); ?>
            
            <?php echo $form->error($model,'description'); ?>
        </div>
	</div>
    <div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'welcome'); ?>
        </div>
		<div class="<?php echo isset($ismenbershop)?"span10":"span7" ?>">
        <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'welcome', 'editorTemplate' => 'full' )); ?>
            
            <?php echo $form->error($model,'welcome'); ?>
        </div>
	</div>
    <div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'service'); ?>
        </div>
		<div class="<?php echo isset($ismenbershop)?"span10":"span7" ?>">
           <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'service', 'editorTemplate' => 'full' )); ?>
            
            <?php echo $form->error($model,'service'); ?>
        </div>
	</div>
    <div class="row-form clearfix">
        <div class="span2">
            <?php echo $form->labelEx($model,'apiUsername'); ?>
        </div>
        <div class="span8">
            
            <?php echo $form->textArea($model,'apiUsername',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiUsername'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span2">
            <?php echo $form->labelEx($model,'apiPassword'); ?>
        </div>
        <div class="span8">
            <?php echo $form->textArea($model,'apiPassword',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiPassword'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span2">
            <?php echo $form->labelEx($model,'apiSignature'); ?>
        </div>
        <div class="span8">
            <?php echo $form->textArea($model,'apiSignature',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'apiSignature'); ?>
        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span2">
            <?php echo $form->labelEx($model,'apiLive'); ?>
        </div>
        <div class="span8">
            <?php echo $form->textField($model,'apiLive'); ?>
            <?php echo $form->error($model,'apiLive'); ?>
        </div>
    </div>
<?php } elseif($fl==0){?>
<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'welcome'); ?>
        </div>
		<div class="span10">
         <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'welcome', 'editorTemplate' => 'full' )); ?>
            <?php // echo $form->textArea($model,'welcome',array('rows'=>6, 'cols'=>40 ,'class'=>'des_shop')); ?>
            <?php echo $form->error($model,'welcome'); ?>
        </div>
	</div>
<?php }elseif($fl==1){?>
 <div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'service'); ?>
        </div>
		<div class="span10">
         <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'service', 'editorTemplate' => 'full' )); ?>
            <?php //echo $form->textArea($model,'service',array('rows'=>6, 'cols'=>40 ,'class'=>'des_shop')); ?>
            <?php echo $form->error($model,'service'); ?>
        </div>
	</div>
<?php } ?>
	<div class="footer tar actions clearfix">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('id'=>'registerbutton','class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$("#MemberShop_image").filestyle({buttonText: "<?php echo Yii::t('global','Choose file') ?>"});
$("#MemberShop_banner").filestyle({buttonText: "<?php echo Yii::t('global','Choose file') ?>"});</script>