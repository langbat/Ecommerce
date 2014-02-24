<div class="span6">
    <div class="row-fluid">
        <div class="span3">
            <div class="ucard clearfix">
                <div class="right">
                    <h4><?php echo $model->name; ?></h4>
                    <div class="rating_view">
                        <?php
                        $this->widget('ext.dzRaty.DzRaty', array(
                            'name' => 'my_rating_field',
                            'value' => Ratings::model()->getRating($model->id),
                            'options' => array(
                                'readOnly' => TRUE,
                            ),
                        ));
                        ?>
                    </div>
                    <div class="image image-product">
                    <img <?php echo 'src="/uploads/product/'.$model->image.'"' ?> class="img-polaroid">
                    </div>
                    <ul class="control fix-control">
                        <li><span class="icon-pencil"></span> <a href="<?php echo $this->createUrl('/admin/products/update',array('id'=>$model->id)); ?>"><?php echo Yii::t('global','Edit') ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="span9">
            <div class="head clearfix">
                <div class="isw-edit"></div>
                <h1><?php echo Yii::t('global','Product info '); ?></h1>
            </div>
            <div class="block scrollBox">

                <div class="scroll" style="height: 250px;">
                    <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model,
                    'attributes'=>array(
                        array(
                            'label'=>Yii::t('global','Instead of price'),
                            'type'=>'raw',
                            'value'=>Utils::number_format($model->price)." €",
                        ),
                        array(
                            'label'=>Yii::t('global','Direct  Price'),
                            'type'=>'raw',
                            'value'=>Utils::number_format($model->direct_buy_price)." €",
                        ),
                        array(
                            'label'=>Yii::t('global','Price Purchase'),
                            'type'=>'raw',
                            'value'=>Utils::number_format($model->price_purchase)." €",
                        ),
                        array(
                            'name'=>'created',
                            'type'=>'raw',
                            'value'=>$model->created,
                            'cssClass'=>'fix-null'
                        ),
                        'updated',
                        'user.username',
                        'short_desciption',
                        'type_shipping',
                        'availble_ship',
                        'availble_pickup',
                        array(
                            'label'=>Yii::t('global','Value / Units (kg/m³...)'),
                            'type'=>'raw',
                            'value'=>$model->value." / ".$model->units,
                            'cssClass'=>'fix-null'
                        ),

                        /*array(
                            'name'=>'shipping_cost',
                            'type'=>'raw',
                            'value'=>$model->shipping_cost,
                            'cssClass'=>'fix-null'
                        ),*/
                        array(
                            'name'=>'is_active',
                            'type'=>'raw',
                            'value'=>$model->getStatusProduct($model->is_active),
                            'cssClass'=>'fix-null'
                        ),
                        array(
                            'name'=>'shipping_immediately',
                            'type'=>'raw',
                            'value'=>$model->getStatusProduct($model->shipping_immediately),
                            'cssClass'=>'fix-null'
                        ),
                        array(
                            'label'=>Yii::t('global','Description'),
                            'type'=>'raw',
                            'value'=>$model->description,
                            'cssClass'=>'fix-null'
                        ),

                        array(
                            'label'=>Yii::t('global','Tags'),
                            'type'=>'raw',
                            'value'=>$model->getTags($model->id),
                            'cssClass'=>'fix-null'
                        ),
                    ),
                )); ?>
                </div>

            </div>
        </div>
    </div>
</div>