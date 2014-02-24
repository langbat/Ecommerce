<?php $model = Members::model()->findByPk(Yii::app()->user->id); ?>
<div class="pull-left col-left">

    <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 2))?>

            <?php
            if (!Yii::app()->user->isGuest)
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'members-form',
                    'enableAjaxValidation'=>false,
                )); ?>
            <div class="vote-content" <?php echo Yii::app()->user->isGuest?'style="background: #EEEEEE;"':'' ?>>
                <?php if (Yii::app()->user->isGuest):?><br />
                    <div class="wrapper_profile wp_profiles">
                        <div class="slider-box purple-grid profile" style="width: 367px; margin: 10px;">
                            <div class="title"><h5><?php echo Yii::t('global','Already registered?'); ?></h5></div>
                            <div class="info_profile">
                                <div class="inner_container">
                                    <?php echo CHtml::form($this->createUrl('users/login'), 'post', array('class'=>'frmcontact', 'id'=>'login-form-cart')); ?>
                                    <input type="text" class="field-username defaultText" name="LoginForm[email]"  title="<?php echo Yii::t('global', 'My username'); ?>"/>
                                    <input type="password" class="field-password defaultText" name="LoginForm[password]" value="" title="<?php echo Yii::t('global', 'My password'); ?>" style="width: 142px;"/>
                                    <input type="hidden" name="is_from_cart" value="1" />
                                    <?php echo CHtml::submitButton(Yii::t('global', 'Login'), array('class'=>'btn-orange', 'name'=>'submit', 'style'=>"margin-bottom: 10px; ")); ?>
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                            </div><!--#end info-->
                            <div class="clearfix"></div>
                        </div>
                        <div class="slider-box purple-grid profile" style="min-height: 145px;width: 367px; margin: 10px;">
                            <div class="title"><h5><?php echo Yii::t('global','Register with us for future convenience'); ?></h5></div>
                            <div class="info_profile">
                                <div class="inner_container" style="text-align: center; margin: 23px;">
                                    <a href="/register" class="change_mail"><span class="btn-orange"><?php echo Yii::t('global','Register'); ?></span></a>
                                </div>
                            </div><!--#end info-->
                            <div class="clearfix"></div>
                        </div>
                        <div class="slider-box purple-grid profile fix_buy_guest" >
                            <div class="title"><h5><?php echo Yii::t('global','Order as a Guest'); ?></h5></div>
                            <div class="info_profile">
                                <div class="inner_container" style="text-align: center; margin: 23px;">
                                    <a href="/cart/buywithguest" class="change_mail"><span class="btn-orange"><?php echo Yii::t('global','Order as a Guest'); ?></span></a>
                                </div>
                            </div><!--#end info-->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php else:?>
                    <div class="salutation">
                        <h5><?php echo Yii::t('global', 'Select a billing address from your address or enter a new address.')?></h5>
                        <select name="billing_address" id="billing_address" style="width: 100%;">
                            <option value="1"><?php echo $model->getFullname()?> - <?php echo $model->getBillingAddress()?></option>
                            <option value="0"><?php echo Yii::t('global', 'New address')?></option>
                        </select>
                    </div>

                    <div id="billing_address" style="display: none;">
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Fullname'); ?> <span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'fname', array('style'=>'width: 44%','class'=>'validate[required]')); ?>
                            <?php echo $form->textField($model,'lname', array('style'=>'width: 44%; margin-left: 2%','class'=>'validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Street and Nr'); ?> <span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255,'class'=>'validate[required]')); ?>
                            <?php echo $form->textField($model,'nr',array('size'=>60,'maxlength'=>255, 'class' =>'last validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Ext information'); ?></label>
						<span>
							<?php echo $form->textField($model,'ext_information',array('size'=>60,'maxlength'=>255)); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Postcode and Ort'); ?><span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'postcode', array('class' =>'first validate[required]','onkeypress'=>'validate(event)')); ?>
                            <?php echo $form->textField($model,'city',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Country'); ?><span class="required">*</span></label>
						<span id="country">
							<?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' )); ?>
						</span>
                        </div>

                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Phone'); ?><span class="required">*</span></label>
						<span id="country">
							<?php echo $form->textField($model,'phone',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                    </div>

                    <div class="salutation">
                        <h5><?php echo Yii::t('global', 'Select a shipping address from your address or enter a new address.')?></h5>
                        <select name="shipping_address" id="billing_address" style="width: 100%;">
                            <option value="1"><?php echo $model->getShippingFullname()?> - <?php echo $model->getShippingAddress()?></option>
                            <option value="0"><?php echo Yii::t('global', 'New address')?></option>
                        </select>
                    </div>

                    <div id="shipping_address" style="display: none;">
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Fullname'); ?><span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'shipping_fname', array('style'=>'width: 44%','class'=>'validate[required]')); ?>
                            <?php echo $form->textField($model,'shipping_lname', array('style'=>'width: 44%; margin-left: 2%','class'=>'validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Street and Nr'); ?><span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'shipping_street',array('size'=>60,'maxlength'=>255,'class'=>'validate[required]')); ?>
                            <?php echo $form->textField($model,'shipping_nr',array('size'=>60,'maxlength'=>255, 'class' =>'last validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Ext information'); ?></label>
						<span>
							<?php echo $form->textField($model,'shipping_ext_information',array('size'=>60,'maxlength'=>255)); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Postcode and Ort'); ?><span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'shipping_postcode', array('class' =>'first validate[required]','onkeypress'=>'validate(event)')); ?>
                            <?php echo $form->textField($model,'shipping_city',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Country'); ?><span class="required">*</span></label>
						<span id="country">
							<?php echo $form->dropDownList($model, 'shipping_country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' )); ?>
						</span>
                        </div>

                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Phone'); ?><span class="required">*</span></label>
						<span id="country">
							<?php echo $form->textField($model,'shipping_phone',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                    </div>
                <?php endif;?>

                <div class="clearfix"></div>
                <?php if (!Yii::app()->user->isGuest):?>
                    <div>
                        <input class="btn-kaufen fix-checkout" type="submit" value="<?php echo Yii::t('global', 'Continue')?>" />
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <br />
            </div>
            <?php if (!Yii::app()->user->isGuest)
                $this->endWidget(); ?>
        </div>
    </div><!--#end vote-wrapper-->

</div><!--#end col-left-->

<div class="pull-left col-right">
    <?php if(!Yii::app()->user->isGuest){ ?>
        <div class="right-box">
            <?php $this->renderPartial('/elements/profile-menu')?>
        </div>
    <?php } ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/tested-safety');?>
    </div>
</div><!--#end col-right-->

<script type="text/javascript">
    $('#billing_address, #shipping_address').change(function(){
        if (this.value == '0')
            $(this).parent().next().show();
        else
            $(this).parent().next().hide();
    })

</script>