<div class="row-fluid">

    <div class="span4">                    

        <div class="wBlock red clearfix">                        
            <div class="dSpace">
                <h3><?php echo  Yii::t('global', 'Shop');?></h3>
                 <?php 
                $stas_list = '';
                $stas_chart = array();
                $stas_chart[] = MemberShop::model()->getTotalShop();
                ?>  
                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><?php echo implode(',', $stas_chart)?></span>
                <span class="number"> <?php echo MemberShop::model()->getTotalShop(); ?></span>                    
            </div>
            <div class="rSpace">
                 <span> <?php echo MemberShop::model()->getTotalShop(); ?>
                <b><?php echo Yii::t('t', 'Shop')?></b></span>  
            </div>                          
        </div>                     

    </div>                

    <div class="span4">                    

        <div class="wBlock green clearfix">                        
            <div class="dSpace">
               
                <h3><?php echo  Yii::t('global', 'Product');?></h3>
                 <?php 
                $stas_list = '';
                $stas_chart = array();
                $stas_chart[] = Products::model()->getTotalProduct();
                $stas_chart[] = ProductsShop::model()->getTotalProductShop();
                ?>  
                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><?php echo implode(',', $stas_chart)?></span>
                <span class="number"><?php echo number_format(Products::model()->getTotalProduct()+ProductsShop::model()->getTotalProductShop(), 0)?></span>                    
            </div>
            <div class="rSpace">
                <span> <?php echo Products::model()->getTotalProduct(); ?>
                <b><?php echo Yii::t('t', 'Product Tosello')?></b></span>  
                <span> <?php echo ProductsShop::model()->getTotalProductShop(); ?>
                <b><?php echo Yii::t('t', 'Product Shop')?></b></span>  
            </div>                          
        </div>                                                            

    </div>

    <div class="span4">                    

        <div class="wBlock blue clearfix">
            <div class="dSpace">
                <h3><?php echo  Yii::t('global', 'Members');?></h3>
                <?php 
                $stas_list = '';
                $stas_chart = array();
                $stas_chart[] = Yii::app()->counter->getOnline();
                $stas_chart[] = Yii::app()->counter->getTotal();
                ?>  
                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><?php echo implode(',', $stas_chart)?></span>
                <span class="number"><?php echo number_format(Yii::app()->counter->getTotal(), 0)?></span>
            </div>
            <div class="rSpace">          
                <span> <?php echo Yii::app()->counter->getActiveOnline()?>
                <b><?php echo Yii::t('t', 'Users online')?></b></span>  
                
                <span> <?php echo Yii::app()->counter->getTotal()?>
                <b><?php echo Yii::t('t', 'Total Members')?></b></span>  
            </div>
        </div>                      

    </div>                
</div> 


