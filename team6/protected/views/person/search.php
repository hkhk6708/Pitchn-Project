<?php
/* @var $this PersonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Search',
);
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialogstyle.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/select2/select2.css"/>
</html>

<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/select2/select2.js');
?>

<div class="search">
    
<div class="searchBox">
    
<button type="button" name="search" class="expander btn btn-danger">
   <i class="icon icon-search icon-white"></i>
</button>

<div class="expandContent">
<?php
$this->renderPartial('_search', array(
    'person' => $person,
    'skill' => $skill,
    'cause' => $cause,
    'freeTime' => $freeTime,
    'orgProjects' => $orgProjects,
));
?>
</div>
    
</div>

<div id="searchResults">
<?php
$this->renderPartial('_ajaxSearchTable', array(
    'data' => $data,
    'organization' => $organization,
));
?>
</div>
    
<div id="messageDialogSearch"></div>

</div>

<script>
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('person/view', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }

    $( ".expandContent" ).css('display', "none");
    $( ".expandContent" ).css('opacity', 0);

    $( ".expander" ).click(function() {
        if ($( ".expandContent" ).is(':visible')) {
            $( ".expandContent" ).slideUp("fast").animate({opacity:0},{queue: false, duration: "fast"});
            autoHideSearch = false;
        } else {
            $( ".expandContent" ).slideDown("fast").animate({opacity:1},{queue: false, duration: "fast"});
            autoHideSearch = true;
        }
    });
    
    $( "#Search" ).click(function() {
        $('#content').css("cursor", "wait");
    });
</script>

<script>

    var messageDialog = $('#messageDialogSearch').dialog();
    $('#messageDialogSearch').dialog("close");
    messageDialog.dialog("widget").css("opacity", "0");
    
    messageDialog.dialog("widget").bind('dialogclose', function(event) {
     messageDialog.dialog("widget").css("opacity", "0");
    });

    $(document).on('click', '#msg', function() {
        var ids = $.fn.yiiGridView.getChecked("searchTable","checkBoxes");

        if (ids == "") {
            ids = new Array(null);
        }
        
        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("Message/ajaxCreate"); ?>',
            data: {},
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
                $("#recipients").select2({width: "488px"}).select2("val", ids);
            },
            error: function(data) { // if error occured
                alert("Error retrieving data!");
                alert(data);
            },
        });
    });
</script>

<script>
    
document.getElementById("projectSelectSearch").value = <?php echo $defaultProjectSelected ?>;    
var projectSelected = $("#projectSelectSearch").val();

$(document).on('change', "#projectSelectSearch", function() {
    projectSelected = $("#projectSelectSearch").val();
//    var rolesLoad = [12]; 
//    $(":input[name^='assignRole']").each(function(){
//        var id=$(this).attr('personid');
//     $(this).select().select2("val",[id]);
//});

initializeRoleSelectors(new Array(projectSelected));
//if (projectSelected == "") {
//$(":input[name^='assignRole']").select2("enable",false);
//}
});

var allProjectsInOrg = new Array();
var projectDropDown = document.getElementById('projectSelectSearch');
for (i = 1; i < projectDropDown.options.length; i++) {
        allProjectsInOrg[i-1] = projectDropDown.options[i].value;
}
//alert(allProjectsInOrg);
function initializeRoleSelectors($projectid) {
    $(":input[name^='assignRole']").off("select2-selecting");
    $(":input[name^='assignRole']").select2('destroy');
    $(":input[name^='assignRole']").select2({
//        placeholder: "Assign Role(s)",
        width: "100%",
        multiple: true,
         ajax: {
                type: 'GET',
                url: '<?php echo Yii::app()->createAbsoluteUrl("Project/fetchAvailableRoles"); ?>',
                dataType: 'json',
                data: function (id) {
                    return {
                        id: $projectid
                    };
                },
                results: function (data) {
                    var checkedData = [];
                        for (var i = 0; i < data.length; i++) { 
                            //if (data[i].text !== "general") {
                            //    checkedData.push({id: data[i].id, text: data[i].text, locked: true});
                            //} else {
                                checkedData.push({id: data[i].id, text: data[i].text, locked: true});
                            //}
                        }
                    return {results: checkedData};
                }
    //            success: function(data) {
    //                $("#messageDialogSearch").html(data);
    ////                document.getElementById("messageDialogSearch").innerHTML = data;
    //                messageDialog = $('#messageDialogSearch').dialog({
    //                    title: "Message",
    //                    resizable: false,
    //                    width: 600,
    //                    dialogClass:"dialogstyle",
    //                });
    //                messageDialog.dialog("widget").animate({opacity: 1}, {duration: "fast"});
    ////                messageDialog.dialog("widget").fadeIn("fast");
    //                $("#recipients").select2({width: "488px"}).select2("val", ids);
    //            },
    //            error: function(data) { // if error occured
    //                alert("Error retrieving data!");
    //                alert(data);
    //            },
            },
            initSelection: function (element, callback) {
                
                if ($projectid == "") {
                    $projectid = allProjectsInOrg;
                }
                var id=$(element).attr('personid');
//                alert(id);
                if (id!=="") {
                    $.ajax({
                        url:'<?php echo Yii::app()->createAbsoluteUrl("Project/fetchAssignedRoles"); ?>',
                        data: {
                            projectid: $projectid,
                            personid: id
                        },
                        dataType: "json"
                    }).done(function(data) { 
                        //alert(data[0].text);
                        var checkedData = [];
                        for (var i = 0; i < data.length; i++) { 
                            //if (data[i].text !== "general") {
                            //    checkedData.push({id: data[i].id, text: data[i].text, locked: true});
                            //} else {
                                checkedData.push({id: data[i].id, text: data[i].text, locked: true});
                            //}
                        }
                        callback(checkedData); 
                    });
                }
//                    var data = [];
//                    
//                    $(element.val().split(",")).each(function () {
//                        alert(this);
//                        data.push({id: this, text: this});
//                    });
//                    callback(data);
//                }
            }
    });
    if (projectSelected == "") {
    $(":input[name^='assignRole']").select2("enable",false);
    } else {
    $(":input[name^='assignRole']").select2("enable",true);
    }
    
    $(":input[name^='assignRole']").on("select2-selecting", function(e) { 

    $.ajax({
              type: 'POST',
              url: '<?php echo Yii::app()->createAbsoluteUrl("personAssignedToRole/ajaxCreate"); ?>',
              data: {roleId: e.val, personId: $(this).attr('personid')},
              success: function(data) {
                  updateFlashMessage(data);
              },
              error: function(data) { // if error occured
                  alert("Error Assigning Role!");
                  alert(data);
              },
          });
  });

}
    
initializeRoleSelectors(new Array(projectSelected));


//$(":input[name^='assignRole']").on("change", function(event)
//{
//    if(event.removed)
//    {
//        if (confirm("Are you sure?")) {
//            alert(event.removed.id);
//        } else {
//            event.removed.preventDefault();
//        }
//    }
//});

//$(":input[name^='assignRole']").on("select2-removing", function(e) { 
//    alert("hey");
//});


function updateFlashMessage(msg) {
        $('#flash').html(msg).fadeIn().delay(2000).fadeOut();
    }
</script>

<script>
        var skillSelect = $('#skills');
$(skillSelect).select2({
    //data:[
<?php
/* $i = 0;
  $labels = $skill->attributeLabels();
  $numOfAttributes = count($labels);
  foreach ($labels as $label) {
  $i++;
  if ($i == 1 || $i == $numOfAttributes) {
  continue;
  }
  echo '{id:"'.$label.'",text:"'.$label.'"},';
  } */
