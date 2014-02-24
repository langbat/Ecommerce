<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('linkyoutube')); ?>:</b>
	<?php echo CHtml::encode($data->linkyoutube); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_highlight')); ?>:</b>
	<?php echo CHtml::encode($data->is_highlight); ?>
	<br />


</div>