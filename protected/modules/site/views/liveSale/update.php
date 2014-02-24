<div class="page-header">
    <h1><?php echo Yii::t('global', 'Update'); ?> 
        <small>
            <?php echo Yii::t('global', 'LiveSale'); ?> <?php echo $model->id; ?>        </small>
    </h1>
</div>
<div class="row-fluid">
<div class="span12">
    <div class="purple-grid">
    <div class="title"> <h5><i class="fa fa-edit"> </i> <?php echo Yii::t('global','Update Live Sale');?></h5></div>
                     <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
       <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        
    </div>
</div></div>