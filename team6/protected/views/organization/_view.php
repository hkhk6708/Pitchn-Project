<?php
/* @var $this OrganizationController */
/* @var $data Organization */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('causeId')); ?>:</b>
	<?php echo CHtml::encode($data->causeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizationName')); ?>:</b>
	<?php echo CHtml::encode($data->organizationName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizationDescription')); ?>:</b>
	<?php echo CHtml::encode($data->organizationDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizationPhone')); ?>:</b>
	<?php echo CHtml::encode($data->organizationPhone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('contactDetails')); ?>:</b>
	<?php echo CHtml::encode($data->contactDetails); ?>
	<br />

	*/ ?>

</div>