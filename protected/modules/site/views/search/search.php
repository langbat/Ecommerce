<?php
    Yii::app()->clientScript->registerScript('specialSort','
    $("body").on("change","#sortDrop",function(){
    $.fn.yiiListView.update("item",{data:{sort:$(this).val()},type:"POST"})
    $.fn.yiiListView.update("items",{data:{sort:$(this).val()},type:"POST"})
    });
    ');
?>

<div class="pull-left col-left">
	<div id="filter">
		<table>
			<tbody>
				<tr>
					<td style="padding-right: 15px;">
					<table>
						<tbody>
							<tr>
								<td>
								<input type="checkbox" <?php echo isset($_GET['free_shipping'])?'checked':''; echo  $count_shipping_cost==0 ?'disabled="disabled"':''?>  id="option_free_shipping" name="option_$id">
								</td>
								<td style="padding: 10px 0 0 5px;"><label for="option_free_shipping"><?php echo Yii::t('global', 'Shipment free')?>&nbsp; <span id="count_free_shipping">(<?php echo $count_shipping_cost;?>) </span></label></td>
							</tr>
						</tbody>
					</table>
					<script type="text/javascript">
						<?php if($free_shipping!=''){?>
						  $('#count_free_shipping').addClass('hide');
						<?php }?>
						  $('#option_free_shipping').click(function() {
							if ($("#option_free_shipping").attr("checked")) {
								window.location = window.location.href + '&free_shipping=DE';

							} else {
								var href = window.location.href;
								href = href.replace("&free_shipping=DE", "");
								window.location = href;
							}
							//
						})
					</script></td>
					<td style="padding-right: 15px;">
					<table>
						<tbody>
							<tr>
								<td>
								<input type="checkbox" <?php echo isset($_GET['reduced'])?'checked':'';echo  $count_discount_percent==0 ?'disabled="disabled"':'';?> id="option_reduced" name="option_$id">
								</td>
								<td style="padding: 10px 0 0 5px;"><label for="option_reduced"><?php echo Yii::t('global', 'Reduce')?>&nbsp; <span id="count_reduced">(<?php echo $count_discount_percent;?>)</span></label></td>
							</tr>
						</tbody>
					</table>
					<script type="text/javascript">
						<?php if($reduced!=''){?>
						$('#count_reduced').addClass('hide');
						<?php }?>
						$('#option_reduced').click(function() {
							if ($('#option_reduced').attr('checked')) {
								window.location = window.location = window.location.href + '&reduced=true';
							} else {
								var href = window.location.href;
								href = href.replace("&reduced=true", "");
								window.location = href;
							}
						})
					</script></td>
					<td>
					<table>
						<tbody>
							<tr>
								<td>
								<input type="checkbox" <?php echo isset($_GET['in_stock'])?'checked':'';echo  $count_shipping_immediately==0 ?'disabled="disabled"':'';?> id="option_in_stock" name="option_$id">
								</td>
								<td style="padding: 10px 0 0 5px;"><label for="option_in_stock"><?php echo Yii::t('global', 'Delevery soon')?>&nbsp; <span id="count_in_stock">(<?php echo $count_shipping_immediately;?>) </span></label></td>
							</tr>
						</tbody>
					</table>
					<script type="text/javascript">
						<?php if($in_stock!=''){?>
						$('#count_in_stock').addClass('hide');
						<?php }?>
						$('#option_in_stock').click(function() {
							if ($('#option_in_stock').attr('checked')) {
								// console.log(window.location);
								window.location = window.location.href + '&in_stock=true';
							} else {
								var href = window.location.href;
								href = href.replace("&in_stock=true", "");
								window.location = href;
							}

						})
					</script></td>
				</tr>
			</tbody>
		</table>

		<table style="margin-top: 10px;">
			<tbody>
				<tr>
					<td style="padding-right: 7px;"><?php echo Yii::t('global', 'Category')?>:</td>
					<td style="padding-right: 15px;">
					<div class="fillter-category">
						<?php
						  echo CHtml::dropDownList('fillter-category','',$categorys); ?>
						<script type="text/javascript">
							var producer = '&producer=';
							$('#fillter-category').change(function() {
								var hostname = window.location.hostname;
								var pathname = window.location.pathname;
								var search = window.location.search;
								if (search.indexOf("producer=") != -1) {
									search = search.replace(/(producer=)[^\&]+/, '$1' + this.value);
								} else if (search.indexOf("q=") != -1) {
									search = search + "&producer=" + this.value;
								} else {
									search = search + "?producer=" + this.value;
								}
								if (this.value == ' ') {
									search = search.replace(/(&producer=)[^\&]+/, ' ');
								}
								window.location = pathname + search;
							})
						</script>
					</div></td>
					<td style="padding-right: 7px;"><?php echo Yii::t("global","Price")?>:</td>
					<td style="padding-right: 15px;">
					<div class="fillter-category">
						<?php
                            echo CHtml::dropDownList('fillter-price','', array(' '=>Yii::t("global","All Price"))+$list_price);
                        ?>
							<script type="text/javascript">
								var producer = '&price=';
								$('#fillter-price').change(function() {

									var hostname = window.location.hostname;
									var pathname = window.location.pathname;
									var search = window.location.search;

									if (search.indexOf("price=") != -1) {
										search = search.replace(/(price=)[^\&]+/, '$1' + this.value);
									} else if (search.indexOf("q=") != -1) {
										search = search + "&price=" + this.value;
									} else {
										search = search + "?price=" + this.value;
									}
									if (this.value == ' ') {
										search = search.replace(/(&price=)[^\&]+/, '');
									}
									window.location = pathname + search;

								})
							</script>

					</div></td>
					<td style="padding-right: 7px;"><?php echo Yii::t('global', 'Sort following')?>:</td>
					<td>
					<div class="sort-product">
						<?php
						echo CHtml::dropDownList('sort_category','',array(
						'created DESC'=>"",
						'id ASC'=> Yii::t('global' ,'ID(Low->High)'),
						'id DESC'=>Yii::t('global' ,'ID(High->Low)'),
						'price_purchase ASC'=> Yii::t('global' ,'Price(Low->High)'),
						'price_purchase DESC'=>Yii::t('global' ,'Price(High->Low)'),
						'name ASC'=>Yii::t('global' ,'Name(A->Z)'),
						'name DESC'=>Yii::t('global' ,'Name(Z->A)')

						),array('id'=>'sortDrop')); ?>
					</div></td>
				</tr>
			</tbody>
		</table>

	</div>
	<h5 class="left-10"><?php echo Yii::t('global', 'Products Tosello')?></h5>
	<?php
	if(count($product_ids) != 0){?>

	<?php } ?>
	<div class="product-wrapper show-grid">
		<?php 
       // var_dump(count($products->getData()));
        $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$products,
		'itemView'=>'../elements/product-box-search-item',
		'id'=>'item',
		'afterAjaxUpdate' => 'updateRatingSearch',
		));
		?>

		<div class="clearfix"></div>
	</div><!--#end product-wrapper-->
	<h5 class="left-10"><?php echo Yii::t('global', 'Products Shop')?></h5>

	<div class="product-wrapper show-grid">
		<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$productsShop,
		'itemView'=>'../elements/products-box-item',
		'id'=>'items',
		'afterAjaxUpdate' => 'updateRatingSearchShop',
		));
		?>

		<div class="clearfix"></div>
	</div><!--#end product-wrapper-->
