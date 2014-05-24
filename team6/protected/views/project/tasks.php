<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Main', 'url' => array('main', 'id' => $id),),
        array('label' => "Team", 'url' => array('team', 'id' => $id), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
        array('label' => 'Roles', 'url' => array('roles', 'id' => $id)),
        array('label' => 'Documents', 'url' => array('documents', 'id' => $id)),
        //array('label' => 'Onboarding', 'url' => array('onboarding','id'=>$id)),
        array('label' => 'Tasks', 'url' => array('tasks', 'id' => $id), 'active' => true, 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
    ),
));
?>

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
        // array('name' => 'id', 'header' => 'Task ID', 'type' => 'raw'),
        array('name' => 'taskName', 'header' => 'Task'),
        array('name' => 'status', 'header' => 'Status'),
        array('name' => 'endDate', 'header' => 'Due Date'),
    //array(
    //    'class' => 'bootstrap.widgets.TbButtonColumn',
    //    'template' => '{view}{update} {delete}',
    //),
    ),
));
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/taskView', array('id' => $id, 'taskId' => '')) ?>";
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
