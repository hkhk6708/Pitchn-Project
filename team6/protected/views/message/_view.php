<?php
/* @var $this MessageController */
/* @var $data Message */
?>



<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipientEmail')); ?>:</b>
	<?php echo CHtml::encode($data->recipientEmail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('senderName')); ?>:</b>
	<?php echo CHtml::encode($data->senderName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userType')); ?>:</b>
	<?php echo CHtml::encode($data->userType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('readmsg')); ?>:</b>
	<?php echo CHtml::encode($data->readmsg); ?>
	<br />

	*/ ?>

</div>