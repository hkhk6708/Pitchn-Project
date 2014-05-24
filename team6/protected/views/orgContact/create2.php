<?php
/* @var $this OrgContactController */
/* @var $model OrgContact */

$this->breadcrumbs = array(
    'Org Contacts' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List OrgContact', 'url' => array('index')),
    array('label' => 'Manage OrgContact', 'url' => array('admin')),
);
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'org-contact-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php //echo $form->labelEx($model, 'email'); ?>
        <?php //echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::label('Person assigned to the contact', 'pName'); ?>
        <?php
        echo $form->dropDownList($model, 'email', getAllOrganizers($model->roleId));
        ?>
        <?php echo $form->error($model, 'email'); ?>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php

function getAllOrganizers($rId) {
    $role = Role::model()->findByPk($rId);
    $project = Project::model()->findByPk($role->projectId);
    $orgId = $project->organizationId;

    $criteria = new CDbCriteria;
    $criteria->with = array(
        'worksFors',);
    $criteria->together = true;
    $criteria->condition = "worksFors.organizationId = :col_val and userType = :col_val2";
    $criteria->params = array(':col_val' => $orgId, ':col_val2' => "organizer");

    $array = CHtml::listData(Person::model()->findAll($criteria), 'email', 'name');

    return $array;
}
?>

<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
