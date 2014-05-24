<?php
/* @var $this ProjectController */
/* @var $model Project */
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
		<?php echo $form->label($model,'organizationId'); ?>
		<?php echo $form->textField($model,'organizationId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'causeId'); ?>
		<?php echo $form->textField($model,'causeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actualEndDate'); ?>
		<?php echo $form->textField($model,'actualEndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectDescription'); ?>
		<?php echo $form->textField($model,'projectDescription',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'province'); ?>
		<?php echo $form->textField($model,'province',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recurring'); ?>
		<?php echo $form->textField($model,'recurring',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectWebsite'); ?>
		<?php echo $form->textField($model,'projectWebsite',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectName'); ?>
		<?php echo $form->textField($model,'projectName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->