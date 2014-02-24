<div class="content-wrapper">
    <div class="purple-grid">
        <div class="title">
            <h5><?php echo Yii::t('global', 'Login'); ?></h5>
        </div>        
        <div class="top_text fix_user">

            <?php echo CHtml::form($this->createUrl('users/login'), 'post', array('class'=>'frmcontact fix_login', 'id'=>'validation2')); ?>
                <?php if($model->hasErrors()){ ?>
            		<p class="error">
            			<?php echo Yii::t('global', 'Please enter your data login again.'); //CHtml::errorSummary($model); ?>
            		</p>
            	<?php } else if(Yii::app()->user->hasFlash('success')){ ?>
                        <div class="info">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                        <?php } else { ?>
                    <p><?php echo Yii::t('global', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
            	<?php } ?>
            	<?php /*
            	<div id='facebookloginbutton'>
            		<?php echo CHtml::link( CHtml::image('http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif', ''), 'javascript:void(0);', array( 'title' => Yii::t('global', 'Login With Facebook'), 'onClick' => "return showFaceBookAuth();" ) ); ?>
            	</div>
            	*/ ?>
            	<label for="LoginForm_email" class="fix_username"><?php echo Yii::t('global', 'My username'); ?></label>
            	<input type="text" class="text tooltipsy validate[required,custom[email]" name="LoginForm[email]" id="LoginForm_email" value="<?php //echo $model->email; ?>" title="<?php //echo Yii::t('global', 'Enter your email address'); ?>"/>
            	<?php //echo CHtml::error($model, 'email', array( 'class' => 'span5 error' )); ?>
            
                <div class="cleafix"></div>
            	
                <label for="LoginForm_password" class="fix_password"><?php echo Yii::t('global', 'Password'); ?></label>
            	<input type="password" class="text tooltipsy validate[required]" name="LoginForm[password]" id="LoginForm_password" value="" title="<?php echo Yii::t('global', 'Enter your password'); ?>"/>
            	<?php //echo CHtml::error($model, 'password', array( 'class' => 'span5 error' )); ?>
            
                <div class="cleafix"></div>
            	
            	<?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn-orange', 'name'=>'submit')); ?>
            	<?php echo CHtml::link( Yii::t('global', 'Forgot Password?'), array('users/lostpassword'), array('id'=>'forgot','class' => 'forget-pass-user') ); ?>
                
            <?php echo CHtml::endForm(); ?>
            <span class="space-change"></span>
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
    </div>
</div>