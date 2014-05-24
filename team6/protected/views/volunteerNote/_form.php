<?php
/* @var $this VolunteerNoteController */
/* @var $model VolunteerNote */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'volunteer-note-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'volunteerEmail'); ?>
		<?php echo $form->textField($model,'volunteerEmail',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'volunteerEmail'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'organizerEmail'); ?>
		<?php echo $form->textField($model,'organizerEmail',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'organizerEmail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organizationId'); ?>
		<?php echo $form->textField($model,'organizationId'); ?>
		<?php echo $form->error($model,'organizationId'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'dateTime'); ?>
		<?php echo $form->textField($model,'dateTime'); ?>
		<?php echo $form->error($model,'dateTime'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->