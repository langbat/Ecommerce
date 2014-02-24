
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-shop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

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
            <?php echo $form->labelEx($model,'parent_id'); ?>
        </div>
		<div class="span9">
            <?php
            $condition = array('parent_id' => 0);
            
            $criteria = new CDbCriteria(array('order' => 'name'));
            if ($model->id){
                $criteria->addCondition('id <> '.$model->id);
            }
            
            $list = CHtml::listData(CategoriesShop::model()->findAllByAttributes($condition, $criteria ), 'id', 'name' ); 
            echo $form->dropDownList($model,'parent_id', $list, array('empty'=>array(0 => '') , 'class'=>'validate[required]')); ?>
            <?php echo $form->error($model,'parent_id'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->