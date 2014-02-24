<div class="span5">
    <div class="head clearfix">
        <div class="isw-list"></div>
        <h1><?php echo Yii::t('global', 'Bids Information'); ?></h1>
    </div>
    
    <div class="block-fluid">
    <h5><?php echo Yii::t('global', 'Analyse All Rank List'); ?></h5>
        <div class="clearfix">
        <?php 
           error_reporting(0);
            $minprice   = Bids::model()->getMinPrice( $model->id );
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid-dashboard-0',
                'dataProvider'=>Bids::model()->getAnalyseRankList( $model->id, 0, 1 ),
                'columns'=>array(
                    array(
                        //'name'  => 'Rank',
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
                        'type' => 'html',
                        'value' => 'Bids::getUserNameAnalyse( $data["auction_id"], $data["price"], $data["Statistic"] )'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Bidder'),
                        'type' => 'html',
                        'value' => 'Members::getUser($data["bidder_id"])'
                    ), 
                ),
            ));
      ?>
             
        </div>
    </div>
    
       <div class="block-fluid">
       <h5><?php echo Yii::t('global', 'Analyse All Cent Place'); ?></h5>
        <div class="clearfix">
        <?php 
           error_reporting(0);
            $minprice   = Bids::model()->getMinPrice( $model->id );
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid-dashboard-1',
                'dataProvider'=>Bids::model()->getAnalyseRankList( $model->id, 1, 1, 1, $minprice ),
                'columns'=>array(
                    array(
                        //'name'  => 'Rank',
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
                        'type' => 'html',
                        'value' => 'Bids::getUserNameAnalyse( $data["auction_id"], $data["price"], $data["Statistic"] )'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Bidder'),
                        'type' => 'html',
                        'value' => 'Members::getUser($data["bidder_id"])'
                    ), 
                ),
            ));
      ?>
             
        </div>
    </div>