</div><!--#end col-left-->

<div class="pull-left col-right">
	<?php if(Yii::app()->user->isGuest){ ?>
	<?php $this->renderPartial('/elements/tested-safety');?>
	<?php $this->renderPartial('/elements/news-box');?>
	<?php }else{ ?>
	<div class="right-box">
		<?php $this->renderPartial('/elements/profile-menu')?>
	</div>
	<?php $this->renderPartial('/elements/tested-safety');?>
	<?php $this->renderPartial('/elements/news-box');?>
	<?php } ?>
</div><!--#end col-right-->
<script>
    $("#fillter-category option[value=<?php echo isset($_GET['producer'])?$_GET['producer']:''?>]").attr("selected","selected");
    $("#fillter-price option[value=<?php echo isset($_GET['price'])?$_GET['price']:''?>]").attr("selected","selected");

	function updateRatingSearch() {
	countdown();
	<?php
	foreach ( $product_ids as $result ){ ?>
	jQuery("#my_rating_field_label_product_tosello_"+<?php echo $result; ?>+"-raty").raty({"half":true,"click":function(score, evt){ ratings(score,<?php echo $result; ?>,1) },"score":<?php Ratings::model()->getRating( $result, 1, 1 ); ?>,"target":"#my_rating_field_label_product_tosello_"+<?php echo $result; ?>+""});jQuery("#my_rating_field_label_product_tosello_"+<?php echo $result; ?>+"").hide();
	<?php }?>
	$('#myModalRate').bind('hide', function() {
	location.reload(true);
	});
	$('#myModalRated').bind('hide', function() {
	location.reload(true);
	});

	}
	function updateRatingSearchShop() {
	countdown();
	<?php
	foreach ( $productshop_ids as $result ){ ?>
	jQuery("#my_rating_field_label_product_shop_"+<?php echo $result; ?>+"-raty").raty({"half":true,"click":function(score, evt){ ratings(score,<?php echo $result; ?>,0) },"score":<?php Ratings::model()->getRating( $result, 0, 1 ); ?>,"target":"#my_rating_field_label_product_shop_"+<?php echo $result; ?>+""});jQuery("#my_rating_field_label_product_shop_"+<?php echo $result; ?>+"").hide();
	<?php }?>
	$('#myModalRate').bind('hide', function() {
	location.reload(true);
	});
	$('#myModalRated').bind('hide', function() {
	location.reload(true);
	});
	}
	function countdown(){
	var nextDay  = new Date();
	var target_date = new Date();
	nextDay.setHours(24);
	nextDay.setMinutes(0);
	nextDay.setSeconds(0);
	//nextDay = new Date(example);
	target_date.setDate(target_date.getDate() + 1);
	target_date.setTime(nextDay.getTime())

	 
	// variables for time units
	var days, hours, minutes, seconds;
	 
	// get tag element
	var countdown = document.getElementById("countdown");
	 
	// update the tag with id "countdown" every 1 second
	setInterval(function () {
	 
	    // find the amount of "seconds" between now and target
	    var current_date = new Date().getTime();
	    var seconds_left = (target_date - current_date) / 1000;
	 
	    // do some time calculations
	    days = parseInt(seconds_left / 86400);
	    seconds_left = seconds_left % 86400;
	     
	    hours = parseInt(seconds_left / 3600);
	    seconds_left = seconds_left % 3600;
	     
	    minutes = parseInt(seconds_left / 60);
	    seconds = parseInt(seconds_left % 60);
	     
	    // format countdown string + set tag value
	    countdown.innerHTML = "<?php echo Yii::t("global","Today you've already rated. please try to rate again in next day!"); ?></br> </br><b>"+days + "</b> <?php echo Yii::t('global','Day'); ?> : " + "<b>"+hours + "</b> <?php echo Yii::t('global','Hours'); ?>  : "
	    +"<b>"+ minutes + "</b> <?php echo Yii::t('global','Minutes'); ?>  : " +"<b>"+ seconds + "</b> <?php echo Yii::t('global','Seconds'); ?> ";  
	 
	}, 1000);
	}</script>
