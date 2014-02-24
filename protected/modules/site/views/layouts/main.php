<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="<?php echo Yii::app()->language; ?>" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="<?php echo Yii::app()->language; ?>"> <!--<![endif]-->
    <head>
        <meta charset="<?php echo Yii::app()->charset; ?>" />
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <title><?php echo ( count( $this->pageTitle ) ) ? implode( ' - ', array_reverse( $this->pageTitle ) ) : $this->pageTitle; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/styles.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/form.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/font-awesome.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/validationEngine.jquery.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/chat.css" />
               <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/mainNavigation.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/jquery.fancybox.css" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.session.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/script.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/functions.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap-datepicker.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bjqs-1.3.min.js' ); ?>
        <?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/run.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/chat.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap-filestyle.min.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.fancybox.js' ); ?>
        <?php if(Yii::app()->language=='en'){
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-en.js' );
        } else {
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-de.js' );
        }
        ?>
        <script src="http://static.opentok.com/v1.1/js/TB.min.js" ></script>
        
        <?php
        Yii::app()->clientScript->registerScript('specialSortshop','
        $("body").on("change","#sortDropshop",function(){
                        $.fn.yiiListView.update("item",{data:{sortshop:$(this).val()},type:"POST"})
                });
        ');
    
        ?>
        <script type="text/javascript">
            var my_balance = '<?php echo Utils::number_format(Yii::app()->session['my_balance'])?>';
            <?php if(!Yii::app()->user->isGuest){ ?>
            var lastest_visit = '<?php echo Yii::app()->session['lastest_visit']; ?>';
            <?php } ?>
        </script>
          <script type='text/javascript'>
            $(document).ready(function() {
                $('.carousel').carousel({
                    interval: 4000
                });
                $('.carousel_pause').carousel('pause');
                $('#EmpfeCarousel').carousel('pause')
            });
        </script>
           <script type="text/javascript">
        function goToPage( id ) {
              var node = document.getElementById( id );
              if( node &&
                node.tagName == "SELECT" ) {
                window.location.href = node.options[node.selectedIndex].value;
              } 
               }
               </script>
    </head>
    <body>
        <div id="wrapper" class="container">
        	
                <div id="wrapper-header">
                    <div class="cnt_header">
						<!--<div id="top-info" class="row-fluid show-grid">
						<?php /*$last_news = Blog::model()->findByAttributes(array('language' => Yii::app()->language), array('order' => 'postdate DESC')); */?>
							<div class="span6"><p><strong> <?php /*echo gmdate("d.m.Y H:i:s", $last_news->postdate); */?> >> </strong> <a class="text-top" href="/blog/view/<?php /*echo $last_news->alias*/?>"><?php /*echo $last_news->title; */?></a></p></div>
							<div class="span6"><p class="text-right"><a class="text-top" href="/blog"><strong><?php /*echo Yii::t('global', 'See all Top News') */?></strong></a></p></div>
						</div>--><!--#end top-info-->
						<div class="cnt_top_header">
							<div id="logo-login-bar" class="row-fluid show-grid">
								<div class="span4"><a href="<?php echo Yii::app()->homeUrl; ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/logo.png" alt="Logo" /></a></div>
								<div class="span8 login-span">
                                
                                   <div class="search-area">
                                    <form method="get" action="/search.html">
                                    <div class="shop-select-checker">
                                    <div class="input-group">
                                      <span class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                      </span>
                                      <input id="mbHeadSearchInput" class="form-control" name="q" value ="<?php echo (isset($_GET['condition'])?$_GET['condition']:(isset($_GET['q'])?$_GET['q']:''))?>"type="text" placeholder="<?php echo Yii::t('global', 'Search word')?>" style="width: 182px;">
                                      <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success" id="mbHeadSearchButton"><?php echo Yii::t('global', 'Search')?></button>
                                     </span>
                                    
                                    </div><!-- /input-group ---->
                                    
                                    </div>
                                    </form>           
                                 </div>
                                 <div id="checkConditon" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="title">
                                        <h5 style="text-align: left;"><?php echo Yii::t('global', 'Notice')?>
                                        </h5>
                                    </div>
                                    <div class="modal-body" >
                                        <p class="sms" style="text-align: center; font-size: 12px;">
                                        <?php echo Yii::t('global','You must input keyword')  ?>
                                        </p>
                                    </div>
                                    <div class="modal-footer fix-footer-popup">
                                        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                
                                </div>

								<!--	<img style="position: absolute; padding-top: 11px;" src="<?php //echo Yii::app()->themeManager->baseUrl; ?>/img/signature.png" alt=""/>-->
									<?php $this->renderPartial('/elements/cart');?>
									<?php $this->renderPartial('/elements/login');?>
								</div><!--#end login-span-->
							</div><!--#end logo-login-bar-->
						</div>

						<div id="mainNavigation">
							<?php $this->renderPartial('/elements/menu'); ?>
						</div><!--#end menu-wrapper-->
					</div>
                </div><!--#end wrapper-header-->

                <div id="wrapper-body">
                    <div class="content-container">
                        <div class="content-wrapper">
                             <?php echo $content?>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div><!--#end wrapper-body-->

                <div id="wrapper-footer">
					<div class="cnt-footer" <?php echo ((preg_match("/Anmeldung/i", Yii::app()->request->requestUri))||(preg_match("/register/i", Yii::app()->request->requestUri)))?'style="width: 1000px;"':''?> >
						<?php $this->renderPartial('/elements/footer');?>

					</div>                    
                </div><!--#end wrapper-footer-->
            </div><!--#end wrapper-->
        <div id="messLogout" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="title">
            <h5 ><?php echo Yii::t('global', 'Warning')?>
            </h5>
        </div>
        <div class="modal-body">
            <p class="fix_content_modal">
                <?php echo Yii::t('global',"You're logged out after 10 inactive Minutes on our page!")  ?>
            </p>

        </div>
        <div class="modal-footer fix-footer-popup">
            <button type="button" class=" close close_mess" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

    </div>
    
    
    <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role == 'mod'){
        if (!Yii::app()->session['opened_tokbox']):?>
            <script type="text/javascript">
                window.open("/index/tokbox", "tokbox_window","width=300,height=340,location=no,toolbar=no");
            </script>
        <?php endif; ?>
    <?php } ?>
    
    


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45711100-1', 'tosello.tv');
  ga('send', 'pageview');

</script>
<script>
$('#mbHeadSearchButton').click(function(){
       var condition = $('#mbHeadSearchInput').val().trim();
       if(condition == ''){
            $('#checkConditon').modal('show');
            return false;
       }
       
    });
</script>
    </body>
</html>