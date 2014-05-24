<?php
/* @var $this OrganizaerController */

$this->breadcrumbs = array(
    'Organizaer' => array('/organizaer'),
    'ViewReports',
);


//$person_count = 0;
////$org_count = 0;
//$pwproject = 0;
//$pwoproject = 0;
//$activeUser = 0;
////$activeOrg = 0;
//$numProject = 0;
//$con = mysqli_connect("localhost", "root", "root", "pvms");

// Check connection
//if (mysqli_connect_errno()) {
//    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
//if (isset($_POST['submit'])) {
//    $selected_radio = $_POST['typereport'];
//    if ($selected_radio == 'nuser') {
//        $result = mysqli_query($con, "SELECT * FROM person");
//        $person_count = mysqli_num_rows($result);
//        $result = mysqli_query($con, "SELECT * FROM organization");
//        $org_count = mysqli_num_rows($result);
//    } else if ($selected_radio == 'norganization') {
//        $result = mysqli_query($con, "SELECT * FROM PersonAssignedToRole");
//        $pwproject = mysqli_num_rows($result);
//        $result = mysqli_query($con, "SELECT * FROM person");
//        $tmp = mysqli_num_rows($result);
//        $pwoproject = abs($pwproject - $tmp);
//    } else if ($selected_radio == 'svol') {
//        $result = mysqli_query($con, "SELECT * FROM person WHERE active = 'Y'");
//        $activeUser = mysqli_num_rows($result);
//    }
////    else if ($selected_radio == 'sorg') {
////        $result = mysqli_query($con, "SELECT * FROM organization WHERE status = 'active'");
////        $activeOrg = mysqli_num_rows($result);
////    } 
//    else if ($selected_radio == 'nrole') {
//        $result = mysqli_query($con, "SELECT * FROM project");
//        $numProject = mysqli_num_rows($result);
//    }
//}
?>
<head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" />    

</head>


<!--<form method="post">
    <h6>Type of Report: </h6>
    <input type="radio" name="typereport" value="nuser"> Number of volunteers <br/>
    <input type="radio" name="typereport" value="norganization"> Number of volunteers without projects vs. with projects<br/>
    <input type="radio" name="typereport" value="svol"> Number of active volunteers<br/>
    <input type="radio" name="typereport" value="sorg"> Number of active Organizations<br/>
    <input type="radio" name="typereport" value="nrole"> Number of Projects<br/><br/>
    <input type="submit" name='submit' value='Submit'>
</form>-->

<?php
//if ($person_count != 0 /* && $org_count != 0 */) {
//    echo "<h5>";
//    echo "The number of volunteers to date is: ";
//    echo $person_count;
//    echo "</h5>";
////    echo "<h5>";
////    echo "The number of organizations to date is: ";
////    echo $org_count;
////    echo "</h5>";
//} else if ($pwoproject != 0 && $pwproject != 0) {
//    echo "<h5>";
//    echo "The number of volunteers with project to date is: ";
//    echo $pwproject;
//    echo "</h5>";
//    echo "<h5>";
//    echo "The number of volunteers without project to date is: ";
//    echo $pwoproject;
//    echo "</h5>";
//} else if ($activeUser != 0) {
//    echo "<h5>";
//    echo "The number of active volunteers to date is: ";
//    echo $activeUser;
//    echo "</h5>";
//}
////else if ($activeOrg != 0) {
////    echo "<h5>";
////    echo "The number of active organization to date is: ";
////    echo $activeOrg;
////    echo "</h5>";
////    
////}
//else if ($numProject != 0) {
//    echo "<h5>";
//    echo "The number of project to date is: ";
//    echo $numProject;
//    echo "</h5>";
//}
//$result = mysqli_query($con, "SELECT * FROM person");
//        $person_count = mysqli_num_rows($result);
//        
//        $result = mysqli_query($con, "SELECT * FROM PersonAssignedToRole");
//        $pwproject = mysqli_num_rows($result);
//        $result = mysqli_query($con, "SELECT * FROM person");
//        $tmp = mysqli_num_rows($result);
//        $pwoproject = abs($pwproject - $tmp);
//        $result = mysqli_query($con, "SELECT * FROM person WHERE active = 'Y'");
//        $activeUser = mysqli_num_rows($result);
//        
//
//?>




<head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" />    

</head>


<!--<form method="post">
    <h6>Type of Report: </h6>
    <input type="radio" name="typereport" value="nuser"> Number of volunteers <br/>
    <input type="radio" name="typereport" value="norganization"> Number of volunteers without projects vs. with projects<br/>
    <input type="radio" name="typereport" value="svol"> Number of active volunteers<br/>
    <input type="radio" name="typereport" value="sorg"> Number of active Organizations<br/>
    <input type="radio" name="typereport" value="nrole"> Number of Projects<br/><br/>
    <input type="submit" name='submit' value='Submit'>
</form>-->

<?php
//if ($person_count != 0 /* && $org_count != 0 */) {
//    echo "<h5>";
//    echo "The number of volunteers to date is: ";
//    echo $person_count;
//    echo "</h5>";
////    echo "<h5>";
////    echo "The number of organizations to date is: ";
////    echo $org_count;
////    echo "</h5>";
//} else if ($pwoproject != 0 && $pwproject != 0) {
//    echo "<h5>";
//    echo "The number of volunteers with project to date is: ";
//    echo $pwproject;
//    echo "</h5>";
//    echo "<h5>";
//    echo "The number of volunteers without project to date is: ";
//    echo $pwoproject;
//    echo "</h5>";
//} else if ($activeUser != 0) {
//    echo "<h5>";
//    echo "The number of active volunteers to date is: ";
//    echo $activeUser;
//    echo "</h5>";
//}
////else if ($activeOrg != 0) {
////    echo "<h5>";
////    echo "The number of active organization to date is: ";
////    echo $activeOrg;
////    echo "</h5>";
////    
////}
//else if ($numProject != 0) {
//    echo "<h5>";
//    echo "The number of project to date is: ";
//    echo $numProject;
//    echo "</h5>";
//}
//$result = mysqli_query($con, "SELECT * FROM person");
//        $person_count = mysqli_num_rows($result);
//        
//        $result = mysqli_query($con, "SELECT * FROM PersonAssignedToRole");
//        $pwproject = mysqli_num_rows($result);
//        $result = mysqli_query($con, "SELECT * FROM person");
//        $tmp = mysqli_num_rows($result);
//        $pwoproject = abs($pwproject - $tmp);
//        $result = mysqli_query($con, "SELECT * FROM person WHERE active = 'Y'");
//        $activeUser = mysqli_num_rows($result);
//        
//
//?>
<div id='organizerReport'>
<?php
$this->widget(
        'chartjs.widgets.ChBars', array(
    'width' => 700,
    'height' => 500,
    'htmlOptions' => array(),
    'labels' => array("Total Volunteers :$SystemData[0]", "Volunteers w/ Proj :$SystemData[1]", "Volunteers w/o Proj :$SystemData[2]", "Active Volunteers :$SystemData[3]"),
    'datasets' => array(
        array(
            "fillColor" => "#f14c49",
            "strokeColor" => "rgba(220,220,220,1)",
            "data" => $SystemData,
        )
    ),
    'options' => array(
    )
        )
);
?>

</div>


<div>
    
   <?php $this->widget('application.extensions.print.printWidget', array(
                      'coverElement' => '#wrapper', //main page which should not be seen
                      'printedElement' => '#organizerReport', //element to be printed
                      
                       )); 
        ?>
    
</div>
 


<script>
      $("#bottomMenuLinkOrganizer").addClass("selectedBottomMenuTab");
</script>

