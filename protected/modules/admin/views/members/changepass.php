<div class="page-header">
    <h1>
        <?php echo Yii::t('global', 'Change'); ?> 
        <small><?php echo Yii::t('global', 'Password'); ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Change'); echo Yii::t('global', 'Password'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul> 
    </div>
    
    <div class="block-fluid">
    
    <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'validation',
        	'enableAjaxValidation'=>false,
        )); ?>
        
        	<?php echo $form->errorSummary($password); ?>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo $form->labelEx($password,'npassword'); ?>
                </div>
        		<div class="span9">
                    <?php echo $form->passwordField($password,'npassword',array('class'=>'validate[minSize[8]]','size'=>60,'maxlength'=>155)); ?>
                    <?php echo $form->error($password,'npassword'); ?>
                </div>
        	</div>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo $form->labelEx($password,'npassword2'); ?>
                </div>
        		<div class="span9">
                    <?php echo $form->passwordField($password,'npassword2'); ?>
                    <?php echo $form->error($password,'npassword2'); ?>
                </div>
        	</div>
        
            <div class="row-form clearfix">
                <input type="hidden" name="from_action" value="<?php echo isset($_GET['action'])?$_GET['action']:'' ?>" />
        		<?php echo CHtml::submitButton(Yii::t('global', 'Change Password'), array('name'=>'submit', 'class'=>'frontend_account btn btn-warning')); ?>
            </div>
        	
        
        <?php $this->endWidget(); ?>
        </div>

</div></div>

