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
            <?php } else { ?>
                <div class="title"><h5><?php echo Yii::t('global','View Blog Shops');?></h5></div>
                <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a></div>
                <div class="info_profile fix-info-profile">
                    <?php $this->widget('zii.widgets.CDetailView', array(
                        	'data'=>$model,
                        	'attributes'=>array(
                                     array(
                                        'label'=>Yii::t('global','Category name'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>$model->category_name,
                                        ),
                                     array(
                                        'label'=>Yii::t('global','Title'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>$model->title,
                                        ),
                                    array(
                                        'label'=>Yii::t('global', 'Description'),
                                        'type'=>'raw',
                                        'value'=>$model->description,
                                    ),                   
                                    /*array(
                                        'name' => 'image',
                                         'cssClass'=>'fix-null-img',
                                        'type'=>'raw',
                                        'value' => '<a class="fancybox" href="/uploads/blogshop/'.$model->image.'" rel="group"><img src="/uploads/product_shop/'.$model->image.'" style="height: 100px;"></a>'
                                    ),*/
                            		array(
                                        'name' => 'content',
                                         'cssClass'=>'fix-null-img',
                                        'type'=>'raw',
                                    ),
                            ),
                    )); ?>
                </div><!--#end info-->
                <div class="clearfix"></div>
            <?php } ?>
        </div>
    </div>
<div class="clearfix"></div>