<div class="page-header">
    <h1><?php echo Yii::t('global', 'Update'); ?> 
        <small>
            <?php echo Yii::t('global', 'Live Sale'); ?> <?php echo $model->id; ?>        </small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Update'); ?>  Live Sale</h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="<?php echo Yii::t('global', 'Back'); ?>"></a></li>
        </ul>
    </div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div></div>