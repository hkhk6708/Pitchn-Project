<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'message-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php /*
      <div class="row">
      <?php echo $form->labelEx($model,'email'); ?>
      <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
      <?php echo $form->error($model,'email'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model,'senderName'); ?>
      <?php echo $form->textField($model,'senderName',array('size'=>60,'maxlength'=>255)); ?>
      <?php echo $form->error($model,'senderName'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model,'userType'); ?>
      <?php echo $form->textField($model,'userType',array('size'=>20,'maxlength'=>20)); ?>
      <?php echo $form->error($model,'userType'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model,'date'); ?>
      <?php echo $form->textField($model,'date'); ?>
      <?php echo $form->error($model,'date'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model,'readmsg'); ?>
      <?php echo $form->textField($model,'readmsg',array('size'=>1,'maxlength'=>1)); ?>
      <?php echo $form->error($model,'readmsg'); ?>
      </div>
     */ ?>

    <div class="row">
        <?php //echo $form->labelEx($model, 'recipientEmail'); ?>
        <?php //echo $form->textField($model, 'recipientEmail', array('size' => 60, 'maxlength' => 255)); ?>
        <?php //echo $form->error($model, 'recipientEmail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
