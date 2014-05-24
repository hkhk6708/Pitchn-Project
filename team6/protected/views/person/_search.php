<?php
/* @var $this PersonController */
/* @var $person Person */
/* @var $form CActiveForm */
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id' => 'searchForm',
	'action'=>Yii::app()->createUrl("Person/search"),
	'method'=>'get',
)); ?>
    
    <div id="middleContentSearch"> 
        <div class="row">
            <label>Only Active Users</label>
            <?php echo $form->checkBox($person,'active'); ?>
        </div>
        <div class="row">

            <?php echo $form->label($person, 'name'); ?>
            <?php echo $form->textField($person, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
        <div class="row">
            <?php echo $form->label($person, 'email'); ?>
            <?php echo $form->textField($person, 'email', array('size' => 60, 'maxlength' => 255)); ?>

        </div>
    </div>
    
    <div id="divider"></div>

    <div id="middleContentSearch"> 
	<div class="row">
		<label>City</label>
		<?php echo $form->textField($person,'locationCity',array('size'=>60,'maxlength'=>255)); ?>
	</div>
            <div class="row">
                <label>Province</label>
		<?php echo $form->textField($person,'locationProvince',array('size'=>2,'maxlength'=>2)); ?>
	</div>
            <div class="row">
                <label>Country</label>
		<?php echo $form->textField($person,'locationCountry',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    </div>
    
    <div id="divider"></div>

    <div id="middleContentSearch"> 
        <div class="row">
            <label>Languages</label>
            <?php echo $form->textField($person, 'language'); ?>
            <?php echo $form->error($person, 'language'); ?>
        </div>

        <div class="row">
            <label>Skills</label>
            <input id="skills" name="skills"/>
            <?php echo $form->error($person, 'skill'); ?>
        </div>

        <div class="row">
            <label>Causes</label>
            <input id="causes" name="causes"/>
            <?php echo $form->error($person, 'cause'); ?>
        </div>
    </div>
    
    <div id="divider"></div>
    
    <div id="middleContentSearch"> 
        <div class="row">
            <label>Start of Availability</label>
            <?php echo $form->dateField($freeTime,'startDate'); ?>
            <?php echo $form->timeField($freeTime,'startTime'); ?>
            <?php echo $form->error($freeTime,'startDate'); ?>
            <?php echo $form->error($freeTime,'startTime'); ?>
        </div>
    
        <div class="row">
            <label>End of Availability</label>
            <?php echo $form->dateField($freeTime,'endDate'); ?>
            <?php echo $form->timeField($freeTime,'endTime'); ?>
            <?php echo $form->error($freeTime,'endDate'); ?>
            <?php echo $form->error($freeTime,'endTime'); ?>
        </div>
    </div>
    
    <div id="divider"></div>
    
    <div id="middleContentSearch"> 
        <div class="row">
            <label>Projects</label>
            <?php
           $this->widget('bootstrap.widgets.TbSelect2', array(
            'name' => 'orgProjects',
            'data' => $orgProjects,
            'htmlOptions' => array(
                'placeholder' => 'Select Projects',
                'width' => "300px",
                'multiple' => 'multiple',
            ),
                )
        );
        ?>
        </div>
    </div>

    <div id="bottomContent"> 
	<div class="row buttons">
		
            <?php
            echo CHtml::ajaxButton('Search', Yii::app()->createAbsoluteUrl("Person/search"), 
                    array('type' => 'GET',
                          'success' => 'js:function(data) {$("#content").css("cursor", "default"); $( ".expander" ).click(); document.getElementById("searchResults").innerHTML = data; '
                        . 'if (document.getElementById("orgProjects").value !== "") {'
                        . 'projectSelected = (document.getElementById("orgProjects").value).split(",")[0]; } else {projectSelected = "" } '
                        . 'document.getElementById("projectSelectSearch").value = projectSelected; initializeRoleSelectors(new Array(projectSelected));}',
                          'error' => 'js:function() {alert("Error Retrieving Data!");}'), 
                    array('name' => 'Search', 'class' => 'btn btn-danger',
            ));
            ?>
	</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
