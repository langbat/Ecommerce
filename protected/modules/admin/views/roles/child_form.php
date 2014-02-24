<div class="page-header">
    <h1>
        <?php echo Yii::t('global', 'Adding'); ?> 
        <small><?php echo Yii::t('global', 'Auth Item'); ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Adding Auth Item'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul> 
    </div>
    
        <div class="block-fluid">
            <?php echo CHtml::form(); ?>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Parent'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeDropDownList($model, 'parent', $roles, array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'parent', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Child'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeListBox($model, 'child', $roles, array( 'size' => 20, 'multiple' => 'multiple', 'prompt' => Yii::t('global', '-- Choose Value --'), 'class' => 'text-input medium-input' )); ?>
		            <?php echo CHtml::error($model, 'child', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="footer tar">
        		<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class'=>'bnt')); ?>
        	</div>
        
        <?php echo CHtml::endForm(); ?>
        
        </div><!-- form -->
</div></div>




