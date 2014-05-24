<?php
/* @var $this SearchController */

$this->breadcrumbs = array(
    'Search' => array('/search'),
    'adminSearch',
);

//$names;
//$emails;
//$telephones;
$results;
$causes;
$skills;
$causesarray = array();
$skillsarray = array();

$link = mysqli_connect('localhost:8889', 'root', 'root', 'pvms');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


$names = "";
$emails = "";
$names = "";
$telephones = "";
$causess = "";
$skillss = "";
$sday = "";
$eday = "";

if (isset($_POST["name"])) {
    $names = $_POST["name"];
}
if (isset($_POST["email"])) {
    $emails = $_POST["email"];
}
if (isset($_POST["name"])) {
    $names = $_POST["name"];
}
if (isset($_POST["telephone"])) {
    $telephones = $_POST["telephone"];
}
if (isset($_POST["causes"])) {
    $causess = $_POST["causes"];
}
if (isset($_POST["skills"])) {
    $skillss = $_POST["skills"];
}
if (isset($_POST["sday"])) {
    $sday = $_POST["sday"];
}
if (isset($_POST["eday"])) {
    $eday = $_POST["eday"];
}

if($names != "" || $emails != "" || $telephones != "" || $causess != "" || $skillss != "" || $sday != "" || $eday != ""){
    $resultsn = mysqli_query($link, "SELECT * FROM person WHERE name = '".$names."'");
    $resulte = mysqli_query($link, "SELECT * FROM person WHERE email = '".$emails."'");
    $resultt = mysqli_query($link, "SELECT * FROM person WHERE phone = '".$telephones."'");
    $resultsday = mysqli_query($link, "SELECT * FROM freetime WHERE startDate = '".$sday."'");
}












if (isset($_POST["name"]) && $_POST["name"] != "") {
    $results = mysqli_query($link, "SELECT * FROM person WHERE name = '" . $_POST['name'] . "'");
    while ($row = mysqli_fetch_assoc($results)) {
        $causes = mysqli_query($link, "SELECT * FROM cause WHERE id = '" . $row['id'] . "'");
        $causesarray[$row['id']] = mysqli_fetch_assoc($causes);
    }
    mysqli_data_seek($results, 0);
    while ($row = mysqli_fetch_assoc($results)) {
        $skills = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
        $skillsarray[$row['id']] = mysqli_fetch_assoc($skills);
    }
    mysqli_data_seek($results, 0);
} elseif (isset($_POST["email"]) && $_POST["email"] != "") {
    $results = mysqli_query($link, "SELECT * FROM person WHERE email = '" . $_POST['email'] . "'");
    while ($row = mysqli_fetch_assoc($results)) {
        $causes = mysqli_query($link, "SELECT * FROM cause WHERE id = '" . $row['id'] . "'");
        $causesarray[$row['id']] = mysqli_fetch_assoc($causes);
    }
    mysqli_data_seek($results, 0);
    while ($row = mysqli_fetch_assoc($results)) {
        $skills = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
        $skillsarray[$row['id']] = mysqli_fetch_assoc($skills);
    }
    mysqli_data_seek($results, 0);
} elseif (isset($_POST["telephone"]) && $_POST["telephone"] != "") {
    $results = mysqli_query($link, "SELECT * FROM person WHERE phone = '" . $_POST['telephone'] . "'");
    while ($row = mysqli_fetch_assoc($results)) {
        $causes = mysqli_query($link, "SELECT * FROM cause WHERE id = '" . $row['id'] . "'");
        $causesarray[$row['id']] = mysqli_fetch_assoc($causes);
    }
    mysqli_data_seek($results, 0);
    while ($row = mysqli_fetch_assoc($results)) {
        $skills = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
        $skillsarray[$row['id']] = mysqli_fetch_assoc($skills);
    }
    mysqli_data_seek($results, 0);
} elseif (isset($_POST["causes"]) && !empty($_POST["causes"])) {// this is an array
    $fields = "id,";
    $parameter = "";
    foreach ($_POST["causes"] as $value)
        $fields = $fields . $value . ",";

    foreach ($_POST["causes"] as $value)
        $parameter = $parameter . $value . " and ";

    $fields = rtrim($fields, ",");
    $parameter = substr($parameter, 0, strlen($parameter) - 4);
    //echo $parameter;

    $ids = mysqli_query($link, "SELECT id FROM cause WHERE " . $parameter . " != 0");

    $stringid = "(";
    if ($ids) {
        while ($row = mysqli_fetch_array($ids)) {
            $stringid = $stringid . $row['id'] . ",";
        }
        $stringid = rtrim($stringid, ",");
        $stringid = $stringid . ")";
    }

    echo $stringid;

    $results = mysqli_query($link, "SELECT * FROM person WHERE id IN " . $stringid);
    if ($results) {
        while ($row = mysqli_fetch_assoc($results)) {
            $causes = mysqli_query($link, "SELECT * FROM cause WHERE id = '" . $row['id'] . "'");
            $causesarray[$row['id']] = mysqli_fetch_assoc($causes);
        }

        mysqli_data_seek($results, 0);

        while ($row = mysqli_fetch_assoc($results)) {
            $skills = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
            $skillsarray[$row['id']] = mysqli_fetch_assoc($skills);
        }
        mysqli_data_seek($results, 0);
    }
} elseif (isset($_POST["skills"]) && !empty($_POST["skills"])) {// this is an array
    $fields = "id,";
    $parameter = "";
    foreach ($_POST["skills"] as $value)
        $fields = $fields . $value . ",";

    foreach ($_POST["skills"] as $value)
        $parameter = $parameter . $value . " and ";

    $fields = rtrim($fields, ",");
    $parameter = substr($parameter, 0, strlen($parameter) - 4);
    //echo $parameter;

    $ids = mysqli_query($link, "SELECT id FROM skill WHERE " . $parameter . " != 0");

    $stringid = "(";
    if ($ids) {
        while ($row = mysqli_fetch_array($ids)) {
            $stringid = $stringid . $row['id'] . ",";
        }
        $stringid = rtrim($stringid, ",");
        $stringid = $stringid . ")";
    }

    $results = mysqli_query($link, "SELECT * FROM person WHERE id IN " . $stringid);
    if ($results) {
        while ($row = mysqli_fetch_assoc($results)) {
            $causes = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
            $causesarray[$row['id']] = mysqli_fetch_assoc($causes);
        }
        mysqli_data_seek($results, 0);

        while ($row = mysqli_fetch_assoc($results)) {
            $skills = mysqli_query($link, "SELECT * FROM skill WHERE id = '" . $row['id'] . "'");
            $skillsarray[$row['id']] = mysqli_fetch_assoc($skills);
        }
        mysqli_data_seek($results, 0);
    }
}


