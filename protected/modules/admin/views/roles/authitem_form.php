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
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Name'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeTextField($model, 'name', array( 'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'name', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Description'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeTextField($model, 'description', array( 'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'description', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Type'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeDropDownList($model, 'type', AuthItem::model()->types, array( 'prompt' => Yii::t('global', '-- Choose Value --'), 'tabindex'=>3,  'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'type', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item bizRule'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeTextArea($model, 'bizrule', array( 'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'bizrule', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
            
            <div class="row-form clearfix">
        		<div class="span3">
                    <?php echo CHtml::label(Yii::t('adminroles', 'Auth Item Data'), ''); ?>
                </div>
        		<div class="span9">
                    <?php echo CHtml::activeTextArea($model, 'data', array( 'class' => 'text-input medium-input' )); ?>
                    <?php echo CHtml::error($model, 'data', array( 'class' => 'input-notification errorshow png_bg' )); ?>
                </div>
        	</div>
        
        	<div class="footer tar">
        		<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class'=>'bnt')); ?>
        	</div>
        
        <?php echo CHtml::endForm(); ?>
        
        </div><!-- form -->
</div></div>




