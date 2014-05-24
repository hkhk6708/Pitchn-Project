<?php
/* @var $this UserAccountController */

$this->breadcrumbs = array(
    'Person',
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>



<div id="profilebuttons">

    <div id="profilebutton">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Create Note',
            'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'normal', // null, 'large', 'small' or 'mini'
//    'url' => array('volunteerNote/create'),
            'url' => $this->createUrl('volunteerNote/create', array('id' => $model->id, 'name' => $model->name)),
            'visible' => Yii::app()->user->getState("type") != 'volunteer',
                //    'style'=> "margin-left: 85%;margin-right: 0;"
        ));
        ?>
    </div>





    <div id ="profilebutton">
        <?php
        if (Yii::app()->user->getState("type") === 'administrator') {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Change Password',
                //'url' => array('person/changePassword', array('id'=>  Yii::app()->user->getState('userId'))),
                'url' => $this->createUrl('person/changePassword', array('id' => $model->id)),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
        }
        ?>
    </div>

    <div id="profilebutton">
        <?php
        if (Yii::app()->user->getState("type") === 'administrator') {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Advanced Settings',
                'url' => Yii::app()->urlManager->createUrl('person/advancedUpdate', array('id' => $model->id)),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
        }
        ?>
    </div>


    <div id ="profilebutton">
        <?php
        if ((Yii::app()->user->getState("type") === 'administrator')) {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Edit Profile',
                'url' => $this->createUrl('person/update', array('id' => $model->id)),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
        }
        ?>
    </div>


    <div id ="profilebutton">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Send Message',
            'url' => $this->createUrl('message/create', array('receiver' => $model->email)),
            'htmlOptions' => array('class' => 'btn btn-danger'),
                )
        );
        ?>
    </div>

    <div id="profilebutton" class="calendar">
        <a type="LinkButton" name="create" id="create" data-toggle="tooltip" data-original-title="View Calendar" class="btn btn-danger" href=<?php echo Yii::app()->urlManager->createUrl("calendar/view", array("id" => $model->id)) ?>>
            <i class="icon icon-calendar icon-white"></i>
        </a>
    </div>


    <div id="profileclear"></div>


</div>




<div id="divider"></div>

<div id="profilebody">

    <div id="profile" class="left">

        <div id="profilerow"><p class="profile">
                <b>Skills:</b> 
                <?php
                $skillString = $skill->getSelectedSkillString('', ', ');
                echo ""
                . "$skillString";
                ?></p>
        </div>

        <div id="profilerow"><p class="profile">
                <b>Phone:</b> 
                <?php echo "$model->phone"; ?></p>
        </div>

        <div id="profilerow"><p class="profile">
                <b>Work Phone:</b> 
                <?php echo "$model->workPhone"; ?></p>
        </div>


        <div id="profilerow"><p class="profile">
                <b>Languages:</b> 
                <?php
                $stringArray = explode(",", $model->language);
                $languageString = implode(", ", $stringArray);
                echo "$languageString";
                ?><p>
        </div>

        <div id="profilerow"><p class="profile">
                <b>City:</b> 
                <?php echo "$model->locationCity"; ?></p>
        </div>


        <div id="profilerow"><p class="profile">
                <b>Province:</b> 
                <?php echo "$model->locationProvince"; ?></p>
        </div>


        <div id="profilerow"><p class="profile">
                <b>Country:</b> 
                <?php echo "$model->locationCountry"; ?></p>
        </div>


        <div id="profilerow"><p class="profile">
                <b>Causes:</b> 
                <?php
                $causeString = $cause->getSelectedCauseString('', ', ');
                echo "$causeString";
                ?></p>
        </div>
        <div id="profilerow"><p class="profile">
                <b>Birthdate:</b> 
                <?php echo "$model->birthdate"; ?></p>
        </div>
        <div id="profilerow"><p class="profile">
                <b>Active User?:</b> 
                <?php
                echo "$model->active";
                if ($model->active == 'Y') {
                    echo '<br><br> <b>Last Active:</b> ' . $model->lastActive;
                }
                ?>



            </p>
        </div>



    </div>

    <div id="profile" class="center">
        <div id="profilerow"><p class="profile">
                <b>Additional Info:</b></p>
        </div>
        <div class="profilerow"><p class="profile">
            <p><?php echo $model->description; ?></p>
        </div>
    </div>

    <div id="profile" class="right">
        <div id="profilepic">
            <?php
            if ($userImage != NULL) {
                //echo CHtml::image(Yii::app()->baseUrl . '/userImages/' . Yii::app()->user->getState('userId') . "/" . $userImage->filename);
                echo CHtml::image(Yii::app()->baseUrl . '/userImages/' . $userImage->email . "/" . $userImage->filename, "", array('width' => "100%"));
            } else {
                echo CHtml::image(Yii::app()->baseUrl . '/images/person_blank.png');
            }
            ?>
        </div>
    </div>


    <div id="profileclear"></div>

</div>


<div id="profilesubheader" >
    <h3>Organizer Notes:</h3>
</div>
<div>

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
            //array('name' => 'organizerEmail', 'header' => 'Added By:'),
            array('value' => '$data->organizerEmail0->name', 'header' => 'Added By:'),
            array('name' => 'content', 'header' => 'Content'),
            array('name' => 'dateTime', 'header' => 'Date/Time'),
//    array(
//    'class' => 'bootstrap.widgets.TbButtonColumn',
//    'template' => '{update} {delete}' //removed {view}
//    ),
        ),
    ));
    ?>

</div>


</div>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('volunteerNote/view', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>


<script>
    $("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
    $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>
