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
            <div class="info_profile1 fix-info-profile">
                <?php 
                $this->widget('zii.widgets.grid.CGridView', array(
                	'id'=>'orders-grid',
                	'dataProvider'=>$model->getCustomerByShopId(),
                    'enableSorting' => false,
                	'filter'=>$model,
                	'columns'=>array(
                        array(
                            'name' => 'id',
                            'type'=>'raw',
                            'htmlOptions'=>array('style'=>'width:50px'),
                        ),
                        
                        /* array(
                            'name' => 'shop_name',
                            'header'=>Yii::t('global','Name Shop'),
                            'value' => '$data->shop->name',
                            'type' => 'raw',
                            'htmlOptions'=>array('style'=>'text-align:center'),
                        ),*/
                
                        array(
                            'name' => 'username',
                            'header'=>Yii::t('global','Name Customer'),
                            'value' => '$data->user->username',
                            'type' => 'raw',
                        ),
                        array(
                            'name'=>'shop_email',
                            'header'=>Yii::t('global','Email'),
                            'value' => '$data->user->email',
                            'type' => 'raw',
                        ),
                        array(
                            'name'=>'billing_fullname',
                            'header'=>Yii::t('global','Billing Fullname'),
                        ),
                        array(
                            'name'=>'billing_address',
                            'header'=>Yii::t('global','Billing Address'),
                        ),
            			array(
                		'class'=>'CButtonColumn',
                        'headerHtmlOptions'=> array('style' => 'width:50px;'),
                        'template'=>'{view}{update}{delete}',
                        'buttons'=>array(
                            'view' => array(
                                'label'=>Yii::t('global','View'),
                                'url'=>'Yii::app()->createUrl("orders/vi_customer", array("id"=>$data->id))',
                            ),
                            'update' => array(
                                'label'=>Yii::t('global','Update'),
                                'url'=>'Yii::app()->createUrl("orders/up_customer", array("id"=>$data->id))',
                            ),
                            'delete' => array(
                                'label'=>Yii::t('global','Delete'),
                                'url'=>'Yii::app()->createUrl("orders/delete", array("id"=>$data->id))',
                            ),
                        ),
                	),
                	),
                )); ?>
            </div>
        <?php } ?>
    </div>
</div>
