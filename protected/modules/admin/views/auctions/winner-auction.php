<div class="span5">
    <div class="head clearfix">
        <div class="isw-list"></div>
        <h1><?php if ( OrderItems::model()->GetIdOrderDashboard( $model->id ) != '' ) { echo CHtml::link(Yii::t('global', 'Winner Auction'),array('orders/update?id='.OrderItems::model()->GetIdOrderDashboard( $model->id )),array('style'=>'color:white') ); } else { echo Yii::t('global', 'Winner Auction'); }    ; ?></h1>
    </div>
    <div class="block-fluid">
        <?php $winner = Bids::model()->getWinner($model->id);
        if($winner){ ?>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Username'); ?> :</div>
                <div class="span3">
                    <?php echo CHtml::link($winner->bidder->username,array("/admin/members/view","id"=>$winner->bidder->id)); ?>
                    <?php //echo $winner->bidder->username; ?>
                </div>
                <div class="span3"> <?php echo Yii::t('global', 'Lowest price'); ?>:</div>
                <div class="span3">
                    <?php echo $winner->price; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Fullname'); ?> :</div>
                <div class="span3">
                    <?php echo $winner->bidder->fname." ".$winner->bidder->lname; ?>
                </div>
                <div class="span3"> <?php echo Yii::t('global', 'Total Bid'); ?> :</div>
                <div class="span3">
                    <?php echo Bids::model()->getTotalBidsMember( $model->id, $winner->bidder->id ); ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Address'); ?> :</div>
                <div class="span3">
                    <?php echo $winner->bidder->address; ?>
                </div>
                <div class="span3"> <?php echo Yii::t('global', 'Phone'); ?>:</div>
                <div class="span3">
                    <?php echo $winner->bidder->phone; ?>
                </div>
            </div>
            <div class="row-form clearfix">
                <div class="span3"> <?php echo Yii::t('global', 'Email'); ?> :</div>
                <div class="span9">
                    <?php echo $winner->bidder->email; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="row-form clearfix">
                <div class="span12"> <?php echo Yii::t('global', 'Auction is going on'); ?> </div>
            </div>
        <?php } ?>
    </div>
</div>