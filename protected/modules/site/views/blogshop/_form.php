<style>
#insert-value{
    /*width: 715px;*/
}
</style>
<div class="block-fluid">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blogshop-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'shop_id',array('value'=>$this->userId)); ?>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'title'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'id'=>'insert-value')); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
	</div>

    <div class="row-form clearfix"> 
        <div class="span3">
            <?php echo $form->labelEx($model,'description'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'description',array('rows'=>4, 'cols'=>40, 'maxlength'=>255, 'id'=>'insert-value')); ?>
            <?php echo $form->error($model,'description'); ?>
        </div>
    </div>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
        	<?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'model' => $model, 'attribute' => 'content', 'editorTemplate' => 'full' )); ?>
            <?php //echo $form->htmlArea($model,'content',array('rows'=>6, 'cols'=>50 )); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>
	<div class="row-form clearfix">
            <?php echo $form->hiddenField($model,'postdate', array('value'=>time(), 'id'=>'insert-value')); ?>
	</div>
    
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		<div class="span4">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" <?php echo 'href="/uploads/blogshop/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/blogshop/'.$model->image.'"'?> style="height: 50px;"/>
                </a>
            <?php endif;?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$("#Blogshop_image").filestyle({buttonText: "<?php echo Yii::t('global','Choose file') ?>"});</script>