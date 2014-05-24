<?php
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs = array(
    'Roles' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Role', 'url' => array('index')),
    array('label' => 'Create Role', 'url' => array('create')),
    array('label' => 'View Role', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Role', 'url' => array('admin')),
);
?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'role-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php //echo $form->labelEx($model,'projectId'); ?>
        <?php //echo $form->textField($model,'projectId');  ?>
        <?php //echo $form->error($model,'projectId');  ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'roleDescription'); ?>
        <?php echo $form->textField($model, 'roleDescription', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'roleDescription'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
