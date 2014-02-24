<div class="content-container">
    <div class="content-wrapper">
    <div class="pull-left col-left purple-grid fix-boder">
    <?php if(Yii::app()->user->isGuest){ ?>
        <div class="message_profile fix-message">
            <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
            <p>
            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
            </p>
        </div>
    <?php }else { ?>
        <div class="title">
            <h5 ><?php echo Yii::t('global', 'All My Completed Auctions')?></h5>
        </div>
        <div class="product-wrapper show-grid">
            <!--<table class="table detail_product fix-table" >
                <tr>
                    <td class="imge "></td>
                    <td class="sellPrice"><?php /* echo Yii::t('global','Product'); */?></td>
                    <td class="sellPrice-sell"><?php /* echo Yii::t('global','Sell with price'); */?></td>
                    <td><?php /* echo Yii::t('global','Saving'); */?></td>
                    <td ><?php /* echo Yii::t('global','Finished at'); */?></td>
                    <td class=" end " class="buyer"><?php /* echo Yii::t('global','Buyer'); */?></td>
                </tr>
            </table>-->
            <table class="table detail_product fix-table" >
                <tr><td colspan="6" height=5px;></td></tr>
                <tr class="bg-end-auction">
                    <td class="imge fix-height-bg"></td>
                    <td style="text-align: left; padding-left: 25px;" width=191px; ><?php  echo Yii::t('global','Product'); ?></td>
                    <td class="fix-sell-Price" style="text-align: left !important; padding-left: 10px;" ><?php  echo Yii::t('global','Sell with price'); ?></td>
                    <td width=80px style="padding-left: 22px;"><?php  echo Yii::t('global','Saving'); ?></td>
                    <td width=100px style="padding-left: 12px"><?php  echo Yii::t('global','Finished at'); ?></td>
                    <td class=" end " class="buyer"><?php  echo Yii::t('global','Buyer'); ?></td>
                </tr>
            </table>
            <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$auctions,
            'id'=>'list-auction-ended',
            'ajaxUpdate'=>false,
            'itemView'=>'../elements/my_auction_ended',
        )); ?>
            <div class="clearfix"></div>
        </div>

        <!--#end product-wrapper-->
    <?php } ?>
    </div><!--#end col-left-->

    <div class="pull-left col-right">
        <?php if(Yii::app()->user->isGuest){ ?>
            <?php $this->renderPartial('/elements/right-ads');?>
            <?php // $this->renderPartial('/elements/auction-finished');?>
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
    </div>
</div>

