<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php echo Yii::app()->charset; ?>" />
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <title><?php echo ( count( $this->pageTitle ) ) ? implode( ' - ', array_reverse( $this->pageTitle ) ) : $this->pageTitle; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
       	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap-responsive.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/font-awesome.css" /> 
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/admin_shop.css" />
         <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/styles.css" />
       <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/stylesheet.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/mCustomScrollbar.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.session.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap-datepicker.js' ); ?>
       	<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/fancybox/jquery.fancybox-1.3.4.pack.js' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine.js' ); ?>
        <?php if(Yii::app()->language=='en'){
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-en.js' );
        } else {
            Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jquery.validationEngine-de.js' );
        }
        ?>
         <?php 
             Yii::app()->clientScript->registerScript('re-install-date-picker', "
            function reinstallDatePicker(id, data) {
                jQuery('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['".(Yii::app()->language=='en'?'':Yii::app()->language)."'], {'dateFormat':'".Yii::app()->locale->getDateFormat('medium_js')."'}));
                jQuery('#datepicker_for_due_date_last').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['".(Yii::app()->language=='en'?'':Yii::app()->language)."'], {'dateFormat':'".Yii::app()->locale->getDateFormat('medium_js')."'}));
            }
            ");
         ?>
         <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap-filestyle.min.js' ); ?>
         <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/jwplayer.js' ); ?>
            <script type="text/javascript">jwplayer.key="YLh0EpQST8/bQUTi3GDUFWxfaIaeKorWSL5ihzmIxDSdoJDoz9fLSJZrt9g=";</script>
    </head>
    
    <script type="text/javascript">
        function goToPage( id ) {
              var node = document.getElementById( id );
              if( node &&
                node.tagName == "SELECT" ) {
                window.location.href = node.options[node.selectedIndex].value;
              } 
               }
               $(document).ready(function() {
                	$(".fancybox").fancybox({
                		openEffect	: 'none',
                		closeEffect	: 'none'
                	});
                });
               </script>
    <body>
    
        <div id="wrapper"> 
            <div class="row-fluid">
                  <?php $this->renderPartial('/elements/header-shop-main-admin'); ?>
                  
                  <?php $this->renderPartial('/elements/navi_manager_shop'); ?>
            </div>
            <div class="row-fluid">
               <div class="content-block">
                     <?php echo $content;?> 
                </div>
            </div>
            </div>
            <div id="wrapper-footer">
					<div class="cnt-footer">
						<?php $this->renderPartial('/elements/footer');?>
					</div>                    
                </div><!--#end wrapper-footer-->
        
    </body>
</html>
