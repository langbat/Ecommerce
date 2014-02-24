<div class="pull-left col-left purple-grid fix-boder">
<?php if(Yii::app()->user->isGuest){ ?>
    <div class="message_profile fix-message">
    	<h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
    	<p>
    	<span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
    	</p>
    </div>
<?php }else{ ?>
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'All My Activities Auctions')?></h5>
    </div>
    <div class="product-wrapper show-grid hide-summary">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$auctions,
        	'itemView'=>'../elements/my-auction-activity',
        )); ?>
        
        <div class="clearfix"></div>
    </div><!--#end product-wrapper-->
<?php } ?>   	
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
