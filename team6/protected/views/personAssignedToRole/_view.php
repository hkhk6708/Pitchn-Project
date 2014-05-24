<?php
/* @var $this PersonAssignedToRoleController */
/* @var $data PersonAssignedToRole */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roleId')); ?>:</b>
	<?php echo CHtml::encode($data->roleId); ?>
	<br />


</div>