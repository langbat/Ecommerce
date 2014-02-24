
<div class="page-header">
    <h1><?php error_reporting(0);echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Orders'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span6">
    <div class="slider-box purple-grid">
                 
            <!--<h1><?php // echo Yii::t('global', 'Orders'); ?> #<?php //echo $model->id; ?></small></h1>-->
           <div class="title"><h5><a href="/orders/update?id=<?php echo $model->id?>" title="Edit" style="color: #fff;"><i class="fa fa-edit"></i> </a> <?php echo Yii::t('global','View Orders Shops');?></h5></div>
                <div class="create_link"><a class="isw-back fa fa-arrow-circle-left fa-2x tipb" href="javascript: history.back()" title="<?php echo Yii::t('global','Back') ?>"></a></div>
       <div class="scroll-view">
       <?php $this->widget('zii.widgets.CDetailView', array(
        	'data'=>$model,
        	'attributes'=>array(
        		'id',
        		array(
                    'name' => 'user',
                    'type' => 'raw',
                    'value'=> '<a href="#fancybox_info" id = "info">'.$model->user->username.'</a>',
                    
                ),
                
        		'created',
        		array('name'=>'remaining_date','cssClass'=>'fix-null'),
        		'amount',
        		'billing_fullname',
        		'billing_address',
        		array('name'=>'shipping_fullname','cssClass'=>'fix-null'),
        		array('name'=>'shipping_address','cssClass'=>'fix-null'),
        		'shipped',
        		
        		array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value'=> Orders::getStatusTrans($model->orderStatus->name),
                ),
        	),
        )); ?></div>
        
        </div>
    </div>
    
    <div class="span6">
        <div class="slider-box purple-grid">
            <div class="title"><h5><i class="fa fa-th-list"></i>  <?php echo Yii::t('global','Items');?></h5></div>
        <div>    
            <?php 
            $items=new OrderItems('search');
            $items->unsetAttributes();  // clear any default values
            $_GET['OrderItems']['order_id'] =$model->id;
            $items->attributes=$_GET['OrderItems'];
        
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'order-items-grid',
                'dataProvider'=>$items->search(),
                'filter'=>null,
                'enableSorting' => false,
                'summaryText'=>'',
                'htmlOptions' => array('class' => 'sOrders'),
                'columns'=>array(
                    array(
                      'name'=>'id',
                      'value'=>'$data->id',
                        'htmlOptions'=>array('style' => 'min-width:20px'),
                    ),
                    array(
                        'name'=> 'item_id',
                        'value' => '$data->showItem('.$model->shop_id.')',
                        'type' => 'raw'
                    ),
                    array(
                        'name'=> 'type',
                        'value' => 'Orders::GetOrderItemType( Lookup::item("OrderItemType", $data->type) )',
                    ),
                    'qty',
                    array(
                        'name' => 'unit_price',
                        'value' => 'Utils::number_format($data->unit_price)." &euro;"',
                        'type' => 'raw',
                        'htmlOptions'=>array('style' => 'min-width:70px'),
                    )
                ),
            )); ?>
        </div>
        </div>
        
    </div>
     <div class="span12" style="display: none;">
                    <div class="slider-box purple-grid" id="fancybox_info">
      
           
            <div class="title"><h5><i class="fa fa-user"></i>  <?php echo Yii::t('global','User info');?></h5></div>

        
        <div class="content-scroll"> 
                                                
                                                <?php 
                                                //  var_dump(Members::model()->findAllByPk($model->user_id));exit();
                                                
                                                $this->widget('zii.widgets.CDetailView', array(
                                                    'data'=>Members::model()->findByPk($model->user_id),
                                                    'attributes'=>array(
                                                    'username',
                                                        array('name'=>'fname','cssClass'=>'fix-null'),
                                                        array('name'=>'lname','cssClass'=>'fix-null'),
                                                        'email',
                                                        array('name'=>'street','cssClass'=>'fix-null'),
                                                        array('name'=>'nr','cssClass'=>'fix-null'),
                                                        array('name'=>'postcode','cssClass'=>'fix-null'),
                                                        array('name'=>'city','cssClass'=>'fix-null'),
                                                        array('name'=>'phone','cssClass'=>'fix-null'),
                                                        array(
                                                            'label'=>Yii::t('global','Joined'),
                                                            // here's a parameter that disable HTML escaping by Yii
                                                            'value'=>date("d/m/Y H:i:s",strtotime(Members::model()->findByPk($model->user_id)->joined)),

                                                        ),
                                                        array(
                                                            'label'=>Yii::t('global','Country'),
                                                            'value'=>Members::model()->findByPk($model->user_id)->country->short_name,
                                                        ),
                                                    ),
                                                )); ?>

                                            </div> </div>
        
</div>

<script type="text/javascript">  
$(document).ready(function() {
        $("#info").fancybox({
                
                'titleShow'  : false,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic'
            });
    })

</script>
