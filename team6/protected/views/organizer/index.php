

<?php
/* @var $this OrganizaerController */

$this->breadcrumbs = array(
    'Organizaer',
);
?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/popUp.css" />
</head>

<script type="text/javascript">
    // function invisble(){
    //   document.getElementById("arrow_box").style.display='none';
    }
</script>


<!--   <div id="arrow_box" onclick="invisble()">
       <div>Hi! Dear </div>
       <div>Tip:</div>
       <div>you can send messages Here  <?php //echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/email.png"))   ?> </div>
   </div> -->


<div id='organizerReport'>

    <?php
    $this->widget(
            'chartjs.widgets.ChBars', array(
        'width' => 750,
        'height' => 250,
        'htmlOptions' => array(),
        'labels' => array("Total Volunteers", "Volunteers w/ Projects", "Volunteers w/o Projects", "Active Volunteers"),
        'datasets' => array(
            array(
                "fillColor" => "#f14c49",
                "strokeColor" => "rgba(220,220,220,1)",
                "data" => $SystemData,
            )
        ),
        'options' => array()
            )
    );
    ?>

</div>


<div id='projectsList'>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'table',
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'selectableRows' => 1,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
        'htmlOptions' => array('style' => 'cursor: pointer;'),
        'selectionChanged' => 'clickedRow',
        'columns' => array(
            //array('name' => 'id', 'header' => 'ProjectID', 'type' => 'raw'),
            array('name' => 'projectName', 'header' => 'Project'),
            array('name' => 'startDate', 'header' => 'Start Date'),
            array('name' => 'endDate', 'header' => 'Target End Date'),
           // array('name' => 'actualEndDate', 'header' => 'Actual End Date'),
            array(
                'header' => 'Current Progress',
                'value' => function($data) {
            Controller::widget('bootstrap.widgets.TbProgress', array('percent' => calculateProjectProgress($data->id), 'type' => 'danger', 'striped' => true,
                'animated' => true,)
            );
        },
            ),
        ),
    ));
    ?>
</div>

<?php

function calculateProjectProgress($id) {
    $criteria = new CDbCriteria;
    $criteria->with = array(
        'role');
    $criteria->together = true;
    $criteria->condition = "role.projectId = :col_val";
    $criteria->params = array(':col_val' => $id);
    $tasks = Task::model()->findAll($criteria);

    $percentage = 0;
    
    if (count($tasks) > 0) {
        $totalPercentage = count($tasks) * 100;
        $progressPercentage = 0;

        foreach ($tasks as $task) {
            $progressPercentage += $task->completion;
        }
        
        $percentage = ($progressPercentage / $totalPercentage * 100);
    }
    
    return $percentage;
}
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/main', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>


<script>
    $("#topMenuLinkOrganizer").addClass("selectedTopMenuTab");
</script>

