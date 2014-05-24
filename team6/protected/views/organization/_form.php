<?php
/* @var $this OrganizationController */
/* @var $model Organization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'organization-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'organizationName'); ?>
		<?php echo $form->textField($model,'organizationName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'organizationName'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('active'=>'Enabled', 'inactive'=>'Disabled')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organizationDescription'); ?>
		<?php echo $form->textField($model,'organizationDescription',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'organizationDescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organizationPhone'); ?>
		<?php echo $form->textField($model,'organizationPhone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'organizationPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contactDetails'); ?>
		<?php echo $form->textField($model,'contactDetails',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactDetails'); ?>
	</div>
        
         <div class="row">
           
            <?php
                $this->widget('bootstrap.widgets.TBSelect2',array(
                    'asDropDownList' => false,
                    'name'=>"causes",
                        ));
            ?>
  
        </div>
        
        
	<div class="row">
		<?php echo $form->labelEx($cause,'Other'); ?>
		<?php echo $form->textField($cause,'other'); ?>
		<?php echo $form->error($cause,'other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
var causeSelect = $('#causes');
$(causeSelect).select2({
    //data:[
<?php

?>
    //],
    tags:[ <?php echo $cause->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Add Causes",
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
 
 
var causesLoad = [ <?php echo $cause->getSelectedCauseString('"', '",'); ?> ]; 

if (causesLoad.length != 0) {
$('#causes').select2('val',causesLoad);
}
 
}); 
</script>