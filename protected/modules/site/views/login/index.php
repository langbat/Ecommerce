<link rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />

<div class="subheader">
			<div class="left">
				<span class="page-title">Đăng Nhập</span>
				<span class="page-desc">Lorem ipsum dolor sit amet consectuer adisplicing</span>			</div>
</div>
<div id="content">
<div class="post-item post-thumb-hor" style="padding: 30px 30px 30px 200px;">

	<p><?php echo Yii::t('login', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
	
	<?php echo CHtml::form($this->createUrl('login/index'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>

		<?php if($model->hasErrors()): ?>
			<p class="error">
				<?php echo Yii::t('login', 'Sorry, But we can\'t find a member with those login information.'); //CHtml::errorSummary($model); ?>
			</p>
		<?php endif; ?>
		
		<?php /*
		<div id='facebookloginbutton'>
			<?php echo CHtml::link( CHtml::image('http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif', ''), 'javascript:void(0);', array( 'title' => Yii::t('login', 'Login With Facebook'), 'onClick' => "return showFaceBookAuth();" ) ); ?>
		</div>
		*/ ?>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Email'); ?></div>
			<div class="span4"><input type="text" placeholder="Email*" class="text tooltipsy validate[required,custom[email]]" name="LoginForm[email]" id="LoginForm_email" value="<?php echo $model->email; ?>" title="<?php echo Yii::t('login', 'Enter your email address'); ?>"/></div>
			<?php //echo CHtml::error($model, 'email', array( 'class' => 'span5 error' )); ?>
		</div>
		
		<div class="row-fluid">
            <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Password'); ?></div>
			<div class="span4"><input type="password" placeholder="Password*" class="text tooltipsy validate[required]" name="LoginForm[password]" id="LoginForm_password" value="" title="<?php echo Yii::t('login', 'Enter your password'); ?>"/></div>
			<?php //echo CHtml::error($model, 'password', array( 'class' => 'span5 error' )); ?>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold" style="margin-left:20px ;"></div>
			<?php echo CHtml::link( Yii::t('login', 'Forgot Password?'), array('lostpassword'), array('id'=>'forgot','class' => 'forget-pass-user') ); ?></div></br>
			<div class="span4" style="margin: -20px 0px 0px 200px;"><?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn-orange', 'name'=>'submit', )); ?>
			 <span class="space-change"></span>
		</div>                            
		
	<?php echo CHtml::endForm(); ?>
	<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
	?>
</div>

<?php /*
<script>
function showOAuth()
{
	window.open('<?php echo $this->createUrl( 'facebooklogin' ); ?>');
}
function showFaceBookAuth()
{
	window.open('<?php echo $facebookLink; ?>', 'Facebook Login',"status=1,height=600,width=700");
}
</script>
*/ ?>
</div>