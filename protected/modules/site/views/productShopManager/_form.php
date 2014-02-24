<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.js' ); error_reporting(0); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.gears.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.silverlight.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.flash.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.browserplus.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.html5.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js' ); ?>
<?php Yii::app()->clientScript->registerCssFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/select2/select2.min.js' ); ?>
<?php Yii::app()->clientScript->registerCssFile( Yii::app()->themeManager->baseUrl . '/css/select2.css' ); ?>


<style>
textarea.validate\[required\]{
    width:780px;
}
</style>
<div class="block-fluid create_shop">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-shop-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
));
$NameShops = MemberShop::model()->getMemberShopByIdMember(Yii::app()->user->id);

//foreach ( $NameShops as $NameShop ){
    $ShopArray[$NameShops['id']] = $NameShops['name'];
//}
 ?>
   <?php $this->widget('widgets.admin.notifications'); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'name'); ?>
          
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
       	<div class="span2">
            <?php echo $form->labelEx($model,'category_id'); ?>
        </div>
		<div class="span4" >
            <select name="ProductsShopCategory[]" id="s2_2" style="width: 100%;" multiple="multiple" class="validate[required]">
                
                
                <?php 
                $cats = array(); CategoriesShop::getTree($cats);
                
                $selected = $model->getCategoriesShopId();              
                foreach ($cats as $cat_id=>$cat){
                    echo '<optgroup  label="'.$cat['name'].'">';
                    if ( isset( $cat['childs'] ) ){
                        foreach ($cat['childs'] as $child_id => $child){
                            echo '<option value="'.$child_id.'"'.(in_array($child_id, $selected)?' selected="selected"':'').'>'.$child['name'].'</option>';
                        }
                    }
                    echo '</optgroup>';
                }
                ?>                                            
            </select>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'price'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'price', array('onchange'=>'getSalePrice()','class'=>'reg_price')); ?>
            <?php echo $form->error($model,'price'); ?>
        </div>
         <div class="span2">
            <?php echo $form->labelEx($model,'direct_buy_price'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'direct_buy_price'); ?>
            <?php echo $form->error($model,'direct_buy_price'); ?>
        </div>
       	
	</div>
     <div class="row-form clearfix">

        <div class="span2">
            <?php echo $form->labelEx($model,'discount_percent'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textField($model,'discount_percent',array('onchange'=>'getSalePrice()','class'=>'discount_percent')); ?>
            <?php echo $form->error($model,'discount_percent'); ?>
        </div>
       <div class="span2">
            <?php echo $form->labelEx($model,'price_purchase'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'price_purchase',array('readonly'=>'readonly','class'=>'sale_price')); ?>
            <?php echo $form->error($model,'price_purchase'); ?>
        </div>
       
    </div>
	<div class="row-form clearfix">
	   <div class="span2">
            <?php echo $form->labelEx($model,'is_active'); ?>
        </div>
		<div class="span4">
            <?php echo $form->checkBox($model,'is_active'); ?>
            <?php echo $form->error($model,'is_active'); ?>
        </div>
		<div class="span2">
            <?php echo $form->labelEx($model,'shipping_immediately'); ?>
        </div>
        <div class="span4">
            <?php echo $form->checkBox($model,'shipping_immediately'); ?>
            <?php echo $form->error($model,'shipping_immediately'); ?>
        </div>
	</div>
    <div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'shop_id'); ?>
        </div>
		<div class="span4">
            <?php echo $form->dropDownList( $model, 'shop_id', $ShopArray ); ?>
            <?php echo $form->error($model,'shop_id'); ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model,Yii::t('global','Shipping cost')); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'shipping_cost'); ?>
            <?php echo $form->error($model,'shipping_cost'); ?>
        </div>
       	
	</div>
    <div class="row-form clearfix">
        <div class="span2">
            <?php echo $form->labelEx($model,'units'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'units'); ?>
            <?php echo $form->error($model,'units'); ?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'value'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textField($model,'value'); ?>
            <?php echo $form->error($model,'value'); ?>
        </div>
    </div>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		<div class="span4">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" <?php echo 'href="/uploads/product_shop/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/product_shop/'.$model->image.'"'?> style="height: 50px;"/>
                </a>
            <?php endif;?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'quantity'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textField($model,'quantity'); ?>
            <?php echo $form->error($model,'quantity'); ?>
        </div>
		
	</div>

	<div class="row-form clearfix">
	
       	<div class="span2">
            <?php echo $form->labelEx($model,'short_desciption'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textArea($model,'short_desciption',array('rows'=>5, 'cols'=>300, 'class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'short_desciption'); ?>
        </div>
	</div>
	
    <div class="row-form clearfix">
		<div class="span3">
            <label> <?php echo Yii::t('global', 'Gallery')?> </label>
        </div>
		<div class="span9">
            <?php if ($model->id):?>
                <div class="block-fluid table-sorting">

                <?php 
                $gallery=new ProductGalleriesShop('search');
                $gallery->unsetAttributes();  // clear any default values
                $_GET['ProductGalleriesShop']['product_shop_id'] = $model->id;
                $gallery->attributes=$_GET['ProductGalleriesShop'];
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'product-galleries-grid',
                    'summaryText'=>'',
                    'dataProvider'=>$gallery->search(),
                    'columns'=>array(
                        array(
                            'header'=>Yii::t('global', 'Uploaded images'),
                            'value' => '$data->showImage()',
                            'type' => 'html'
                        ),
                        array(
                            'class'=>'CButtonColumn',
                            'template'=>'{delete}',
                            'buttons'=>array(
                                      'delete'=>array(
                                         'url'=>'$this->grid->controller->createUrl("/productShopManager/deleteGalleries", array("id"=>$data->primaryKey,"pro_id"=>$data->product_shop_id))',
                                         ),
                                    ),
                        ),
                    ),
                )); ?>
                </div>
            <?php endif;?>
            <div id="uploader"><center>Browser don't support a HTML5</center></div>
            <script type="text/javascript">
               function getSalePrice(){
                    var reg_price = $('.reg_price').val();
                    var discount_percent = $('.discount_percent').val();
                    $('.sale_price').val(reg_price-(reg_price*discount_percent)/100);
                }
                           $("#s2_2").select2();
                    var uploader = $("#uploader").pluploadQueue({     
                            runtimes : 'html5', // html5 uploader
                            url : '<?php echo $this->createUrl('productShopManager/upload/')?>', // server uploader
                            max_file_size : '6mb',
                            chunk_size : '6mb',
                            unique_names : true,
                            dragdrop : true,
                            //resize : {width : 320, height : 240, quality : 100},                             
                            filters : [
                                {title : "Image files", extensions : "jpg,gif,png"}
                            ]
                            ,
                            init : {
                                FilesAdded: function(up, files) {
                                    up.start();
                                },
                                UploadComplete: function(up, files) {
                                }
                            }
                    });  
                      
                //});
            </script>
        </div>
	</div>
	<div class="footer tar actions" style="text-align: right;">
	
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('id'=>'registerbutton','class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$("#ProductsShop_image").filestyle({buttonText: "<?php echo Yii::t('global','Choose file') ?>"});</script>