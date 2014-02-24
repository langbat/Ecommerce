<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Analyse All Cent Place'); ?></small></h1>
</div>
<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Analyse All Cent Place'); ?></h1>
            <ul class="buttons">
                <li><a data-original-title="<?php echo Yii::t('global','Back'); ?>" href="javascript: history.back()" class="isw-left tipb"></a></li>
            </ul>
        </div>
  <?php 
//        error_reporting(0);
//        $minprice   = $bids->getMinPrice( $id );    
//        $analyseAll = $bids->getAnalyseAll( $id ); 
//        foreach ( $analyseAll as $analy  ){
//            $inforAnalyseSta[Utils::number_format_compare($analy['price'])]    .= $analy['Statistic'];
//            $inforAnalyseBidder[Utils::number_format_compare($analy['price'])]  .= $analy['bidder_id'];
//            $price[]   = Utils::number_format_compare($analy['price']);
//        }
//        $analyseAllRank = $bids->getAnalyseAll( $id, 2, $minprice ); 
//        foreach ( $analyseAllRank as $analyseRank ) {        
//                $inforAnalyseRank[Utils::number_format_compare($analyseRank['price'])] .= $analyseRank['Rank'];
//           }
//        $mprice     = $bids->getAnalyseAll( $id, 1 );
//        foreach( $mprice as $maxpr ){
//            $maxprice = $maxpr['maxprice'];
//        }
   ?>
       <div class="block-fluid table-sorting">
       <?php
            error_reporting(0);
            $minprice   = $bids->getMinPrice( $id );
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid',
                'dataProvider'=>$bids->getAnalyseRankList( $id, 1, 0, 1, $minprice ),
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
                        'type' => 'html',
                        'value' => 'Bids::getUserNameAnalyse( $data["auction_id"], $data["price"], $data["Statistic"] )'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Bidder'),
                        'type' => 'html',
                        'value' => 'Members::getUser($data["bidder_id"])'
                    ), 
                ),
            ));?>
       
       
       
        <?php /*    <div class="grid-view" id="myBids-grid">
<!-- <div class="summary">Zeige Ergebnisse 1-10 von 13.</div> -->
<table class="items table">
<thead>
<tr>
<th id="myBids-grid_c0"><?php echo Yii::t('global', 'Rank'); ?></th><th id="myBids-grid_c1"><?php echo Yii::t('global', 'Bid'); ?></th><th id="myBids-grid_c2"><?php echo Yii::t('global', 'Statistic'); ?></th><th id="myBids-grid_c3"><?php echo Yii::t('global', 'Bidder'); ?></th></tr>
</thead>
<tbody>
<?php 
    $i = 0.01;
    while( $i < $maxprice ){ ?>
    <tr class="">
    <?php if ( in_array( Utils::number_format_compare($i), $price ) ){
        ?>
         <td> 
         <?php foreach( $inforAnalyseRank as $keyS=>$valS ){
            if(Utils::number_format_compare($keyS) == Utils::number_format_compare($i)) { echo $valS; }
        } ?>
         </td><td><?php echo Utils::number_format_compare($i); ?></td>  
         <td> <?php foreach( $inforAnalyseSta as $key=>$val ){
            if(Utils::number_format_compare($key) == Utils::number_format_compare($i)) { echo $val; }
        } ?> </td> 
        <td> <?php foreach( $inforAnalyseBidder as $keyB=>$valB ){
            if(Utils::number_format_compare($keyB) == Utils::number_format_compare($i)) echo Members::getUser($valB); } ?> </td></tr>   
    <?php }
    else{
     ?>
        <td> &nbsp; </td><td><?php echo Utils::number_format_compare($i); ?></td><td> 0 </td><td>&nbsp;</td></tr>
   <?php } ?>
    <?php    
     $i = $i + 0.01;    
    }

?>

</tbody>
</table>
<div class="pager"><div class="dataTables_paginate paging_full_numbers" id="yw0"><a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid" class="first hidden">&lt;&lt; Erste</a>
<a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid" class="previous hidden">&lt; Vorherige</a>
<a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid" class="page paginate_active">1</a>
<a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid&amp;page=2" class="paginate_button">2</a>
<a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid&amp;page=2" class="paginate_button">Nächste &gt;</a>
<a href="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid&amp;page=2" class="paginate_button">Letzte &gt;&gt;</a></div></div>
<div title="/admin/auctions/viewAnalyseAll?id=1&amp;ajax=myBids-grid" style="display:none" class="keys"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div> */ ?>
</div>
      
        </div>
</div>
