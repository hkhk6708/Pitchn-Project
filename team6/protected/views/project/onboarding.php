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
        array('label' => 'Role Info', 'url' => array('onBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") == 'volunteer', 'active' => true),
        array('label' => 'Modify Info of the role', 'url' => array('modifyOnBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
        array('label' => 'Role Tasks', 'url' => array('roleView', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Contacts', 'url' => array('orgContacts', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
    ),
));
?>

<?php
$managerEmail = 'N/A';
$managerName = 'N/A';
$managerPhone = 'N/A';
if (!empty($patr)) {
    $managerEmail = $patr->email;
    $manager = Person::model()->findByAttributes(array('email' => $managerEmail));
    $managerName = $manager->name;
    $managerPhone = $manager->workPhone;
}
$userName = Yii::app()->user->getState('realName');
$role = Role::model()->findByPk($roleId);
$project = Project::model()->findByPk($id);
$orgId = $project->organizationId;
$org = Organization::model()->findByPK($orgId);
$orgName = $org->organizationName;
$orgWebsite = $org->website;
$orgPhone = $org->organizationPhone;
$text = "Hi, $userName ! Welcome to Project, $project->projectName. <br>"
        . "The goal of $project->projectName is to $project->projectDescription. <br>"
        . "Your role is $role->title. <br> "
        . "The purpose of this role is $role->roleDescription. <br>";
$text1 = "By clicking the 'Dcuments' tab on the left hand side, you will find any files you will need to bring you up to speed with $project->projectName. <br>"
        . "You should read these documents ASAP and read the other ones when you have time! Thank you. <br>";
$text3 = "These are your contacts for the following roles you are assigned to. <br> If you have any questions or other concerns, these are the people you should go to. <br>";
?>

<?php echo $text ?>

<br>

<h2>Documents:</h2>
<?php echo $text1 ?>

<br>

<h2>Contacts:</h2>
<?php echo $text3 ?>

<br>

<h4>Organization Contact Info:</h4>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => array('id' => 1, 'name' => $orgName, 'website' => $orgWebsite, 'phone' => $orgPhone),
    'attributes' => array(
        array('name' => 'name', 'label' => 'Organization Name'),
        array('name' => 'website', 'label' => 'Website'),
        array('name' => 'phone', 'label' => 'Organization Phone'),
    ),
));
?>

<h4>Project Contact Info:</h4>
<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => array('id' => 2,
        'pName' => $project->projectName,
        'pWebsite' => $project->projectWebsite,
        'pGeneral' => $managerName,
        'email' => $managerEmail,
        'phone' => $managerPhone,),
    'attributes' => array(
        array('name' => 'pName', 'label' => 'Project Name'),
        array('name' => 'pWebsite', 'label' => 'Project Website'),
        //array('name' => 'pGeneral', 'label' => "Manager's name"),
        array('value' => CHtml::link(CHtml::encode($managerName), CController::createUrl('message/create', array('receiver' => $managerEmail))), 'type' => 'raw', 'label' => "Manager's name"),
        //array('name' => 'email', 'label' => "Manager's email"),
        array('name' => 'phone', 'label' => "Manager's phone"),
    ),
));
?>

<h4>Other Contact Info:</h4>
<?php foreach ($orgContacts as $orgC): ?>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data' => array('id' => 2,
            'title' => $orgC->title,
            'name' => $orgC->email0->name,
            'phone' => $orgC->email0->workPhone,
        ),
        'attributes' => array(
            //array('name' => 'name', 'label' => 'Name'),
            array('value' => CHtml::link(CHtml::encode($orgC->email0->name), CController::createUrl('message/create', array('receiver' => $orgC->email))), 'type' => 'raw', 'label' => "Name"),
            array('name' => 'title', 'label' => "Contact's title"),
            array('name' => 'phone', 'label' => "Contact's phone"),
        ),
    ));
    ?>

    <div id="divider"></div>

<?php endforeach; ?>


<h2>Addtional Info from the organizer:</h2>
<?php echo $info ?>

<script>
      $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>
