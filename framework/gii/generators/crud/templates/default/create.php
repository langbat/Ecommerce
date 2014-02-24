<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="page-header">
    <h1>
        <?php echo "<?php echo Yii::t('global', 'Create'); ?>" ?> 
        <small><?php echo "<?php echo Yii::t('global', '".$this->modelClass."'); ?>"; ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo "<?php echo Yii::t('global', 'Create'); ?>" ?>  <?php echo $this->modelClass; ?></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo "<?php echo Yii::t('global', 'Back'); ?>" ?>"></a></li>
        </ul> 
    </div>
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

</div></div>