
<div class="pull-left col-left">

    <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 2))?>

            <?php
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'members-form',
                    'enableAjaxValidation'=>false,
                )); ?>
            <div class="vote-content" >

                    <div class="salutation">
                        <h5><?php echo Yii::t('global', 'Enter a basic info.')?></h5>
                    </div>

                    <div id="billing_address" >
                        <div class="salutation">
                            <label ><?php echo Yii::t('global', 'Email'); ?> <span class="required">*</span></label>
                            <span>
                                <?php echo $form->textField($model,'email', array('class'=>'validate[required]')); ?>
                                </span>
                        </div>
                    </div>
                    <div class="salutation">
                        <h5><?php echo Yii::t('global', 'Enter a new billing address.')?></h5>
                    </div>

                    <div id="billing_address" >
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
                            <label><?php echo Yii::t('global', 'Postcode and Ort'); ?> <span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'postcode', array('class' =>'first validate[required]','onkeypress'=>'validate(event)')); ?>
                            <?php echo $form->textField($model,'city',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Country'); ?> <span class="required">*</span></label>
						<span id="country">
							<?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' )); ?>
						</span>
                        </div>

                        <div class="salutation">
                            <label><?php echo Yii::t('global', 'Phone'); ?> <span class="required">*</span></label>
						<span id="country">
							<?php echo $form->textField($model,'phone',array('class'=>'validate[required]')); ?>
						</span>
                        </div>
                    </div>

                    <div class="option_info">
                        <label class="delivery"><?php echo Yii::t('global','Delivery address') ?></label>
                        <input class="radio validate[required]" id="use_default" value="0" type="radio"  name="billing_select">
                        <label class="label_option_info" for="use_default"><?php echo  Yii::t('global','Use given address') ?></label>
                        <input class="radio validate[required] fix_margin_radio" id="create_new" checked="checked" value="1" type="radio" name="billing_select">
                        <label class="label_option_info" for="create_new"><?php echo Yii::t('global','Enter another shippment address') ?></label>

                    </div>
                    <div class="billing_hide">
                        <div class="salutation">
                            <h5><?php echo Yii::t('global', 'Enter a new shipping address.')?></h5>
                        </div>
                        <div id="shipping_address" >
                            <div class="salutation">
                                <label><?php echo Yii::t('global', 'Fullname'); ?> <span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'shipping_fname', array('style'=>'width: 44%','class'=>'validate[required]')); ?>
                            <?php echo $form->textField($model,'shipping_lname', array('style'=>'width: 44%; margin-left: 2%','class'=>'validate[required]')); ?>
						</span>
                            </div>
                            <div class="salutation">
                                <label><?php echo Yii::t('global', 'Street and Nr'); ?> <span class="required">*</span></label>
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
                                <label><?php echo Yii::t('global', 'Postcode and Ort'); ?> <span class="required">*</span></label>
						<span>
							<?php echo $form->textField($model,'shipping_postcode', array('class' =>'first validate[required]','onkeypress'=>'validate(event)')); ?>
                            <?php echo $form->textField($model,'shipping_city',array('class'=>'validate[required]')); ?>
						</span>
                            </div>
                            <div class="salutation">
                                <label><?php echo Yii::t('global', 'Country'); ?> <span class="required">*</span></label>
						<span id="country">
							<?php echo $form->dropDownList($model, 'shipping_country_id', CHtml::listData(Countries::model()->findAll(), 'id', 'short_name' )); ?>
						</span>
                            </div>

                            <div class="salutation">
                                <label><?php echo Yii::t('global', 'Phone'); ?> <span class="required">*</span></label>
						<span id="country">
							<?php echo $form->textField($model,'shipping_phone',array('class'=>'validate[required]')); ?>
						</span>
                            </div>
                        </div>

                    </div>

                <div class="clearfix"></div>
                    <div>
                        <input class="btn-kaufen fix-checkout" type="submit" value="<?php echo Yii::t('global', 'Continue')?>" />
                    </div>
                <div class="clearfix"></div>
                <br />
            </div>
            <?php $this->endWidget(); ?>
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
    $('.option_info input').on('change', function() {
        var options = $('input[name=billing_select]:checked', '.option_info').val();
        if(options == 1){
            $('.billing_hide').css('display','block');
        } else {
            $('.billing_hide').css('display','none');
        }
    });
</script>