<div class="content-wrapper">
        <div class="pull-left col-left">
            <div class="wrapper_profile">            
                <div class="slider-box purple-grid fix-boder">
                    <div class="notice-register"> <?php echo $message; ?></div>
                    <div class="clearfix"></div>
                </div>                    
            </div>
        </div><!--#end col-left-->

    <div class="pull-left col-right">
        <?php $this->renderPartial('/elements/right-ads');?>
        <?php //$this->renderPartial('/elements/auction-finished');?>
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>

    </div><!--#end col-right-->

        <div class="clearfix"></div>                        
</div>