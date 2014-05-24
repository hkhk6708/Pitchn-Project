<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialogstyle.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/popUp.css" />
</head>

<script type="text/javascript">
    //function invisble() {
    //  document.getElementById("arrow_box").style.display = 'none';
    //}
</script>

<script>
 
      $("#topMenuLinkVolunteer").addClass("selectedTopMenuTab");
 
</script>

<!--<div id="arrow_box" onclick="invisble()">
    <div>Hi! Dear </div>
    <div>Tip:</div>
    <div>you can send messages Here  <?php //echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/email.png"))      ?> </div>
</div> -->


<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<div id="dashtop">

<div id='calendarMini'>
    <?php
    $this->widget('ext.EFullCalendar.EFullCalendar', array(
        'id' => "calendar",
        'themeCssFile' => 'cupertino/jquery-ui.min.css',
        'options' => array(
            'header' => array(
                'left' => 'prev,next,today',
                'center' => 'title',
                'right' => 'agendaDay, agendaWeek',
            ),
            'timeFormat' => 'H:mm { - H:mm}',
            'titleFormat' => array(
                'week' => "",
                'day' => ""),
            'lazyFetching' => true,
//            'events' => 'js:fetchDBEvents',
            'eventSources' => array('js:fetchDBEvents', 'js:fetchProjectEvents', 'js:fetchTaskEvents'),
            'defaultView' => 'agendaWeek',
//            'editable' => true,
//            'selectable' => true,
            'unselectAuto' => false,
    )));
    ?>
</div>


<div id='taskMini'>
    <h3 class="dash">My Tasks</h3> 
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'taskTable',
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider2,
        'selectableRows' => 1,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
        'htmlOptions' => array('style' => 'cursor: pointer;'),
        'selectionChanged' => 'clickedTaskRow',
        'columns' => array(
            array('name' => 'id', 'header' => 'taskId', 'visible' => false),
            array('name' => 'role.project.projectName', 'header' => 'Project'),
            array('name' => 'taskName', 'header' => 'Task'),
            array('name' => 'status', 'header' => 'Status'),
            array('name' => 'endDate', 'header' => 'Due Date'),
//            array(
//                'class' => 'bootstrap.widgets.TbButtonColumn',
//                //'header' => 'View',
//                'template' => '{b3}',
//                'buttons' => array(
//                    'b3' => array(
//                        'label' => 'view',
//                        'url' => 'Yii::app()->createUrl("/project/taskView", array("id"=>getProjectId($data["id"]),"taskId" => $data["id"]))',
//                    ),
//                ),
//            ),
        ),
    ));
    ?>

</div>
    <div id="dashclear"></div>
</div>

<div id="dashtop">
    

<div id='projects'>
    <h3 class="dash">My Projects</h3>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'projectTable',
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'selectableRows' => 1,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
        'htmlOptions' => array('style' => 'cursor: pointer;'),
        'selectionChanged' => 'clickedProjectRow',
        'columns' => array(
            array('name' => 'id', 'header' => 'ProjectID', 'visible' => false),
            array('name' => 'projectName', 'header' => 'Project'),
            array('name' => 'startDate', 'header' => 'From:'),
            array('name' => 'endDate', 'header' => 'To:'),
//            array(
//                'class' => 'bootstrap.widgets.TbButtonColumn',
//                //'header' => 'View',
//                'template' => '{b3}',
//                'buttons' => array(
//                    'b3' => array(
//                        'label' => 'view',
//                        'url' => 'Yii::app()->createUrl("/project/main", array("id"=>$data["id"]))',
//                    ),
//                ),
//            ),
        ),
    ));
    ?>

</div >







<div id='contactInfo'>
    <h3 class="dash"> Contact Info</h3>
    <?php
//    $this->widget('bootstrap.widgets.TbDetailView', array(
//        'data' => array('id' => 1, 'name' => $orgName, 'website' => $orgWebsite, 'phone' => $orgPhone),
//        'cssFile' => Yii::app()->baseUrl . '/css/detailView.css',
//        'attributes' => array(
//            array('name' => 'name', 'label' => 'Organization Name'),
//            array('name' => 'website', 'label' => 'Website'),
//            array('name' => 'phone', 'label' => 'Organization Phone'),
//        ),
//    ));
    ?>
    
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'orgContactTable',
        'type' => 'striped bordered condensed',
        'dataProvider' => $orgContacts,
        'selectableRows' => 1,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
        'htmlOptions' => array('style' => 'cursor: pointer;'),
        'selectionChanged' => 'openMsgDialog',
        'enableSorting' => false,
        'columns' => array(
            array('name' => 'role.title', 'header' => 'For Role:'),
            array('name' => 'title', 'header' => 'Contact Title'),
            //array('name' => 'email0.phone', 'header' => 'Phone #'),
            array('name' => 'email0.workPhone', 'header' => 'Work Phone #'),
        ),
    ));
    ?>

