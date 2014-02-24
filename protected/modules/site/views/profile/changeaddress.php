<div class="content-wrapper">
        <div class="pull-left col-left">
             <div class="wrapper_profile">
                <div class="slider-box purple-grid profile">
                    <div class="title"><h5><?php echo Yii::t('global','Change address'); ?></h5></div>
                    
                <?php $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'changeaddress-form',
                	'enableAjaxValidation'=>false,
                )); ?>
                
                	
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'street'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'street'); ?>
                            <?php echo $form->error($profile,'street'); ?>
                        </div>
                	</div>
                
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'nr'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'nr'); ?>
                            <?php echo $form->error($profile,'nr'); ?>
                        </div>
                	</div>
					
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'postcode'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'postcode'); ?>
                            <?php echo $form->error($profile,'postcode'); ?>
                        </div>
                	</div>
					
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'city'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'city'); ?>
                            <?php echo $form->error($profile,'city'); ?>
                        </div>
                	</div>
                    
                    <div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'country_id'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->dropDownList($profile, 'country', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
                            <?php echo $form->error($profile,'country'); ?>
                        </div>
                	</div>
                    
                    
                   
                	<span class="changeaddress">	<?php echo CHtml::submitButton(Yii::t('global', 'Change address'), array('name'=>'submit', 'class'=>'frontend_account btn btn-warning')); ?> </span>
                
                        
                <?php $this->endWidget(); ?>
               <span class="space-change"></span>
            </div>
            	
        </div>
    </div>
</div>
