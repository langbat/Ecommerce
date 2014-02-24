
<div class="span7">
    <div class="head clearfix">
        <div class="isw-list"></div>
        <h1><?php echo Yii::t('global', 'Auction information'); ?></h1>
    </div>
    <div class="block  news scrollBox">
        <div class="scroll" style="height: 450px;">
            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Product name'); ?> :</div>
                <div class="span9">
                    <?php echo $model->product->name; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Max Price'); ?>:</div>
                <div class="span3">
                    <?php echo $model->max_price ; ?> €
                </div>
                <div class="span3"><?php echo Yii::t('global', 'Bid Price'); ?>:</div>
                <div class="span3">
                    <?php echo $model->bid_price ; ?> €
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Bid quote'); ?>:</div>
                <div class="span3">
                    <?php echo $model->basic_max_bids_number * $model->join_count ; ?>
                </div>
                <div class="span3"><?php echo Yii::t('global', 'Countdown'); ?> : </div>
                <div class="span3">
                    <?php echo $model->getCountDown()?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Start Time'); ?> :</div>
                <div class="span3">
                    <?php echo $model->start_time ; ?>
                </div>
                <div class="span3"><?php echo Yii::t('global', 'End Time'); ?> :</div>
                <div class="span3">
                    <?php echo $model->end_time;?>
                </div>
            </div>
           <!-- <div class="row-form clearfix">
                <div class="span3"><?php /*echo Yii::t('global', 'Is Featured'); */?> :</div>
                <div class="span3">
                    <?php /*echo $model->is_featured ; */?>
                </div>
                <div class="span3"><?php /*echo Yii::t('global', 'As Banner'); */?> : </div>
                <div class="span3">
                    <?php /*echo $model->as_banner*/?>
                </div>
            </div>-->
            <?php
                if($model->type == Auctions::TYPE_BASIC){
                    $this->renderPartial('_views-basic-info', compact('model','form'));
                } else {
                    $this->renderPartial('_views-lowprice-info', compact('model','form'));
                }
            ?>

            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Joker Bid Code'); ?> : </div>
                <div class="span3">
                    <?php echo $model->joker_bid_code ?>
                </div>
                <div class="span3"><?php echo Yii::t('global', 'Joker Bid Price'); ?> :</div>
                <div class="span3">
                    <?php echo $model->joker_bid_price ; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"><?php echo Yii::t('global', 'Joker Position From'); ?>:</div>
                <div class="span3">
                    <?php echo $model->joker_position_from ; ?>
                </div>
                <div class="span3"><?php echo Yii::t('global', 'Joker Position To'); ?>:</div>
                <div class="span3">
                    <?php echo $model->joker_position_to ; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Cashback Position 2'); ?>:</div>
                <div class="span3">
                    <?php echo $model->cashback_position_2 ; ?>
                </div>
                <div class="span3"><?php echo Yii::t('global', 'Cashback Position 3'); ?> :</div>
                <div class="span3">
                    <?php echo $model->cashback_position_3 ; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Comfort Bid Credit'); ?>:</div>
                <div class="span9">
                    <?php echo $model->comfort_bid_credit ; ?>
                </div>
            </div>
        </div>
    </div>
</div>

