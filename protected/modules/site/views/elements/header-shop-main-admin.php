<div id="wrapper-header">
    <div class="cnt_top_header">
	   <div class="row-fluid show-grid" id="logo-login-bar">
            <div class="span3"><a href="<?php echo Yii::app()->homeUrl;?>"><img alt="Logo" src="/themes/default/img/logo.png"></a></div>
            <div class="span3">
               
            </div>
    		<div class="span6 login-span">
                
    			
                <?php $this->renderPartial('/elements/cart');?>
    			<?php $this->renderPartial('/elements/login');?>
    	   </div> 
	   </div>
    </div>     
</div>