
<div class="service-wrapper">

    <!--<div class="service-box span2">
        <?php /*Widgets::show('onecentdeal'); */?>
    </div>

    <div class="service-box span2">
        <?php /*Widgets::show('low-price-auction'); */?>
    </div>-->
    <!--<div class="service-box span2">
        <?php /*Widgets::show('basic-auction'); */?>
    </div>-->
    <div class="service-box span2">
        <?php Widgets::show('information'); ?>
    </div>
    <div class="copyright-box span4">
        <span><?php echo'&copy; 2013 tosello.tv | '.Yii::t('global','All rights reserved') ?></span>
        <a href="<?php echo Yii::app()->homeUrl?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/logo-small.png" alt="Logo" /></a>
    </div>
    <div class="clearfix"></div>
    <!--<div class="line"></div>
    
        <?php
/*        $cats = array();
        Categories::getTree($cats);
        foreach ($cats as $cat_main_id => $cat_main){*/?>
        <div class="service-box span3">
            <p><strong><?php /*echo $cat_main['name']*/?></strong></p>
            <ul>
                <?php /*foreach ($cat_main['childs'] as $cat_child_id => $cat_child){
                    echo '<li><a href="/auctions/category/'.$cat_child['alias'].'">'.$cat_child['name'].'</a></li>';    
                }
                */?>
            </ul>
        </div>
        --><?php //} ?>
        
    
    
    <div class="clearfix"></div>
</div><!--#end service-wrapper-->