<div class="title"><h5><?php echo Yii::t('global', 'Account Balance'); ?></h5></div>
<div class="info_profile">
    <div class="inner_container">
        <p>
            <strong><?php echo Yii::t('global','Total amount'); ?></strong>: <?php echo Utils::number_format(Yii::app()->session['my_balance'])?> &euro;<br /><br />
        </p>
        <a href="#addfund" role="button" data-toggle="modal"><span class="btn-orange"><?php echo Yii::t('global','Add fund'); ?></span></a>
        <!-- <a href="#cashback" role="button" data-toggle="modal"><span class="btn-orange"><?php echo Yii::t('global','Cashback'); ?></span></a> -->
        
        
        <div id="addfund" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="purple-grid">
                <div class="modal-header fix-header-modal title">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1 ><?php echo Yii::t('global','Add fund'); ?></h1>
                </div>
            </div>
            <?php $this->renderPartial('/elements/profile-inpayment', array('model'=>$inpayment)); ?>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t('global','Close'); ?></button>
                <button class="btn btn-primary" id="addMoney" type="submit"><?php echo Yii::t('global','Add'); ?></button>
            </div>
        </div>
        
        
        <!-- 
        <div id="cashback" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
        <?php 
        $model = new Transactions;
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'auctions-form',
            'action' => '/transactions/cashback',
            'enableAjaxValidation'=>false,
        )); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3><?php echo Yii::t('global','Cashback'); ?></h3>
            </div>
            <div class="modal-body">       
                <h6><?php echo Yii::t('global','Please input amount you would like to withdraw to your Paypal account.'); ?></h6>         
        		<p>
                    <?php echo $form->labelEx($model,'amount'); ?>
                    <?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10,'class' => 'euro')); ?>
                </p>
                <p>
                    <label><?php echo Yii::t('global', 'Paypal Email')?></label>
                    <input type="text" name="email" value="<?php echo Yii::app()->user->email ?>" />
                </p>
                <p>
                    <label><?php echo Yii::t('global', 'Account balance')?></label>
                    <?php echo Utils::number_format(Yii::app()->session['my_balance'])?>&euro;
                </p>
                <p>
                    <label><?php echo Yii::t('global', 'Cashback fee')?></label>
                    <?php echo Utils::number_format(Yii::app()->settings->cashback_fee)?>&euro;
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t('global','Close'); ?></button>
                <button class="btn btn-primary" type="submit"><?php echo Yii::t('global','Withdraw'); ?></button>
            </div>
        <?php $this->endWidget(); ?>
        </div>
        -->        
    </div>
</div><!--#end info-->
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#addMoney').click(function(){
            var myRadio = $('input[name=optionsRadios]');
            var amount = myRadio.filter(':checked').val();
            var id =  myRadio.filter(':checked').attr('id');
            var bonusHoliday = $(".bonus_holiday_"+id).val();
            var bonusInpayment = $(".bonus_inpayment_"+id).val();
            window.location.href = '/transactions/addfund?amount='+amount+'&bonusHoliday='+bonusHoliday+'&bonusInpayment='+bonusInpayment;

        });
    })
</script>