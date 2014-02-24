<script type="text/javascript">  
$(document).ready(function() {
        $(".fancybox_update").fancybox({
                'titleShow'  : false,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic'
            });
    })
</script>

<?php if(Yii::app()->user->isGuest){ ?>
    <div class="message_profile fix-message">
        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
        <p>
            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
        </p>
    </div>
<?php } else { ?>
    <div class="wrapper_profile">
            <div class="span2">
                <div class="ucard clearfix">
                    <div class="right">
                        <h4><?php echo $model->name; ?></h4>
                        <div class="rating_view">
                            <?php
                            $this->widget('ext.dzRaty.DzRaty', array(
                                'name' => 'my_rating_field',
                                'value' => Ratings::model()->getRating($model->id, 1 ),
                                'options' => array(
                                    'readOnly' => TRUE,
                                ),
                            ));
                            ?>
                        </div>
                        <div class="image image-product">
                            <a class="fancybox" <?php echo 'href="/uploads/product_shop/'.$model->image.'"'?> rel="group"><img <?php echo 'src="/uploads/product_shop/'.$model->image.'"' ?> class="img-polaroid"></a>
                        </div>
                        <ul class="control fix-control">
                            <li><span class="fa fa-pencil"></span> <a href="<?php echo $this->createUrl('/productShopManager/update',array('id'=>$model->id)); ?>"><?php echo Yii::t('global','Edit') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <div class="span6">
        
            <div class="slider-box purple-grid">
                <div class="title"><h5><i class="fa fa-edit"></i>  <?php echo Yii::t('global','View Products Shops');?></h5></div>
                    <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="/productShopManager/index" title="<?php echo Yii::t('global','Back') ?>"></a> </div>
                        <div class="info_profile fix-info-profile scroll-view">
                            <?php $this->widget('zii.widgets.CDetailView', array(
                                	'data'=>$model,
                                    'attributes'=>array(
                            		'name',
                                     array(
                                        'label'=>Yii::t('global','Price'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>Utils::number_format($model->price)." €",
                                        ),
                                     array(
                                        'label'=>Yii::t('global','Price Purchase'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>Utils::number_format($model->price_purchase)." €",
                                        ),
                                     array(
                                        'label'=>Yii::t('global','Direct Buy Price'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>Utils::number_format($model->direct_buy_price)." €",
                                        ),
                                     'shop.name', 
                                    array(
                                        'label'=>Yii::t('global', 'Category'),
                                        'type'=>'raw',
                                        'value'=>$model->getProductCategoryShopBE($model->id ),
                                    ), 
                            		'short_desciption',
                            		//'description',
                            		array(
                                        'label'=>Yii::t('global','Shipping cost'),
                                        'type'=>'raw',
                                        'cssClass'=>'fix-null',
                                        'value'=>Utils::number_format($model->shipping_cost)." €",
                                    ),
                                    array(
                                            'label'=>Yii::t('global','Descritpion Shipping fee'),
                                            'type'=>'raw',
                                            'cssClass'=>'fix-null',
                                            'value'=>$model->description_shipping_fee,
                                    ),
                                    array(
                                        'name'=>'is_active',
                                        'type'=>'raw', 
                                        'value'=>Products::model()->getStatusProduct($model->is_active),
                                        'cssClass'=>'fix-null'
                                    ),
                                    array(
                                        'name'=>'shipping_immediately',
                                        'type'=>'raw',
                                        'value'=>Products::model()->getStatusProduct($model->shipping_immediately),
                                        'cssClass'=>'fix-null'
                                    ),
                            		'created',
                            		'updated',
                            	),
                                )); ?>
                    </div>
                <div class="clearfix"></div>       
            </div>
    </div>
        <div class="slider-box purple-grid span4">
                <div class="title"><h5><i class="fa fa-comments"></i>  <?php echo Yii::t('global','Comment Products Shops');?></h5></div>
                   <div class="info_profile fix-info-profile scroll-view">
                        <div class="fix_content_comment" style="margin-top: -30px;">
                            <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                'id'=>'comment-grid',
                                'dataProvider'=>$commentProductShop,
                                'summaryText'=>'',
                                'columns'=>array(
                                    array(
                                        'name'=>'content',
                                    ),
                                    array(
                                        'class'=>'CButtonColumn',
                                       'template'=> '{delete}{update}',
                                        'buttons'=>array(
                                          'delete'=>array(
                                             'url'=>'$this->grid->controller->createUrl("/productShopManager/deletecomment", array("id"=>$data->primaryKey))',
                                             ),
                                             'update'=>array(
                                             'options'=>array(
                                                'class'=>"fancybox_update",
                                             ),
                                            
                                             'url'=>'$this->grid->controller->createUrl("/productShopManager/updatecomment", array("id"=>$data->primaryKey,"id_pro"=>'.$model->id.'))',
                                             ),
                                        ),
                                        'htmlOptions'=>array('style'=>'width:50px;')
                                    ),
                                ),
                                ));  ?>
                        </div>
                    </div><!--#end info-->
            <div class="clearfix"></div>
        </div> 
    </div>

<div class="clearfix"></div>
    <div class="row-fluid">
        <?php $this->renderPartial('info-img-product', compact('model','images')); ?>
    </div>
<?php } ?>




