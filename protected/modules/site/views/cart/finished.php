<div class="pull-left col-left">
    
        <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 5))?>
            
            <?php echo CHtml::form($this->createUrl('cart/finished'), 'post', array('style' => 'margin: 0')); ?>
            <div class="vote-content">
              	<h5 style="padding: 10px;"><?php echo Yii::t('global', 'Thank you for your purchase!')?></h5>
				<div>
					<a class="bt_colo" href="/"><?php echo Yii::t('global', 'Continue shopping')?></a>
				</div>
                <div class="clearfix"></div> 
           
                <div class="clearfix"></div>
            </div>
            <?php echo CHtml::endForm(); ?>            
        </div>
    </div><!--#end vote-wrapper-->

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
<?php
    //$token = $_GET['token'];
    if(isset($_GET['token'])){ ?>
        var count_cart = parseInt($('.cart_count').html());
        if(count_cart>0){
            $('.cart_count').html(count_cart);
        } else {
            $('.cart_count').html(0);
        }

<?php  } ?>
</script>