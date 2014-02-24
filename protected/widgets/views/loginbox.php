<ul class="nav" id="login_box">
	<li class="dropdown">
	<?php if( Yii::app()->user->isGuest )
	{ ?>
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo Yii::t('global', 'Login'); ?></a>
		<ul class="dropdown-menu">
			<?php echo CHtml::form(Yii::app()->createUrl('/login'), 'post', array('id'=>'validation')); ?>
				<div class="row-fluid">
					<label for="LoginBox_email"><?php echo Yii::t('global', 'Email'); ?></label>
				</div>
				<div class="row-fluid">
					<input type="text" placeholder="Email" class="tooltipsy validate[required,custom[email]]" name="LoginForm[email]" id="LoginBox_email" value=""/>
				</div>
				
				<div class="row-fluid">
					<label for="LoginBox_password"><?php echo Yii::t('global', 'Password'); ?></label>
				</div>
				<div class="row-fluid">
				  <input type="password" placeholder="Password" class="tooltipsy validate[required]" name="LoginForm[password]" id="LoginBox_password" value=""/>
				</div>	

				<div class="row-fluid">
					<?php echo CHtml::submitButton(Yii::t('global', 'Login'), array('name'=>'submit')); ?>
				</div>
				<div class="row-fluid">
					<?php echo CHtml::link(Yii::t('global', 'Forgot password?'), array('/forgot-password')); ?>
				</div>
			<?php echo CHtml::endForm(); ?>
		</ul>
		</li><li>
		<?php echo CHtml::link(Yii::t('global', 'Register'), array('/register'), array('class'=>'register')); ?>
	<?php }
	else
	{
		$my = Members::model()->findByPk(Yii::app()->user->id); ?>
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi, <?php echo $my->getDisplayName(); ?>!</a>
		<ul class="dropdown-menu">
			<?php if($my->vericode != '') : ?><li><?php echo CHtml::link(Yii::t('global', 'Verify email'), array('users/verify')); ?></li><?php endif; ?>
			<li><?php echo CHtml::link(Yii::t('global', 'New Movie'), array('videos/new')); ?></li>
			<li><?php echo CHtml::link(Yii::t('global', 'My Profile'), array('users/viewprofile','id'=>$my->id,'alias'=>$my->seoname)); ?></li>
			<li><?php echo CHtml::link(Yii::t('global', 'Edit Profile'), array('users/index')); ?></li>
			<li><?php echo CHtml::link(Yii::t('global', 'Change password'), array('users/changepass')); ?></li>
			<li><?php echo CHtml::link(Yii::t('global', 'Logout'), array('logout/index')); ?></li>
		</ul><?php 
	} ?>
	</li>
</ul>