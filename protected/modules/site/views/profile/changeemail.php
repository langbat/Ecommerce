<div class="content-wrapper">
        <div class="pull-left col-left">
             <div class="wrapper_profile">
                <div class="slider-box purple-grid profile">
                    <div class="title"><h5><?php echo Yii::t('global','Change email'); ?></h5></div>
                    
                <?php $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'validation',
                	'enableAjaxValidation'=>false,
                )); ?>
                
                	<?php echo $form->errorSummary($email); ?>
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($email,'email'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($email,'email'); ?>
                            <?php echo $form->error($email,'email'); ?>
                        </div>
                	</div>
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($email,'nemail'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($email,'nemail',array('size'=>60,'maxlength'=>155)); ?>
                            <?php echo $form->error($email,'nemail'); ?>
                        </div>
                	</div>
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($email,'nemail2'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($email,'nemail2'); ?>
                            <?php echo $form->error($email,'nemail2'); ?>
                        </div>
                	</div>
                
                		<?php echo CHtml::submitButton(Yii::t('global', 'Change email'), array('name'=>'submit', 'class'=>'frontend_account btn btn-warning')); ?>
                	
                
                <?php $this->endWidget(); ?>
               
            </div>
        </div>
    </div>
</div>
