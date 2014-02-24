<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Auctions'); ?> #<?php echo $model->id; ?></small></h1>
</div>


<div class="row-fluid">
    <?php
        $this->renderPartial('infor-auctions', compact('model'));
        $this->renderPartial('infor-bid', compact('model'));
    ?>
</div>
<div class="row-fluid">
    <?php
        $this->renderPartial('statistics-auction', compact('model'));
        $this->renderPartial('winner-auction', compact('model'));
    ?>

</div>