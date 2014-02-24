<div class="content-wrapper">
    <div class="purple-grid">
        <div class="title">
            <h5><?php echo Yii::t('global', 'Reset your password'); ?></h5>
        </div>        
        <div class="top_text fix_user">
            <?php if(Yii::app()->user->hasFlash('error')){ ?>
            <div class="info error-lost-password">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
            <?php } ?>   
            <p><h4><?php echo Yii::t('global', 'Forgot your password?'); ?></h4></p>
    		<p><?php echo Yii::t('global', 'Enter you email here. You will receive a reset password via email.'); ?></p>
    		<span class="space-change"></span>	
    		<?php echo CHtml::form($this->createUrl('users/lostpassword'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
    
    			<?php if($model->hasErrors()): ?>
    				<p class="error">
    					<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
    				</p>
    			<?php endif; ?>
    			
    			<div class="row-fluid">
    				<div class="span3 bold"> <?php echo Yii::t('global', 'Username'); //CHtml::activeLabel($model, 'Username'); ?> 
                    <?php echo CHtml::activeTextField($model, 'username', array( 'class' => 'text tooltipsy validate[required,custom[username]]', 'title' => Yii::t('global', 'Enter your username') )); ?> </div>
    				<div class="span4"></div>
    				<?php echo CHtml::error($model, 'username', array( 'class' => 'span6 error' )); ?>
    			</div>
    		   <?php 	
    			/*<div class="row-fluid">
    				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'verifyCode'); ?> </div>
    				<div class="span4" style="margin-bottom:20px;">
    					<?php echo CHtml::activeTextField($model, 'verifyCode', array( 'class' => 'text tooltipsy validate[required]', 'title' => Yii::t('global', 'Enter the text displayed in the image below') )); ?>
    					<br/><?php $this->widget('CCaptcha', array('buttonLabel'=>'Get a new code', 'buttonOptions'=>array('class'=>'btnRefresh', 'style'=>'margin-left:20px;', 'title'=>'Get a new code'))); ?>
    				</div>
    				<?php echo CHtml::error($model, 'verifyCode', array( 'class' => 'span6 error' )); ?>
    			</div>*/
    			?>
    			<div class="row-fluid">
    				<div class="span3 bold"><?php echo CHtml::submitButton(Yii::t('global', 'Request'), array('name'=>'submit','class'=>'btn-orange')); ?></div>
    				<div class="span4"></div>
    			</div>
    			
    		<?php echo CHtml::endForm(); ?>
            <span class="space-change"></span>
            
            <p><h4><?php echo Yii::t('global', 'Forgot Username?'); ?></h4></p>
    		<p><?php echo Yii::t('global', 'Then enter your email here. You will receive your username via email'); ?></p>
    		<span class="space-change"></span>
            <?php echo CHtml::form($this->createUrl('users/lostpassword'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
    
    			<?php if($model->hasErrors()): ?>
    				<p class="error">
    					<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
    				</p>
    			<?php endif; ?>
    			
    			<div class="row-fluid">
    				<div class="span3 bold"> <?php echo Yii::t('global', 'Email Address');//CHtml::activeLabel($model, 'E-Mail-Adresse'); ?> 
                    <?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text tooltipsy validate[required,custom[email]]', 'title' => Yii::t('global', 'Enter your email address') )); ?> </div>
    				<div class="span4"></div>
    				<?php echo CHtml::error($model, 'email', array( 'class' => 'span6 error' )); ?>
    			</div>
    			<div class="row-fluid">
    				<div class="span3 bold"><?php echo CHtml::submitButton(Yii::t('global', 'Request'), array('name'=>'submit','class'=>'btn-orange')); ?></div>
    				<div class="span4"></div>
    			</div>
    			
    		<?php echo CHtml::endForm(); ?>
            <span class="space-change"></span>	
       </div>        
    </div>
</div>