?>
    //],
    tags:[ <?php echo $skill->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Select Skills",
    tokenSeparators: [","],
    initSelection: function (element, callback) {
var data = [];
$(element.val().split(",")).each(function () {
    data.push({id: this, text: this});
});
callback(data);
}
});
        
var causeSelect = $('#causes');
$(causeSelect).select2({
    //data:[
<?php
/* $i = 0;
  $labels = $cause->attributeLabels();
  $numOfAttributes = count($labels);
  foreach ($labels as $label) {
  $i++;
  if ($i == 1 || $i == $numOfAttributes) {
  continue;
  }
  echo '{id:"'.$label.'",text:"'.$label.'"},';
  } */
?>
    //],
    tags:[ <?php echo $cause->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Select Causes",
    tokenSeparators: [","],
    initSelection: function (element, callback) {
var data = [];
$(element.val().split(",")).each(function () {
    data.push({id: this, text: this});
});
callback(data);
}
});

var languageSelect = $('#Person_language');
$(languageSelect).select2({
    //data:[
<?php
/* $i = 0;
  $labels = $cause->attributeLabels();
  $numOfAttributes = count($labels);
  foreach ($labels as $label) {
  $i++;
  if ($i == 1 || $i == $numOfAttributes) {
  continue;
  }
  echo '{id:"'.$label.'",text:"'.$label.'"},';
  } */
?>
    //],
    tags:["English","Chinese","Japanese","Korean","French"],
    multiple: true,
    width: "300px",
    placeholder: "Select Languages",
    tokenSeparators: [","],
});

//var orgProjectSelect = $('#orgProjects');
//$(orgProjectSelect).select2({
//    ajax: {
//                type: 'GET',
//                url: '<?php echo Yii::app()->createAbsoluteUrl("Organization/fetchOrganizationProjects"); ?>',
//                dataType: 'json',
//                results: function (data) {
//                    return {results: data};
//                }
//            },
//    multiple: true,
//    width: "300px",
//    placeholder: "Select Projects",
//});
                     
jQuery(function($) {
 
var skillsLoad = [ <?php echo $skill->getSelectedSkillString('"', '",'); ?> ]; 
 
var causesLoad = [ <?php echo $cause->getSelectedCauseString('"', '",'); ?> ]; 

if (skillsLoad.length != 0) {
$('#skills').select2('val',skillsLoad);
}
  
if (causesLoad.length != 0) {
$('#causes').select2('val',causesLoad);
}

}); 
</script>

<script>
      $("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>
