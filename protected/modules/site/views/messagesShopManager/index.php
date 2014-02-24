<style>
.table thead{
    background: #F3F5F6;
}
.bold{background: #DBFFB3!important;}
</style>
<?php
$ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id' => Yii::
        app()->user->id));
if (!empty($ismemberShop)) {
?>
<div class="content-block">
        <div class="wrapper_profile">
            <div class="slider-box purple-grid ">
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
               
                    <div class="info_profile1 fix-info-profile">
                    <div class="header-mss">
                    <label><?php echo Yii::t('global', 'Folder') ?></label>
                    <!--<form action="" method="post">-->
                    <select size="1" name="s"  onchange="goToPage('select1')" id="select1">
                            <option <?php echo isset($_GET['id']) ? $_GET['id'] ==
                                        0 ? 'selected' : '' : 'selected' ?> value="/messagesShopManager?id=0"><?php echo
                                        Yii::t('global', 'Inbox') ?></option>
                            <option <?php echo isset($_GET['id']) ? $_GET['id'] ==
                                        1 ? 'selected' : '' : '' ?> value="/messagesShopManager?id=1"><?php echo
                                        Yii::t('global', 'Outbox') ?></option>
                                    
                                
                                
                            
					</select>
                  <!--  <select name="s">
                    <option value="0"><?php echo Yii::t('global', 'Inbox') ?></option>
                    <option value="1"><?php echo Yii::t('global', 'Outbox') ?></option>
                    
                    
                    </select>
                    <input type="submit" style="margin-top: -10px;margin-left: 10px;height: 30px;"/>
                    </form>
                    -->
                    
                    
                    </div>
                  
                        <?php

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'messages-shop-grid',
            'dataProvider' => $dataprovider,
            'summaryText' => '',
            //'filter'=>$model,
            'columns' => array(
                /*
                'id',
                
                */


                array(

                    'name' => isset($_GET['id']) ? $_GET['id'] == 1 ? 'receiver' : 'sender' :
                        'receiver',
                    'header' => Yii::t('global', 'Receiver'),
                    'value' => isset($_GET['id']) ? $_GET['id'] == 1 ?
                        'messagesShop::model()->getUserfrom($data->receiver)' :
                        'messagesShop::model()->getUserfrom($data->sender)' :
                        'messagesShop::model()->getUserfrom($data->sender)',
                    //'filter' => '',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    'htmlOptions' => array('style' => 'width:50px;')),
                /*
                array(
                'name'=>'from',
                'header'=>Yii::t('global','from'),
                'type' => 'raw',
                'filter'=>$from,
                'value' => 'Products::model()->getStatusProduct($data->is_active)',
                'htmlOptions'=>array('style'=>'text-overflow:ellipsis;')
                ),
                '',
                /**
                *                                  array(
                *                                 'name' => 'to',
                *                                 'header' => 'TO',
                *                                 'filter' => 'to',
                *                                 'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                *                             ),
                *                              */

                array(
                    'name' => 'subject',
                    'header' => Yii::t('global', 'Subject'),
                    'htmlOptions' => array('style' =>
                            'width:30px;white-space:nowrap; text-overflow:ellipsis;'),
                    'value' => 'strlen($data->subject)>30?substr($data->subject, 0, 30).".....":$data->subject',
                    //'filter' => 'message',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    ),
                array(
                    'name' => 'message',
                    'header' => Yii::t('global', 'Message'),
                    'htmlOptions' => array('style' => 'width:230px;'),
                    'value' => 'strlen($data->message)>40?substr($data->message, 0, 40).".....":$data->message',
                    //'filter' => 'message',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    ),


                array(
                    'name' => 'sent',
                    'type' => 'raw',
                    'header' => Yii::t('global', 'Sent'),

                    'htmlOptions' => array('style' => 'width:100px;'),

                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',

                    ),


                /*
                'status_message',
                
                'is_read',
                */
                array(
                    'htmlOptions' => array('style' => 'width:30px;'),
                    'class' => 'CButtonColumn',
                    'template' => '{view}',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    /**
                     *                                     'buttons'=>array
                     *                                     (
                     *                                         'open' => array
                     *                                         (
                     *                                             'label'=> Yii::t('global','Read message'),
                     *                                            
                     *                                             //'imageUrl'=>Yii::app()->themeManager->baseUrl.'/img/btn-open-e.png',
                     *                                             'value'=>'Öffnen',
                     *                                             'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                     *                                            // 'click'=>'function(){alert("Going down!");}',
                     *                                         ),
                     *                                         'down' => array
                     *                                         (
                     *                                             'label'=>'[-]',
                     *                                             'url'=>'"#"',
                     *                                             'visible'=>'$data->score > 0',
                     *                                             'click'=>'function(){alert("Going down!");}',
                     *                                         ),
                     *                                     ),
                     */
                    ),
                ),
            ));
        Yii::app()->clientScript->registerScript('re-install-date-picker', "
                        function reinstallDatePicker(id, data) {
                            $('#re-install-date-picker').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['" .
            (Yii::app()->language == 'en' ? '' : Yii::app()->language) . "'], {'dateFormat':'" .
            Yii::app()->locale->getDateFormat('medium_js') . "'}));
                        }");
?>
                    </div><!--#end info-->
                  
                <?php } ?>
            </div>
        </div>

</div>
<?php } else { ?>
            <div class="content-wrapper">
                <div class="pull-left col-left">
                    <div class="wrapper_profile">
                        <div class="slider-box purple-grid ">
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <div class="message_profile fix-message">
                                    <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                                    <p>
                                        <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                                    </p>
                                </div>
                            <?php } else { ?>
                                           <div class="content-block" style="padding: 0;">
                    <div class="wrapper_profile">
                        <div class="slider-box purple-grid ">
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <div class="message_profile fix-message">
                                    <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'You must login to see this page.'); ?></h1>
                                    <p>
                                        <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global', 'Please login to see this page.'); ?></span>
                                    </p>
                                </div>
                            <?php } else { ?>
                           
                                <div class="info_profile1 fix-info-profile">
                                <div style="padding: 5px 0 0 10px;background: #54ADFF;">
                                <label><?php echo Yii::t('global', 'Folder') ?></label>
                                <!--<form action="" method="post">-->
                                <select size="1" name="s"  onchange="goToPage('select1')" id="select1">
                                         <option <?php echo isset($_GET['id']) ?
                                            $_GET['id'] == 0 ? 'selected' : '' : 'selected' ?> value="/messagesShopManager?id=0"><?php echo
                                            Yii::t('global', 'Inbox') ?></option>
                                         <option <?php echo isset($_GET['id']) ?
                                            $_GET['id'] == 1 ? 'selected' : '' : '' ?> value="/messagesShopManager?id=1"><?php echo
                                            Yii::t('global', 'Outbox') ?></option>
                                    
                                                
                                            
                                            
                                        
            					</select>
                         
                                
                                
                                </div>
                              
                                    <?php
            //$catProducts = CategoriesShop::getAllCategoryShop();

            //$from = Members::model()->f;
            // $productShops = ProductsShop::getProductShopByShopId(1);
            //var_dump($model);exit();

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'messages-shop-grid',
                'dataProvider' => $dataprovider,
                'summaryText' => '',
                //	'filter'=>$model,
                'columns' => array(
                    /*
                    'id',
                    
                    */


                    array(

                    'name' => isset($_GET['id']) ? $_GET['id'] == 1 ? 'receiver' : 'sender' :
                        'receiver',
                    'header' => Yii::t('global', 'Receiver'),
                    'value' => isset($_GET['id']) ? $_GET['id'] == 1 ?
                        'messagesShop::model()->getUserfrom($data->receiver)' :
                        'messagesShop::model()->getUserfrom($data->sender)' :
                        'messagesShop::model()->getUserfrom($data->sender)',
                    //'filter' => '',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    'htmlOptions' => array('style' => 'width:60px;')),
                /*
                array(
                'name'=>'from',
                'header'=>Yii::t('global','from'),
                'type' => 'raw',
                'filter'=>$from,
                'value' => 'Products::model()->getStatusProduct($data->is_active)',
                'htmlOptions'=>array('style'=>'text-overflow:ellipsis;')
                ),
                '',
                /**
                *                                  array(
                *                                 'name' => 'to',
                *                                 'header' => 'TO',
                *                                 'filter' => 'to',
                *                                 'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                *                             ),
                *                              */

                array(
                    'name' => 'subject',
                    'header' => Yii::t('global', 'Subject'),
                    'htmlOptions' => array('style' =>
                            'width:30px;white-space:nowrap; text-overflow:ellipsis;'),
                    'value' => 'strlen($data->subject)>30?substr($data->subject, 0, 30).".....":$data->subject',
                    //'filter' => 'message',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    ),
                array(
                    'name' => 'message',
                    'header' => Yii::t('global', 'Message'),
                    'htmlOptions' => array('style' => 'width:230px;'),
                    'value' => 'strlen($data->message)>40?substr($data->message, 0, 40).".....":$data->message',
                    //'filter' => 'message',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    ),


                array(
                    'name' => 'sent',
                    'type' => 'raw',
                    'header' => Yii::t('global', 'Sent'),

                    'htmlOptions' => array('style' => 'width:100px;'),

                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',

                    ),


                /*
                'status_message',
                
                'is_read',
                */
                array(
                    'htmlOptions' => array('style' => 'width:30px;'),
                    'class' => 'CButtonColumn',
                    'template' => '{view}',
                    'cssClassExpression' => '$data["is_read"] == 0 ? "bold" : ""',
                    /**
                     *                                     'buttons'=>array
                     *                                     (
                     *                                         'open' => array
                     *                                         (
                     *                                             'label'=> Yii::t('global','Read message'),
                     *                                            
                     *                                             //'imageUrl'=>Yii::app()->themeManager->baseUrl.'/img/btn-open-e.png',
                     *                                             'value'=>'Öffnen',
                     *                                             'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                     *                                            // 'click'=>'function(){alert("Going down!");}',
                     *                                         ),
                     *                                         'down' => array
                     *                                         (
                     *                                             'label'=>'[-]',
                     *                                             'url'=>'"#"',
                     *                                             'visible'=>'$data->score > 0',
                     *                                             'click'=>'function(){alert("Going down!");}',
                     *                                         ),
                     *                                     ),
                     */
                    ),
                    ),
                ));
            Yii::app()->clientScript->registerScript('re-install-date-picker', "
                                    function reinstallDatePicker(id, data) {
                                        $('#re-install-date-picker').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['" .
                (Yii::app()->language == 'en' ? '' : Yii::app()->language) . "'], {'dateFormat':'" .
                Yii::app()->locale->getDateFormat('medium_js') . "'}));
                                    }");
?>
                                </div><!--#end info-->
                              
                            <?php } ?>
                        </div>
                    </div>
            
            </div>
                                            <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
    </div><!--#end col-left-->

    <div class="pull-left col-right">
        <?php if (Yii::app()->user->isGuest) { ?>
            <?php $this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php $this->renderPartial('/elements/tested-safety'); ?>
            <?php $this->renderPartial('/elements/news-box'); ?>
        <?php } else { ?>
            <div class="right-box">
                <?php $this->renderPartial('/elements/profile-menu') ?>
            </div>
            <?php //$this->renderPartial('/elements/right-ads'); ?>
            <?php //$this->renderPartial('/elements/auction-finished'); ?>
            <?php //$this->renderPartial('/elements/tested-safety'); ?>
            <?php //$this->renderPartial('/elements/news-box'); ?>
        <?php } ?>
    </div><!--#end col-right-->

    <div class="clearfix"></div>
</div>



<?php } ?>








