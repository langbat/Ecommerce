<div id="header">
				<div class="header-inner">
					<!-- Begin Shell -->
					<div class="shell">
						<h1 id="logo"><a class="notext" href="/shop/detail/<?php echo $this->membershop->id; ?>"> <?php echo $this->membershop->name; ?></h1>
						<?php /* <div id="account">
							<a class="view-account" title="View Account" href="#">Your Shopping Cart</a>
							<span><?php echo Yii::t('global','Product'); ?> : 0</span><span><?php echo Yii::t('global','Price'); ?> : <strong>0.00 €</strong></span>
							<div class="cl">&nbsp;</div>
						</div> */ ?>
						<!-- Begin Navigation -->
						<div id="navigation">
							<ul>
								<li><a href="/shop/detail/<?php echo $this->membershop->id; ?>" <?php echo (Yii::app()->request->requestUri=='/shop/detail/'.$this->membershop->id)?'class="active"':''?> title="<?php echo Yii::t('global','Home'); ?>"><span><?php echo Yii::t('global','Home'); ?></span></a></li>
                                <li><a href="/blogshop/detail/<?php echo $this->membershop->id; ?>" <?php echo (Yii::app()->request->requestUri=='/blogshop/detail/'.$this->membershop->id)?'class="active"':''?> title="<?php echo Yii::t('global','Blog'); ?>"><span><?php echo Yii::t('global','Blog'); ?></span></a></li>
                                <li><a href="/shopNewsletter/join/<?php echo $this->membershop->id; ?>" <?php echo (Yii::app()->request->requestUri=='/shopNewsletter/join/'.$this->membershop->id)?'class="active"':''?>title="<?php echo Yii::t('global','Newsletter'); ?>"><span><?php echo Yii::t('global','Newsletter'); ?></span></a></li>
                                <?php if(Yii::app()->user->id !== $this->membershop->user_id){?>
								<li><a href="/shop/messagesShop?shop_id=<?php echo $this->membershop->id; ?>" <?php echo (Yii::app()->request->requestUri=='/shop/messagesShop?shop_id='.$this->membershop->id)?'class="active"':''?> title="<?php echo Yii::t('global','Messages To Shop Page'); ?>"><span><?php echo Yii::t('global','Messages To Shop'); ?></span></a></li>
								<?php }?>
                                <?php if(Yii::app()->user->id == $this->membershop->user_id){?>
								<li><a href="/shopManager/detail"  title="<?php echo Yii::t('global','Dealer Manager'); ?>"><span><?php echo Yii::t('global','Dealer Manager'); ?></span></a></li>
								<?php }?>
                                <?php /*<li><a href="#" alt="<?php echo Yii::t('global','My Account Page'); ?> "><span><?php echo Yii::t('global','My Account'); ?></span></a></li>
								<li><a href="#" alt="<?php echo Yii::t('global','Store Page'); ?>"><span><?php echo Yii::t('global','The Store'); ?></span></a></li> */ ?>
								<li><a href="/shop/contact/<?php echo $this->membershop->id; ?>" <?php echo (Yii::app()->request->requestUri=='/shop/contact/'.$this->membershop->id)?'class="active"':''?> title="<?php echo Yii::t('global','Contact Page'); ?>"><span><?php echo Yii::t('global','Contact'); ?></span></a></li>
                                
							</ul>
                            
							<div class="cl">&nbsp;</div>
						</div>
						<!-- End Navigation -->
                       <!-- <div ><a href="/shop/messagesShop?id=<?php echo $this->membershop->id; ?>" style="margin-top: 10px;" class="btn" alt="<?php //echo Yii::t('global','Send message to ').$this->membershop->name;?>"><i class="fa fa-envelope"></i></a></div>-->
						<div class="cl">&nbsp;</div>
					</div>
					<!-- End Shell -->
				</div>
			</div>
          