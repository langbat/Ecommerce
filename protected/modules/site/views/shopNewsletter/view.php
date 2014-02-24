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
                <div class="title"><h5><?php echo Yii::t('global','View Shop Newsletter');?></h5></div>
                <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a></div>
                <div class="info_profile fix-info-profile">
                    <?php $this->widget('zii.widgets.CDetailView', array(
                   	    'data'=>$model,
                    	'attributes'=>array(
                                 array(
                                    'label'=>Yii::t('global','Name'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>$model->name,
                                    ),
                                 array(
                                    'label'=>Yii::t('global','Email'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>$model->email,
                                    ),
                                 array(
                                    'label'=>Yii::t('global','Joined'),
                                    'type'=>'raw',
                                    'cssClass'=>'fix-null',
                                    'value'=>Yii::app()->dateFormatter->format("DD.MM.yyyy hh:mm:ss a", CDateTimeParser::parse($model->joined, "yyyy-MM-dd H:mm:ss"))
                                    ),
                                array(
                                    'label'=>Yii::t('global', 'Shop Id'),
                                    'type'=>'raw',
                                    'value'=>$model->shop_id,
                                ),
                        	),
                    )); ?>
                </div><!--#end info-->
                <div class="clearfix"></div>
            <?php } ?>
        </div>
    </div>
<div class="clearfix"></div>