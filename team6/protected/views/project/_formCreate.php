<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'project-form',
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
        <?php echo $form->labelEx($model, 'projectName'); ?>
        <?php echo $form->textField($model, 'projectName', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'projectName'); ?>
    </div>

    <div class="row">

        <?php //echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownListRow($model, 'status', array('In Progress'=>'In Progress', 'Completed'=>'Completed', 'Not Yet Started'=>'Not Yet Started', 'Pending Verification'=>'Pending Verification')) ?>
        <?php // echo $form->textField($model, 'status', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'status'); ?>

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
        <?php echo $form->labelEx($model, 'endDate'); ?>
        <?php
        date_default_timezone_set('UTC');
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



    
    <div class="row">
        <?php echo $form->labelEx($model, 'projectDescription'); ?>
        <?php echo $form->textField($model, 'projectDescription', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'projectDescription'); ?>
    </div>

<!--    <div class="row">
        <?php echo $form->labelEx($model, 'city'); ?>
        <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'province'); ?>
        <?php echo $form->textField($model, 'province', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'province'); ?>
    </div>-->

<!--    <div class="row">
        <?php echo $form->labelEx($model, 'recurring'); ?>
        <?php echo $form->textField($model, 'recurring', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'recurring'); ?>
    </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'projectWebsite'); ?>
        <?php echo $form->textField($model, 'projectWebsite', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'projectWebsite'); ?>
    </div>

    <div id="middleContent">

        <div class="row">
            <?php echo $form->labelEx($model, 'cause'); ?>
            <?php
            $this->widget('bootstrap.widgets.TBSelect2', array(
                'asDropDownList' => false,
                'name' => "causes",
            ));
            ?>
            <?php echo $form->error($model, 'cause'); ?>
        </div>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->




<script type="text/javascript">

    var causeSelect = $('#causes');
    $(causeSelect).select2({
        //data:[
<?php
/* $i = 0;
  $labels = $cause->attributeLabels();
  $numOfAttributes = count($labels);
  foreach ($labels as $label) {
  $i++;
  if ($i == 1 || $i == $numOfAttributes) {
  continue;
  }
  echo '{id:"'.$label.'",text:"'.$label.'"},';
  } */
?>

        //],
        tags: [<?php echo $cause->getAttributeString('"', '",'); ?>],
        multiple: true,
        width: "300px",
        placeholder: "Add Causes",
        tokenSeparators: [","],
        initSelection: function(element, callback) {
            var data = [];
            $(element.val().split(",")).each(function() {
                data.push({id: this, text: this});
            });
            callback(data);
        }
    });

    jQuery(function($) {

        //var skillsLoad = [<?php //echo $skill->getSelectedSkillString('"', '",');   ?>];

        var causesLoad = [<?php echo $cause->getSelectedCauseString('"', '",'); ?>];

        //if (skillsLoad.length != 0) {
        //    $('#skills').select2('val', skillsLoad);
        //}

        if (causesLoad.length != 0) {
            $('#causes').select2('val', causesLoad);
        }

    });
</script> 