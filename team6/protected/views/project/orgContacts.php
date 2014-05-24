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
        array('label' => 'Role Tasks', 'url' => array('roleView', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Contacts', 'url' => array('orgContacts', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer', 'active' => true),
    ),
));
?>

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
        //array('name' => 'id', 'header' => 'Org contant ID', 'type' => 'raw'),
        array('name' => 'email', 'header' => 'Email'),
        array('name' => 'title', 'header' => 'Title'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("orgContact/delete2", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Add new contact',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => array('orgContact/createWithRid', 'rId' => $roleId),
));
?>

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>

