<script type="text/javascript">
$(document).ready(function() {
    
   
            $('.btn').click(function(){
               
                if($("input[name='MessagesShop[subject]']").val()!='' && $("#MessagesShop_message").val()!=''){
                    
            $('#myModalSentMS').modal('show');
                }
             });});
                
               // 
           
</script>
<?php
$ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id' => Yii::
        app()->user->id));
if (!empty($ismemberShop)) { ?>
<style>
ul{list-style-type: none;}
fieldset.read-message {
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        margin-bottom: 10px;
        height: 100%;
        width: 100%;
        margin-top: 10px;
        padding: 10px;
        font-size: 14px;
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
        margin-right: -11px;
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

<div class="content-block">
        <div class="wrapper_profile">
            <div class="slider-box">
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="info_profile1 fix-info-profile">
                    <fieldset class="read-message">
                    <a class="sellerMessageBackBtn pull-right" href="<?php echo Yii::app()->homeUrl . 'messagesShopManager' ?>">  <?php echo Yii::t('global', 'Back') ?>            </a>
                   <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
                
                </fieldset>
                    </div><!--#end info-->
                  
                <?php } ?>
                
            </div>
        </div>

</div>
<?php } else { ?>
<style>
ul{list-style-type: none;}
fieldset.read-message {
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        margin-bottom: 10px;
        height: 100%;
        /*width: 100%;*/
        margin-top: 10px;
        padding: 10px;
        font-size: 14px;
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
        margin-right: -11px;
        padding: 0 2px;
        z-index: 10;
}
#MessagesShop_message,#MessagesShop_subject{
    width:90% !important;
    margin-left: 30px;
}

</style>
<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="wrapper_profile">
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>        
                    <div class="slider-box">
                            <div class="info_profile1 fix-info-profile">
                            <fieldset class="read-message">
                                <a class="sellerMessageBackBtn pull-right" href="<?php echo Yii::app()->homeUrl . 'messagesShopManager' ?>">  <?php echo Yii::t('global', 'Back') ?>            </a>
                                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>   
                            </fieldset>
                            </div>
                    </div>
                     <div class="clearfix"></div>
                <?php } ?>
        </div>
    </div><!--#end col-left-->

    <div class="pull-left col-right">
        <?php if (Yii::app()->user->isGuest) { ?>
            <?php $this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php $this->renderPartial('/elements/tested-safety'); ?>
            <?php $this->renderPartial('/elements/news-box'); ?>
        <?php } else { ?>
            <div class="right-box">
                <?php $this->renderPartial('/elements/profile-menu') ?>
            </div>
            <?php //$this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php //$this->renderPartial('/elements/tested-safety'); ?>
            <?php //$this->renderPartial('/elements/news-box'); ?>
        <?php } ?>
    </div><!--#end col-right-->

    <div class="clearfix"></div>
</div>
<?php } ?>
<div id="myModalSentMS" class="modal hide fade purple-grid" style="margin-bottom: 0px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Notice') ?>
        </h5>
    </div>
    <div class="modal-body" style="height: 50px;">
        <p class="fix_content_modal">
            <?php echo Yii::t('global', 'Your message has been sent') ?>
        </p>
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>
