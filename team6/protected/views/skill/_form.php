<?php
/* @var $this SkillController */
/* @var $model Skill */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'skill-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'accounting'); ?>
		<?php echo $form->textField($model,'accounting'); ?>
		<?php echo $form->error($model,'accounting'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'advertising'); ?>
		<?php echo $form->textField($model,'advertising'); ?>
		<?php echo $form->error($model,'advertising'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branding'); ?>
		<?php echo $form->textField($model,'branding'); ?>
		<?php echo $form->error($model,'branding'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'businessStrategy'); ?>
		<?php echo $form->textField($model,'businessStrategy'); ?>
		<?php echo $form->error($model,'businessStrategy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'communications'); ?>
		<?php echo $form->textField($model,'communications'); ?>
		<?php echo $form->error($model,'communications'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'copywriting'); ?>
		<?php echo $form->textField($model,'copywriting'); ?>
		<?php echo $form->error($model,'copywriting'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'design'); ?>
		<?php echo $form->textField($model,'design'); ?>
		<?php echo $form->error($model,'design'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'education'); ?>
		<?php echo $form->textField($model,'education'); ?>
		<?php echo $form->error($model,'education'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'entrepreneurship'); ?>
		<?php echo $form->textField($model,'entrepreneurship'); ?>
		<?php echo $form->error($model,'entrepreneurship'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventPlanning'); ?>
		<?php echo $form->textField($model,'eventPlanning'); ?>
		<?php echo $form->error($model,'eventPlanning'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finance'); ?>
		<?php echo $form->textField($model,'finance'); ?>
		<?php echo $form->error($model,'finance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fundraising'); ?>
		<?php echo $form->textField($model,'fundraising'); ?>
		<?php echo $form->error($model,'fundraising'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'humanResources'); ?>
		<?php echo $form->textField($model,'humanResources'); ?>
		<?php echo $form->error($model,'humanResources'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'legal'); ?>
		<?php echo $form->textField($model,'legal'); ?>
		<?php echo $form->error($model,'legal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'marketing'); ?>
		<?php echo $form->textField($model,'marketing'); ?>
		<?php echo $form->error($model,'marketing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'multimedia'); ?>
		<?php echo $form->textField($model,'multimedia'); ?>
		<?php echo $form->error($model,'multimedia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'onlineMarketing'); ?>
		<?php echo $form->textField($model,'onlineMarketing'); ?>
		<?php echo $form->error($model,'onlineMarketing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photography'); ?>
		<?php echo $form->textField($model,'photography'); ?>
		<?php echo $form->error($model,'photography'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'projectManagement'); ?>
		<?php echo $form->textField($model,'projectManagement'); ?>
		<?php echo $form->error($model,'projectManagement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publicRelations'); ?>
		<?php echo $form->textField($model,'publicRelations'); ?>
		<?php echo $form->error($model,'publicRelations'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sales'); ?>
		<?php echo $form->textField($model,'sales'); ?>
		<?php echo $form->error($model,'sales'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'socialMedia'); ?>
		<?php echo $form->textField($model,'socialMedia'); ?>
		<?php echo $form->error($model,'socialMedia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'technology'); ?>
		<?php echo $form->textField($model,'technology'); ?>
		<?php echo $form->error($model,'technology'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'webDevelopment'); ?>
		<?php echo $form->textField($model,'webDevelopment'); ?>
		<?php echo $form->error($model,'webDevelopment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other'); ?>
		<?php echo $form->textField($model,'other',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->