<!DOCTYPE html>
<html>
    <head>
        <title><?php echo ( count($this->pageTitle) ) ? implode(' - ', array_reverse($this->pageTitle)) : $this->pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/font-awesome.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/style_shop_new.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/favicon.ico" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/styles_shop.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/jquery.fancybox.css" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap.js' ); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/functions_add_to_cart.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.session.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/script.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/functions.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/actions.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap-datepicker.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bjqs-1.3.min.js' ); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/run.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/chat.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.fancybox.js' ); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.cleditor.js' ); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/easy.notification.js' ); ?>
        <?php if(Yii::app()->language=='en'){
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-en.js' );
        } else {
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-de.js' );
        }
        ?>
        <?php
            Yii::app()->clientScript->registerScript('specialSort','
            $("body").on("change","#sortDrop",function(){
                            $.fn.yiiListView.update("item",{data:{sort:$(this).val()},type:"POST"})
                    });
            ');
        ?>
        <script type="text/javascript">
        
        function goToPage( id ) {
              var node = document.getElementById( id );
              if( node &&
                node.tagName == "SELECT" ) {
                window.location.href = node.options[node.selectedIndex].value;
              } 
               }
    function ratings( score, id, type ){
    
        
         if ( type == '' ){type = 0;}
         $.get('/products/saveRating?score='+score+'&id='+id+'&type='+type, function(html) {
            if(html=="false"){        
                $('#myModalRated').modal('show');              
           } else {
                
                $('#myModalRate').modal('show');
           }
            });
                 }
        function shop_ratings( score, id){
             $.get('/shop/ratingShop?score='+score+'&id='+id, function(html) {
                if(html!=""){
                   $('#myModalRate').modal('show');
                } else {
                    $('#myModalRated').modal('show');
                }
            });
        }
          $(document).ready(function() {
                $('#tabs-detail a').click(function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
                $('.carousel').carousel({
                    interval: 4000
                });
                $('#EmpfeCarousel').carousel('pause');
                $('#myModalRate').bind('hide', function() {
                        location.reload(true);
                });
            });
            
        </script>
          <script type="text/javascript">
            var my_balance = '<?php echo Utils::number_format(Yii::app()->session['my_balance'])?>';
            <?php if(!Yii::app()->user->isGuest){ ?>
            var lastest_visit = '<?php echo Yii::app()->session['lastest_visit']; ?>';
            <?php } ?>
        </script>
        <script type="text/javascript">
    $(document).ready(function(){
        $('.img_small a').click(function(){
           var url = $(this).attr('data-id');
            var old_url = $('#large_img').attr('src');
            if(url != old_url){
                $('.img_small a').removeClass('active');
                $('#large_img').fadeOut(300, function(){
                    $(this).attr('src',url).bind('onreadystatechange load', function(){
                        $(this).width( 360 );
                        if (this.complete){
                            $(this).fadeIn(300);
                        }
                    });
                });
                $(this).addClass('active');
            }

        });
    })
</script>
</head>
<body>
	<!-- Begin Wrapper -->
	<div id="wrapper">
		<!-- Begin Inner -->
		<div class="inner">
        
             <?php $this->renderPartial('/elements/header-shop-main'); ?>
			<!-- Begin Header -->
			 <?php $this->renderPartial('/elements/header-shop'); ?>
			<!-- End Header -->
			<!-- Begin Shell -->
			<div class="shell">
				<!-- Begin Main -->
				<div id="main">
					<div class="row-fluid">
                    <div class="span3">
                    <!-- Begin Sidebar -->
					<?php $this->renderPartial('/elements/menu-left-shop'); ?>
					<!-- End Sidebar -->
                    </div>
					<!-- Begin Content -->
					<div class="span9">
                    
                        <?php echo $content;  ?>  
				
					<!-- End Content -->
					
					<!-- Begin Products Slider -->
				    </div>
                    </div>	
					<!-- End Products Slider -->
				<?php $this->renderPartial('/elements/products_slider'); ?>
                <?php $this->renderPartial('/elements/infor_rule_payment_shop'); ?>                                          
			  </div>
                
				<!-- End Main -->
				<!-- Begin Footer -->
    
			     <?php /*<div id="footer">
					<p class="bottom-menu"><a href="/shop/detail/<?php echo $this->membershop->id; ?>" title="<?php echo Yii::t('global','Home'); ?>"><?php echo Yii::t('global','Home'); ?></a><span>|</span><a href="#" title="Support Page">Support</a><span>|</span><a href="#" title="My Account Page">My Account</a><span>|</span><a href="#" title="Store Page">The Store</a><span>|</span><a href="/shop/contact/<?php echo $this->membershop->id; ?>" title="Contact Page">Contact</a></p>
                    <p>© 2013 <a href="http://tosello.toasternet-online.de"> tosello.tv </a> | <?php echo Yii::t('global','All rights reserved'); ?> </a></p>
					<div class="cl">&nbsp;</div>
				</div> */ ?>
				<!-- End Footer -->
			</div>
			<!-- End Shell -->
		</div>
		<!-- End Inner -->
	</div>
         <div id="wrapper-footer">
					<div class="cnt-footer">
						<?php $this->renderPartial('/elements/footer-detail-shop');?>
					</div>                    
                </div>       
	<!-- End Wrapper -->
</body>
</html>