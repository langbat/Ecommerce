
                     
<?php if(Yii::app()->user->isGuest){ ?>
    <div class="login-area pull-right">
        <p class="login-links">
            <a href="<?php echo $this->createUrl('/').(Yii::app()->language == 'de'?'/Anmeldung':'/register'); ?>"><?php echo Yii::t('global', 'Register'); ?></a><span> |
            </span><a href="<?php echo $this->createUrl('/users/lostpassword'); ?>"><?php echo Yii::t('global', 'Forgot Password?'); ?></a></p>
        <div class="login-box">  
                <?php echo CHtml::form($this->createUrl('users/login'), 'post', array('class'=>'frmcontact', 'id'=>'login-form')); ?>
                    <input type="text" class="field-username defaultText" name="LoginForm[email]" id="LoginForm_email"  title="<?php echo Yii::t('global', 'My username'); ?>"/>
                    <input type="password" class="field-password defaultText" name="LoginForm[password]" id="LoginForm_password" value="" title="<?php echo Yii::t('global', 'My password'); ?>"/>
                    <?php echo CHtml::submitButton(Yii::t('global', 'Login'), array('class'=>'btn-login', 'name'=>'submit')); ?>
               	<?php echo CHtml::endForm(); ?>
        </div>
    </div><!--#end login-box-->
<?php }else{ ?>
    <div class="login-area pull-right" style="padding-left:-100px;">
        <p class="login-links"><?php echo Yii::t('global', 'Hello') ?>, <a href="<?php echo $this->createUrl('/profile/index'); ?>"><b><?php echo Yii::app()->user->username; ?></b></a><span> | </span><a href="<?php echo $this->createUrl('/logout/index'); ?>" class="deleteSessionAjax" style="color: #A10EA1;"><?php echo Yii::t('global', '(Logout)'); ?></a></p>
        
        <p class="login-links"><?php echo Yii::t('global', 'Account Balance') ?>: <span class="balance my_balance"><?php echo Utils::number_format(Yii::app()->session['my_balance'])?> &euro;</span></p>
        
    </div><!--#end login-box-->
<?php } ?>

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
<script type="text/javascript">
    $(document).ready(function(){
        $('.deleteSessionAjax').live('click',function(){
            $.session.clear();
        });
    })
</script>