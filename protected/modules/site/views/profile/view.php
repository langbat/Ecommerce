<div class="content-wrapper">
    <?php if(Yii::app()->user->isGuest){ ?>
    <div class="pull-left col-left">
       <div class="slider-box purple-grid fix-boder">
            <div class="message_profile fix-message">
                <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                <p>
                    <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                </p>
            </div>
       </div>
    </div>
    <?php } else { ?>
    <div class="pull-left col-left">
        <div class="personal_settings">
            <h1 class="title"><?php echo Yii::t('global', 'My profile'); ?></h1>
            <div class="message_profile">
                <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Welcome'); ?></span>, <?php echo $model->username; ?></h1>
                <p>
                <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Here you  can edit your persional information. Keep your information up to date, as this\'s neccessary for delivery your winning and purchasing.'); ?></span>
                </p>
            </div>
            <?php if($err!='') echo "<div class='error_pass'>".$err."</div>" ?>
            <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'validation',
            'enableAjaxValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

            <?php echo $form->errorSummary($model); ?>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'gender'); ?>
                    <?php echo $form->radioButtonList($model,'gender',array('1'=>Yii::t('global','Male'),'0'=>Yii::t('global','Female')),array('separator'=>'','class'=>'radio validate[required]','template'=>'{input}<span>{label}</span>')); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'fname'); ?>
                    <span>
                                    <?php echo $form->textField($model,'fname',array('size'=>40,'maxlength'=>40,'title' => Yii::t('global', 'Enter your first name'),'class' => 'validate[required]')); ?>
                                </span>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'lname'); ?>
                    <span>
								    <?php echo $form->textField($model,'lname',array('size'=>40,'maxlength'=>40, 'title' => Yii::t('global', 'Enter your last name'),'class' => 'validate[required]' )); ?>
                                </span>
                    <?php echo $form->error($model,'lname'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'birthday'); ?>
                    <span>
									<?php $tmp= explode('.',$model->birthday);
                        echo $form->dropDownList($model, 'bday', DateHelper::getDays(), array('prompt' =>$tmp[0]));
                        echo $form->dropDownList($model, 'bmonth', DateHelper::getMonths(), array('prompt' => $tmp[1]));
                        echo $form->dropDownList($model, 'byear', DateHelper::getYears(), array('prompt' => $tmp[2],));
                        ?>
                        <?php echo $form->error($model,'birthday'); ?>
								</span>
                </div>

                <div class="clearfix">&nbsp;</div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'street'); ?>
                    <span>
									<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255, 'title' => Yii::t('global', 'Enter your street'),'class' => 'validate[required]')); ?>
                        <?php echo $form->textField($model,'nr',array('size'=>60,'maxlength'=>255, 'class' => 'validate[required] last', 'title' => Yii::t('global', 'Enter your address'))); ?>
                                </span>

                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'ext_information'); ?>
                    <span>
								    <?php echo $form->textField($model,'ext_information',array('size'=>60,'maxlength'=>255, 'title' => Yii::t('global', 'Enter your extra information ') )); ?>
                                </span>
                    <?php echo $form->error($model,'ext_information'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>


                <div class="salutation">
                    <label><?php echo $form->labelEx($model,'postcode'); ?></label>
								<span>
									<?php echo $form->textField($model,'postcode', array('class' => 'validate[required] first', 'title' => Yii::t('global', 'Enter your Post Code '))); ?>
                                    <?php echo $form->textField($model,'city', array('title' => Yii::t('global', 'Enter your city'),'class' => 'validate[required]')); ?>
                                </span>

                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php $country = CHtml::listData(Countries::model()->findAllByAttributes(array('is_active' => 1)), 'id', 'short_name' );
                    foreach ($country as $key=>$value){
                        $country[$key] = Yii::t('global', $value);
                    }
                    echo $form->labelEx($model,'country_id'); ?>
                    <span id="country">
									<?php echo $form->dropDownList($model, 'country', $country); ?>
								</span>
                    <?php echo $form->error($model,'country'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'phone'); ?>
                    <span>
								    <?php echo $form->textField($model,'phone',array('size'=>40,'maxlength'=>40, 'title' => Yii::t('global', 'Enter your phone') )); ?>
                                </span>
                    <?php echo $form->error($model,'phone'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <span>
								    <?php echo $model->username ;//$form->textField($model,'username',array('size'=>60,'maxlength'=>155,'onchange'=>'checkUser()','class'=>'username', 'title' => Yii::t('global', 'Enter your first name '))); ?>
                        <div class="noticeStatus" id="noticeStatus"></div>
                                </span>
                    <?php echo $form->error($model,'username'); ?>
                    <div class="clearfix">&nbsp;</div>

                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <span>
								    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>155, 'title' => Yii::t('global', 'Enter your desired email address'),'class'=>" validate[required]")); ?>
                                </span>
                    <?php echo $form->error($model,'email'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>
                <div class="change_pass"><?php echo Yii::t('global','Change Password'); ?></div>
            <div class="error_password"></div>
                <div class="salutation">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <span>
                                    <?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40,'class'=>'validate[minSize[8]]', 'title' => Yii::t('global', 'Enter your desired password '),'value'=>'')); ?>
                                </span>
                    <?php echo $form->error($model,'password'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="salutation">
                    <?php echo $form->labelEx($model,'npassword'); ?>
                    <span>
                                    <?php echo $form->passwordField($model,'password2',array('size'=>40,'maxlength'=>40, 'class' => 'validate[minSize[8]] ')); ?>
                                </span>
                    <?php echo $form->error($model,'npassword'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>
            <div class="salutation">
                    <?php echo $form->labelEx($model,'npassword2'); ?>
                    <span>
                                    <?php echo $form->passwordField($model,'npassword2',array('size'=>40,'maxlength'=>40)); ?>
                                </span>
                    <?php echo $form->error($model,'npassword2'); ?>
                    <div class="clearfix">&nbsp;</div>
                </div>


                <div class="salutation check_profile">

                    <?php if($emailNewsletter ==1){
                    echo "<input type='checkbox' name='Members[subcriber]' id='Members_subcriber' checked value=''>";
                    } else echo "<input type='checkbox' name='Members[subcriber]' id='Members_subcriber' value='' >"; ?>
                    <?php echo Yii::t('global','I want to receive information about bonus activities, guideline and new things.'); ?>
                </div>
                <div class="clearfix"></div>

            <div class="actions">

                <?php echo CHtml::submitButton( Yii::t('global','Save'), array('class'=>'btn registerbutton', 'id'=>'registerbutton','onclick'=>'return false' )); ?>
            </div>
            
            <?php $this->endWidget(); ?>
           
        </div>
        <table><tr><td height=10px></td></tr></table>
        <br /> 
    </div><!--#end col-left-->
    
    <?php } ?>
    <div class="pull-left col-right">
        <?php if(Yii::app()->user->isGuest){ ?>
        <?php $this->renderPartial('/elements/right-ads');?>
        <?php //$this->renderPartial('/elements/auction-finished');?>
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
        <?php }else{ ?>
        <div class="right-box">
            <?php $this->renderPartial('/elements/profile-menu')?>
        </div>
        <?php //$this->renderPartial('/elements/right-ads');?>
        <?php //$this->renderPartial('/elements/auction-finished');?>
        <?php //$this->renderPartial('/elements/tested-safety');?>
        <?php //$this->renderPartial('/elements/news-box');?>
        <?php } ?>
    </div><!--#end col-right-->
    <div class="clearfix"></div>

</div>
<script type="text/javascript">
    /*function checkAddEmail(id){
        var checkEmail = document.getElementById('addEmail');
        if( checkEmail.checked){
            $.get('/profile/addNewsletter?user_id='+id, function(){});
        } else {
            $.get('/profile/removeNewsletter?user_id='+id, function(){});
        }
    }*/
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});



    $('#registerbutton').live('click',function(){
        var oldPassword = $('#Members_password').val();
        var newPassword = $('#Members_password2').val();
        var newPasswordCon = $('#Members_npassword2').val();
        if(oldPassword != '' && newPassword == ''){
            $('.error_password').html('<?php echo Yii::t('global','New password cant empty') ?>');
        } else if (newPassword != '' && newPasswordCon != newPassword){
            $('.error_password').html('<?php echo Yii::t('global','New password confirm not same new password') ?>')
        } else {
            $('#validation').submit();
        }
    })
    setTimeout(function(){},10000);

</script>