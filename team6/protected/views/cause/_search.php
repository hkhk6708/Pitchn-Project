<?php
/* @var $this CauseController */
/* @var $model Cause */
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
		<?php echo $form->label($model,'animalWelfare'); ?>
		<?php echo $form->textField($model,'animalWelfare'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'artsAndCulture'); ?>
		<?php echo $form->textField($model,'artsAndCulture'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'children'); ?>
		<?php echo $form->textField($model,'children'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'communityAndService'); ?>
		<?php echo $form->textField($model,'communityAndService'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'democracyAndPolitics'); ?>
		<?php echo $form->textField($model,'democracyAndPolitics'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'education'); ?>
		<?php echo $form->textField($model,'education'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'environment'); ?>
		<?php echo $form->textField($model,'environment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'food'); ?>
		<?php echo $form->textField($model,'food'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'health'); ?>
		<?php echo $form->textField($model,'health'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'housingAndHomelessness'); ?>
		<?php echo $form->textField($model,'housingAndHomelessness'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'humanRights'); ?>
		<?php echo $form->textField($model,'humanRights'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'humanitarianRelief'); ?>
		<?php echo $form->textField($model,'humanitarianRelief'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'internationalAffairs'); ?>
		<?php echo $form->textField($model,'internationalAffairs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'media'); ?>
		<?php echo $form->textField($model,'media'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'povertyAlleviation'); ?>
		<?php echo $form->textField($model,'povertyAlleviation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'religion'); ?>
		<?php echo $form->textField($model,'religion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'scienceAndTechnology'); ?>
		<?php echo $form->textField($model,'scienceAndTechnology'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seniorCitizens'); ?>
		<?php echo $form->textField($model,'seniorCitizens'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'womensIssues'); ?>
		<?php echo $form->textField($model,'womensIssues'); ?>
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