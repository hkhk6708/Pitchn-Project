<?php
/* @var $this CalendarController */
/* @var $freeTimes Events */
/* @var $person Person */

$this->breadcrumbs = array(
    'Calendar' => array('index'),
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/datetimepicker/jquery.datetimepicker.css"/>
</html>

<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/datetimepicker/jquery.datetimepicker.js');
?>

<?php
$calendarEditable = false;
$calendarSelectable = false;
$calendarUnselectAuto = false;

if ($editable == "true") {
    $calendarEditable = true;
    $calendarSelectable = true;
    $calendarUnselectAuto = true;
}

$this->widget('ext.EFullCalendar.EFullCalendar', array(
    'id' => "calendar",
    'themeCssFile' => 'cupertino/theme.css',
    'options' => array(
        'header' => array(
            'left' => 'prev,next,today',
            'center' => 'title',
            'right' => 'agendaWeek, month',
        ),
        'timeFormat' => 'H:mm { - H:mm}',
        'lazyFetching' => true,
//        'events' => 'js:fetchDBEvents',
        'eventSources' => array('js:fetchDBEvents', 'js:fetchProjectEvents', 'js:fetchTaskEvents'),
        'eventClick' => 'js:eventEdit',
        'defaultView' => 'month',
        'editable' => $calendarEditable,
        'selectable' => $calendarSelectable,
        'select' => 'js:eventSelectAdd',
        'unselectAuto' => $calendarUnselectAuto,
        'eventDrop' => 'js:eventMoveEvent',
        'eventResize' => 'js:eventResizeEvent',
)));
?>

<div id="eventDialog">
</div>

<script>
    var viewingEvent;
    $('#eventDialog').dialog();
    $('#eventDialog').dialog("close");
    
    var editable = <?php echo $editable ?>;
    
    if (editable) {
    $('#calendar').css("cursor", "pointer");
    }
    
    $('.ui-dialog-titlebar-close').click(function() {
        if (viewingEvent != null) {
            var recurringEvents = $('#calendar').fullCalendar( 'clientEvents', viewingEvent.id); 
            for (var i = 0; i < recurringEvents.length; i++) {
                recurringEvents[i].className = 'availableEvent';
                $('#calendar').fullCalendar('updateEvent', recurringEvents[i]);
            }
        }
    });
</script>

<script>
    function eventEdit(event, eventElement) {
        if (editable && event.editable != false) {
            var model = JSON.parse(event.model);
            event.className = 'selectedAvailableEvent',
            $('#calendar').fullCalendar('updateEvent', event);
            viewingEvent = event;
            $.ajax({
                type: 'GET',
                url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/update"); ?>',
                data: {id: model.id},
                success: function(data) {
                    document.getElementById('eventDialog').innerHTML = data;
                    $('#eventDialog').dialog({
                        title: "Update",
                        resizable: false,
                        width: 400,
                        open: function(event, ui) {
                            $('#FreeTime_recurring_0').blur();
                        },
                        close: function(event, ui) {
                            $('#calendar').fullCalendar('unselect');
                        }
                    });
                    $('#FreeTime_startDate').datepicker({
                        dateFormat: 'yy-mm-dd',
                        startDate: '1900-1-1',
                        endDate: '2100-1-1',
                    });
                    $('#FreeTime_endDate').datepicker({
                        dateFormat: 'yy-mm-dd',
                        startDate: '1900-1-1',
                        endDate: '2100-1-1',
                    });
                    $('#FreeTime_startTime').datetimepicker({
                        datepicker:false,
                        format: 'H:i:s',
                        step: 15
                    });
                    $('#FreeTime_endTime').datetimepicker({
                        datepicker:false,
                        format: 'H:i:s',
                        step: 15
                    });
                },
                error: function(data) { // if error occured
                    alert("Error retrieving free time data!");
                    alert(data);
                },
                dataType: 'html'
            });
        }
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

    function eventSelectAdd(startDate, endDate, allDay, jsEvent, view) {

        var start = parseDate(startDate);
        var end = parseDate(endDate);
        $('#calendar').css("cursor", "wait");

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/create"); ?>',
            data: {id: <?php echo $person->id; ?>, startDate: start.date, startTime: start.time, endDate: end.date, endTime: end.time},
            success: function(data) {
                document.getElementById('eventDialog').innerHTML = data;
                $('#calendar').css("cursor", "pointer");
                $('#eventDialog').dialog({
                    title: "Create",
                    //modal: true,
                    resizable: false,
                    width: 400,
                    open: function(event, ui) {
                        $('#FreeTime_recurring_0').blur();
                    },
                    close: function(event, ui) {
                        $('#calendar').fullCalendar('unselect');
                    }
                });
                $('#FreeTime_startDate').datepicker({
                    dateFormat: 'yy-mm-dd',
                    startDate: '1900-1-1',
                    endDate: '2100-1-1',
                });
                $('#FreeTime_endDate').datepicker({
                    dateFormat: 'yy-mm-dd',
                    startDate: '1900-1-1',
                    endDate: '2100-1-1',
                });
                $('#FreeTime_startTime').datetimepicker({
                    datepicker:false,
                    format: 'H:i:s',
                    step: 15
                });
                $('#FreeTime_endTime').datetimepicker({
                    datepicker:false,
                    format: 'H:i:s',
                    step: 15
                });
            },
            error: function(data) { // if error occured
                alert("Error retrieving data!");
                alert(data);
            },
            dataType: 'html'
        });
    }
    
    function eventMoveEvent(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view) { 
        var model = JSON.parse(event.model);
        $('#calendar').css("cursor", "wait");
        updateEventAllDay(event);
        
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/moveFreeTime"); ?>',
            data: {id: model.id, dayDelta: dayDelta, minuteDelta: minuteDelta},
            success: function(data) {
                $('#calendar').css("cursor", "pointer");
                updateFlashMessage(data);
                moveResizeRefetch(event, view);
            },
            error: function(data) {
                alert("Error retrieving data!");
                alert(data);
                revertFunc();
            },
            dataType: 'html'
        });
        
    }
    
    function eventResizeEvent( event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view ) { 
        var model = JSON.parse(event.model);
        $('#calendar').css("cursor", "wait");
        updateEventAllDay(event);
        
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/resizeFreeTime"); ?>',
            data: {id: model.id, dayDelta: dayDelta, minuteDelta: minuteDelta},
            success: function(data) {
                $('#calendar').css("cursor", "pointer");
                updateFlashMessage(data);
                moveResizeRefetch(event, view);
            },
            error: function(data) {
                alert("Error retrieving data!");
                alert(data);
                revertFunc();
            },
            dataType: 'html'
        });
    }
    
    function updateFlashMessage(msg) {
        $('#flash').html(msg).fadeIn().delay(2000).fadeOut();
    }
    
    function moveResizeRefetch(event, view) {
        if ((event.rtag === "(D)" || event.rtag === "(W)" || event.rtag === "(M)") && (view.name == "month" || view.name == "agendaWeek")) {
            $('#calendar').fullCalendar( 'refetchEvents' );
        }
    }
    
    function updateEventAllDay(event) {
        if (event.start.getMinutes() === 0 &&
                event.start.getHours() === 0 &&
                    event.end.getMinutes() === 59 &&
                        event.end.getHours() === 23) {
           event.allDay = true;
           event.title = "All Day Available " + event.rtag;
       } else {
           event.allDay = false;
           event.title = " Available " + event.rtag;    
       }
       
       $('#calendar').fullCalendar('updateEvent', event);
    }
    
    function fetchDBEvents(start, end, callback) {
        $('#calendar').css("cursor", "wait");
        var parsedStart = parseDate(start);
        var parsedEnd = parseDate(end);

        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Calendar/FetchFreeTimeData"); ?>',
            data: {id: <?php echo $person->id; ?>, startDate: parsedStart.date, startTime: parsedStart.time, endDate: parsedEnd.date, endTime: parsedEnd.time},
            success: function(data) {
                if (editable) {
                    $('#calendar').css("cursor", "pointer");
                } else {
                    $('#calendar').css("cursor", "default");
                }
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
                if (editable) {
                    $('#calendar').css("cursor", "pointer");
                } else {
                    $('#calendar').css("cursor", "default");
                }
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
                if (editable) {
                    $('#calendar').css("cursor", "pointer");
                } else {
                    $('#calendar').css("cursor", "default");
                }
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
</script>

<script>
      $("#bottomMenuLinkVolunteer").addClass("selectedBottomMenuTab");
</script>

<script>
    $("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>
