<?php
/* @var $this SkillController */
/* @var $model Skill */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accounting'); ?>
		<?php echo $form->textField($model,'accounting'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'advertising'); ?>
		<?php echo $form->textField($model,'advertising'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branding'); ?>
		<?php echo $form->textField($model,'branding'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'businessStrategy'); ?>
		<?php echo $form->textField($model,'businessStrategy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'communications'); ?>
		<?php echo $form->textField($model,'communications'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'copywriting'); ?>
		<?php echo $form->textField($model,'copywriting'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'design'); ?>
		<?php echo $form->textField($model,'design'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'education'); ?>
		<?php echo $form->textField($model,'education'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entrepreneurship'); ?>
		<?php echo $form->textField($model,'entrepreneurship'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eventPlanning'); ?>
		<?php echo $form->textField($model,'eventPlanning'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finance'); ?>
		<?php echo $form->textField($model,'finance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fundraising'); ?>
		<?php echo $form->textField($model,'fundraising'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'humanResources'); ?>
		<?php echo $form->textField($model,'humanResources'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'legal'); ?>
		<?php echo $form->textField($model,'legal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marketing'); ?>
		<?php echo $form->textField($model,'marketing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'multimedia'); ?>
		<?php echo $form->textField($model,'multimedia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onlineMarketing'); ?>
		<?php echo $form->textField($model,'onlineMarketing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photography'); ?>
		<?php echo $form->textField($model,'photography'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectManagement'); ?>
		<?php echo $form->textField($model,'projectManagement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publicRelations'); ?>
		<?php echo $form->textField($model,'publicRelations'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sales'); ?>
		<?php echo $form->textField($model,'sales'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'socialMedia'); ?>
		<?php echo $form->textField($model,'socialMedia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'technology'); ?>
		<?php echo $form->textField($model,'technology'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'webDevelopment'); ?>
		<?php echo $form->textField($model,'webDevelopment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other'); ?>
		<?php echo $form->textField($model,'other',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->