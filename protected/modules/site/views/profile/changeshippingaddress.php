<div class="content-wrapper">
        <div class="pull-left col-left">
             <div class="wrapper_profile">
                <div class="slider-box purple-grid profile">
                    <div class="title"><h5><?php echo Yii::t('global','Change Shipping Address'); ?></h5></div>
                    
                <?php $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'validation1',
                	'enableAjaxValidation'=>false,
                )); ?>
                
                	
                
                	<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'shipping_street'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'shipping_street'); ?>
                            <?php echo $form->error($profile,'shipping_street'); ?>
                        </div>
                	</div>
                
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'shipping_nr'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'shipping_nr'); ?>
                            <?php echo $form->error($profile,'shipping_nr'); ?>
                        </div>
                	</div>
					
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'shipping_postcode'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'shipping_postcode'); ?>
                            <?php echo $form->error($profile,'shipping_postcode'); ?>
                        </div>
                	</div>
					
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'shipping_city'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->textField($profile,'shipping_city'); ?>
                            <?php echo $form->error($profile,'shipping_city'); ?>
                        </div>
                	</div>
					
					<div class="row-form clearfix">
                		<div class="span3">
                            <?php echo $form->labelEx($profile,'shipping_country_id'); ?>
                        </div>
                		<div class="span9">
                            <?php echo $form->dropDownList($profile, 'shipping_country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' ), array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
                            <?php echo $form->error($profile,'shipping_country_id'); ?>
                        </div>
                	</div>
                    
                   
                	<span class="changeaddress">	<?php echo CHtml::submitButton(Yii::t('global', 'Change address'), array('name'=>'submit', 'class'=>'frontend_account btn btn-warning')); ?> </span>
                	
                        
                <?php $this->endWidget(); ?>
               <span class="space-change"></span>
            </div>
        </div>
    </div>
</div>