mysqli_close($link);
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap.min.js"></script>


<h3>Search Volunteers/Organizers</h3>
<h6>(Search with maximum of 1 search term)</h6>

<form method="post">

    <h5>Name: </h5>
    <input type="text" name="name">
    <h5>Email: </h5>
    <input type="email" name="email">
    <h5>Telephone: </h5>
    <h6>(555-555-5555) </h6>
    <input type="tel" name="telephone">
    <h5>Causes: </h5>
    <h6>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</h6>
    <select multiple="multiple" name="causes[]">
        <option value="animalWelfare">Animal Welfare</option>
        <option value="artsAndCulture">Arts and Culture</option>
        <option value="children">Children</option>
        <option value="communityAndService">Community and Service</option>
        <option value="democracyAndPolitics">Democracy and Politics</option>
        <option value="education">Education</option>
        <option value="environment">Environment</option>
        <option value="food">Food</option>
        <option value="health">Health</option>
        <option value="housingAndHomelessness">Housing and Homelessness</option>
        <option value="humanRights">Human Rights</option>
        <option value="humanitarianRelief">Humanitarian Relief</option>
        <option value="internationalAffairs">International Affairs</option>
        <option value="media">Media</option>
        <option value="povertyAlleviation">Poverty Alleviation</option>
        <option value="religion">Religion</option>
        <option value="scienceAndTechnology">Science and Technology</option>
        <option value="seniorCitizens">Senior Citizens</option>
        <option value="womenIssues">Women Issues</option>
        <option value="other">Other</option>
    </select>
    <h5>Skills: </h5>
    <h6>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</h6>
    <select multiple="multiple" name="skills[]">
        <option value="accounting">Accounting</option>
        <option value="advertising">Advertising</option>
        <option value="branding">Branding</option>
        <option value="businessStrategy">Business Strategy</option>
        <option value="communications">Communications</option>
        <option value="copywriting">Copy Writing</option>
        <option value="design">Design</option>
        <option value="education">Education</option>
        <option value="entrepreneurship">Entrepreneurship</option>
        <option value="eventPlanning">Event Planning</option>
        <option value="financing">Financing</option>
        <option value="fundraising">Fund Raising</option>
        <option value="humanResources">Human Resources</option>
        <option value="legal">Legal</option>
        <option value="marketing">Marketing</option>
        <option value="multimedia">Multimedia</option>
        <option value="onlineMarketing">Online Marketing</option>
        <option value="photography">Photography</option>
        <option value="projectManagement">Project Management</option>
        <option value="publicRelations">Public Relations</option>
        <option value="sales">Sales</option>
        <option value="socialMedia">Social Media</option>
        <option value="technology">Technology</option>
        <option value="webDevelopment">Web Development</option>
        <option value="other">Other</option>
    </select><br/>
    <h5>Free Time: </h5>
    <h6>Start Date: </h6>
    <input type="date" name="sdate"/>
    <h6>End Date: </h6>
    <input type="date" name="edate"/>
    <br />
    <INPUT TYPE="submit" name="submit" />
</form>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Cause(s)</th>
            <th>Skill(s)</th>
        </tr>
    </thead>
    <tbody>
<?php
if (isset($results) && $results) {
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>";
        echo "<td>";
        echo $row["name"];
        echo "</td>";
        echo "<td>";
        echo $row["email"];
        echo "</td>";
        echo "<td>";
        echo $row["phone"];
        echo "</td>";
        echo "<td>";
        foreach ($causesarray[$row['id']] as $key => $value) {
            if ($value != 0 && $key != 'id')
                echo $key . "<br>";
        }
        echo "</td>";
        echo "<td>";
        foreach ($skillsarray[$row['id']] as $key => $value) {
            if ($value != 0 && $key != 'id')
                echo $key . "<br>";
        }
        echo "</td>";
        echo "</tr>";
    }
}
else {
    echo "<tr><td>Sorry no results found</td></tr>";
}
?>

    </tbody>
</table>
