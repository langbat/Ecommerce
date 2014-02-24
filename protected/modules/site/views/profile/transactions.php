<?php
    Yii::app()->clientScript->registerScript('search', "
        $(' .search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $('#transactions-grid').yiiGridView('update', {
                data: $(this).serialize()
            });
            return false;
        });
    ");
?>
<div class="content-wrapper">
        <div class="pull-left col-left">
            <div class="wrapper_profile">            
                <div class="slider-box purple-grid fix-boder">
                    <?php if(Yii::app()->user->isGuest){ ?>
                        <div class="message_profile fix-message">
                            <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                            <p>
                                <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                            </p>
                        </div>
                    <?php } else { ?>
                        <div class="title"><h5><?php echo Yii::t('global','Account transactions');?></h5></div>
                        <div class="head-transaction">
                            <div id="text">
                                <label><?php echo Yii::t('global',' Describe account transactions') ?></label>
                            </div>
                            <div id="search-time"  class="search-form">
                                <?php
                                    $this->renderPartial('_search-transaction',array(
                                        'model'=>$model,
                                    ));?>
                            </div>
                        </div>
                        <div class="info_profile fix-info-profile">
                            <?php
                            $paymentType = Lookup::items('PaymentType');
                            $this->widget('zii.widgets.grid.CGridView', array(
                                'id'=>'transactions-grid',
                                'dataProvider'=>$model->search(),
                                'summaryText' =>'',
                                'filter'=>$model,
                                'afterAjaxUpdate' => 'reinstallDatePicker',
                                'columns'=>array(
                                    array(
                                        'name' => 'created',
                                        'header'=>Yii::t("global","Date/Time"),
                                        'value' => 'date("d/m/Y H:i:s",strtotime($data->created))',
                                        'htmlOptions'=> array('style' => 'text-align: center; border-right: 1px solid #dddddd;'),
                                        'headerHtmlOptions'=> array('style' => 'text-align: center'),
                                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                                'model'=>$model,
                                                'attribute'=>'created',
                                                'mode'=>'date',
                                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                                'language' => Yii::app()->language=='en'?'':Yii::app()->language
                                            ),
                                        true)
                                    ),
                                    array(
                                        'name' => 'transactiontype',
                                        'filter'=>$paymentType,
                                        'htmlOptions'=> array('style' => 'text-align: center; border-right: 1px solid #dddddd;'),
                                        'headerHtmlOptions'=> array('style' => 'text-align: center'),
                                        'value' => 'Yii::t("global",Lookup::item("PaymentType", $data->transactiontype))'
                                    ),
                                    array(
                                        'name' => 'amount',
                                        'value' => '($data->amount >0 )? "+".Utils::number_format($data->amount)." &euro;" : Utils::number_format($data->amount)." &euro;"',
                                        'type' => 'raw',
                                        'htmlOptions'=> array('style' => 'text-align: center; border-right: 1px solid #dddddd;'),
                                        'headerHtmlOptions'=> array('style' => 'text-align: center'),
                                    ),
                                    //'currency',

                                    array(
                                        'header'=>Yii::t("global","Description"),
                                        'htmlOptions'=> array('style' => 'text-align: center;'),
                                        'headerHtmlOptions'=> array('style' => 'text-align: center'),
                                        'type'=>'raw',
                                        'value' => '$data->getDescription($data->transactiontype,$data->payment_transaction)'
                                    ),
                                    /*
                                    'modified',
                                    'created',
                                    'payment_transaction',
                                    'options',
                                    */
                                    /*array(
                                        'class'=>'CButtonColumn',
                                        'template'=>'{view}',
                                    ),*/
                                ),
                            ));
                            Yii::app()->clientScript->registerScript('re-install-date-picker', "
                            function reinstallDatePicker(id, data) {
                                $('#Transactions_created').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['".(Yii::app()->language=='en'?'':Yii::app()->language)."'], {'dateFormat':'".Yii::app()->locale->getDateFormat('medium_js')."'}));
                            }");
                            ?>
                        </div><!--#end info-->
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
        <?php } ?>
    </div><!--#end col-right-->
        
        <div class="clearfix"></div>                        
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#search-btn').live('click',function(){
            var from_time = $('.from-time').val()
            var to_time = $('.to-time').val();
            if((from_time !='') && (to_time !='')){
                $('.info_profile').html('<div class="ajax-loader"></div>');
                $.get('/profile/searchTransactions?fromtime='+from_time+'&totime='+to_time,function(html){
                      $('.info_profile').html(html)
                });
            } else {
                alert('<?php echo Yii::t("global","Please enter from date .... to date .... before clicking on search!")?>');
            }

        });
    })
</script>