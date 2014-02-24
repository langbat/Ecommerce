<div class="page-header">
    <h1>
        <?php echo Yii::t('global', 'Create'); ?> 
        <small><?php echo Yii::t('global', 'LiveSale'); ?></small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
<?php echo $this->renderPartial('_form', array('model'=>$model,'shop_id'=>$shop_id)); ?>
</div></div>