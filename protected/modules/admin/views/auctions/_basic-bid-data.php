<div class="head clearfix">
    <h1> <?php echo Yii::t('global', 'Basic - Bid Data')?></h1>
</div>
<div class="block block-fluid">
    <div class="itemIn fix-row">
        <div class="row-form clearfix">
            <div class="span4">
                <?php echo $form->labelEx($model,'basic_participant_min'); ?>
            </div>
            <div class="span8">
                <?php echo $form->textField($model,'basic_participant_min'); ?>
                <?php echo $form->error($model,'basic_participant_min'); ?>
            </div>
        </div>
    
        <div class="row-form clearfix">
            <div class="span4">
                <?php echo $form->labelEx($model,'basic_participant_max'); ?>
            </div>
            <div class="span8">
                <?php echo $form->textField($model,'basic_participant_max'); ?>
                <?php echo $form->error($model,'basic_participant_max'); ?>
            </div>
        </div>
    
        <div class="row-form clearfix">
            <div class="span4">
                <?php echo $form->labelEx($model,'basic_join_fee'); ?>
            </div>
            <div class="span8">
                <?php echo $form->textField($model,'basic_join_fee'); ?>
                <?php echo $form->error($model,'basic_join_fee'); ?>
            </div>
        </div>
    
        <div class="row-form clearfix">
            <div class="span4">
                <?php echo $form->labelEx($model,'basic_max_bids_number'); ?>
            </div>
            <div class="span8">
                <?php echo $form->textField($model,'basic_max_bids_number'); ?>
                <?php echo $form->error($model,'basic_max_bids_number'); ?>
            </div>
        </div>
    </div>
</div>