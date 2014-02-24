
    <h1 class="title"><?php echo Yii::t('global', 'Edit Profile'); ?></h1>
    
    <?php echo CHtml::form($this->createUrl('users/index'), 'post', array('class'=>'frmcontact', 'id'=>'validation2', 'enctype'=>'multipart/form-data')); ?>
    
    <?php if($model->hasErrors()): ?>
    	<p class="error">
    		<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
    	</p>
    <?php endif; ?>
    
    <div class="row-fluid">
    	<div class="span3 bold"></div>
    	<div class="span4"><img src="<?php echo Yii::app()->homeUrl.'uploads/avatar/';
    		if($model->photo !='' && file_exists(ROOT_PATH.'uploads/avatar/t_'.$model->photo) ) echo 't_'.$model->photo;
    		else echo 'default.png';
    	?>" alt="<?php echo $model->fname . ' ' . $model->lname; ?>"/></div>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'photo'); ?></div>
    	<div class="span4"><input type="file" name="photo" class="tooltipsy" title="Upload your photo"/></div>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'fname'); ?></div>
    	<div class="span4"><?php echo CHtml::activeTextField($model, 'fname', array( 'class' => 'tooltipsy validate[required,minSize[3]]', 'title' => Yii::t('global', 'Enter your first name') )); ?></div>
    	<?php echo CHtml::error($model, 'fname', array( 'class' => 'span5 error' )); ?>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'lname'); ?></div>
    	<div class="span4"><?php echo CHtml::activeTextField($model, 'lname', array( 'class' => 'tooltipsy validate[required,minSize[3]]', 'title' => Yii::t('global', 'Enter your last name') )); ?></div>
    	<?php echo CHtml::error($model, 'lname', array( 'class' => 'span5 error' )); ?>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'address'); ?></div>
    	<div class="span4"><?php echo CHtml::activeTextField($model, 'address', array( 'class' => 'tooltipsy validate[required,minSize[3]]', 'title' => Yii::t('global', 'Enter your address') )); ?></div>
    	<?php echo CHtml::error($model, 'address', array( 'class' => 'span5 error' )); ?>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'city'); ?></div>
    	<div class="span4"><?php echo CHtml::activeTextField($model, 'city', array( 'class' => 'tooltipsy validate[required,minSize[3]]', 'title' => Yii::t('global', 'Enter your city') )); ?></div>
    	<?php echo CHtml::error($model, 'city', array( 'class' => 'span5 error' )); ?>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'phone'); ?></div>
    	<div class="span4"><?php echo CHtml::activeTextField($model, 'phone', array( 'class' => 'tooltipsy validate[required,custom[phone]]', 'title' => Yii::t('global', 'Enter your phone number') )); ?></div>
    	<?php echo CHtml::error($model, 'phone', array( 'class' => 'span5 error' )); ?>
    </div>
    
    <div class="row-fluid">
    	<div class="span3 bold"></div>
    	<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Save changes'), array('class'=>'btn-submit', 'name'=>'submit')); ?></div>
    </div>                            
    
    <?php echo CHtml::endForm(); ?>
    
    
    
    
   