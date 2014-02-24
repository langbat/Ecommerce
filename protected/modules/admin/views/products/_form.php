<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.js' ); error_reporting(0); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.gears.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.silverlight.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.flash.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.browserplus.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.html5.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/plupload.js' ); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js' ); ?>

<div class="block-fluid">
<?php $allTag = Tags::model()->getAllTag();
 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>
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
            <label class="required" for="s2_2">
                <?php echo Yii::t('global', 'Categories')?>
                <span class="required">*</span>
            </label>
        </div>
		<div class="span4" >
            <select name="ProductCategories[]" id="s2_2" style="width: 100%;" multiple="multiple" class="validate[required]">
                <?php 
                $cats = array(); Categories::getTree($cats);
                
                $selected = $model->getCategoriesId();                
                foreach ($cats as $cat_id=>$cat){
                    echo '<optgroup  label="'.$cat['name'].'">';
                    if( isset( $cat['childs'] ) ){
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
        <div class="span2 ">
            <?php echo $form->labelEx($model,'price_purchase'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textField($model,'price_purchase',array('readonly'=>'readonly','class'=>'sale_price')); ?>
            <?php echo $form->error($model,'price_purchase'); ?>
        </div>

    </div>
    <div class="row-form clearfix">

        <div class="span2 ">
            <?php echo $form->labelEx($model,'shipping_cost'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'shipping_cost'); ?>
            <?php echo $form->error($model,'shipping_cost'); ?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'producer_id'); ?>
        </div>
        <div class="span4 ">
            <?php $producer_name = Producers::model()->findAll();
            foreach ($producer_name as $key=>$name){
                $producer_name1[$name['id']] = Yii::t('global', $name['name']);
            } ?>
            

            <?php echo $form->dropDownList($model,'producer_id',$producer_name1); ?>
            <?php echo $form->error($model,'producer_id'); ?>
        </div>
    </div>
    <div class="row-form clearfix">

        <div class="span2 ">
            <?php echo $form->labelEx($model,'type_shipping'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'type_shipping'); ?>
            <?php echo $form->error($model,'type_shipping'); ?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'availble_ship'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'availble_ship'); ?>
            <?php echo $form->error($model,'availble_ship'); ?>
        </div>
    </div>
    <div class="row-form clearfix">
        <div class="span2 ">
            <?php echo $form->labelEx($model,'units'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'units'); ?>
            <?php echo $form->error($model,'units'); ?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'value'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'value'); ?>
            <?php echo $form->error($model,'value'); ?>
        </div>
    </div>
    <div class="row-form clearfix">

        <div class="span2 ">
            <?php echo $form->labelEx($model,'availble_pickup'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textArea($model,'availble_pickup',array('class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'availble_pickup'); ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model,'short_desciption'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textArea($model,'short_desciption',array('size'=>60,'maxlength'=>1024, 'class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'short_desciption'); ?>
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
            <?php echo $form->labelEx($model,'is_special'); ?>
        </div>
        <div class="span4">
            <?php echo $form->checkBox($model,'is_special'); ?>
            <?php echo $form->error($model,'is_special'); ?>
        </div>
        <div class="span2 ">
            <?php echo $form->labelEx($model,'label_id'); ?>
        </div>
        <div class="span4 ">
            <?php $producer_name_label = ProductLabels::model()->findAll();
            foreach ($producer_name_label as $key=>$name){
                $producer_name_label1[$key+1] = Yii::t('global', $name['name']);
            }  ?>

            <?php echo $form->dropDownList($model,'label_id',$producer_name_label1); ?>
            <?php echo $form->error($model,'label_id'); ?>
        </div>
    </div>
   
   
	<div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'image'); ?>
        </div>
		<div class="span3">
            <?php echo $form->fileField($model,'image'); ?>
            <?php echo $form->error($model,'image'); ?>
            <?php if ($model->image):?>
                <a class="fancybox" <?php echo 'href="/uploads/product/'.$model->image.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/product/'.$model->image.'"'?> style="height: 50px;"/>
                </a>
            <?php endif;?>
        </div>
         <div class="span2 ">
            <?php echo $form->labelEx($model,'quantity'); ?>
        </div>
        <div class="span4 ">
            <?php echo $form->textField($model,'quantity'); ?>
            <?php echo $form->error($model,'quantity'); ?>
        </div>

	</div>
    
    
    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'video'); ?>
        </div>
        <div class="span8 fix_video">
            <div class="options_video">
                <select name="options_video" class="select_video">
                    <option value="link"><?php echo Yii::t('global','Choose video from website ') ?></option>
                    <option value="upload"><?php echo Yii::t('global','Upload from your computer') ?></option>
                    <option value="choose"><?php echo Yii::t('global','Choose from your website') ?></option>
                </select>
                <div class="text_link_video">
                    <?php echo $form->textField($model,'video', array('title'=>Yii::t('global','Please type url video'),'class'=>'video_from_url')); ?>
                    <?php echo $form->error($model,'video'); ?>
                </div>
                <div class="file_upload_video">
                <?php   echo $form->fileField($model,'video2',array('class'=>'fix_input_upload'));?>
                </div>
                <div class="choose_file_video span5">
                  <?php
                    $iterator = new FilesystemIterator("./uploads/video/");
                    $filelist = array();
                    foreach($iterator as $entry) {
                        if(preg_match('/^.*\.(mp4|mov|avi)$/i', $entry->getFilename()))
                              $filelist[$entry->getFilename()] = $entry->getFilename();
                        } 
                      // var_dump($filelist);
                       echo $form->dropDownList($model,'video',$filelist,array('class'=>'choose_video')); 
                       echo $form->error($model,'video');
                       ?>
                
            </div>
              
            </div>
            <?php if ($model->video):?>
                <?php echo Products::getVideo($model->video); ?>
            <?php endif;?>
        </div>
    </div>

