<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
    <small><?php echo Yii::t('global', 'Basic Auctions'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Auctions'); ?></h1>
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('auctions/create', array('type' => Auctions::TYPE_BASIC)) ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Auctions'); ?>"></a></li>
    </ul>
</div>
<div class="block-fluid table-sorting">
<?php
    error_reporting(0);
    $auctionStatus = Lookup::items('AuctionStatus');
    $auctionStatusbasic = array("1"=>$auctionStatus[1],"3"=>$auctionStatus[3]);
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auctions_basic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		'id',
        array(
            'name'  => 'product_name',
            'header'=>Yii::t('global', 'Product name'),
            'value' =>'CHtml::link($data->product->name,array("/admin/products/view/","id"=>$data->product->id))',
            'type'=>'html'
        ),
        array(
            'name'  => 'status',
            'header'=>Yii::t('global', 'Status'),
            'value' =>'$data->getStringStatus($data->getStatusBasic())',
            'filter'=>$auctionStatusbasic,
        ),
        array(
            //'name'  => 'Participant',
            'header'=>Yii::t('global', 'Participant'),
            'value' =>'$data->join_count'
        ),
        array(
            'name'  => 'max_bid_quote_new',
            'header'=>Yii::t('global', 'Bid quote'),
            'value' =>'$data->basic_max_bids_number*$data->join_count',
            'filter'=>'',
        ),
		//'countdown',
        array(
            'name'  =>'bids_count',
            'header'=>Yii::t('global', 'Bids'),
            'filter'=>'',
            'value' =>'$data->bid_count',
            'type'  =>'html'
        ),
         array(
                        'name' => 'remaindate',
                        'value'=> 'Auctions::model()->getRemainingDate($data->id)',
                        'header'=>Yii::t('global', 'Remaining Date'),
                        'htmlOptions'=> array('style' => 'text-align: center'),
                        'filter'=>'',
                      //  'filter' => $this->widget('CJuiDateTimePicker', array(
//                                'model'=>$model,
//                                'attribute'=> 'remaindate',
//                                'mode'=>'date',
//                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
//                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
//                                'htmlOptions' => array(
//                                    'id' => 'datepicker_for_due_date',
//                                    'size' => '10',
//                                    'style' => 'text-align: center'
//                                ),
//                            ),
//                            true)
                    ),
		/*
		'end_time',
		'bid_quote',
		'is_featured',
		'as_banner',
		'special_bid',
		'special_bid_start_time',
		'special_bid_end_time',
		'special_bid_start_quote',
		'special_bid_end_quote',
		'half_price_bid',
		'half_price_bid_start_quote',
		'half_price_bid_end_quote',
		'free_bid',
		'free_bid_start_quote',
		'free_bid_end_quote',
		'joker_bid_price',
		'joker_bid_code',
		'joker_position_from',
		'joker_position_to',
		'cashback_position_2',
		'cashback_position_3',
		'comfort_bid_credit',
		'win_bid_id',
		'is_paid',
		'created',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>