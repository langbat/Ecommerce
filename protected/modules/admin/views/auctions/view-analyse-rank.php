
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Analyse All Rank List'); ?></small></h1>
</div>
<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Analyse All Rank List'); ?></h1>
            <ul class="buttons">
                <li><a data-original-title="<?php echo Yii::t('global','Back'); ?>" href="javascript: history.back()" class="isw-left tipb"></a></li>
            </ul>
        </div>
          <div class="block-fluid table-sorting">
            <?php
            error_reporting(0);
            $minprice   = $bids->getMinPrice( $id );
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid',
                'dataProvider'=>$bids->getAnalyseRankList( $id ),
                'columns'=>array(
                    array(
                        'name'  => 'Rank',
                        'header'=>Yii::t('global', 'Rank'),
                        'value'=>'$data["Rank"]',
                        'htmlOptions'=>array('width'=>'90'),
                    ),
                    array(
                        'name' => 'price',
                        'header'=>Yii::t('global', 'Bid'),
                        'type' => 'html',
                        'value' => '$data["price"]'
                    ),
                    array(
                        'name' => 'Statistic',
                        'header'=>Yii::t('global', 'Statistic'),
                        'type' => 'raw',
                        //'value'=>'CHtml::link(Bids::getUserNameAnalyse( $data["auction_id"], $data["price"], $data["Statistic"] ),
//                        CHtml::normalizeUrl("javascript:void(0)"),
//                            array(
//                                "id" => "'.rand(0,999999).'",
//                                "class" => "tipb",
//                                "data-original-title"=>"Source cannot be translated",
//                            )
//                        )',
                        'value' => ' Bids::getUserNameAnalyse( $data["auction_id"], $data["price"], $data["Statistic"] )',
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Bidder'),
                        'type' => 'html',
                        'value' => 'Members::getUser($data["bidder_id"])'
                    ), 
                ),
            ));?>
          
        </div>   
</div>