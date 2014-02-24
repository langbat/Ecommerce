<div class="container">

		<div class="content-container">
			<div class="content-wrapper">
				<div class="pull-left col-left">
					<div class="clearfix"></div>
                    <!--<div class="cart-wrapper">
						<div class="cart-grid purple-grid register">
							<div class="title">
								<ul class="inline menu">
										<li>
											<span class="a-left"></span>
											<a href="#"><?php /*echo Yii::t('global','Shopping cart'); */?></a>
											<span class="a-right"></span>
										</li>
										<li class="active">
											<span class="a-left"></span>
											<a href="#"><?php /*echo Yii::t('global','Register'); */?></a>
											<span class="a-right fix-register"></span>
										</li>
										<li>
											<span class="a-left"></span>
											<a href="#"><?php /*echo Yii::t('global','Complete order');*/?></a>
											<span class="a-right"></span>
										</li>												
								</ul>
							</div>
						</div>
					</div>--><!--#end vote-wrapper-->

                    <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'validation',
                    	'enableAjaxValidation'=>false,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )); ?>
                    	<?php  echo $form->errorSummary($model); ?>
                        
                        <div class="personal_settings">
							<h1 class="title"><?php echo Yii::t('global', 'Your Personal Infomation'); ?></h1>
							<div class="salutation">
								<?php echo $form->labelEx($model,'gender'); ?>
										<?php echo $form->radioButtonList($model,'gender',array('1'=>Yii::t('global','Male'),'0'=>Yii::t('global','Female')),array('separator'=>'','class'=>'radio validate[required]','template'=>'{input}<span>{label}</span>')); ?>
								<div class="clearfix">&nbsp;</div>
							</div>
                            
							<div class="salutation">
								<?php echo $form->labelEx($model,'fname'); ?>
								<span>
                                    <?php echo $form->textField($model,'fname',array('size'=>40,'maxlength'=>40,'title' => Yii::t('global', 'Enter your first name') )); ?>
                                </span>
								<div class="clearfix">&nbsp;</div>
							</div>
							
							<div class="salutation">
								<?php echo $form->labelEx($model,'lname'); ?>
								<span>
								    <?php echo $form->textField($model,'lname',array('size'=>40,'maxlength'=>40, 'title' => Yii::t('global', 'Enter your last name') )); ?>

                                </span>
								<?php echo $form->error($model,'lname'); ?>
								<div class="clearfix">&nbsp;</div>
							</div>
                            
                            <div class="salutation">
								<?php echo $form->labelEx($model,'birthday'); ?>
								<span>
									<?php
                                        echo $form->dropDownList($model, 'bday', DateHelper::getDays(), array('prompt' => Yii::t('global','Day'),'class' => 'validate[required]'));
                                        echo $form->dropDownList($model, 'bmonth', DateHelper::getMonths(), array('prompt' => Yii::t('global','Month'),'class' => 'validate[required]'));
                                        echo $form->dropDownList($model, 'byear', DateHelper::getYears(), array('prompt' => Yii::t('global','Year'),'class' => 'validate[required]'));
                                    ?>
                                        <?php echo $form->error($model,'birthday'); ?>
								</span>
							</div>
                            
							<div class="clearfix">&nbsp;</div>

							<div class="salutation">
								<?php echo $form->labelEx($model,'street'); ?>
								<span>	
									<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255, 'title' => Yii::t('global', 'Enter your street'))); ?>
                                    <?php echo $form->textField($model,'nr',array('size'=>60,'maxlength'=>255, 'class' => 'last', 'title' => Yii::t('global', 'Enter your address'))); ?>
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
									<?php echo $form->textField($model,'postcode', array('class' => 'first', 'title' => Yii::t('global', 'Enter your Post Code '))); ?>
                                    <?php echo $form->textField($model,'city', array('title' => Yii::t('global', 'Enter your city'))); ?>
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
									<?php echo $form->dropDownList($model, 'country', $country, array( 'prompt' => Yii::t('global', '-- Choose Value --') )); ?>
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
								    <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>155,'onchange'=>'checkUser()','class'=>'username', 'title' => Yii::t('global', 'Enter your username'))); ?>
                                    <div class="noticeStatus" id="noticeStatus"></div>
                                </span>
								<?php echo $form->error($model,'username'); ?>
								<div class="clearfix">&nbsp;</div>

							</div>
							
                            
			
							<div class="salutation">
								<?php echo $form->labelEx($model,'email'); ?>
								<span>
								    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>155, 'title' => Yii::t('global', 'Enter your desired email address'))); ?>
                                </span>
								<?php echo $form->error($model,'email'); ?>
								<div class="clearfix">&nbsp;</div>
							</div>
							
			
							<div class="salutation">
								<?php echo $form->labelEx($model,'password'); ?>
								<span>
                                    <?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40,'class'=>'validate[minSize[8]]', 'title' => Yii::t('global', 'Enter your desired password '))); ?>
                                </span>
								<?php echo $form->error($model,'password'); ?>
								<div class="clearfix">&nbsp;</div>
							</div>
                            <div class="salutation">
                                <?php echo $form->labelEx($model,'password2'); ?>
                                <span>
                                    <?php echo $form->passwordField($model,'password2',array('size'=>40,'maxlength'=>40, 'class' => 'validate[equals[Profile_password] ', 'title' => Yii::t('global', 'Confirm your password'))); ?>
                                </span>
                                <?php echo $form->error($model,'password2'); ?>
                                <div class="clearfix">&nbsp;</div>
                            </div>

                            <div class="note">
								 <?php echo Yii::t('global','Your password must be at least 8 characters.'); ?>
							</div>

							<div class="salutation">

                                <?php
                                $SourceFrom = Lookup::items('SourceFrom');
                                echo $form->labelEx($model,'sourcefrom'); ?>
                                <span id='country'>
                                    <?php echo $form->dropDownList($model, 'sourcefrom',$SourceFrom, array( 'prompt' => Yii::t('global', '-----Choose Value-----') )); ?>
                                </span>
								<?php echo $form->error($model,'sourcefrom'); ?>
								<div class="clearfix">&nbsp;</div>
							</div>
						
						
							<div class="salutation">
								<?php echo $form->labelEx($model,'coupon'); ?>
								<span>
								    <?php echo $form->textField($model,'coupon', array('title' => Yii::t('global', 'Enter your Coupon Code address') )); ?>
                                </span>
								<?php echo $form->error($model,'coupon'); ?>
								<div class="clearfix">&nbsp;</div>
							</div> 	

							<div class="salutation check">
                                <?php echo $form->checkBox($model,'accepted'); ?><span><?php echo Yii::t('global','I have read and accept'); ?> <a href="/terms-of-service"><?php echo Yii::t('global','Term of Service '); ?></a><?php echo Yii::t('global',' and '); ?><a href="/privacy-policy"><?php echo Yii::t('global','Privacy'); ?> </a></span>

                            </div>
							<div class="clearfix"></div>
							<div class="salutation check">
                                <?php echo $form->checkBox($model,'subcriber'); ?><?php echo Yii::t('global','I want to subcriber the newsletters.'); ?>
							</div>
							<div class="clearfix"></div>
						</div>
                    
                        <div class="actions">
							<label><span class="required">* </span><?php echo Yii::t('global', 'This fields is required') ;?></label>
							
                            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Register Now') : Yii::t('global','Save'), array('class'=>'btn', 'id'=>'registerbutton','onclick'=>'return false' )); ?>
						</div>
                    
                    <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>


<script type="text/javascript">
$("#validation").validationEngine({promptPosition : "topLeft", scroll: true});
function checkUser(){
    var username = $('.username').val();
    $.get('/profile/checkUser?username='+username, function(html) {
            $('.noticeStatus').html(html);
    });
}


$('#registerbutton').live('click',function(){
       var checkUser = $('.noticeStatus').html();
    if(checkUser == ''){
        $('#validation').submit();
    } else {
        $(window).scrollTop($('#noticeStatus').offset().top);
    }
})



</script>