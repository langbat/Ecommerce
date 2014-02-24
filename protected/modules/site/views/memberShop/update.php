


<div class="content-block">

        <div class="wrapper_profile">
            <div class="slider-box purple-grid">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { if($fl!=0 && $fl!=1){?>
                    
                    <div class="title"><h5><?php echo Yii::t('global','My Shop');?></h5></div>
                    <?php } elseif($fl==0){?>
                    <div class="title"><h5><?php echo Yii::t('global','Setup Welcome');?></h5></div>
                     <?php } elseif($fl==1){?>
                     <div class="title"><h5><?php echo Yii::t('global','Setup Service');?></h5></div>
                     <?php } ?>
                    <div class="info_profile fix-info-profile">
                        <?php echo $this->renderPartial('_form', array('model'=>$model,'fl'=>$fl)); ?>
                    </div><!--#end info-->
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
 

  
    <div class="clearfix"></div>
</div>
