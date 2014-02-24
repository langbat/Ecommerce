<div class="page-header">
    <h1>
        <?php error_reporting(0); echo Yii::t('global', 'Create'); ?> 
        <small><?php echo Yii::t('global', 'Orders'); ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Create'); ?>  <?php echo Yii::t('global', 'Orders'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul> 
    </div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div></div>