<div class="content-wrapper">
        <div class="pull-left col-left">
            <div class="vote-wrapper">
                <div class="vote-grid purple-grid">
                    <div class="title"><h5><?php echo Yii::t('global','Charge account');?></h5></div>
                        <div class="vote-content">
                            <!--<div class="top_text">
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing eluyam erat, sed diam voluptua. </p>
                            </div>-->
                            <div class="block-fluid table-sorting">
                                <?php $this->renderPartial('/elements/profile-inpayment', compact('model')); ?>
                            </div>
                            <!--<div class="description-paypal">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>-->
                            <div class="pice_paypal">
                                <div class="icon_paypal"><img src="/themes/default/img/paypal.png" alt="Ads" /></div>
                                <div class="link_paypal"><a class="text_paypal" href="#"><?php echo Yii::t('global','PayPal')?></a> <button type="button" class="btn_paypal"><?php echo Yii::t('global','Pay now')?></button></div>
                                <div class="paypal_descrip">
                                    <a href="https://www.paypal.com/<?php echo Yii::app()->language ?>/webapps/mpp/paypal-popup" target="_blank">
                                        <?php echo Yii::t('global', 'What is PayPal?')?>
                                    </a>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <div class="clearfix"></div>
                        </div>
                    <div class="clearfix"></div>
                </div>                    
            </div>
        </div><!--#end col-left-->

        <div class="pull-left col-right">
            <div class="right-box">
                <?php $this->renderPartial('/elements/profile-menu')?>
            </div>
        </div><!--#end col-right-->
        
        <div class="clearfix"></div>                        
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.input-checked').parent().parent().parent().addClass('fix-radio-charge');
        $('.input-checked').parent().addClass('fix-radio-charge');
        $('input[name=optionsRadios]').click(function(){
            $( "tr" ).removeClass( "fix-radio-charge" );
            $( "label").removeClass( "fix-radio-charge" );
            if ($(this).is(':checked')) {
                $(this).parent().addClass('fix-radio-charge');
                $(this).parent().parent().parent().addClass('fix-radio-charge');
            }
        });

        $('.btn_paypal').click(function(){
            var myRadio = $('input[name=optionsRadios]');
            var amount = myRadio.filter(':checked').val();
            var id =  myRadio.filter(':checked').attr('id');
            var bonusHoliday = $(".bonus_holiday_"+id).val();
            var bonusInpayment = $(".bonus_inpayment_"+id).val();
            window.location.href = '/transactions/addfund?amount='+amount+'&bonusHoliday='+bonusHoliday+'&bonusInpayment='+bonusInpayment;

        });
    })
</script>