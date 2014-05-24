<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<?php
$type = Yii::app()->user->getState("type")
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'task-form',
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
        <?php //echo $form->labelEx($model,'roleId'); ?>
        <?php //echo $form->textField($model,'roleId'); ?>
        <?php //echo $form->error($model,'roleId');  ?>
    </div>

    <?php if ($type != "volunteer") : ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'taskName'); ?>
            <?php echo $form->textField($model, 'taskName', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'taskName'); ?>
        </div>

        <div class="row">
            <?php echo $form->dropDownListRow($model, 'status', array('In Progress' => 'In Progress', 'Not Yet Started' => 'Not Yet Started', 'Pending Verification' => 'Pending Verification', 'Completed' => 'Completed')) ?>
            <?php // echo $form->textField($model, 'status', array('size' => 10, 'maxlength' => 10));  ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'timeSpent'); ?>
            <?php echo $form->textField($model, 'timeSpent'); ?>
            <?php echo $form->error($model, 'timeSpent'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'estCompTime'); ?>
            <?php echo $form->textField($model, 'estCompTime'); ?>
            <?php echo $form->error($model, 'estCompTime'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'taskDescription'); ?>
            <?php echo $form->textField($model, 'taskDescription', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'taskDescription'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'startDate'); ?>
            <?php
            date_default_timezone_set('UTC');
            $form->widget('bootstrap.widgets.TBDatePicker', array(
                'model' => $model,
                'attribute' => 'startDate',
                'options' => array(
                    'format' => 'yyyy-mm-dd',
                    'defaultDate' => date('y-m-d'),
                    'startDate' => date('Y-m-d'),
                    'endDate' => '2100-1-1',
                )
            ))
            ?>
            <?php echo $form->error($model, 'startDate'); ?>
        </div>

        <div class="row">
            <?php // echo $form->textField($model, 'endDate'); ?>
            <?php echo $form->labelEx($model, 'endDate'); ?>
            <?php
            $form->widget('bootstrap.widgets.TBDatePicker', array(
                'model' => $model,
                'attribute' => 'endDate',
                'options' => array(
                    'format' => 'yyyy-mm-dd',
                    'defaultDate' => date('y-m-d'),
                    'startDate' => date('Y-m-d'),
                    'endDate' => '2100-1-1',
                )
            ))
            ?>
            <?php echo $form->error($model, 'endDate'); ?>
        </div>

    <?php else : ?>

        <div class="row">
            <?php
            echo $form->dropDownListRow($model, 'status', array('In Progress' => 'In Progress',
                'Not Yet Started' => 'Not Yet Started',
                'Pending Verification' => 'Pending Verification',
                    //'Completed'
                    )
            )
            ?>
            <?php // echo $form->textField($model, 'status', array('size' => 10, 'maxlength' => 10));  ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'timeSpent'); ?>
            <?php echo $form->textField($model, 'timeSpent'); ?>
            <?php echo $form->error($model, 'timeSpent'); ?>
        </div>

    <?php endif; ?>

    <?php if (!$model->isNewRecord) : ?>
        <?php echo $form->labelEx($model, 'completion'); ?>
        <?php echo $form->numberField($model, 'completion'); ?>
        <?php echo $form->error($model, 'completion'); ?>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->