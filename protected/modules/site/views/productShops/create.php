

<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="wrapper_profile">
            <div class="slider-box purple-grid fix-boder">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="title"><h5><?php echo Yii::t('global','Create Products Shop');?></h5></div>
                       <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <ul class="buttons">
                            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
                        </ul> 
                    </div>
                    <div class="info_profile fix-info-profile">
                        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                    </div><!--#end info-->
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
    </div><!--#end col-left-->

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

