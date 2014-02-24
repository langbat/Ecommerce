<?php
$check = MemberShop::getMemberShopByIdMemberShop(Yii::app()->user->id);
if($check->id == $membershop->id){ ?>
<div class="content-block">
   <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
        <div class="wrapper_profile">
              <div class="span2">
            <div class="ucard clearfix">
                <div class="right">
                    <h4><?php echo $model->name; ?></h4>
                    <div class="rating_view">
                        <?php
                        $this->widget('ext.dzRaty.DzRaty', array(
                            'name' => 'my_rating_field',
                            'value' => ShopRatings::model()->getRatingShop($model->id),
                            'options' => array(
                                'readOnly' => TRUE,
                            ),
                        ));
                        ?>
                    </div>
                    <div class="image image-product">
                        <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->image.'"'?>><img <?php echo 'src="/uploads/logoshop/'.$model->image.'"' ?> class="img-polaroid"></a>
                    </div>
                    <ul class="control fix-control">
                        <li><i class="fa fa-pencil"></i> &nbsp;&nbsp;<a href="<?php echo $this->createUrl('/memberShop/update',array('id'=>$model->id, 'fl'=>'2')); ?>"><?php echo Yii::t('global','Edit') ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="span10">
            <div class="slider-box purple-grid ">
                
           
                    <div class="title"><h5><i class="fa fa-edit"> </i><?php echo Yii::t('global','View shops');?></h5></div>
                     <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb"  href="/shopManager/detail" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
                    <!-- scroll-view -->
                    <div class="info_profile fix-info-profile">
                        <?php $this->widget('zii.widgets.CDetailView', array(
                            'data'=>$model,
                            'attributes'=>array(
                                'name',
                                'slogan',
                                'email', 
                                array(
                                    'name' =>  'description',
                                    'type'=>'raw',
                                    
                                ),
                            
                               array(
                                    'name' =>   'apiUsername',
                                    'type'=>'raw',
                                    
                                ),
                              
                               
                                'apiPassword',
                                'apiSignature',
                                'apiLive',
                                 array(
                                    'name' =>  'welcome',
                                    'type'=>'raw',
                                    
                                ),
                                  array(
                                    'name' =>   'service',
                                    'type'=>'raw',
                                    
                                ),
                                array(
                                    'name' => 'banner',
                                    'cssClass'=>'fix-null-img',
                                    'type'=>'raw',
                                    'value' => '<a class="fancybox" href="/uploads/logoshop/'.$model->banner.'" rel="group"><img src="/uploads/logoshop/'.$model->banner.'" style="height: 90px;"></a>'
                                ),
                               
                                'created',
                                'updated',
                            ),
                        )); ?>
                    </div><!--#end info-->
                    <div class="clearfix"></div>
                
            </div>
            </div>
        </div>
 

  
    <div class="clearfix"></div>
    <?php } ?>
</div>
<?php }else{
    $this->redirect(Yii::app()->homeUrl);
}
