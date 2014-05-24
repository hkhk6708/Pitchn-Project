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
        array('label' => 'Roles', 'url' => array('roles', 'id' => $id), 'active' => true),
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
    'selectionChanged' => 'clickedRow',
    'columns' => array(
        //array('name' => 'id', 'header' => 'Role ID', 'type' => 'raw'),
        array('name' => 'title', 'header' => "Role"),
        array('name' => 'roleDescription', 'header' => "Description"),
        //array('name' => 'pid', 'header' => 'Person ID'),
        //array('name' => 'pname', 'header' => 'Assigned To:'),
        array('value' => 'CHtml::link(CHtml::encode($data["pname"]), array("person/view", "id" => $data["pid"]))', 'type' => 'raw', 'header' => "Assigned To", 'visible' => Yii::app()->user->getState("type") != "volunteer"),
        // array('name' => 'email', 'header' => "Email"),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'header' => 'Assign/Remove',
            'template' => '{b1}{b2}',
            'visible' => Yii::app()->user->getState("type") != "volunteer",
            'buttons' => array(
                'b2' => array(
                    'label' => 'Assign',
                    'url' => 'Yii::app()->createUrl("Person/search", array("projectAssignId" => Yii::app()->request->getParam("id")))',
                    'visible' => '$data["patrId"]==NULL',
                ),
                'b1' => array(
                    'label' => 'remove',
                    'url' => 'Yii::app()->createUrl("/personAssignedToRole/delete2", array("id"=>$data["patrId"],"projectId" => Yii::app()->request->getParam("id")))',
                    'visible' => '$data["patrId"]!=NULL && $data["title"]!="general"',
                    'options' => array('onclick' => 'return confirm("Are you sure to remove the person who is assigend?")'),
                ),
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'header' => 'Edit Role',
            'template' => '{b3}',
            'visible' => Yii::app()->user->getState("type") != "volunteer",
            'buttons' => array(
                'b3' => array(
                    'label' => 'edit',
                    'url' => 'Yii::app()->createUrl("/role/updateWithPid", array("id"=>$data["id"],"projectId" => Yii::app()->request->getParam("id")))',
                    'visible' => '$data["title"]!="general"',
                ),
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'header' => 'Copy Role',
            'template' => '{b3}',
            'visible' => Yii::app()->user->getState("type") != "volunteer",
            'buttons' => array(
                'b3' => array(
                    'label' => 'copy',
                    'url' => 'Yii::app()->createUrl("/role/copyRole", array("id"=>$data["id"],"projectId" => Yii::app()->request->getParam("id")))',
                    'visible' => '$data["title"]!="general"',
                ),
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'visible' => Yii::app()->user->getState("type") != "volunteer",
            'buttons' => array(
                'delete' => array(
                    'label' => 'Delete Role',
                    'url' => 'Yii::app()->createUrl("project/deleteRole", array("id"=>$data["id"]))',
                    'visible' => '$data["title"]!="general"',
                ),
            ),
        ),
    ),
));
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/roleView', array('id' => $id, 'roleId' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>


<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Add Role',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => array('role/createWithPid', 'projectId' => Yii::app()->request->getParam('id')),
    'visible' => Yii::app()->user->getState("type") != 'volunteer',
//    'style'=> "margin-left: 85%;margin-right: 0;"
));
?>

<?php /*
  'url' => 'Yii::app()->createUrl("personAssignedToRole/createById", array("roleId"=>$data["id"]))',
  'visible' => '$data["pname"]==NULL', */
?>

<?php
/*
  echo CHtml::linkButton('Delete',array(
  'submit'=>array('/personAssignedToRole/delete2','id'=>26),
  'confirm'=>"Are you sure to delete this post?",
  )); */
//array("roleId"=>$data["id"],"projectId" => Yii::app()->request->getParam('id'))
?>

<script>
    $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
