<div class="logo_support">
						<h1><a href="<?php echo Yii::app()->homeUrl ?>"><img src="/themes/default/img/logo_tosello.png" alt=""/></a><?php echo Yii::t('globale','We show how it work')?></h1>
					</div>
					<div id="navi_sup">
						<ul>
							<li class="<?php echo (Yii::app()->controller->id)==='support'&&((Yii::app()->controller->getRoute())!=='site/support/blogdetail'&&(Yii::app()->controller->getRoute())!=='site/support/blogvideo')?'active':'button_navi'?>">
								<a href="<?php echo Yii::app()->homeUrl?>support"><?php echo Yii::t('global','Welcome')?></a>
							</li>
							<li class="<?php echo (Yii::app()->controller->getRoute())==='site/support/blogdetail'||(Yii::app()->controller->getRoute())==='site/support/blogvideo'?'active':'button_navi'?>">
								<a href="#conten-fancybox2" id="fancyBoxLink2" ><?php echo Yii::t('global','Did you know?')?></a>
							</li>
							<li class="<?php echo (Yii::app()->controller->id)==='questions'?'active':'button_navi'?>">
								<a href="<?php echo Yii::app()->homeUrl?>questions"><?php echo Yii::t('global','TS-Experts genial');?></a>
							</li>
						</ul>
                    </div>
                         <div style="display:none">
		          	<div id="conten-fancybox2">
                    <h4><?php echo Yii::t('support-page','Instruction in Blog "Von Euch fuer Euch"') ?></h4>
			     	
			     	<p>
				        <?php echo Yii::t('support-page','Tell about the newest things, product infor. and gain much from understanding our customer')?> 
			     	</p>
			     	
				
				<a href="/support/blogvideo"><i class="fa fa-angle-double-right"></i><?php echo Yii::t('globle','Go to blog') ?></a>

			</div>
		</div>