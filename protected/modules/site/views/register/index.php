
<link rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
<div class="subheader">
	<div class="left">
		<span class="page-title"><?php echo Yii::t('register', 'Đăng Ký'); ?></span>
		<span class="page-desc">Lorem ipsum dolor sit amet consectuer adisplicing</span>			</div>
</div>

        
<div id="content">

<div class="post-item post-thumb-hor" style="padding: 20px 20px 20px 100px;">

	<p><?php echo Yii::t('register', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
	<?php if($model->hasErrors()): ?>
			<div class="errordiv">
				<?php echo Yii::t('register', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
			</div>
		<?php endif; ?>
	</br>
	<?php echo CHtml::form($this->createUrl('register/index', array('lang'=>Yii::app()->language)), 'post', array('class'=>'frmcontact', 'id'=>'validation2', 'enctype'=>'multipart/form-data')); ?>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Username'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'username', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'Username*','size'=>50, 'title' => Yii::t('register', 'Enter your desired username (Min: 3 Max: 32)') )); ?></div>
			<?php echo CHtml::error($model, 'username', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Password'); ?></div>
			<div class="span4"><?php echo CHtml::activePasswordField($model, 'password', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'Password*','size'=>50, 'title' => Yii::t('register', 'Enter your desired password (Min: 3 Max: 32)') )); ?></div>
			<?php echo CHtml::error($model, 'password', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Re-password'); ?></div>
			<div class="span4"><?php echo CHtml::activePasswordField($model, 'password2', array( 'class' => 'text tooltipsy validate[required,equals[RegisterForm_password]','placeholder'=>'Password2*','size'=>50, 'title' => Yii::t('register', 'Confirm your password') )); ?></div>
			<?php echo CHtml::error($model, 'password2', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">		
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Email'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text tooltipsy validate[required,custom[email]]','placeholder'=>'Email*', 'size'=>50, 'title' => Yii::t('register', 'Enter your desired email address') )); ?></div>
			<?php echo CHtml::error($model, 'email', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'First Name'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'fname', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'First Name*','size'=>50, 'title' => Yii::t('register', 'Enter your first name') )); ?></div>
			<?php echo CHtml::error($model, 'fname', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Last name'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'lname', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'Last Name*', 'size'=>50, 'title' => Yii::t('register', 'Enter your last name') )); ?></div>
			<?php echo CHtml::error($model, 'lname', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Address'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'address', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'Address*','size'=>50, 'title' => Yii::t('register', 'Enter your address') )); ?></div>
			<?php echo CHtml::error($model, 'address', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'City'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'city', array( 'class' => 'text tooltipsy validate[required,minSize[3]]','placeholder'=>'City*','size'=>50, 'title' => Yii::t('register', 'Enter your city') )); ?></div>
			<?php echo CHtml::error($model, 'city', array( 'class' => 'span5' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Phone'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'phone', array( 'class' => 'text tooltipsy validate[required,custom[phone]]','placeholder'=>'Phone*','size'=>50, 'title' => Yii::t('register', 'Enter your phone number') )); ?></div>
			<?php echo CHtml::error($model, 'phone', array( 'class' => 'span5' )); ?>
		</div>
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Avartar'); ?></div>
			<div class="span4" style="margin-bottom:10px;"><input type="file" name="photo" placeholder="Photo" class="text tooltipsy" title="Upload your photo"/></div>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Affiliate ID'); ?></div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'parent_id', array( 'class' => 'text tooltipsy validate[custom[affiliate]]','placeholder'=>'Affiliate ID','size'=>50, 'title' => Yii::t('register', 'Enter an ID and select your Affiliate Name from the drop down list') )); ?></div>
			<!--<div class="span5" id="refname"><?php echo $refname; ?></div> -->
			<input type="hidden" id="pid" value="<?php echo $model->parent_id > 0 ? $model->parent_id : ''; ?>"/>
		</div>
		
		<?php /*
		<div class="row-fluid">
			<div class="span5 bold"><?php echo CHtml::activeLabel($model, 'verifyCode'); ?> *</div>
			<div class="span7">
				<?php echo CHtml::activeTextField($model, 'verifyCode', array( 'class' => 'tooltipsy validate[required]', 'title' => Yii::t('register', 'Enter the text displayed in the image below') )); ?>
				<br/><?php $this->widget('CCaptcha', array('buttonLabel'=>'Get a new code', 'buttonOptions'=>array('class'=>'btnRefresh', 'title'=>'Get a new code'))); ?>
			</div>
			<?php echo CHtml::error($model, 'verifyCode', array( 'class' => 'span5 error' )); ?>
		</div>
		*/ ?>
		<div class="row-fluid">
			<div class="span3 bold"></div>
			<div class="span4">
				<input type="checkbox" class="validate[required] checkbox" value="1" name="terms" id="termsid"> 
				<label for="termsid"><?php echo Yii::t('register', 'I have read and accept'); ?> <a href="<?php echo $this->createUrl(Yii::app()->language.'/terms-of-service', array('lang'=>false)); ?>" target="_blank" title="<?php echo Yii::t('register', 'the Terms of Service'); ?>"><?php echo Yii::t('register', 'the Terms of Service'); ?></a></label>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold"></div>
			<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Create'), array('name'=>'submit')); ?></div>
		</div>                            
		
	<?php echo CHtml::endForm(); ?>		
	
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#RegisterForm_parent_id').autocomplete({
			source: 'http://' + ROOT + '/register/ajaxuser',
			minLength: 1,
			select: function( event, ui ) {
				$('#pid').val(ui.item.value);
				$('#refname').html(ui.item.label);
			},
			change: function() {
				if($('#RegisterForm_parent_id').val() != $('#pid').val())
				{
					$('#RegisterForm_parent_id, #pid').val('');
					$('#refname').html('');
				}
			}
		}).change(function(){
			if($('#RegisterForm_parent_id').val() != $('#pid').val())
			{
				$('#RegisterForm_parent_id, #pid').val('');
				$('#refname').html('');
			}
		});
	});
</script>
</div>
