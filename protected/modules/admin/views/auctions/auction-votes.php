<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Auction Votes'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Auction Votes'); ?></h1>

        </div>
        <div class="block-fluid table-sorting">
            <?php 
                error_reporting(0);
                $catProducts = Categories::getAllCategory();
                $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'auction-votes-grid',
                'dataProvider'=>$model->getAuctionVotes(),
                'filter'=>$model,
                'columns'=>array(
                    'id',
                    array(
                        'name'  => 'product_name',
                        'header'=>Yii::t("global","Product name"),
                        'value' =>'$data->product->name',
                        'type'=>'html'
                    ),
                    array(
                        'name'  => 'yes_count',
                        'header'=>Yii::t("global",'Yes'),
                        'value' =>'$data->yes_count',
                        'type'=>'html',
                        'filter'=>'',
                    ),
                    array(
                        'name'  => 'no_count',
                        'header'=>Yii::t("global",'No'),
                        'value' =>'$data->no_count',
                        'type'=>'html',
                        'filter'=>'',
                    ),
                    array(
                        'header'=>Yii::t("global",'Quote'),
                        'value' =>'Utils::number_format(($data->yes_count/($data->yes_count+$data->no_count))*100) ." %"',
                        'type'=>'html'
                    ),
                    array(
                    'name'=>'category',
                    'header'=>Yii::t('global', 'Category'),
                    'type' => 'raw',
                    'filter'=>$catProducts,
                    'value' => 'Products::getProductCategory($data->product->id)',
                    'htmlOptions'=>array('style'=>'width:120px;')
                    ),
                    array(
                        'name'=>'producer_name',
                        'header'=>Yii::t('global', 'Producer'),
                        'type' => 'html',
                        'value' => '$data->product->producer->name',
                        'htmlOptions'=>array('style'=>'width:100px;')
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
                                'url'=>'Yii::app()->createUrl("/admin/auctionVotes/viewVoted", array("id"=>$data->id))',
                            ),
                        ),
                    ),
                ),
            )); ?>
        </div>
    </div></div>