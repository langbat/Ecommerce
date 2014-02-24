<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Evaluation Auction'); ?></small></h1>
</div>
<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Evaluation Auction'); ?></h1>
        </div>
          <div class="block-fluid table-sorting">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid',
                'dataProvider'=>$model->evaluationAuction( ),
                'columns'=>array(
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Duration'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content-two'),
                        'value'=>'Auctions::getDurationBid( $data["start_time"], $data["end_time"] )',
                        
                    ),
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Name of item'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'name'=>'name',
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content-two'),
                        'value' => '$data["name"]'
                    ),
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Start bid quote'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'Auctions::getBidQuote( $data["bid_quote"], $data["totalbid"] )'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Current bid quote'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval(Auctions::getBidQuote( $data["bid_quote"], $data["totalbid"] ) - $data["totalbid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Additional bid'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'Auctions::getAdditionalBid( $data["totalbid"], Auctions::getBidQuote( $data["bid_quote"], $data["totalbid"] ) )'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Total Bid'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'totalbid',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["totalbid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Single bid'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'singlebid',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["singlebid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Multi bid'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'mutilbid',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["mutilbid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'No. of bidder'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'noofbid',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["noofbid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Avarage per bidder'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'Utils::number_format_compare( Auctions::myDivision( $data["totalbid"], intval( $data["noofbid"] )) )'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Bidder name'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'username',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => '$data["username"]'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Free Bid'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'name' => 'freebid',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["freebid"])'
                    ), 
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'Revenue (bid)'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'intval($data["totalbid"]-$data["freebid"])'
                    ), 
                    array(
                        'header'=>'<b>'.Yii::t('evaluation-auctions', 'Revenue').'</b>',
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'Utils::number_format_compare(($data["totalbid"]-$data["freebid"])*$data["bid_price"]). " €"'
                    ),
                    array(
                        'header'=>Yii::t('evaluation-auctions', 'fee'),
                        'headerHtmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-size'),
                        'type' => 'html',
                        'htmlOptions'=>array(Yii::app()->language=='en'?'':'class'=>'fix-font-content'),
                        'value' => 'Utils::number_format_compare((($data["totalbid"]-$data["freebid"])*$data["bid_price"])* (Auctions::myDivision( Yii::app()->settings->vat_tax, 100) ) ). " €"'
                    ), 
                ),
            ));
            ?>
          
        </div>   
       
</div>
