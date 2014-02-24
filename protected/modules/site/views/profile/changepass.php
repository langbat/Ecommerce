<div class="content-wrapper">
        <div class="pull-left col-left">
             <div class="wrapper_profile">
                <div class="slider-box purple-grid profile">
                    <div class="title"><h5><?php echo Yii::t('global','Change Password'); ?></h5></div>
                    
                <?php $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'validation',
                	'enableAjaxValidation'=>false,
                )); ?>
                
                	<?php echo $form->errorSummary($password); ?>
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($password,'password'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->passwordField($password,'password'); ?>
                            <?php echo $form->error($password,'password'); ?>
                        </div>
                	</div>
                
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
                
                		<?php echo CHtml::submitButton(Yii::t('global', 'Change Password'), array('name'=>'submit', 'class'=>'frontend_account btn btn-warning')); ?>
                	
                
                <?php $this->endWidget(); ?>
               
            </div>
        </div>
    </div>
</div>
