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

<div id="roleSubHeader">
    <p class="rolepath"><span><?php echo Yii::app()->user->getState('projectTitle'); ?></p>
    <?php Yii::app()->user->setState('projectTitle', ''); ?></span></p>
</div>
<div id="profileclear">

</div>
<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Role Documents', 'url' => array('roleDocuments', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Info', 'url' => array('onBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
        array('label' => 'Modify Role Info', 'url' => array('modifyOnBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
        array('label' => 'Role Tasks', 'url' => array('roleView', 'id' => $id, 'roleId' => $roleId), 'active' => true),
        array('label' => 'Role Contacts', 'url' => array('orgContacts', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
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
        //array('name' => 'id', 'header' => 'Task ID', 'type' => 'raw'),
        array('name' => 'taskName', 'header' => 'Task'),
        array('name' => 'status', 'header' => 'Status'),
        array('name' => 'endDate', 'header' => 'Due Date'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'visible' => Yii::app()->user->getState("type") != "volunteer",
            'buttons' => array(
                'delete' => array(
                    'label' => 'Remove Task',
                    'url' => 'Yii::app()->createUrl("project/deleteTask", array("id"=>$data->id))',
                ),
            ),
        ),
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

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Add Task',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => array('task/createWithRid', 'projectId' => Yii::app()->request->getParam('id'), 'roleId' => Yii::app()->request->getParam('roleId')),
    'visible' => Yii::app()->user->getState("type") != 'volunteer',
//    'style'=> "margin-left: 85%;margin-right: 0;"
));
?>

<script>
    $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
