<div class="workplace">
    <div class="page-header">
        <h1><?php echo Yii::t('global','Product info '); ?><small><?php echo $model->name; ?></small></h1>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('info-product', compact('model')); ?>
            <div class="span6">
                <div class="head clearfix">
                    <div class="isw-sound"></div>
                    <h1><?php echo Yii::t('global','Product Video'); ?></h1>
                </div>
                <div class="block scrollBox videoShow">
                    <?php
                    error_reporting(0); 
                    echo $model->getVideo($model->video)?>
                </div>
            </div>
    </div>

    <div class="row-fluid">
        <?php $this->renderPartial('info-img-product', compact('model','images')); ?>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('schedule_show',compact('model')); ?>
    </div>
    <div class="row-fluid">
        <?php $this->renderPartial('productcomments',compact('model'));?>
    </div>
</div>