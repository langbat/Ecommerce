<div class="block-fluid">
<script type="text/javascript">
$(document).ready(function(){
    $('#image_flash_type').hide();
    $('#content_type').hide();
    $('#Banners_type').change(function(){
        if (this.value == <?php echo Banners::TYPE_FLASH?> || this.value == <?php echo Banners::TYPE_IMAGE?>){
            $('#image_flash_type').show();
            $('#content_type').hide();
        }
        else{
            $('#image_flash_type').hide();
            $('#content_type').show();
        }
    })
    <?php if ($model->id):?>
    $('#Banners_type').change();
    <?php endif;?>
})
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banners-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'position'); ?>
        </div>
		<div class="span3">
            <?php echo $form->dropDownList($model,'position', Lookup::items('BannerPosition')); ?>
            <?php echo $form->error($model,'position'); ?>
        </div>
        
        <div class="span3">
            <?php echo $form->labelEx($model,'type'); ?>
        </div>
		<div class="span3">
            <?php echo $form->dropDownList($model,'type', Lookup::items('BannerType'), array('empty' => Yii::t('global', '--- Please choose ---'))); ?>
            <?php echo $form->error($model,'type'); ?>
        </div>
	</div>

	<div class="row-form clearfix" id="image_flash_type">
		<div class="span3">
            <?php echo $form->labelEx($model,'filename'); ?>
        </div>
		<div class="span3">
            <?php echo $form->fileField($model,'filename',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'filename'); ?>
        </div>
        <div class="span6">
            <?php if ($model->filename && ($model->type == Banners::TYPE_IMAGE || $model->type == Banners::TYPE_FLASH)){
                $source = Yii::app()->basePath."/../uploads/banner/$model->filename";
                if (is_file($source)){
                    if ($model->type == Banners::TYPE_IMAGE):?>
                    <a class="fancybox" href="/uploads/banner/<?php echo $model->filename?>" rel="group">
                        <img class="img-polaroid" src="/uploads/banner/<?php echo $model->filename?>" style="height:50px" />
                    </a>
                    <?php else: 
                        list($width, $height) = getimagesize($source);
                        if ($height > 100){
                            $scare = $height/100;    
                            $height = ceil($height/$scare);
                            $width = ceil($width/$scare);
                        }
                        
                        ?>        
                    <object width="<?php echo $width?>" height="<?php echo $height?>" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                        codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
                        <param name="src" value="/uploads/banner/<?php echo $model->filename?>" />
                        <embed src="/uploads/banner/<?php echo $model->filename?>" width="<?php echo $width?>" height="<?php echo $height?>" />
                    </object> 
                <?php endif;
                }
            }?>
        </div>
	</div>

	<div class="row-form clearfix" id="content_type">
		<div class="span3">
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php echo $form->htmlArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'link'); ?>
        </div>
		<div class="span3">
            <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'link'); ?>
        </div>
        
        <div class="span3">
            <?php echo $form->labelEx($model,'is_active'); ?>
        </div>
		<div class="span3">
            <?php echo $form->checkBox($model,'is_active'); ?>
            <?php echo $form->error($model,'is_active'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->