<?php /*    
<div class="row-form clearfix">

    <div class="span2">
        <?php echo $form->labelEx($model,'video'); ?>
    </div>
    <div class="span4 fix_video_show">
        <?php echo $form->textField($model,'video'); ?>
        <?php echo $form->error($model,'video'); ?>
        <?php if ($model->video):
            echo $model->getVideo($model->video);
        endif;?>
    </div>
</div>
*/ ?>

    <div class="row-form clearfix">
        <div class="span3">
            <label> <?php echo Yii::t('global', 'Tag')?> </label>
        </div>
        <div class="span8" >
            <?php $tagProducts = ($model->id)?  ProductTags::model()->getTagById($model->id):''  ; 
                  $tagProduct  = isset( $tagProducts )?$tagProducts:''; 
                 ?>
            <input name="Products[tag]" id="mySingleField" value="<?php echo implode(",", (isset( $tagProduct ))? $tagProduct : '' ); ?>" type="hidden">
            <ul id="singleFieldTags"></ul>
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
                $gallery=new ProductGalleries('search');
                $gallery->unsetAttributes();  // clear any default values
                $_GET['ProductGalleries']['product_id'] = $model->id;
                $gallery->attributes=$_GET['ProductGalleries'];
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'product-galleries-grid',
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
                jQuery(document).ready(function(){
                    //$('.select2-input').addClass('validate[required]');

                    var uploader = $("#uploader").pluploadQueue({     
                            runtimes : 'html5', // html5 uploader
                            url : '<?php echo $this->createUrl('products/upload/')?>', // server uploader
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
                      
                });

                $(function(){

                    var sampleTags = [<?php echo "'".implode("','", ($allTag)? $allTag : array(0) )."'" ?>];
                    $('#singleFieldTags').tagit({
                        availableTags: sampleTags,
                        singleField: true,
                        allowSpaces: true,
                        singleFieldNode: $('#mySingleField')
                    });
                    $('#removeConfirmationTags').tagit({
                        availableTags: sampleTags,
                        removeConfirmation: true
                    });
                });
                    var type = $('.select_video').val();
                    if(type == 'link'){
                     $('.choose_file_video').css('display','none');
                     $('.choose_video').attr('name', '');
                 }
                $('.select_video').change(function(){
                    var type = $('.select_video').val();
                    if(type == 'link'){
                        $('.file_upload_video').css('display','none');
                           $('.choose_file_video').css('display','none');
                        $('.text_link_video').css('display','block');
                        $('.choose_video').attr('name', '');
                        $('.video_from_url').attr('name', 'Products[video]');
                     
                    } else if(type=='choose') {
                        $('.choose_file_video').css('display','block');
                        $('.text_link_video').css('display','none');
                        $('.file_upload_video').css('display','none');
                        $('.video_from_url').attr('name', '');
                        $('.choose_video').attr('name', 'Products[video]');
                    }
                        else{
                            $('.fix_input_upload').parent().css('display','block');
                            $('.text_link_video').css('display','none');
                            $('.file_upload_video').css('display','block');
                            $('.choose_file_video').css('display','none');
                             
                        }
                });
            </script>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget();
 ?>

</div><!-- form -->