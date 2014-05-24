<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'horizontalForm',
    'type' => 'horizontal',
        ));
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/content.css');
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/project.css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/popUp.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>
<div id="roleSubHeader">
    <p class="rolepath"><span><?php echo Yii::app()->user->getState('projectTitle'); ?></p>
                    <?php Yii::app()->user->setState('projectTitle', ''); ?></span></p>
</div>
<div id="roleSubHeader">
    <p class="rolepath"><span><?php echo Yii::app()->user->getState('roleTitle'); ?></p>
                    <?php Yii::app()->user->setState('roleTitle', ''); ?></span></p>
</div>
<div id="profileclear">
    
</div>

<script type="text/javascript">
   /* function visble(){
        document.getElementById("arrow_box2").style.display='block';
    }
    function invisble(){
        document.getElementById("arrow_box2").style.display='none';
    } */
</script>
<div id="projectbuttons">
<div id="projectbutton" onmouseover="visble()" onmouseout="invisble()">

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Edit Task',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => array('task/updateWithPid', 'id' => $model->id, 'projectId'=>Yii::app()->request->getParam("id")),
//    'style'=> "margin-left: 85%;margin-right: 0;"
));
?>

</div>

<div id="projectbutton" onmouseover="visble()" onmouseout="invisble()">
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Delete Task',
    'size' => 'normal',
    'type' => 'danger',
    'visible' =>  Yii::app()->user->getState("type")!='volunteer',
    'htmlOptions' => array(
        'onclick' => 'js:bootbox.confirm("Are you sure to delete this task?",
                        function(confirmed){
                                if (confirmed) {
                                        window.location.href="index.php?r=task/delete2&id='.$model->id.'&projectId='.$id.'";
                                }


                        })'
    ),
));
?>
</div>
</div>
<!--<div id="arrow_box2">
    you can use this button to edit project info.
</div> -->





<div id="project" class="left">
    <p class="project"><b>Status: </b><?php echo $model->status; ?></p>
    <p class="project"><b>Start Date:</b><?php echo $model->startDate; ?></p>
    <p class="project"><b>End Date:</b><?php echo $model->endDate; ?></p>
    <p class="project"><b>Estimated Completion Time： </b><?php echo $model->estCompTime; ?> hours</p>
    <p class="project"><b>Time Spent So-far: </b><?php echo $model->timeSpent; ?> hours</p>

  
    

</div>

<div id="project" class="right">
    <p class="project"><b>Description: </b><?php echo $model->taskDescription; ?></p>
    
</div>
<div id="projectclear"></div>
<div id="project" class="full">
        <h3 class="project">Comments</h3>
            <p class="project"><b>Add a comment (max 255 characters):</b></p>
    <div id="projectfield">
     <?php echo CHtml::textArea('comment', '', array('style'=>'width:90%;height:60px;')); ?>
    </div>
    <div id="projectbutton">
    <?php echo CHtml::submitButton('Submit your comment', array('size' => 'large',)); ?>
    </div>
</div>
<div id="project" class="full">


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
    'selectableRows' => 1,
    'template' => "{items}\n{pager}",
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(
        //array('name' => 'id', 'header' => 'PCommentsID', 'type' => 'raw'),
        array('name' => 'cdate', 'header' => 'Date',),
        //array('name' => 'email', 'header' => 'Posted By',),
        array('value' => '$data->email0->name', 'header' => 'Posted By',),
        array('name' => 'content', 'header' => 'Content',),
    //array(
    //'class' => 'bootstrap.widgets.TbButtonColumn',
    //'template' => '{update} {delete}' //removed {view}
    //),
    ),
));
?>
<div id="projectclear"></div>

</div>
<?php $this->endWidget(); ?>

<script>
$("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>