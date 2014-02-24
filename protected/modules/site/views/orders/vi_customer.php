
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
                    <div class="title">
                        <h5><?php echo Yii::t('global','Customer Shop');?></h5> 
                    </div>
                     <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a></div>
                    <div class="info_profile1 fix-info-profile">
                    <?php 
                    $this->widget('zii.widgets.CDetailView', array(
                    	'data'=>$model,
                    	'attributes'=>array(
                    		//'id',
                    		array(
                                'name' => 'Name Shop',
                                'label'=> Yii::t('global','Name Shop'),
                                'type' => 'raw',
                                'value'=> MemberShop::model()->getNameShops($model->shop_id),
                            ),
                            array(
                                'name' => 'Name Customer',
                                'label'=> Yii::t('global','Name Customer'),
                                'type' => 'raw',
                                'value'=> $model->user->username,
                            ),
                            array(
                                'name' => 'Email',
                                'label'=> Yii::t('global','Email'),
                                'type' => 'raw',
                                'value'=> Members::model()->getEmails($model->user_id),
                            ),
                    		'billing_fullname',
                    		'billing_address',
                    	),
                        
                    )); ?>       
                        </div><!--#end info-->
                  
                <?php } ?>
            </div>
        </div>
