<div class="page-header">
    <h1>
        <?php echo Yii::t('global', 'Create'); ?> 
        <small><?php echo Yii::t('global', ' Admin'); ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Create'); echo Yii::t('global', ' Admin'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul> 
    </div>

    <div class="block-fluid">

        <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'members-form',
        'enableAjaxValidation'=>false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row-form clearfix">
            <div class="span3">
                <?php echo $form->labelEx($model,'username'); ?>
            </div>
            <div class="span9">
                <?php echo $form->textField($model,'username',array( 'onchange'=>'checkUser()','size'=>60,'maxlength'=>155,'class'=>' username ',)); ?>
                <?php echo $form->error($model,'username'); ?>
                <div class="noticeStatus" id="noticeStatus"></div>
            </div>
	    </div>
        <div class="row-form clearfix">
            <div class="span3">
                <?php echo $form->labelEx($model,'password'); ?>
            </div>
            <div class="span9">
                <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>155,'class'=>'validate[minSize[8]]',)); ?>
                <?php echo $form->error($model,'password'); ?>
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
                <?php echo $form->labelEx($model,'country_id'); ?>
            </div>
            <div class="span9">
                <?php echo $form->dropDownList($model, 'country', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
                <?php echo $form->error($model,'country_id'); ?>
            </div>
        </div>

        <div class="row-form clearfix">
            <div class="span3">
                <?php echo $form->labelEx($model,'role'); ?>
            </div>
            <div class="span9">
                <?php echo $form->textField($model,'role',array('size'=>30,'maxlength'=>30, 'value'=>'admin')); ?>
                <?php echo $form->error($model,'role'); ?>
            </div>
        </div>
        <div class="footer tar">
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div></div>

<script type="text/javascript">
    function checkUser(){
        var username = $('.username').val();
        $.get('/profile/checkUser?username='+username, function(html) {
            $('.noticeStatus').html(html);
        });
    }



</script>