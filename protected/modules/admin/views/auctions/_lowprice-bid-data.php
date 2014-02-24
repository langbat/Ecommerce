<div class="head clearfix">
    <h1> <?php echo Yii::t('global', 'Low-price - Bid Data')?></h1>
</div>
<div class="block block-fluid">
    <div class="itemIn fix-row">
        <div class="row-form clearfix">
            <div class="span5">
                <?php echo $form->labelEx($model,'free_bid', array('style'=>"font-weight: bold;")); ?>
            </div>
            <div class="span7">
                <?php echo $form->textField($model,'free_bid'); ?>
                <?php echo $form->error($model,'free_bid'); ?>
            </div>
        </div>
        <div class="row-form clearfix">
            <div class="span3">
                <label for="Auctions_free_bid_start_quote"><?php echo Yii::t('global', 'Start Quote')?></label>
            </div>
            <div class="span3">
                <?php echo $form->textField($model,'free_bid_start_quote'); ?>
                <?php echo $form->error($model,'free_bid_start_quote'); ?>
            </div>
            <div class="span3">
                <label for="Auctions_free_bid_start_quote"><?php echo Yii::t('global', 'End Quote')?></label>
            </div>
            <div class="span3">
                <?php echo $form->textField($model,'free_bid_end_quote'); ?>
                <?php echo $form->error($model,'free_bid_end_quote'); ?>
            </div>
        </div>
        <div class="row-form clearfix">
            <div class="span5">
                <?php echo $form->labelEx($model,'half_price_bid', array('style'=>"font-weight: bold;")); ?>
            </div>
            <div class="span7">
                <?php echo $form->textField($model,'half_price_bid'); ?>
                <?php echo $form->error($model,'half_price_bid'); ?>
            </div>
        </div>
        <div class="row-form clearfix">
            <div class="span3">
                <label for="Auctions_half_price_bid_start_quote"><?php echo Yii::t('global', 'Start Quote')?></label>
            </div>
            <div class="span3">
                <?php echo $form->textField($model,'half_price_bid_start_quote'); ?>
                <?php echo $form->error($model,'half_price_bid_start_quote'); ?>
            </div>
            <div class="span3">
                <label for="Auctions_half_price_bid_end_quote"><?php echo Yii::t('global', 'End Quote')?></label>
            </div>
            <div class="span3">
                <?php echo $form->textField($model,'half_price_bid_end_quote'); ?>
                <?php echo $form->error($model,'half_price_bid_end_quote'); ?>
            </div>
        </div>
        <div class="row-form clearfix">
                <div class="span5">
                    <?php echo $form->labelEx($model,'special_bid', array('style'=>"font-weight: bold;")); ?>
                </div>
                <div class="span7">
                    <?php echo $form->textField($model,'special_bid'); ?>
                    <?php echo $form->error($model,'special_bid'); ?>
                </div>
        </div>
        <div class="row-form clearfix">
                <div class="span5">
                    <?php echo $form->labelEx($model,'special_bid_start_quote'); ?>
                </div>
                <div class="span7">
                    <?php echo $form->textField($model,'special_bid_start_quote'); ?>
                    <?php echo $form->error($model,'special_bid_start_quote'); ?>
                </div>
        </div>
        <div class="row-form clearfix">
                <div class="span5">
                    <?php echo $form->labelEx($model,'special_bid_end_quote'); ?>
                </div>
                <div class="span7">
                    <?php echo $form->textField($model,'special_bid_end_quote'); ?>
                    <?php echo $form->error($model,'special_bid_end_quote'); ?>
                </div>
        </div>
        <div class="row-form clearfix">
                <div class="span3">
                    <label for="Auctions_special_bid_start_time"><?php echo Yii::t('global', 'Start Time')?></label>
                </div>
                <div class="span3">
                    <?php echo $form->textField($model,'special_bid_start_time'); ?>
                    <?php echo $form->error($model,'special_bid_start_time'); ?>
                </div>
                <div class="span3">
                    <label for="Auctions_special_bid_end_time"><?php echo Yii::t('global', 'End Time')?></label>
                </div>
                <div class="span3">
                    <?php echo $form->textField($model,'special_bid_end_time'); ?>
                    <?php echo $form->error($model,'special_bid_end_time'); ?>
                </div>
        </div>


    </div>
</div>