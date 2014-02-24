<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'live-sale-form',
	'enableAjaxValidation'=>false,
     'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
));
error_reporting(0);
$NameShops = MemberShop::model()->getNameShopById( isset($model->shop_id)?$model->shop_id:0 );
foreach ( $NameShops as $NameShop ){
    $ShopArray[$NameShop['id']] = $NameShop['name'];
}
 ?>

	<?php echo $form->errorSummary($model); ?>
    
    <div id="myModal12" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'List Product')?></h5>
    </div> 
    <div class="modal-input-filter">
       <span class="title-filter"> <span  class="title-filter"><?php echo Yii::t('global','Search'); ?> : </span><span class="modal-search"> <input name="getnameproduct" id="inputsearch" class="input-search-new"/> </span>
   
       <span class="result-search"></span>
    </div>
    <div class="modal-body fix-new-scrollBox"> 
      <div id="list-product-on-shop">
       <ul id="ul-list-product">
             <?php
                 $Products = ProductsShop::model()->getProductsShopByNotExitst( isset($model->shop_id)?$model->shop_id:0, isset($model->list_product_id)?$model->list_product_id:0 );
                 foreach( $Products as $Product ){
                    echo '<li data-label="'.Utils::seoUrl(($Product['name'])).'"><input class="skip" type="checkbox" name="list_product_check" id="check_product" value="'.$Product['id'].'--'.$Product['price'].'--'.$Product['image'].'--'.$Product['name'].'"> '.$Product['name'].'</li>';
                 }   
             ?>
        </ul>
        </div>
    </div>
    <div class="modal-footer">
        <div class="btn btn-primary" id="choice-product-new"><?php echo Yii::t('global','Add'); ?></div> <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t('global','Cancel'); ?></button>
    </div>
