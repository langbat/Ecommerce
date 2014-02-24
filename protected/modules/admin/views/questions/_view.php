<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emails')); ?>:</b>
	<?php echo CHtml::encode($data->emails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('questions')); ?>:</b>
	<?php echo CHtml::encode($data->questions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answers')); ?>:</b>
	<?php echo CHtml::encode($data->answers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datequestion')); ?>:</b>
	<?php echo CHtml::encode($data->datequestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateanswer')); ?>:</b>
	<?php echo CHtml::encode($data->dateanswer); ?>
	<br />


</div>