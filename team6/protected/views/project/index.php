<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Projects',
);

$this->menu = array(
    array('label' => 'Create Project', 'url' => array('create')),
    array('label' => 'Manage Project', 'url' => array('admin')),
);
?>

<?php
$value = 50;
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
    'selectableRows' => 1,
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'enableSorting' => true,
    'selectionChanged' => 'clickedRow',
    'columns' => array(
        //array('name' => 'id', 'header' => 'ProjectID', 'type' => 'raw'),
        array('name' => 'projectName', 'header' => 'Project'),
        array('name' => 'startDate', 'header' => 'Start Date'),
        array('name' => 'endDate', 'header' => 'Target End Date'),
        array('name' => 'actualEndDate', 'header' => 'Actual End Date'),
        array('name'=>'status', 'header'=>'Project Status'),
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

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Create Project',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => array('project/create'),
    'visible' => Yii::app()->user->getState("type") != 'volunteer',
//    'style'=> "margin-left: 85%;margin-right: 0;"
));
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/main', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>

<script>
    $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>

<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
