<!DOCTYPE html>
<html>
	<head>
		<title><?php echo ( count($this->pageTitle) ) ? implode(' - ', array_reverse($this->pageTitle)) : $this->pageTitle; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/favicon.ico" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/support.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/chat.css" />

		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/chat.js' ); ?>
		<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/bootstrap.js' ); ?>

		<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> -->
		<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/fancybox/jquery.fancybox-1.3.4.pack.js' ); ?>
		<?php //Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/fancybox/video.js' ); ?>

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
		<?php
		Yii::app()->clientScript->registerScript('fancybox-again','
		$(".video").click(function() {
		var root = location.protocol + "//" + location.host;
		$.fancybox({
		padding		: 0,
		autoScale		: false,
		transitionIn	: none,
		transitionOut	: none,
		title			: this.title,
		width			: 640,
		height		    : 385,
		href			: ytVidId(this.href)?this.href.replace(new RegExp("watch\\?v=", "i"), "v/"):"http://dev.flosky.org/jwplayer/jwplayer.swf?file="+root+"/uploads/video/"+this.title+"&autostart=true",
		type			: swf,
		swf			: {
		wmode				: transparent,
		allowfullscreen	: true
		}
		});

		return false;
		});
		');

		?>
	</head>
	<script>
		$(document).ready(function() {
			$('#tabs-detail a').click(function(e) {
				e.preventDefault();
				$(this).tab('show');
			});
			$('.carousel').carousel({
				interval : 4000
			});
			$('#EmpfeCarousel').carousel('pause');
			$('#myModalRate').bind('hide', function() {
				location.reload(true);
			});
			function ytVidId(url) {
				var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
				return (url.match(p)) ? true : false;
			}

			/*Fancybox video*/
			$(".video").click(function() {
				var root = location.protocol + '//' + location.host;
				$.fancybox({
					'padding' : 0,
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
				//	'title' : this.title,
					'width' : 640,
					'height' : 385,
					'href' : ytVidId(this.href) ? this.href.replace(new RegExp("watch\\?v=", "i"), 'v/') : 'http://dev.flosky.org/jwplayer/jwplayer.swf?file=' + root + '/uploads/video/' + this.title + '&autostart=true',
					'type' : 'swf',
					'swf' : {
						'wmode' : 'transparent',
						'allowfullscreen' : 'true'
					}
				});

				return false;

			});

			$("a#fancyBoxLink").fancybox({

				'titleShow' : false,
				'width' : 620,
				'height' : 430,
				'transitionIn' : 'elastic',
				'transitionOut' : 'elastic'
			});
			$("a#fancyBoxLink2").fancybox({

				'titleShow' : false,
				'width' : 620,
				'height' : 430,
				'transitionIn' : 'elastic',
				'transitionOut' : 'elastic'
			});

		});

	</script>

	<?php $productdetail = Products::model()->findByPk( Products::GetIdVideoLastest() );?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.support-chat-box').click(function() {
				var moderator = '<?php echo $productdetail->user->username; ?>';
				chatWith(moderator, '');
				//  alert(moderator);
				return false;
			});

		});
	</script>

	<body>
		<?php $this->renderPartial('/elements/header-shop-main-admin');?>
		<div id="wrapper">
			<?php $this->renderPartial('/elements/slide_bar'); ?>
			<div class="row-fluid" id="body_sup">
				<div class="content-block" id="header_sup">
					<?php $this->renderPartial('/elements/header-support'); ?>
				</div>
				<div id="contain-sup" class="content-block">
					<div id="conten-sup">
						<?php echo $content?>
						<?php $this->renderPartial('/elements/footer_conten_support'); ?>
					</div>

				</div>

			</div>
			<div id="footer_sup_contain">
				<?php $this->renderPartial('/elements/footer-support'); ?>
			</div>
			<div id="wrapper-footer">
				<div class="cnt-footer">
					<?php $this->renderPartial('/elements/footer'); ?>
				</div>
			</div>
			<script type="text/javascript">
				//*********************************************
				// *  draw image from use javascript an camvas *
				//*********************************************

				function draw(video, thecanvas, img) {
					// get the canvas context for drawing
					var context = thecanvas.getContext('2d');

					// draw the video contents into the canvas x, y, width, height
					context.drawImage(video, 0, 0, thecanvas.width, thecanvas.height);

					// get the image data from the canvas object
					var dataURL = thecanvas.toDataURL();

					// set the source of the img tag
					img.setAttribute("src", dataURL);
				}

				//*************************************************
				//* END: draw image from use javascript an camvas *
				//*************************************************

			</script>
	</body>
</html>