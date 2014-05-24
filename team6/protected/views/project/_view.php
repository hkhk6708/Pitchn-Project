<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizationId')); ?>:</b>
	<?php echo CHtml::encode($data->organizationId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('causeId')); ?>:</b>
	<?php echo CHtml::encode($data->causeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualEndDate')); ?>:</b>
	<?php echo CHtml::encode($data->actualEndDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('projectDescription')); ?>:</b>
	<?php echo CHtml::encode($data->projectDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
	<?php echo CHtml::encode($data->province); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recurring')); ?>:</b>
	<?php echo CHtml::encode($data->recurring); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectWebsite')); ?>:</b>
	<?php echo CHtml::encode($data->projectWebsite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectName')); ?>:</b>
	<?php echo CHtml::encode($data->projectName); ?>
	<br />

	*/ ?>

</div>