</div>
<div id="dashclear"></div>
</div>

<div id="messageDialogSearch"></div>


<script>
    function fetchDBEvents(start, end, callback) {
        $('#calendar').css("cursor", "wait");
        var parsedStart = parseDate(start);
        var parsedEnd = parseDate(end);

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/FetchFreeTimeData"); ?>',
            data: {id: <?php echo $person->id; ?>, startDate: parsedStart.date, startTime: parsedStart.time, endDate: parsedEnd.date, endTime: parsedEnd.time},
            success: function(data) {
                $('#calendar').css("cursor", "default");
                var events = data;
                callback(events);
            },
            error: function(data) {
                //alert("Error retrieving data!");
                //alert(data);
            },
            dataType: 'json'
        });
    }
    
        function fetchProjectEvents(start, end, callback) {
        $('#calendar').css("cursor", "wait");
        var parsedStart = parseDate(start);
        var parsedEnd = parseDate(end);

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/FetchProjectEndData"); ?>',
            data: {id: <?php echo $person->id; ?>, startDate: parsedStart.date, startTime: parsedStart.time, endDate: parsedEnd.date, endTime: parsedEnd.time},
            success: function(data) {
                $('#calendar').css("cursor", "default");
                var events = data;
                callback(events);
            },
            error: function(data) {
                //alert("Error retrieving data!");
                //alert(data);
            },
            dataType: 'json'
        });
    }
    
    function fetchTaskEvents(start, end, callback) {
        $('#calendar').css("cursor", "wait");
        var parsedStart = parseDate(start);
        var parsedEnd = parseDate(end);

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/FetchTaskEndData"); ?>',
            data: {id: <?php echo $person->id; ?>, startDate: parsedStart.date, startTime: parsedStart.time, endDate: parsedEnd.date, endTime: parsedEnd.time},
            success: function(data) {
                $('#calendar').css("cursor", "default");
                var events = data;
                callback(events);
            },
            error: function(data) {
                //alert("Error retrieving data!");
                //alert(data);
            },
            dataType: 'json'
        });
    }

    function parseDate(date) {
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hour = date.getHours();
        var min = date.getMinutes();

        if (month + 1 <= 10) {
            month = "0" + month;
        }

        if (day + 1 <= 10) {
            day = "0" + day;
        }

        if (hour + 1 <= 10) {
            hour = "0" + hour;
        }

        if (min + 1 <= 10) {
            min = "0" + min;
        }

        var selectedTime = hour + ":" + min + ":00";
        var selectedDate = date.getFullYear() + "-" + month + "-" + day;

        var parsedDate = new Object();
        parsedDate.date = selectedDate;
        parsedDate.time = selectedTime;

        return parsedDate;
    }
</script>

<script>

    var messageDialog = $('#messageDialogSearch').dialog();
    $('#messageDialogSearch').dialog("close");
    messageDialog.dialog("widget").css("opacity", "0");
    
    messageDialog.dialog("widget").bind('dialogclose', function(event) {
     messageDialog.dialog("widget").css("opacity", "0");
    });
    
   function openMsgDialog(id) {
        var pid = $.fn.yiiGridView.getSelection(id);
        $.fn.yiiGridView.update(id);
        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Message/ajaxCreate"); ?>',
            data: {contact: pid},
            success: function(data) {
                $("#messageDialogSearch").html(data);
//                document.getElementById("messageDialogSearch").innerHTML = data;
                messageDialog = $('#messageDialogSearch').dialog({
                    title: "Message",
                    resizable: false,
                    width: 600,
                    dialogClass:"dialogstyle",
                });

                messageDialog.dialog("widget").animate({opacity: 1}, {duration: "fast"});
//                messageDialog.dialog("widget").fadeIn("fast");
                $("#recipients").select2({width: "488px"}).select2("val", preSelect);
            },
            error: function(data) { // if error occured
                alert("Error retrieving data!");
                alert(data);
            },
        });
    };
</script>


<script type="text/javascript">
    function clickedProjectRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/main', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>

<script type="text/javascript">
    function clickedTaskRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('project/taskDirect', array('taskId' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
    
</script>


<?php

function getProjectId($taskId) {
    $task = Task::model()->findByPk($taskId);
    $roleId = $task->roleId;
    $role = Role::Model()->findByPk($roleId);
    $projectId = $role->projectId;
    return $projectId;
}