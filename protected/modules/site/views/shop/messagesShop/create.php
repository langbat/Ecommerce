
<style>
ul{list-style-type: none;}
fieldset.read-message {
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        margin-bottom: 10px;
        height: 100%;
        width: 86%;
        margin-top: 20px;
        padding: 10px;
        font-size: 14px;
        margin-left: 0px;
        padding-right: 78px;
}
.sellerMessageBackBtn {
        color: #222;
        background-color: #fff;
        box-shadow: none;
        text-shadow: none;
        background-repeat: repeat;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-style: solid;
        border-width: 1px;
        border-color: #aaa;
        border-bottom: none;
        font-size: 11px;
        margin-top: -31px;
        margin-right: -79px;
        padding: 0 2px;
        z-index: 10;
}
.read-message div.title{
        width: 30%;
        float: left;
}
.read-message ul li{line-height: 40px; }
#MessagesShop_message,#MessagesShop_subject{
    width:90% !important;
}
</style>
<div class="content-block1">
        <div class="wrapper_profile1">
            <div class="slider-box purple-grid">
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo
Yii::t('global', 'You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo
Yii::t('global', 'Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="info_profile1 fix-info-profile">
                    <fieldset class="read-message">
                    <a class="sellerMessageBackBtn pull-right" href="<?php echo
Yii::app()->homeUrl . 'shop/detail/' . $this->membershop->id ?>">  <?php echo
Yii::t('global', 'Back') ?>            </a>
                   <?php echo $this->renderPartial('messagesShop/_form', array('model' =>
$model)); ?>
                
                </fieldset>
                    </div><!--#end info-->
                  
                <?php } ?>
                
            </div>
        </div>

</div>

<div id="myModalSentMS" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Notice') ?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php echo Yii::t('global', 'Your message has been sent') ?>

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>









