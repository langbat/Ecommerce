<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blogshop-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); 
$NameShops = MemberShop::model()->getNameShop();

foreach ( $NameShops as $NameShop ){
    $ShopArray[$NameShop['id']] = $NameShop['name'];
}
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo Yii::t('global', 'Category name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList( $model, 'category_name', array('Blog'=>'Blog') ); ?>
            <?php echo $form->error($model,'category_name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'shop_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList( $model, 'shop_id', $ShopArray ); ?>
            <?php echo $form->error($model,'shop_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'title'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
	</div>
    
   	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		<div class="span9">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" <?php echo 'href="/uploads/blogshop/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/blogshop/'.$model->image.'"'?> style="height: 50px;"/>
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
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'name' => 'Blogshop[content]', 'value' => isset($model->content) ? $model->content : '', 'editorTemplate' => 'full' )); ?> 
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>
    

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn button_new','id'=>'button_new')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->