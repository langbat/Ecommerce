<div class="page-header">
    <h1><?php echo Yii::t('global', 'Update'); ?> 
        <small>
            <?php echo Yii::t('global', 'ProductComments'); ?> <?php echo $model->id; ?>        </small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <?php echo $this->renderPartial('_formcomment', array('model'=>$model)); ?></div></div>