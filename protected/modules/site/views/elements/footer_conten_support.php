<div class="row-fluid row_conten_sup" >
	<ul class="folow">
		<li style="margin: 0;">
			<a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo
			Yii::app()->request->serverName ?>','facewindow2','width=800,height=400');return false;" href=""><i class="fa fa-facebook-square fa-2x"></i><?php echo
			Yii::t('support-page', 'TS on Facebook') ?></a>
		</li>
		<li>
			<a onclick="window.open('http://twitter.com/share?url=http://<?php echo
			Yii::app()->request->serverName ?>','twwindow2','width=800,height=400');return false;" href=""><i class="fa fa-twitter-square fa-2x" style="color: #06C1FC;"></i><?php echo
			Yii::t('support-page', 'TS on Twitter') ?></a>
		</li>
		<li>
			<a href="http://www.youtube.com"><i class="fa fa-youtube fa-2x" style="color: #C90101;"></i><?php echo
			Yii::t('support-page', 'TS on Youtube') ?> </a>
		</li>
		<li>
			<a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo
			Yii::app()->request->serverName ?>','facewindow3','width=800,height=400');return false;" href=""><i class="fa fa-facebook-square fa-2x"></i><?php echo
			Yii::t('support-page', 'TS More on Facbook') ?></a>
		</li>
		<li>
			<a onclick="window.open('http://twitter.com/share?url=http://<?php echo
			Yii::app()->request->serverName ?>','twwindow3','width=800,height=400');return false;" href=""><i class="fa fa-twitter-square fa-2x"  style="color: #06C1FC;"></i><?php echo
			Yii::t('support-page', 'TS More on Twitter') ?></a>
		</li>
	</ul>
</div>
<div class="row-fluid row_conten_sup" >
	<ul class="folow">
		<li style="margin-left: 210px;">
			<a href=""><i class="fa fa-lock fa-2x"></i><?php echo Yii::t('support-page',
			'Datenfreigabe') ?></a>
		</li>
		<li class="fa-color">

			<g:plusone></g:plusone>
			<script type="text/javascript">
				(function() {
					var po = document.createElement('script');
					po.type = 'text/javascript';
					po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(po, s);
				})();
			</script>
			<!--<i class="fa fa-adjust fa-2x"></i><a onclick="window.open('https://plus.google.com/share?url=http://<?php echo
			Yii::app()->request->serverName ?>','twwindow4','width=800,height=400');return false;" href=""class="btn" ><i class="fa fa-google-plus fa-2x" ></i>1</a>-->
		</li>

		<li class="fa-color">
			<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"><?php echo
			Yii::t('global', 'Tweet') ?> </a>
			<script>
				! function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (!d.getElementById(id)) {
						js = d.createElement(s);
						js.id = id;
						js.src = "https://platform.twitter.com/widgets.js";
						fjs.parentNode.insertBefore(js, fjs);
					}
				}(document, "script", "twitter-wjs");
			</script>
			<!--	<i class="fa fa-adjust fa-2x"></i><a onclick="window.open('http://twitter.com/share?url=http://<?php echo
			Yii::app()->request->serverName ?>','twwindow4','width=800,height=400');return false;" href="" class="btn" ><i class="fa fa-twitter fa-2x" ></i><?php echo
			Yii::t('support-page', 'Tweet') ?></a>-->
		</li>
		<!--	<li class="fa-color">
		<i class="fa fa-adjust fa-2x"></i><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo
		Yii::app()->request->serverName ?>','facewindow5','width=800,height=400');return false;" href="" class="btn" ><i class="fa fa-facebook-square fa-2x" ></i><?php echo
		Yii::t('support-page', 'Like') ?></a>

		</li>-->
		<li class="fa-color">
			<div id="fb-root"></div>
			<script>
				( function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id))
							return;
						js = d.createElement(s);
						js.id = id;
						js.src = "//connect.facebook.net/<?php echo (Yii::app()->language=='de')?'de_DE':'en_US' ?>/all.js#xfbml=1";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));

			</script>

			<div class="fb-like" data-href="http://<?php echo Yii::app()->request->
			serverName ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" ></div>
		</li>
	</ul>
</div>

<div class="row-fluid navi-footer row_conten_sup" >

	<?php Widgets::showCustomSupport('informationsupport'); ?>
	<!--
	<ul class="folow">
	<li style="margin: 0; list-style-type: none;">
	<a href="">Impressum</a>
	</li>
	<li>
	<a href="">AGB & Widerruf</a>
	</li>
	<li>
	<a href="">Daten & Jugendschutz</a>
	</li>
	<li>
	<a href="">Werbepartner</a>
	</li>
	<li>
	<a href="">Ober Tosello.TV</a>
	</li>
	<li>
	<a href="">Karriere</a>
	</li>
	<li>
	<a href="">Ober Tosello.TVBlog</a>
	</li>
	</ul>
	-->
</div>
<a href=""><img src="/themes/default/img/logo-small.png"/></a>
