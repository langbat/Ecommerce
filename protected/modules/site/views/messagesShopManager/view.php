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
.read-message div.title{
        width: 30%;
        float: left;
        font-weight: normal;
      /*  background-color: white;*/
}
.read-message div.text{
        word-break:break-all;
        padding-left: 15%;
}


.read-message ul li{line-height: 40px; }

</style>
<?php 
 $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
 if(!empty($ismemberShop)){
?>

<div class="content-block">
        <div class="wrapper_profile">
            <div class="slider-box ">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="info_profile1 fix-info-profile">
                    <fieldset class="read-message">
                    <a class="sellerMessageBackBtn pull-right" href="<?php echo Yii::app()->homeUrl.'messagesShopManager'?>">
                      <?php echo Yii::t('global','Previous') ?>            </a>
                    <?php $this->widget('zii.widgets.CDetailView', array(
                	'data'=>$model,
                	'attributes'=>array(
                        array(
                			'name'=>'sent',
                			'type'=>'text',
                			'value'=>date_format(new DateTime($model->sent), 'd/m/Y H:j:s'),
                            'htmlOptions'=>array('style'=>'width:30px;')
                		),
                       
                	//	'id',

               
                		array(
                            'label'=>Yii::t('global', 'Message from'),
                            'type'=>'raw',
                            'value'=>messagesShop::model()->getUserfrom($model->sender),
                            'htmlOptions'=>array('style'=>'width:30px;')
                        ),     
                		//'to',
                       
                        	array(
                        	'name'=>'subject',
                            'type'=>'raw',
                            'htmlOptions'=>array('style'=>' word-break:break-all;')
                        ),  
                	
                        	array(
                        	'name'=>'message',
                            'type'=>'raw',
                            
                            'htmlOptions'=>array('style'=>'word-break:break-all;')
                        ),
                    
                	//	'sent',
                		//'status_message',
                	//	'is_read',
                	),
                )); ?>
                <div class="pull-right button-top">
            <span>
            <?php if($model->sender!==Yii::app()->user->id){?>
                <a href="/messagesShopManager/create?id=<?php echo $model->sender?>" class="btn pull-right"><?php echo Yii::t('global','Answer');?></a>
            <?php }?>
            </span>
        </div>
                </fieldset>
                    </div><!--#end info-->
                  
                <?php } ?>
                
            </div>
        </div>

</div>


<?php }else{?>
<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="wrapper_profile">
           
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                                
        <div class="wrapper_profile">
            <div class="slider-box ">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                                <div class="info_profile1 fix-info-profile">
                                <fieldset class="read-message">
                                <a class="sellerMessageBackBtn pull-right" href="<?php echo Yii::app()->homeUrl.'messagesShopManager'?>">
                                  <?php echo Yii::t('global','Previous') ?>            </a>
                                <?php $this->widget('zii.widgets.CDetailView', array(
                            	'data'=>$model,
                            	'attributes'=>array(
                                    array(
                            			'name'=>'sent',
                            			'type'=>'text',
                            			'value'=>date_format(new DateTime($model->sent), 'd/m/Y'),
                                        'htmlOptions'=>array('style'=>'width:30px;')
                            		),
                                   
                            	//	'id',
            
                           
                            		array(
                                        'label'=>Yii::t('global', 'Message from'),
                                        'type'=>'raw',
                                        'value'=>messagesShop::model()->getUserfrom($model->sender),
                                        'htmlOptions'=>array('style'=>'width:30px;')
                                    ),     
                            		//'to',
                                   
                                    	array(
                                    	'name'=>'subject',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('style'=>' word-break:break-all;')
                                    ),  
                            	
                                    	array(
                                    	'name'=>'message',
                                        'type'=>'raw',
                                        
                                        'htmlOptions'=>array('style'=>'word-break:break-all;')
                                    ),
                                
                            	//	'sent',
                            		//'status_message',
                            	//	'is_read',
                            	),
                            )); ?>
                            <div class="pull-right button-top">
                        <span>
                        <?php if($model->sender!==Yii::app()->user->id){?>
                            <a href="/messagesShopManager/create?id=<?php echo $model->sender?>" class="btn pull-right"><?php echo Yii::t('global','Answer');?></a>
                        <?php }?>
                        </span>
                    </div>
                            </fieldset>
                                </div><!--#end info-->
                              
                            <?php } ?>
                            
                        </div>
                    </div>
            
           
                                            <div class="clearfix"></div>
                <?php } ?>
            
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



<?php }?>









