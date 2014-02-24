<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Low-price Auctions'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Auctions'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('auctions/create', array('type' => Auctions::TYPE_LOWPRICE)) ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Auctions'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">
<?php
    $auctionPhase  = Lookup::items('AuctionPhase');
    $auctionStatus = Lookup::items('AuctionStatus');
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auctions-grid',
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
            'value' =>'$data->getStringStatus($data->getStatus())',
            'filter'=>$auctionStatus,
        ),
        array(
            'name'  => 'is_phase',
            'header'=>Yii::t('global', 'Phase'),
            'value' =>'Auctions::getActiveStatusPhase( $data->id, $data->bid_quote, $data->countdown,$data->start_time )',
            'filter'=>$auctionPhase,
        ),
		//'max_price',        
		array('name' => 'bid_quote',
              'class'=>'ext.diggindata.ddautofilter.DDAutoFilterDataColumn',
              'header'=> Yii::t('global', 'Bid quote'),
              'value' => '$data->bid_quote ."/".($data->bid_quote+$data->bid_count)'),
		//'countdown',
        array(
            'name'  =>'bids_count',
            'header'=>Yii::t('global', 'Bids'),
            'filter'=>'',
            'value' =>'$data->bid_count',
            'type'  =>'html'
        ),
        array(
            //'name'  =>'amount',
            'header'=>Yii::t('global', 'Bid Amount'),
            'value' =>'Utils::number_format($data->bid_amount) ." &euro;"',
            'type'  =>'html'
        ),
		array(
                'name' => 'start_time',
                'header'=>Yii::t('global', 'Start Time'),
                'filter' => $this->widget('CJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'start_time',
                        'mode'=>'date',
                        'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                        'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                            'style' => 'text-align: center'
                        ),
                    ),
                    true)
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
            'template'=>'{view}{update}{delete}{restart}',
            'buttons' => array(
                'delete' => array('visible'=>'$data->canDelete()'),
                'restart' => array(
                    'visible'=>'$data->isFinished()',
                    'label' => '<i class="icon-retweet"></i>',
                    'url' => function($data, $row){
                        return '/admin/auctions/restart?id='.$data->id;    
                    },
                    'options'=>array(
                        'class' => 'tipb restart',
                        'data-original-title' => Yii::t('global', 'Restart auction'),
                        'title' => Yii::t('global', 'Restart auction'),
                        
                    ),
                )            
            )
		),
	),
));
?>
</div>
</div></div>



<script type="text/javascript">
$(document).ready(function(){
    $('.restart').click(function(){
        
    })
})
</script>