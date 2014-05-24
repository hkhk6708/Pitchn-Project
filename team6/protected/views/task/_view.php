<?php
/* @var $this TaskController */
/* @var $data Task */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roleId')); ?>:</b>
	<?php echo CHtml::encode($data->roleId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taskName')); ?>:</b>
	<?php echo CHtml::encode($data->taskName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeSpent')); ?>:</b>
	<?php echo CHtml::encode($data->timeSpent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estCompTime')); ?>:</b>
	<?php echo CHtml::encode($data->estCompTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taskDescription')); ?>:</b>
	<?php echo CHtml::encode($data->taskDescription); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	*/ ?>

</div>