</div>
    
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shop_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList( $model, 'shop_id', $ShopArray ); ?>
            <?php echo $form->error($model,'shop_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'start'); ?>
        </div>
		<div class="span9">
              <?php 
                    $model->start = Utils::date_format24h($model->start, 1);
                    $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,
                    'attribute'=>'start',
                    'mode'=>'datetime',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => false),
                    'language' => Yii::app()->language=='en'?'':Yii::app()->language
                )); 
              ?>
            <?php echo $form->error($model,'start'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'end'); ?>
        </div>
		<div class="span9">
             <?php 
                    $model->end = Utils::date_format24h($model->end, 1);
                    $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,
                    'attribute'=>'end',
                    'mode'=>'datetime',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => false),
                    'language' => Yii::app()->language=='en'?'':Yii::app()->language
                )); 
              ?>
            <?php echo $form->error($model,'end'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'list_product_id'); ?>
        </div>
		<div class="span9">
            <div id="users-contain" class="ui-widget">
                <h5><?php echo Yii::t('global','Existing Products'); ?> :</h5>
                 
                
                <table id="users" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width='30px'><?php echo Yii::t('global','Option'); ?></th>
                    <th width='50%'><?php echo Yii::t('global','Name'); ?></th>
                    <th width='70px'><?php echo Yii::t('global','Price'); ?></th>
                    <th width='150px'><?php echo Yii::t('global','Image'); ?></th>
                </tr>
                </thead>
                <tbody id="content-product-add">
                       <?php 
                        if(isset($model->list_product_id)){
                             $productexists = ProductsShop::model()->getProductsShopExists( isset($model->shop_id)?$model->shop_id:0, isset($model->list_product_id)?$model->list_product_id:0 );
                             foreach( $productexists as $Productexist ){ ?>
                             <tr><td colspan=4 height=3px></td></tr><tr><td width='86px'><input type="checkbox" value ='<?php echo $Productexist['id']; ?>' name="dg[]" id="dg" checked='checked'/></td>
                            <td width='386px'><a href='/admin/productsShop/view?id=<?php echo $Productexist['id']; ?>'> <?php echo $Productexist['name']; ?> </a></td>
                            <td width='100px'><?php echo $Productexist['price']; ?> €</td>
                            <td width='150px'><a rel='group' href='/uploads/product_shop/<?php echo $Productexist['image']; ?>' class='fancybox'><img src='/uploads/product_shop/<?php echo $Productexist['image']; ?>' height=75px width=75px></a></td>
                            </tr><tr><td colspan=4 height=3px></td></tr>   
                     <?php            
                                }
                            }
                     
                     ?>
                </tbody>
                </table>
            </div>
            <div style="margin: 15px 0 0 10px;"></div>
            <div id="choice-product" class="btn"><?php echo Yii::t('global','Add Product'); ?></div>
            <?php echo $form->error($model,'list_product_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'media'); ?>
        </div>
		<div class="span9 fix_video">
             <div class="options_video">
                <select name="options_video" class="select_video">
                    <option value="link"><?php echo Yii::t('global','Choose video from website ') ?></option>
                    <option value="upload"><?php echo Yii::t('global','Upload from your computer') ?></option>
                </select>
                <div class="text_link_video">
                    <?php echo $form->textField($model,'media', array('title'=>Yii::t('global','Please type url video'),'class'=>'video_from_url')); ?>
                    <?php echo $form->error($model,'media'); ?>
                </div>
                <div class="file_upload_video">
                    <?php echo $form->fileField($model,'media2',array('class'=>'fix_input_upload')); ?>
                </div>

            </div>
            <?php echo $form->error($model,'media'); ?>
            <?php if ($model->media):?>
                <?php echo Products::getVideo($model->media); ?>
            <?php endif;?>
                                    
        </div>
	</div>
    <script>
           $('.select_video').change(function(){
                    var type = $('.select_video').val();
                    if(type == 'link'){
                        $('.file_upload_video').css('display','none');
                        $('.text_link_video').css('display','block');
                    } else {
                        $('.fix_input_upload').parent().css('display','block');
                        $('.text_link_video').css('display','none');
                        $('.file_upload_video').css('display','block');
                    }
           });
           $('#choice-product').click(function(){
                $('#myModal12').modal('show');
                $('#myModal12').html();
           });
           
           	$('#inputsearch').on( "keyup", function() {
            var input = makeSlug($(this).val().toLowerCase());
        			$("#list-product-on-shop ul li").show();
        			$("#list-product-on-shop ul li").not("[data-label*="+ input +"]").hide();
        		var matched = $("#list-product-on-shop ul li[data-label*="+ input +"]").length;
        		if(input.length > 0){
        			$('.result-search').show();
        			$('.result-search').html('<?php echo Yii::t('global','Searched for'); ?> "' + $(this).val() + '" (' + matched + ' <?php echo Yii::t('global','Matched'); ?>)');
        	} else {
        			$("#list-product-on-shop ul li").show();
                    $('.result-search').hide();
                    }
            });
           
           $("#choice-product-new").click(function() {
                $("input[type=checkbox]:checked").each(function() {
                     var valproduct = $(this).val().split('--');  
                     if( typeof(valproduct[2]) !== 'undefined' ){
                            $( "#content-product-add" ).append( "<tr><td colspan=4 height=3px></td></tr><tr>" +
                            "<td width='103px'><input type=checkbox value ='" + valproduct[0] + "' name='dg[]' id='dg' checked='checked'></td>" +
                            "<td width='390px'><a href='/admin/productsShop/view?id=" + valproduct[0] + "'>" + valproduct[3] + "</a></td>" +
                            "<td width='118px'>" + valproduct[1] + "€</td>" +
                            "<td width='150px'><a rel='group' href='/uploads/product_shop/" + valproduct[2] + "' class='fancybox'><img src='/uploads/product_shop/" + valproduct[2] + "' height=75px width=75px></a></td>" +
                            "</tr><tr><td colspan=4 height=3px></td></tr>" );
                    }   
                });
                $("#check_product:checked").before("<img src=/themes/admin/default/img/checked-boxes.png class='new_input_form'>");     
                $("#check_product:checked").remove(); 
                $("#watchers:disabled").removeAttr( "disabled" ); 
                $("input:checked", this).removeAttr( "checked" );
               $('#myModal12').modal('hide');
               $('#myModal12').html(); 
           });
           
           function makeSlug(urlString, filter) {
                // Changes, e.g., "Petty theft" to "petty_theft".
                // Remove all these words from the string before URLifying
            
                if(filter) {
                    removelist = ["a", "an", "as", "at", "before", "but", "by", "for", "from",
                    "is", "in", "into", "like", "of", "off", "on", "onto", "per",
                    "since", "than", "the", "this", "that", "to", "up", "via", "het", "de", "een", "en",
                    "with"];
                }
                else {
                    removelist = [];
                }
                s = urlString;
                r = new RegExp('\\b(' + removelist.join('|') + ')\\b', 'gi');
                s = s.replace(r, '');
                s = s.replace(/[^-\w\s]/g, ''); // Remove unneeded characters
                s = s.replace(/^\s+|\s+$/g, ''); // Trim leading/trailing spaces
                s = s.replace(/[-\s]+/g, '-'); // Convert spaces to hyphens
                s = s.toLowerCase(); // Convert to lowercase
                return s; // Trim to first num_chars characters
        }
           
    </script>
	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->