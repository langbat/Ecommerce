<div class="pull-left col-left">

<?php

    if(Yii::app()->user->isGuest){
        if($_GET['alias']=='how-it-works' || $_GET['alias']== 'terms-of-service' || $_GET['alias']== 'privacy-policy' || $_GET['alias']== 'faq' || $_GET['alias']== 'partners' || $_GET['alias']== 'imprint' || $_GET['alias']== 'about-us' ){ ?>
            <div class="purple-grid fix-boder">
                <div class="title">
                    <h5><?php echo $model->title; ?></h5>
                </div>
                <div class="top_text">
                    <?php echo $model->content; ?>
                    <div class="clearfix"></div>
                </div><!--#end product-wrapper-->
            </div>
        <?php }  else { ?>
    <div class="message_profile">
    	<h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
    	<p>
    	<span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
    	</p>
    </div>
<?php }}else{ ?>
	<div class="purple-grid fix-boder">
        <div class="title">
            <h5><?php echo $model->title; ?></h5>
        </div>        
        <div class="top_text">
            <?php echo $model->content; ?>	
    		<div class="clearfix"></div>
    	</div><!--#end product-wrapper-->
     </div>
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
