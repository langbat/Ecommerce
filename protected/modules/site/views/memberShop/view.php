

<div class="content-wrapper">

<?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
    <div class="pull-left col-left">
        <div class="wrapper_profile">
        <div class="span2" style="margin: 0;">
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
                           <a class="fancybox" <?php echo 'href="/uploads/logoshop/'.$model->image.'"'?> rel="group"><img <?php echo 'src="/uploads/logoshop/'.$model->image.'"' ?> class="img-polaroid"></a>
                    </div>
                    <ul class="control fix-control">
                        <li><span class="fa fa-pencil"></span> <a href="<?php echo $this->createUrl('/memberShop/update',array('id'=>$model->id, 'fl'=>'2')); ?>"><?php echo Yii::t('global','Edit') ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
         <div class="span6">
            <div class="slider-box purple-grid">
                
                 
       
                    <div class="title"><h5><i class="fa fa-edit"></i><?php echo Yii::t('global','View shops');?></h5></div>
                     <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" style="margin-top: -50px;" href="/memberShop" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
                    <div class="info_profile fix-info-profile scroll-view">
                        <?php $this->widget('zii.widgets.CDetailView', array(
                            'data'=>$model,
                            'attributes'=>array(
                                'name',
                                'slogan',
                                'email',
                                array(
                                    'name' => 'image',
                                    'cssClass'=>'fix-null-img',
                                    'type'=>'raw',
                                    'value' => '<a class="fancybox" href="/uploads/logoshop/'.$model->image.'" rel="group"><img src="/uploads/logoshop/'.$model->image.'" style="height: 90px;"></a>'
                                ),
                                'description',
                                'apiUsername',
                                'apiPassword',
                                'apiSignature',
                                'apiLive',
                                'welcome',
                                'service',
                                'created',
                                'updated',
                            ),
                        )); ?>
                    </div><!--#end info-->
                    </div>
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
     
    </div><!--#end col-right-->

    <div class="clearfix"></div>
       <?php } ?>
</div>

