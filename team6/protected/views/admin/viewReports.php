<?php
/* @var $this AdminController */

$this->breadcrumbs = array(
    'Admin' => array('/admin'),
    'ViewReports',
);

?>

<head>
        
<link rel="stylesheet" type="text/css" media="print" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" />    

</head>

<!--<form method="post">
    <h6>Type of Report: </h6>
    <input type="radio" name="typereport" value="nuser"> Number of volunteers vs. Number of organizations<br/>
    <input type="radio" name="typereport" value="norganization"> Number of volunteers without projects vs. with projects<br/>
    <input type="radio" name="typereport" value="svol"> Number of active volunteers<br/>
    <input type="radio" name="typereport" value="sorg"> Number of active Organizations<br/>
    <input type="radio" name="typereport" value="nrole"> Number of Projects<br/><br/>
    <input type="submit" name='submit' value='Submit'>
</form>-->

<?php
//if ($person_count != 0 && $org_count != 0) {
//    echo "<h5>";
//    echo "The number of volunteers to date is: ";
//    echo $person_count;
//    echo "</h5>";
//    echo "<h5>";
//    echo "The number of organizations to date is: ";
//    echo $org_count;
//    echo "</h5>";
//    
//} else if ($pwoproject != 0 && $pwproject != 0) {
//    echo "<h5>";
//    echo "The number of volunteers with project to date is: ";
//    echo $pwproject;
//    echo "</h5>";
//    echo "<h5>";
//    echo "The number of volunteers without project to date is: ";
//    echo $pwoproject;
//    echo "</h5>";
//    
//} else if ($activeUser != 0) {
//    echo "<h5>";
//    echo "The number of active volunteers to date is: ";
//    echo $activeUser;
//    echo "</h5>";
//    
//} else if ($activeOrg != 0) {
//    echo "<h5>";
//    echo "The number of active organization to date is: ";
//    echo $activeOrg;
//    echo "</h5>";
//    
//}else if ($numProject != 0) {
//    echo "<h5>";
//    echo "The number of project to date is: ";
//    echo $numProject;
//    echo "</h5>";
//    
//}
?>
<div>
    <div id='adminReport' >
    <?php 
        $this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 680,
                'height' => 250,
                'htmlOptions' => array(),
                'labels' => array("Total Volunteers","Total Organizations","Volunteers w/ Projects","Volunteers w/o Projects","Active Volunteers","Active Organizations", "Total Projects"),
                'datasets' => array(
                    array(
                        "fillColor" =>  "#f14c49",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $SystemData,
                    )       
                ),
                'options' => array()
            )
        ); 
    ?>
</div>

    <div id="adminReport">
    <?php 
        $num = intval($SystemData[0]);
            $this->widget(
                'chartjs.widgets.ChPie', 
                array(
                    'width' => 750,
                    'height' => 300,
                    'htmlOptions' => array(),
                    'drawLabels' => true,
                    'datasets' => array(
                        array(
                            "value" => $SystemData[0],
                            "color" => "#f14c49",
                            "label" => "Volunteers"
                        ),
                        array(
                            "value" => $SystemData[1],
                            "color" => "#1aab9f",
                            "label" => "Organizers"
                        )
                    ),
                    'options' => array()
                )
            ); 
        ?>
</div>

</div>
<div>
     <?php /*
        $this->widget(
            'chartjs.widgets.ChLine', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => array("January","February","March","April","May","June"),
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(10, 20, 25, 25, 50, 60)
                    ),
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(55, 50, 45, 30, 20, 10)
                    )      
                ),
                'options' => array()
            )
        ); */
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
      $("#bottomMenuLinkAdmin").addClass("selectedBottomMenuTab");
</script>