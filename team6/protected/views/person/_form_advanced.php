<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
/* @var $accountOrgDataProvider CActiveDataProvider */
/* @var $allOrgDataProvider CActiveDataProvider */
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

        
        <div id="middleContent">

        
	<div class="row">
            <label>Organizations</label>
                 <?php
                $this->widget(
                    'bootstrap.widgets.TbSelect2', array(
                    'name' => 'orgSelect',
                    'data' => $allOrgList,
                    'htmlOptions' => array(
                        'placeholder' => 'Select Organizations',
                        'multiple' => 'multiple',
                        'width' => "300px",
                    ),
                        )
                );
                ?>
                <?php /*echo $form->dropDownList($worksFor, 'organizationId', CHtml::listData(Organization::model()->findAll(), 'id', 'organizationName'));*/ ?>
		<?php /*echo $form->error($worksFor,'organizationId');*/ ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
                <?php echo $form->dropDownList($model, 'userType', array('volunteer'=>'Volunteer', 'organizer'=>'Organizer', 'administrator'=>'Administrator')); ?>
		<?php echo $form->error($model,'userType'); ?>
	</div>
	
        
        <div class="row">
		<?php echo $form->labelEx($model,'permissionLevel'); ?>
                <?php echo $form->dropDownList($model, 'permissionLevel', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10')); ?>
		<?php echo $form->error($model,'permissionLevel'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('active'=>'Enabled', 'inactive'=>'Disabled')); ?>
		<?php echo $form->error($model,'status'); ?>
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

<script>
    var ids = [<?php echo implode(',',$accountOrgList) ?>];
    $("#orgSelect").select2({width: "488px"}).select2("val", ids);
</script>
