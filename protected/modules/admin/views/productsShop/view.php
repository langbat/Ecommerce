<div class="workplace">
    <div class="page-header">
        <h1><?php echo Yii::t('global','Product Shop info '); ?><small><?php echo $model->name; ?></small></h1>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('info-product', compact('model')); ?>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('info-img-product', compact('model','images')); ?>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('product_shop_comment', compact('model','images')); ?>
    </div>
</div>