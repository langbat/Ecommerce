<?php  
   $name = explode('--',$nameproduct)
?>
<div class="title">
    <h5><?php echo Yii::t('global', 'bid confirm')?>
        <button type="button" class="close " data-dismiss="modal" aria-hidden="true"> x </button>
    </h5>
</div>
<div class="modal-body">
    <p><?php echo Yii::t('global', 'Your bid is {euro},{cent} EUR for the auction ', array( '{euro}' => $euro, '{cent}' => $cent ) ).'“'.$name[1].'”'; ?></p>
    <br />
    <a class="format-confirm btn-confirm-green  fix-btn fix_btn_orange"  data-dismiss="modal" aria-hidden="true" data="<?php echo $nameproduct; ?>">
    <?php echo Yii::t('global','Confirm'); ?></a> <a href="" class="btn-confirm fix-btn"  data-dismiss="modal" aria-hidden="true"><?php echo Yii::t('global','stop'); ?></a> </div>
</div>

<div class="modal-footer fix-footer-popup">
    <span class="message-check"><input onclick="saveSessionConfirm()" type="checkbox" name="hideMessage" class="hideMessage" /> <?php echo Yii::t('global','Do not show this message again!'); ?>  </span>
</div>
<script type="text/javascript">
    function saveSessionConfirm()
    {
        if ($('.hideMessage').is(':checked')) {
            $.session.set('checkConfirmPopup', 'checked');
        } else {
            $.session.remove('checkConfirmPopup');
        }
    }
</script>