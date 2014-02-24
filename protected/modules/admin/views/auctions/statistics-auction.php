<div class="span7">
    <div class="head clearfix">
        <div class="isw-list"></div>
        <h1><?php echo Yii::t('global', 'Statistics Auction'); ?></h1>
    </div>
    <div class="block-fluid">
        <div class="row-form clearfix">
            <div class="span3"><?php echo Yii::t('global', ' Single Bid'); ?> :</div>
            <div class="span9">
                <?php echo $model->bid_count_single; ?>
            </div>
        </div>
        <div class="row-form clearfix">
            <div class="span3"><?php echo Yii::t('global', 'Multi  Bid'); ?>  :</div>
            <div class="span9">
                <?php echo $model->bid_count - $model->bid_count_single; ?>
            </div>
        </div>
        <div class="row-form clearfix">
            <div class="span3"> <?php echo Yii::t('global', 'Total Bid'); ?> :</div>
            <div class="span9">
                <?php echo $model->bid_count; ?>
            </div>
        </div>
    </div>
</div>