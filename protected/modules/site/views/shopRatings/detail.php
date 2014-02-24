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
                    <div class="title">
                        <h5><?php echo Yii::t('global','Shop Rating');?></h5>
                    </div>
                    <div class="info_profile1 fix-info-profile">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        	'id'=>'shop-ratings-grid',
                        	'dataProvider'=>$model,
                        	'columns'=>array(
                        		'id',
                        		'score',
                                //array(
//                                    'name'=>'shopname',
//                                    'header'=>Yii::t('global','Name Shop'),
//                                    'htmlOptions'=>array('style'=>'width:200px;'),
//                                    'value'=>'$data->shop->name'
//                                ),
                        		'created',
                        		'updated',
                        		
                        	),
                        )); 
                        ?>               
                        </div><!--#end info-->
                  
                <?php } ?>
            </div>
        </div>
</div>