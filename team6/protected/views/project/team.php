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
        array('label' => "Team", 'url' => array('team', 'id' => $id), 'visible' => Yii::app()->user->getState("type") == 'volunteer', 'active' => TRUE),
        array('label' => 'Roles', 'url' => array('roles', 'id' => $id),),
        array('label' => 'Documents', 'url' => array('documents', 'id' => $id)),
        //array('label' => 'Onboarding', 'url' => array('onboarding', 'id' => $id)),
        array('label' => 'Tasks', 'url' => array('tasks', 'id' => $id), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
    ),
));
?>

<?php
/*
  $this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $dataProvider,
  )); */
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
    'columns' => array(
        //array('name' => 'id', 'header' => 'Role ID', 'type' => 'raw'),
        array('name' => 'title', 'header' => "Role"),
        array('name' => 'roleDescription', 'header' => "Description"),
        //array('name' => 'pid', 'header' => 'Person ID'),
        //array('name' => 'pname', 'header' => 'Assigned To:'),
        array('value' => 'CHtml::link(CHtml::encode($data["pname"]), array("message/create", "receiver" => $data["email"]))', 'type' => 'raw', 'header' => "Team member"),
    ),
));
?>

<script>
    $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
