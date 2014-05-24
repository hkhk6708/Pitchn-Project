<?php
/* @var $this SkillController */
/* @var $data Skill */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accounting')); ?>:</b>
	<?php echo CHtml::encode($data->accounting); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advertising')); ?>:</b>
	<?php echo CHtml::encode($data->advertising); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branding')); ?>:</b>
	<?php echo CHtml::encode($data->branding); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('businessStrategy')); ?>:</b>
	<?php echo CHtml::encode($data->businessStrategy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('communications')); ?>:</b>
	<?php echo CHtml::encode($data->communications); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('copywriting')); ?>:</b>
	<?php echo CHtml::encode($data->copywriting); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('design')); ?>:</b>
	<?php echo CHtml::encode($data->design); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
	<?php echo CHtml::encode($data->education); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entrepreneurship')); ?>:</b>
	<?php echo CHtml::encode($data->entrepreneurship); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventPlanning')); ?>:</b>
	<?php echo CHtml::encode($data->eventPlanning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finance')); ?>:</b>
	<?php echo CHtml::encode($data->finance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fundraising')); ?>:</b>
	<?php echo CHtml::encode($data->fundraising); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('humanResources')); ?>:</b>
	<?php echo CHtml::encode($data->humanResources); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legal')); ?>:</b>
	<?php echo CHtml::encode($data->legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marketing')); ?>:</b>
	<?php echo CHtml::encode($data->marketing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('multimedia')); ?>:</b>
	<?php echo CHtml::encode($data->multimedia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onlineMarketing')); ?>:</b>
	<?php echo CHtml::encode($data->onlineMarketing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photography')); ?>:</b>
	<?php echo CHtml::encode($data->photography); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectManagement')); ?>:</b>
	<?php echo CHtml::encode($data->projectManagement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publicRelations')); ?>:</b>
	<?php echo CHtml::encode($data->publicRelations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales')); ?>:</b>
	<?php echo CHtml::encode($data->sales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('socialMedia')); ?>:</b>
	<?php echo CHtml::encode($data->socialMedia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('technology')); ?>:</b>
	<?php echo CHtml::encode($data->technology); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('webDevelopment')); ?>:</b>
	<?php echo CHtml::encode($data->webDevelopment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
	<br />

	*/ ?>

</div>