<?php
/* @var $this CauseController */
/* @var $data Cause */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('animalWelfare')); ?>:</b>
	<?php echo CHtml::encode($data->animalWelfare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artsAndCulture')); ?>:</b>
	<?php echo CHtml::encode($data->artsAndCulture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('children')); ?>:</b>
	<?php echo CHtml::encode($data->children); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('communityAndService')); ?>:</b>
	<?php echo CHtml::encode($data->communityAndService); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('democracyAndPolitics')); ?>:</b>
	<?php echo CHtml::encode($data->democracyAndPolitics); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
	<?php echo CHtml::encode($data->education); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('environment')); ?>:</b>
	<?php echo CHtml::encode($data->environment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('food')); ?>:</b>
	<?php echo CHtml::encode($data->food); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('health')); ?>:</b>
	<?php echo CHtml::encode($data->health); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('housingAndHomelessness')); ?>:</b>
	<?php echo CHtml::encode($data->housingAndHomelessness); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('humanRights')); ?>:</b>
	<?php echo CHtml::encode($data->humanRights); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('humanitarianRelief')); ?>:</b>
	<?php echo CHtml::encode($data->humanitarianRelief); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internationalAffairs')); ?>:</b>
	<?php echo CHtml::encode($data->internationalAffairs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('media')); ?>:</b>
	<?php echo CHtml::encode($data->media); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('povertyAlleviation')); ?>:</b>
	<?php echo CHtml::encode($data->povertyAlleviation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('religion')); ?>:</b>
	<?php echo CHtml::encode($data->religion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scienceAndTechnology')); ?>:</b>
	<?php echo CHtml::encode($data->scienceAndTechnology); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seniorCitizens')); ?>:</b>
	<?php echo CHtml::encode($data->seniorCitizens); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('womensIssues')); ?>:</b>
	<?php echo CHtml::encode($data->womensIssues); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
	<br />

	*/ ?>

</div>