<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
    <div id="dividerHead">General</div>
    <div id="divider"></div>

    <div id="middleContent">

            <?php  
            if ($model->isNewRecord) { ?>
            <div class="row">
                <?php
                echo $form->labelEx($model,'email');
                echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255));
                echo $form->error($model,'email');
                ?>
                </div>
                <?php } ?>


        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
		<?php
                $form->widget('bootstrap.widgets.TBDatePicker', array(
                    'model' => $model,
                    'attribute' => 'birthdate',
                    'options'=>array(
                        'format' => 'yyyy-mm-dd', 
                        'startDate' => '1940-1-1',
                        'endDate' => '2100-1-1',
                        )
                ))
                ?>
		<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'workPhone'); ?>
		<?php echo $form->textField($model,'workPhone',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'workPhone'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

        </div>
        
        <div id="dividerHead">Location</div>
        <div id="divider"></div>
        
        <div id="middleContent">
        <div class="row">
		<?php echo $form->labelEx($model,'locationCity'); ?>
		<?php echo $form->textField($model,'locationCity',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'locationCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locationProvince'); ?>
		<?php echo $form->textField($model,'locationProvince',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'locationProvince'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locationCountry'); ?>
		<?php echo $form->textField($model,'locationCountry',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'locationCountry'); ?>
	</div>
        
    </div>
        
            <div id="dividerHead">Extra</div>
            <div id="divider"></div>
        
    <div id="middleContent">
        <div class="row">
            <?php echo $form->labelEx($model, 'language'); ?>
            <?php
            $this->widget(
                    'bootstrap.widgets.TbSelect2', array(
                'asDropDownList' => false,
                'model' => $model,
                'attribute' => 'language',
                'options' => array(
                    'tags' => array("English",
                        "Chinese",
                        "Japanese",
                        "Korean",
                        "French",
                    ),
                    'placeholder' => 'Add Your Languages',
                    'width' => "300px",
                ),
                    )
            );
            ?>
            <?php echo $form->error($model, 'language'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'skill'); ?>
            <?php
                $this->widget('bootstrap.widgets.TBSelect2',array(
                    'asDropDownList' => false,
                    'name'=>"skills",
                        ));
            ?>
            <?php echo $form->error($model,'skill'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'cause'); ?>
            <?php
                $this->widget('bootstrap.widgets.TBSelect2',array(
                    'asDropDownList' => false,
                    'name'=>"causes",
                        ));
            ?>
            <?php echo $form->error($model,'cause'); ?>
        </div>
        
    </div>
        
        <div id="divider"></div>

        <div id="bottomContent">
	<div id="contentButton">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-danger')); ?>
	</div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
        var skillSelect = $('#skills');
$(skillSelect).select2({
    //data:[
<?php
/* $i = 0;
  $labels = $skill->attributeLabels();
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
    tags:[ <?php echo $skill->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Add Your Skills",
    tokenSeparators: [","],
    initSelection: function (element, callback) {
var data = [];
$(element.val().split(",")).each(function () {
    data.push({id: this, text: this});
});
callback(data);
}
});
        
        
        
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
    tags:[ <?php echo $cause->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Add Your Causes",
    tokenSeparators: [","],
    initSelection: function (element, callback) {
var data = [];
$(element.val().split(",")).each(function () {
    data.push({id: this, text: this});
});
callback(data);
}
});
                            
jQuery(function($) {
 
var skillsLoad = [ <?php echo $skill->getSelectedSkillString('"', '",'); ?> ]; 
 
var causesLoad = [ <?php echo $cause->getSelectedCauseString('"', '",'); ?> ]; 

if (skillsLoad.length != 0) {
$('#skills').select2('val',skillsLoad);
}
  
if (causesLoad.length != 0) {
$('#causes').select2('val',causesLoad);
}
 
}); 
</script>

