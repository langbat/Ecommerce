<?php /*$model = Members::model()->findByPk(Yii::app()->user->id);*/ ?>
<div class="pull-left col-left">
    
    <div class="clearfix"></div>
  

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 3))?>
            
            <form action="/cart/review" method="">
            <div class="vote-content">
                <div class="salutation">
                    <h5><?php echo Yii::t('global', 'Method Payment'); ?></h5>
                    <label class="paypal-info">
                        <img src="/themes/default/img/paypal.gif" />
                        <input type="radio" name="paymentmethod" class="option_paypal" checked value="paypal">
                        <a href="https://www.paypal.com/<?php echo Yii::app()->language ?>/webapps/mpp/paypal-popup" target="_blank">
                            <?php echo Yii::t('global', 'What is PayPal?')?>
                        </a>
                    </label>

                </div>
                                
                <div class="clearfix"></div> 
                                <div>
                   <input type="submit" value="<?php echo Yii::t('global', 'Continue')?> " class="btn-kaufen fix-checkout ">
                </div>
                    			<div class="clearfix"></div>
                <br> 
            </div>
            </form>
                    
        </div>
    </div>

</div><!--#end col-left-->

<div class="pull-left col-right">
      <?php if(!Yii::app()->user->isGuest){ ?>
        <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
        </div>
     <?php } ?>
     <div class="right-box">
        <?php $this->renderPartial('/elements/tested-safety');?>
    </div>
</div><!--#end col-right-->

<script type="text/javascript">
    $('#billing_address, #shipping_address').change(function(){
        if (this.value == '0')
            $(this).parent().next().show();
        else
            $(this).parent().next().hide();
    });

    
</script>