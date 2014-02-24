<?php $product = new Products;
if ($model->product_id) $product = $product->findByPk($model->product->id);
?>
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'auctions-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row-form clearfix">
    <div class="span3">
        <?php echo $form->labelEx($model,'product_id'); ?>
    </div>
    <div class="span9">
        <?php echo $form->dropDownList($model,'product_id', CHtml::listData(Products::model()->findAll(),'id','name')); ?>
    </div>
</div>
<div class="row-form clearfix">
    <div class="span2">
        <?php echo $form->labelEx($model,'max_price'); ?>
    </div>
    <div class="span4">
        <?php echo $form->textField($model,'max_price'); ?>
        <?php echo $form->error($model,'max_price'); ?>
    </div>
    <div class="span2">
        <?php echo $form->labelEx($model,'bid_price'); ?>
    </div>
    <div class="span4">
        <?php echo $form->textField($model,'bid_price'); ?>
        <?php echo $form->error($model,'bid_price'); ?>
    </div>
</div>
<div class="row-form clearfix">
    <div class="span2">
        <?php //echo $form->labelEx($model,'start_time');
              echo Yii::t('auction', 'start time');
         ?>
    </div>
    <div class="span4">
        <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'start_time',
            'mode'=>'datetime',
            'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
            'language' => Yii::app()->language=='en'?'':Yii::app()->language
        )); ?>
        <?php echo $form->error($model,'start_time'); ?>
    </div>
    <div class="span2">
        <?php //echo $form->labelEx($model,'end_time');
              echo Yii::t('auction', 'end time');
        ?>
    </div>
    <div class="span4">
        <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'end_time',
            'mode'=>'datetime',
            'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
            'language' => Yii::app()->language=='en'?'':Yii::app()->language
        )); ?>
        <?php echo $form->error($model,'end_time'); ?>
    </div>
</div>
<div class="row-form clearfix">
    <div class="span2">
        <?php echo $form->labelEx($model,'countdown'); ?>
    </div>
    <div class="span4">
        <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'countdown',
            'mode'=>'time',
            'language' => Yii::app()->language=='en'?'':Yii::app()->language
        )); ?>
        <?php echo $form->error($model,'countdown'); ?>
    </div>
    <div class="span2">
        <?php echo $form->labelEx($model,'bid_quote'); ?>
    </div>
    <div class="span4">
        <?php echo $form->textField($model,'bid_quote'); ?>
        <?php echo $form->error($model,'bid_quote'); ?>
    </div>
</div>
<?php if ($model->type == Auctions::TYPE_LOWPRICE){ ?>
<!--<div class="row-form clearfix">
    <div class="span2">
        <?php /*echo $form->labelEx($model,'is_featured'); */?>
    </div>
    <div class="span4">
        <?php /*echo $form->checkBox($model,'is_featured'); */?>
        <?php /*echo $form->error($model,'is_featured'); */?>
    </div>
    <div class="span2">
        <?php /*echo $form->labelEx($model,'as_banner'); */?>
    </div>
    <div class="span4">
        <?php /*echo $form->checkBox($model,'as_banner'); */?>
        <?php /*echo $form->error($model,'as_banner'); */?>
    </div>
</div>-->
<?php 
}
if(!$model->isNewRecord) {?>
<div class="row-form clearfix">
    <div class="span2">
        <?php echo Yii::t('global','Purchased Product ') ?>
    </div>
    <div class="span4">
        <?php
            $purchased = OrderItems::model()->purchaseProduct($model->product_id);
        echo $purchased; ?>
    </div>
</div>
<?php } ?>
<div class="row-fluid">
    <div class="span6">
        <?php if ($model->type == Auctions::TYPE_LOWPRICE){
            $this->renderPartial('_lowprice-bid-data', compact('model','form'));
        }
        else{
            $this->renderPartial('_basic-bid-data', compact('model','form'));
        }

        ?>
    </div>
     <?php if ($model->type == Auctions::TYPE_LOWPRICE){ ?>
    <div class="span6">
        <div class="head clearfix">
            <h1><?php echo Yii::t('global','Joker bid') ?></h1>
        </div>
        <div class="block block-fluid">
            <div class="itemIn fix-row">
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'cashback_position_2'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'cashback_position_2'); ?>
                        <?php echo $form->error($model,'cashback_position_2'); ?>
                    </div>
                </div>
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'cashback_position_3'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'cashback_position_3'); ?>
                        <?php echo $form->error($model,'cashback_position_3'); ?>
                    </div>
                </div>
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'joker_bid_price'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'joker_bid_price'); ?>
                        <?php echo $form->error($model,'joker_bid_price'); ?>
                    </div>
                </div>
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'joker_bid_code'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'joker_bid_code',array('size'=>12,'maxlength'=>12)); ?>
                        <?php echo $form->error($model,'joker_bid_code'); ?>
                    </div>
                </div>
                
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'joker_position_from'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'joker_position_from'); ?>
                        <?php echo $form->error($model,'joker_position_from'); ?>
                    </div>
                </div>
                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'joker_position_to'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'joker_position_to'); ?>
                        <?php echo $form->error($model,'joker_position_to'); ?>
                    </div>
                </div>

                <div class="row-form clearfix">
                    <div class="span5">
                        <?php echo $form->labelEx($model,'comfort_bid_credit'); ?>
                    </div>
                    <div class="span7">
                        <?php echo $form->textField($model,'comfort_bid_credit'); ?>
                        <?php echo $form->error($model,'comfort_bid_credit'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<div class="footer tar">
    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
$("#Auctions_product_id").select2();
</script>
</div><!-- form -->