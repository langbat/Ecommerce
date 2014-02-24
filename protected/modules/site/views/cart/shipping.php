<div class="pull-left col-left">
    
        <div class="clearfix"></div>
    <!--#end product-wrapper-->

    <div class="cart-wrapper">
        <div class="cart-grid purple-grid">
            <?php $this->renderPartial('steps', array('step' => 3))?>
            
            <?php echo CHtml::form('', 'post', array('style' => 'margin: 0')); ?>
            <div class="vote-content">
              	
				<div>
                    <h4>Shipping information here</h4>
					
					<input class="btn-kaufen" type="submit" name="submit" value="<?php echo Yii::t('global', 'Continue')?>" />
				</div>
                
                <div class="clearfix"></div>
                <br /> 
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