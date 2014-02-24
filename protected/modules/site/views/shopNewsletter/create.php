
        <div class="wrapper_profile">
            <div class="slider-box purple-grid">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="title" style="margin-bottom: 20px;"><h5><?php echo Yii::t('global','Create Shop Newsletter');?></h5></div>
                   <div class="create_link"><a class="isw-back tipb" style="margin-top: -50px;" href="/shopNewsletter/index" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
                    <div class="info_profile fix-info-profile" style="margin: 10px;">
                        <?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>
                    </div><!--#end info-->
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
    <div class="clearfix"></div>
