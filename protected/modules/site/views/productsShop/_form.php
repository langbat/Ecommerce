

<div class="block-fluid create_shop">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-shop-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
));
$NameShops = MemberShop::model()->getNameShop();

foreach ( $NameShops as $NameShop ){
    $ShopArray[$NameShop['id']] = $NameShop['name'];
}
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
            <?php echo $form->textField($model,'price'); ?>
            <?php echo $form->error($model,'price'); ?>
        </div>
       	<div class="span2">
            <?php echo $form->labelEx($model,'price_purchase'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'price_purchase'); ?>
            <?php echo $form->error($model,'price_purchase'); ?>
        </div>
	</div>
    
	<div class="row-form clearfix">
	   <div class="span2">
            <?php echo $form->labelEx($model,'is_active'); ?>
        </div>
		<div class="span4 ">
            <?php echo $form->checkBox($model,'is_active'); ?>
            <?php echo $form->error($model,'is_active'); ?>
        </div>
		<div class="span2 clearfix">
            <?php echo $form->labelEx($model,'direct_buy_price'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'direct_buy_price'); ?>
            <?php echo $form->error($model,'direct_buy_price'); ?>
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
		<div class="span2">
            <?php echo $form->labelEx($model,'shipping_cost'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'shipping_cost'); ?>
            <?php echo $form->error($model,'shipping_cost'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
	
       	<div class="span2">
            <?php echo $form->labelEx($model,'short_desciption'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textArea($model,'short_desciption',array('rows'=>4, 'cols'=>25, 'class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'short_desciption'); ?>
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
            <?php echo $form->labelEx($model,'short_desciption'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textArea($model,'short_desciption',array('rows'=>4, 'cols'=>25, 'class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'short_desciption'); ?>
        </div>
	</div>
	<div class="footer tar actions">
	
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('id'=>'registerbutton','class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->