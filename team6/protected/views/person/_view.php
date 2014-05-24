<?php
/* @var $this PersonController */
/* @var $data Person */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('causeId')); ?>:</b>
	<?php echo CHtml::encode($data->causeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skillId')); ?>:</b>
	<?php echo CHtml::encode($data->skillId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workPhone')); ?>:</b>
	<?php echo CHtml::encode($data->workPhone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permissionLevel')); ?>:</b>
	<?php echo CHtml::encode($data->permissionLevel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userType')); ?>:</b>
	<?php echo CHtml::encode($data->userType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthdate')); ?>:</b>
	<?php echo CHtml::encode($data->birthdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationCity')); ?>:</b>
	<?php echo CHtml::encode($data->locationCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationProvince')); ?>:</b>
	<?php echo CHtml::encode($data->locationProvince); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationCountry')); ?>:</b>
	<?php echo CHtml::encode($data->locationCountry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('registered')); ?>:</b>
	<?php echo CHtml::encode($data->registered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastActive')); ?>:</b>
	<?php echo CHtml::encode($data->lastActive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>