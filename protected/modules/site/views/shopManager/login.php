<div  style="max-width: 480px;margin: 0 auto;">
    <div class="purple-grid" style="">
        <div class="title" style="text-align: center;text-transform: uppercase;margin-bottom: 20px;">
            <h5><?php echo Yii::t('global', 'Login'); ?></h5>
        </div>        
        <div class="top_text fix_user" style="margin: 10px;">
        
            <?php echo CHtml::form($this->createUrl('shopManager/detail'), 'post', array('class'=>'frmcontact fix_login', 'id'=>'validation2')); ?>
                
            	<?php /*
            	<div id='facebookloginbutton'>
            		<?php echo CHtml::link( CHtml::image('http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif', ''), 'javascript:void(0);', array( 'title' => Yii::t('global', 'Login With Facebook'), 'onClick' => "return showFaceBookAuth();" ) ); ?>
            	</div>
            	*/ ?>
            	<label for="LoginForm_email" class="fix_username" style="font-weight: bold;"><?php echo Yii::t('global', 'Email / User Name'); ?></label>
            	<input type="text" class="text tooltipsy validate[required,custom[email]" placeholder="<?php echo Yii::t('global', 'Enter your email address or user name'); ?>" style="width: 100%;padding: 4px 0;" name="LoginForm[email]" id="LoginForm_email" value="<?php //echo $model->email; ?>" title="<?php //echo Yii::t('global', 'Enter your email address'); ?>"/>
            	<?php //echo CHtml::error($model, 'email', array( 'class' => 'span5 error' )); ?>
            
                <div class="cleafix"></div>
            	
                <label for="LoginForm_password" style="font-weight: bold;" class="fix_password"> <?php echo Yii::t('global', 'Password'); ?></label>
            	<input type="password" class="text tooltipsy validate[required]" name="LoginForm[password]" placeholder="<?php echo Yii::t('global', 'Enter your password'); ?>" style="width: 100%;padding: 4px 0;" id="LoginForm_password" value="" title="<?php echo Yii::t('global', 'Enter your password'); ?>"/>
            	<?php //echo CHtml::error($model, 'password', array( 'class' => 'span5 error' )); ?>
            
                <div class="cleafix"></div>
            	
            	<?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn btn-info', 'name'=>'submit')); ?>
            	<?php echo CHtml::link( Yii::t('global', 'Forgot Password?'), array('users/lostpassword'), array('id'=>'forgot','class' => 'forget-pass-user') ); ?>
                
            <?php echo CHtml::endForm(); ?>
            <span class="space-change"></span>
            <?php 
            
            /*
            
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
            <div style="color: red;"><?php if(isset($this->err)){ foreach($this->err as $err=>$value) {
            foreach ($value as $key){
                echo $key ."<br>";
            }
        }
        }
            
        ?></div>    
        </div>        
    </div>
</div>