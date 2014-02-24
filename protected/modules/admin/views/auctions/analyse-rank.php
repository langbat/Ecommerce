<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Analyse All Rank List'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Analyse All Rank List'); ?></h1>

        </div>
        <div class="block-fluid table-sorting">
            <?php 
             $auctionStatus = Lookup::items('AuctionStatus');
             $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'auction-analyse-all-grid',
                'dataProvider'=>$model->getAnalyseAuctions(),
                'filter'=>$model,
                'columns'=>array(
                    'id',
                    array(
                        'name'  => 'product_name',
                        'header'=>Yii::t('global', 'Product name'),
                        'value' =>'$data->product->name',
                        'type'=>'html'
                    ),
                    array(
                        'name'  => 'status',
                        'header'=>Yii::t('global', 'Status'),
                        'value' =>'$data->getStringStatus($data->getStatus())',
                        'filter'=>$auctionStatus,
                    ),
                    'max_price',
                    //'bid_price',
                    array(
                        'name' => 'start_time',
                        'header'=>Yii::t('analyse', 'Start time'),
                        'htmlOptions'=> array('style' => 'text-align: center'),
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
                    array(
                        'name' => 'end_time',
                        'header'=>Yii::t('analyse', 'End time'),
                        'htmlOptions'=> array('style' => 'text-align: center'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'end_time',
                                'mode'=>'date',
                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_due_date_last',
                                    'size' => '10',
                                    'style' => 'text-align: center'
                                ),
                            ),
                            true)
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{viewAuction}',
                        'buttons'=>array
                        (
                            'viewAuction' => array
                            (
                                'label'=>'View',
                                'imageUrl'=>'/assets/images/view.png',
                                'url'=>'Yii::app()->createUrl("/admin/auctions/viewAnalyseRank", array("id"=>$data->id))',
                            ),
                        ),
                    ),
                ),
            )); ?>
        </div>
    </div></div>