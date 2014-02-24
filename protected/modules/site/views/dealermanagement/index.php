<style>
	.head-style2 {
		background-color: #8298B7;
	}
	.head-edge-style2 {
		border-color: transparent #e26601 transparent transparent;
		float: left;
	}
	.head-edge {
		width: 0px;
		height: 0px;
		border-style: solid;
		border-width: 0 14px 13px 0;
		border-color: transparent #677486 transparent transparent;
	}
	.why-manybuy {
		background-color: #ffffff;
		border: 1px solid #ACABAB;
		margin-left: 13px;
        height: 230px;
        background-color: #f7f7f7;
        padding-top: 10px;padding-left: 10px;
	}
	.blog {
		width: 258px;
		margin-bottom: 30px;
		margin-left: 10px;
	}
	.head-text p {
		padding-top: 5px;
		text-align: center;
		color: #ffffff;
	}
    .why-manybuy span {
		color: #363d45;
	}
     .why-manybuy a {
		display: block;
        text-decoration: none;
        height: 30px;
        width: 90%;
        background-color: #025c25;
        text-align: center;
        padding-top: 10px;
        margin: 110px auto;
        color: #ffffff;
        border-radius: 10px;
	}
    
	.head-text {
		height: 30px;
	}
</style>

<div class="content-wrapper">
	<div class="pull-left col-left">
		<div class="wrapper_profile">
			<div >
				<div class="span3 blog" style="margin-left: 0px;">
					<div class="head-text head-style2">
						<p>
						<?php echo Yii::t('global', 'Messages')?>
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
					<span><?php echo Yii::t('global', 'You have 9 new messages')?></span>
                    
					</div>

				</div>
				<div class="span3 blog">

					<div class="head-text head-style2">
						<p>
							<?php echo Yii::t('global', 'Add live sale show')?>
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
					<span><?php echo Yii::t('global', 'The direkt line to your customer. Purchasing it easiest ever! Add Live sale channel now with only some clicks')?></span><br />	
					<a href=""><?php echo Yii::t('global','Add live sale show')?></a>
                    </div>

				</div>
				<div class="span3 blog" >

					<div class="head-text head-style2">
						<p>
						<?php echo Yii::t('global', 'Book advertising place')?>	
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
							<span><?php echo Yii::t('global', 'Increase your revenue easy through booking attractive advertisment place tosello.tv')?></span>	
					</div>

				</div>
			</div>

			<div >
				<div class="span3 blog" style="margin-left: 0px;">
					<div class="head-text head-style2">
						<p>
							<?php echo Yii::t('global', 'Orders')?>		
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
						<span><?php echo Yii::t('global', '	Since your last logging in, O orders in your shop is made')?></span>	
				
					</div>

				</div>
				<div class="span3 blog" >

					<div class="head-text head-style2">
						<p>
						<?php echo Yii::t('global', 'Rating')?>	
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
					<span><?php echo Yii::t('global', 'Since your last login o times rating is given')?></span>
					</div>

				</div>
				<div class="span3 blog" >

					<div class="head-text head-style2">
						<p>
							<?php echo Yii::t('global', 'Customer')?>
						</p>
					</div>
					<div class="head-edge head-edge-style2"></div>
					<div class="why-manybuy">
						<span><?php echo Yii::t('global', '	Increase your revenue easy through booking attractive advertisment place tosello.tv')?></span>	
					</div>

				</div>
			</div>
		</div>

	</div><!--#end col-left-->

	<div class="pull-left col-right">
		<?php if(Yii::app()->user->isGuest){ ?>
		<?php $this -> renderPartial('/elements/right-ads'); ?>
		<?php //$this->renderPartial('/elements/auction-finished'); ?>
		<?php $this -> renderPartial('/elements/tested-safety'); ?>
		<?php $this -> renderPartial('/elements/news-box'); ?>
		<?php }else{ ?>
		<div class="right-box">
			<?php $this->renderPartial('/elements/profile-menu')?>
		</div>
		<?php //$this->renderPartial('/elements/right-ads'); ?>
		<?php //$this->renderPartial('/elements/auction-finished'); ?>
		<?php //$this->renderPartial('/elements/tested-safety'); ?>
		<?php //$this->renderPartial('/elements/news-box'); ?>
		<?php } ?>
	</div><!--#end col-right-->

	<div class="clearfix"></div>
</div>

