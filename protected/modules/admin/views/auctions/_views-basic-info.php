<div class="row-form clearfix">
    <div class="span3"><?php echo Yii::t('global', 'Participant Max'); ?> : </div>
    <div class="span3">
        <?php echo $model->basic_participant_max?>
    </div>
    <div class="span3"><?php echo Yii::t('global', 'Participant Min'); ?> :</div>
    <div class="span3">
        <?php echo $model->basic_participant_min ; ?>
    </div>
</div>
<div class="row-form clearfix">
    <div class="span3"><?php echo Yii::t('global', 'Join Fee'); ?> : </div>
    <div class="span3">
        <?php echo $model->basic_join_fee?>
    </div>
    <div class="span3"><?php echo Yii::t('global', 'Max Bid Number'); ?> :</div>
    <div class="span3">
        <?php echo $model->basic_max_bids_number ; ?>
    </div>
</div>