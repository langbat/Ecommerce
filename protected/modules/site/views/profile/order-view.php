<?php error_reporting(0); ?>
<div class="content-wrapper">
    <div class="pull-left col-left">
        <div class="slider-box purple-grid profile">
            <div class="title"><h5><?php echo Yii::t('global','Shipping Address'); ?></h5></div>
            <div class="message_profile">
                <p>
                    <b><?php echo Yii::t('global','Order number');?></b>: <?php echo $model->id?>
                </p>
                <p>
                    <b><?php echo Yii::t('global','Order Date');?></b>: <?php echo $model->created?>
                </p>
            </div>

            <div class="wrapper_profile wp_profiles">
                <div class="info_profile hide-summary">
                    <?php
                    $items=new OrderItems('search');
                    $items->unsetAttributes();  // clear any default values
                    $_GET['OrderItems']['order_id'] =$model->id;
                    $items->attributes=$_GET['OrderItems'];
                    $sumShipment = 0;
                    foreach($model->items as $shipment){
                        if($model->shop_id == 0){
                            $sumShipment=($sumShipment > $shipment['Products']['shipping_cost'])?$sumShipment:$shipment['Products']['shipping_cost'];
                        } else {
                            $sumShipment=($sumShipment > $shipment['ProductShop']['shipping_cost'])?$sumShipment:$shipment['ProductShop']['shipping_cost'];
                        }

                    }
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'order-items-grid',
                        'dataProvider'=>$items->search(),
                        'filter'=>null,
                        'enableSorting' => false,
                        'summaryText'=>'',
                        'columns'=>array(
                            array(
                                'name'=> 'id',
                                'header'=>Yii::t('global','Product number'),
                                'value' => '$data->item_id',
                                'type' => 'raw'
                            ),
                            array(
                                'name'=> 'item_id',
                                'header'=>Yii::t('global','Product description'),
                                'value' => '$data->showItem('.$model->shop_id.')',
                                'type' => 'raw'
                            ),
                            array(
                                'name'=> 'qty',
                                'header'=>Yii::t('global','Unit'),
                                'value' => '$data->qty',
                            ),
                           /* array(
                                'name'=> 'qty',
                                'header'=>Yii::t('global','Unit'),
                                'value' => '$data->Products->shipping_cost',
                            ),*/
                            array(
                                'name' => 'unit_price',
                                'header'=>Yii::t('global','Price'),
                                'value' => 'Utils::number_format($data->unit_price)." &euro;"',
                                'type' => 'raw'
                            ),
                            array(
                                'header'=>Yii::t('global','Total'),
                                'value' => 'Utils::number_format($data->unit_price * $data->qty)." &euro;"',
                                'type' => 'raw'
                            )
                        ),
                    )); ?>
                </div><!--#end info-->
                <div class="vote-content">
                    <div class="box fix_box">
                        <div class="box_right cart-result">
                            <?php //$credit = Auctions::checkWinbid($model->items); ?>
                            <div class="span2"><b><?php echo Yii::t('global','Sum') ?></b></div>
                            <div class="span1"><b id="sum"><?php echo Utils::number_format($model->amount-$sumShipment ) ?> €</b></div>
                           <?php /*if($credit != 0){ */?><!--
                                <div class="span2"><b><?php /*echo Yii::t('global','Credit')*/?></b></div>
                                <div class="span1"><b id="credit"><?php /*echo Utils::number_format($credit) */?> €</b></div>
                            --><?php //} ?>
                            <div class="span2"><b><?php echo Yii::t('global','Shipment') ?></b></div>
                            <div class="span1"><b id="shipment"><?php echo Utils::number_format($sumShipment);//Utils::number_format($sumShipment) ?> €</b></div>
                            <div class="span2"><b><?php echo Yii::t('global','Sum net') ?></b></div>
                            <div class="span1"><b id="sum_net"><?php echo Utils::number_format($model->amount/(1+Yii::app()->settings->vat_tax/100)) ?> €</b></div>
                            <div class="span2"><b><?php echo Yii::t('global','Value Add Tax') ?></b></div>
                            <div class="span1"><b id="value_add_tax"><?php  echo Utils::number_format(($model->amount/(1+Yii::app()->settings->vat_tax/100))*Yii::app()->settings->vat_tax/100); ?> €</b></div>
                            <div class="span2 fonts"><b><?php echo Yii::t('global','Total amount') ?></b></div>
                            <div class="span1 fonts"><b id="total_amount"><?php echo Utils::number_format($model->amount)  ?> €</b></div>
                        </div>
                    </div>
                </div>
                <div class="order_history">
                    <div class="header_order"><?php echo Yii::t('global','Order history') ?></div>
                    <div class="cover_top_right">
                        <span class="payment_method"><?php echo Yii::t('global','Payment methods')?>:<span><?php echo Yii::t('global',Lookup::item('OrderType',$model->type)) ?></span></span>

                        <span class="delivery fix_delivery"><?php echo Yii::t('global','Delivery Way')?>: <span><?php echo Yii::t('global',Lookup::item('DeliveryWay',$model->delivery_way)) ?></span></span>

                    </div>
                    <div class="list_order_history">
                        <?php foreach( $model->orderProcesses as $item){  ?>
                            <span class="day_history"><?php echo $item['created'] ?></span>
                            <span class="status_history"><?php echo Yii::t('global',$item['orderStatus']['name']) ?></span>
                        <?php } ?>

                    </div>
                    <div class="btn btn-warning back_btn"><a href="/profile/orders"> <img class="icon_back" src="/themes/default/img/icon-back.png"> <?php echo Yii::t('global','Back') ?></a></div>
                </div>
                <div class="des_status">
                    <div class="header_des_status">
                        <div class="triangle"><img  src="/themes/default/img/triangle.png"></div>
                        <div class="question_status"><?php echo Yii::t('global','What does order status mean?')?></div>
                    </div>
                    <div class="content_status">
                        <?php
                        $orderStatus = OrderStatus::model()->findAll();
                        foreach($orderStatus as $status) { ?>
                            <div class="status_order"><?php echo Yii::t('global',$status->name) ?></div>
                            <div class="explain_status"><?php echo Yii::t('global', $status->description) ?></div>
                        <?php } ?>
                    </div>
                </div>
             <div class="clearfix"></div>
        </div>
            <div class="clearfix"></div>
        </div>
    </div><!--#end col-left-->
    <div class="pull-left col-right">
        <div class="right-box">
            <?php

            $this->renderPartial('/elements/profile-menu')?>
        </div>

        <?php //$this->renderPartial('/elements/right-ads');?>
        <?php //$this->renderPartial('/elements/auction-finished');?>
        <?php //$this->renderPartial('/elements/tested-safety');?>
        <?php //$this->renderPartial('/elements/news-box');?>
    </div><!--#end col-right-->
    <div class="clearfix"></div>

</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.triangle').click(function(e){
                $('.content_status').slideToggle();
            });
        });
    </script>