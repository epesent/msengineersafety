<?php
    session_start();
    $permissionLevel = $_SESSION['permissionLevel'];
    if (empty($permissionLevel)) {
        header("location:index.php");
    }

    $userId = $_SESSION['userId'];
    require_once 'connectdb.php';
    $assoc = getAsc ($dbconn, $userId);
    $divisionId = $assoc['divisionId'];

try {
    if (isset($_POST['submit'])) {
        //set variables
        $pqdate = new DateTime($_POST['jobDate']);
        $jobDate = $pqdate->format('Y-m-d');
        $customer = mysqli_real_escape_string($dbconn, trim($_POST['customer']));
        $jobNo = mysqli_real_escape_string($dbconn, trim($_POST['jobNo']));
        $crewLeader = mysqli_real_escape_string($dbconn, trim($_POST['crewLeader']));
        $currentWeather = mysqli_real_escape_string($dbconn, trim($_POST['currentWeather']));
        $scopeOfWork = mysqli_real_escape_string($dbconn, trim($_POST['scopeOfWork']));
        if (!empty($_POST['permitRequired'])) {$permitRequired = $_POST['permitRequired'];} else {$permitRequired = 0;}
        $permitType = mysqli_real_escape_string($dbconn, trim($_POST['permitType']));
        if (!empty($_POST['fire'])) {$fire = $_POST['fire'];} else {$fire = 0;}
        if (!empty($_POST['noise'])) {$noise = $_POST['noise'];} else {$noise = 0;}
        if (!empty($_POST['energizedCircuits'])) {$energizedCircuits = $_POST['energizedCircuits'];} else {$energizedCircuits = 0;}
        if (!empty($_POST['electrical'])) {$electrical = $_POST['electrical'];} else {$electrical = 0;}
        if (!empty($_POST['weather'])) {$weather = $_POST['weather'];} else {$weather = 0;}
        if (!empty($_POST['minimumDistance'])) {$minimumDistance = $_POST['minimumDistance'];} else {$minimumDistance = 0;}
        if (!empty($_POST['mechanical'])) {$mechanical = $_POST['mechanical'];} else {$mechanical = 0;}
        if (!empty($_POST['slips_trips_falls'])) {$slips_trips_falls = $_POST['slips_trips_falls'];} else {$slips_trips_falls = 0;}
        if (!empty($_POST['lead'])) {$lead = $_POST['lead'];} else {$lead = 0;}
        if (!empty($_POST['chemical'])) {$chemical = $_POST['chemical'];} else {$chemical = 0;}
        if (!empty($_POST['congestedArea'])) {$congestedArea = $_POST['congestedArea'];} else {$congestedArea = 0;}
        if (!empty($_POST['othersInArea'])) {$othersInArea = $_POST['othersInArea'];} else {$othersInArea = 0;}
        $additionalHazards = mysqli_real_escape_string($dbconn, trim($_POST['additionalHazards']));
        if (!empty($_POST['hardHat'])) {$hardHat = $_POST['hardHat'];} else {$hardHat = 0;}
        if (!empty($_POST['frc'])) {$frc = $_POST['frc'];} else {$frc = 0;}
        if (!empty($_POST['safetyGlasses'])) {$safetyGlasses = $_POST['safetyGlasses'];} else {$safetyGlasses = 0;}
        if (!empty($_POST['safetyToeShoes'])) {$safetyToeShoes = $_POST['safetyToeShoes'];} else {$safetyToeShoes = 0;}
        if (!empty($_POST['monogoggles'])) {$monogoggles = $_POST['monogoggles'];} else {$monogoggles = 0;}
        if (!empty($_POST['safetyHarness'])) {$safetyHarness = $_POST['safetyHarness'];} else {$safetyHarness = 0;}
        if (!empty($_POST['faceShields'])) {$faceShields = $_POST['faceShields'];} else {$faceShields = 0;}
        if (!empty($_POST['hotStick'])) {$hotStick = $_POST['hotStick'];} else {$hotStick = 0;}
        if (!empty($_POST['hearingProtection'])) {$hearingProtection = $_POST['hearingProtection'];} else {$hearingProtection = 0;}
        if (!empty($_POST['grounds'])) {$grounds = $_POST['grounds'];} else {$grounds = 0;}
        if (!empty($_POST['fireExtinguisher'])) {$fireExtinguisher = $_POST['fireExtinguisher'];} else {$fireExtinguisher = 0;}
        if (!empty($_POST['rubberGloves'])) {$rubberGloves = $_POST['rubberGloves'];} else {$rubberGloves = 0;}
        if (!empty($_POST['barricades_signs'])) {$barricades_signs = $_POST['barricades_signs'];} else {$barricades_signs = 0;}
        if (!empty($_POST['workGloves'])) {$workGloves = $_POST['workGloves'];} else {$workGloves = 0;}
        if (!empty($_POST['safetyVest'])) {$safetyVest = $_POST['safetyVest'];} else {$safetyVest = 0;}
        if (!empty($_POST['shirtTuckedIn'])) {$shirtTuckedIn = $_POST['shirtTuckedIn'];} else {$shirtTuckedIn = 0;}
        if (!empty($_POST['noStains'])) {$noStains = $_POST['noStains'];} else {$noStains = 0;}
        if (!empty($_POST['noTears_holes_frayedEdges'])) {$noTears_holes_frayedEdges = $_POST['noTears_holes_frayedEdges'];} else {$noTears_holes_frayedEdges = 0;}
        if (!empty($_POST['noContactWithBleach'])) {$noContactWithBleach = $_POST['noContactWithBleach'];} else {$noContactWithBleach = 0;}
        if (!empty($_POST['noContactWithDEET'])) {$noContactWithDEET = $_POST['noContactWithDEET'];} else {$noContactWithDEET = 0;}
        $inspectionOfTools = mysqli_real_escape_string($dbconn, trim($_POST['inspectionOfTools']));
        $housekeeping = mysqli_real_escape_string($dbconn, trim($_POST['housekeeping']));
        $medicalServices = mysqli_real_escape_string($dbconn, trim($_POST['medicalServices']));
        $attendeeName1 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName1']));
        $attendeeName2 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName2']));
        $attendeeName3 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName3']));
        $attendeeName4 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName4']));
        $attendeeName5 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName5']));
        $attendeeName6 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName6']));
        $attendeeName7 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName7']));
        $attendeeName8 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName8']));
        $attendeeName9 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName9']));
        $attendeeName10 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName10']));
        $attendeeName11 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName11']));
        $attendeeName12 = mysqli_real_escape_string($dbconn, trim($_POST['attendeeName12']));

        //insert to db
        $sqlInsert= "INSERT INTO jsaTaskAnalysis (divisionId, userId, jobDate, customer, jobNo, crewLeader, currentWeather, scopeOfWork, permitRequired, permitType, fire, noise, energizedCircuits, 
                    electrical, weather, minimumDistance, mechanical, slips_trips_falls, lead, chemical, congestedArea, othersInArea, additionalHazards, hardHat, frc, safetyGlasses, safetyToeShoes, monogoggles, 
                    safetyHarness, faceShields, hotStick, hearingProtection, grounds, fireExtinguisher, rubberGloves, barricades_signs, workGloves, safetyVest, shirtTuckedIn, noStains, 
                    noTears_holes_frayedEdges, noContactWithBleach, noContactWithDEET, inspectionOfTools, housekeeping, medicalServices, attendeeName1, attendeeName2, attendeeName3, attendeeName4, 
                    attendeeName5, attendeeName6, attendeeName7, attendeeName8, attendeeName9, attendeeName10, attendeeName11, attendeeName12) VALUES ('$divisionId', '$userId', NULLIF ('$jobDate', ''), 
                    NULLIF ('$customer', ''), NULLIF ('$jobNo', ''), NULLIF ('$crewLeader', ''), NULLIF ('$currentWeather', ''), NULLIF ('$scopeOfWork', ''), '$permitRequired', NULLIF ('$permitType', ''),
                    '$fire', '$noise', '$energizedCircuits', '$electrical', '$weather', '$minimumDistance', '$mechanical', '$slips_trips_falls', '$lead', '$chemical', '$congestedArea', '$othersInArea', 
                    NULLIF ('$additionalHazards', ''), '$hardHat', '$frc', '$safetyGlasses', '$safetyToeShoes', '$monogoggles', '$safetyHarness', '$faceShields', '$hotStick', '$hearingProtection', '$grounds', '$fireExtinguisher', 
                    '$rubberGloves', '$barricades_signs', '$workGloves', '$safetyVest', '$shirtTuckedIn', '$noStains', '$noTears_holes_frayedEdges', '$noContactWithBleach', '$noContactWithDEET', 
                    NULLIF ('$inspectionOfTools', ''), NULLIF ('$housekeeping', ''), NULLIF ('$medicalServices', ''), NULLIF ('$attendeeName1', ''), NULLIF ('$attendeeName2', ''), 
                    NULLIF ('$attendeeName3', ''), NULLIF ('$attendeeName4', ''), NULLIF ('$attendeeName5', ''), NULLIF ('$attendeeName6', ''), NULLIF ('$attendeeName7', ''), NULLIF ('$attendeeName8', ''), 
                    NULLIF ('$attendeeName9', ''), NULLIF ('$attendeeName10', ''), NULLIF ('$attendeeName11', ''), NULLIF ('$attendeeName12', ''))";
        $dbconn->query($sqlInsert);

        if ($_SESSION['permissionLevel'] == 'mgr') {
            header("location: dashboarddivmgr.php");
        } elseif ($_SESSION['permissionLevel'] == 'asc') {
            header("location: associate.php");
        } else {
            header("location: dashboardadmin.php");
        }
    }
} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>JSTA FORM</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>

    <!--Script for jquery ui for the dialog box-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/datepicker.js"></script>

    <style type="text/css">
        body {
            background-color: #323232;
        }
        a.shl:link {
            text-decoration: none;
            /*color: #226666;*/
            color: #effff4;
            letter-spacing: 2px;
        }
        a.shl:visited {
            text-decoration: none;
            /*color: #226666;*/
            color: #effff4;
            letter-spacing: 2px;
        }
        a.shl:hover {
            text-decoration: none;
            /*color: #804515;*/
            color: #9c9c9c;
            letter-spacing: 2px;
        }
    </style>
    <script>
        function disableSubmit() {
            document.getElementById("submit").disabled = true;
        }

        function activateButton(element) {

            if(element.checked) {
                document.getElementById("submit").disabled = false;
            }
            else  {
                document.getElementById("submit").disabled = true;
            }

        }
    </script>

</head>
<body onload="disableSubmit()">
    <div id="topbannerForms" class="container-fluid text-white" style="font-family: Georgia, Times New Roman, Times, serif;">
        <div class="row pt-3 pb-3 align-items-end">
            <div class="col-md-4">
                <span>M&S ENGINEERING</span>
            </div>
            <div class="col-md-4"><span>Safety and Compliance Database</span></div>
            <div class="col-md-2 text-md-center"><a href="javascript:history.back()" class="nav-item nav-link shl" title="LOG OUT" id="logOut">Go Back</a></div>
            <div class="col-md-2 text-md-center"><a href="index.php?logout=yes" class="nav-item nav-link shl" title="LOG OUT" id="logOut">Log Out</a></div>
        </div><!--end Row-->
    </div>

    <div class="bg-light pb-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-2 pt-md-5 mb-md-3">
                <div class="col-md-5"><h4>Job Safety Task Analysis</h4></div>
            </div><!--end row-->
            <form action="" method="post">
                <div id="generalInfo" class="form-group">
                    <div class="form-row mb-md-3">
                        <label for="jobDate" class="col-md-1 form-control-label ml-md-5">Date:</label>
                        <input type="text" id="jobDate" name="jobDate" class="col-md-2 form-control pickDate"/>
                        <label for="customer" class="col-md-2 form-control-label text-md-right">Customer:</label>
                        <input type="text" id="customer" name="customer" class="col-md-3 form-control"/>
                        <label for="jobNo" class="col-md-2 form-control-label text-md-right">Job No.:</label>
                        <input type="text" id="jobNo" name="jobNo" class="col-md-1 form-control"/>
                    </div><!--end form row-->
                    <div class="form-row mb-md-3">
                        <label for="crewLeader" class="col-md-2 form-control-label ml-md-5">Crew Leader:</label>
                        <input type="text" id="crewLeader" name="crewLeader" class="col-md-3 form-control"/>
                        <label for="currentWeather" class="col-md-2 form-control-label text-md-right">Weather:</label>
                        <input type="text" id="currentWeather" name="currentWeather" class="col-md-4 form-control"/>
                    </div><!--end form-row-->
                    <div class="form-row mb-md-3">
                        <div class="form-check-inline mt-3 mt-md-0 mb-3 mb-md-0">
                            <label for="permitRequired" class="form-check-label ml-md-5">
                                <input type="checkbox" id="permitRequired" name="permitRequired" class="form-check-input" value="1">Permit Required
                            </label>
                        </div>
                        <label for="permitType" class="col-md-1 form-control-label text-md-right">Type:</label>
                        <input type="text" id="permitType" name="permitType" class="col-md-4 form-control"/>
                    </div>
                </div><!--end form group general info-->
                <div class="row mt-md-4">
                    <div class="col-md-3"><h5>Job Hazards:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="jobHazards" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="fire" class="form-check-label">
                                    <input id="fire" name="fire" type="checkbox" class="form-check-input" value="1">Fire
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noise" class="form-check-label">
                                    <input id="noise" name="noise" type="checkbox" class="form-check-input" value="1">Noise
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="energizedCircuits" class="form-check-label">
                                    <input id="energizedCircuits" name="energizedCircuits" type="checkbox" class="form-check-input" value="1">Energized Circuits
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="electrical" class="form-check-label">
                                    <input id="electrical" name="electrical" type="checkbox" class="form-check-input" value="1">Electrical
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="weather" class="form-check-label">
                                    <input id="weather" name="weather" type="checkbox" class="form-check-input" value="1">Weather
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="minimumDistance" class="form-check-label">
                                    <input id="minimumDistance" name="minimumDistance" type="checkbox" class="form-check-input" value="1">Minimum Distance
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="mechanical" class="form-check-label">
                                    <input id="mechanical" name="mechanical" type="checkbox" class="form-check-input" value="1">Mechanical
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="slips_trips_falls" class="form-check-label">
                                    <input id="slips_trips_falls" name="slips_trips_falls" type="checkbox" class="form-check-input" value="1">Slips, Trips, Falls
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="lead" class="form-check-label">
                                    <input id="lead" name="lead" type="checkbox" class="form-check-input" value="1">Lead
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="chemical" class="form-check-label">
                                    <input id="chemical" name="chemical" type="checkbox" class="form-check-input" value="1">Chemical
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="congestedArea" class="form-check-label">
                                    <input id="congestedArea" name="congestedArea" type="checkbox" class="form-check-input" value="1">Congested Area
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="othersInArea" class="form-check-label">
                                    <input id="othersInArea" name="othersInArea" type="checkbox" class="form-check-input" value="1">Others in Area
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div>
                        <label for="additionalHazards" class="form-control-label">Additional Hazards (Please specify):</label>
                        <input id="additionalHazards" name="additionalHazards" type="text" class="form-control"/>
                    </div>
                </div><!--end form group job hazards-->

                <div class="row mt-md-4">
                    <div class="col-md-8"><h5>Personal Protective and Safety Equipment Required:</h5></div>
                    <div class="col-md-3 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="PPSE" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hardHat" class="form-check-label">
                                    <input id="hardHat" name="hardHat" type="checkbox" class="form-check-input" value="1">Hard Hat
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="frc" class="form-check-label">
                                    <input id="frc" name="frc" type="checkbox" class="form-check-input" value="1">FRC
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyGlasses" class="form-check-label">
                                    <input id="safetyGlasses" name="safetyGlasses" type="checkbox" class="form-check-input" value="1">Safety Glasses
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyToeShoes" class="form-check-label">
                                    <input id="safetyToeShoes" name="safetyToeShoes" type="checkbox" class="form-check-input" value="1">Safety Toe Shoes
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->

                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="monogoggles" class="form-check-label">
                                    <input id="monogoggles" name="monogoggles" type="checkbox" class="form-check-input" value="1">Monogoggles
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyHarness" class="form-check-label">
                                    <input id="safetyHarness" name="safetyHarness" type="checkbox" class="form-check-input" value="1">Safety Harness
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="faceShields" class="form-check-label">
                                    <input id="faceShields" name="faceShields" type="checkbox" class="form-check-input" value="1">Face Shields
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hotStick" class="form-check-label">
                                    <input id="hotStick" name="hotStick" type="checkbox" class="form-check-input" value="1">Hot Stick
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->

                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hearingProtection" class="form-check-label">
                                    <input id="hearingProtection" name="hearingProtection" type="checkbox" class="form-check-input" value="1">Hearing Protection
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="grounds" class="form-check-label">
                                    <input id="grounds" name="grounds" type="checkbox" class="form-check-input" value="1">Grounds
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="fireExtinguisher" class="form-check-label">
                                    <input id="fireExtinguisher" name="fireExtinguisher" type="checkbox" class="form-check-input" value="1">Fire Extinguisher
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="rubberGloves" class="form-check-label">
                                    <input id="rubberGloves" name="rubberGloves" type="checkbox" class="form-check-input" value="1">Rubber Gloves
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="barricades_sign" class="form-check-label">
                                    <input id="barricades_sign" name="barricades_sign" type="checkbox" class="form-check-input" value="1">Barricades & Signs
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="workGloves" class="form-check-label">
                                    <input id="workGloves" name="workGloves" type="checkbox" class="form-check-input" value="1">Work Gloves
                                </label>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyVest" class="form-check-label">
                                    <input id="safetyVest" name="safetyVest" type="checkbox" class="form-check-input" value="1">Safety Vest
                                </label>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-3">&nbsp;</div>
                    </div><!--end form row-->
                    <div class="row mt-2">
                        <div class="col-md-5 mt-md-2 ml-md-3"><span>Other FR Clothing Check</span></div>
                    </div><!--end row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="shirtTuckedIn" class="form-check-label">
                                    <input id="shirtTuckedIn" name="shirtTuckedIn" type="checkbox" class="form-check-input" value="1">Shirt Tucked In
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noStains" class="form-check-label">
                                    <input id="noStains" name="noStains" type="checkbox" class="form-check-input" value="1">No Stains
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noTears_holes_frayedEdges" class="form-check-label">
                                    <input id="noTears_holes_frayedEdges" name="noTears_holes_frayedEdges" type="checkbox" class="form-check-input" value="1">No Tears/Holes/Frayed Edges
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->

                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noContactWithBleach" class="form-check-label">
                                    <input id="noContactWithBleach" name="noContactWithBleach" type="checkbox" class="form-check-input" value="1">No Contact with Bleach
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noContactWithDEET" class="form-check-label">
                                    <input id="noContactWithDEET" name="noContactWithDEET" type="checkbox" class="form-check-input" value="1">No Contact with DEET
                                </label>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-4">&nbsp;</div>
                    </div><!--end form row-->
                </div><!--end form group ppse-->
                <div id="comments" class="form-group">
                    <label for="inspectionOfTools" class="form-control-label">Inspection of Tools and Other Equipment to be used:</label>
                    <input id="inspectionOfTools" name="inspectionOfTools" type="text" class="form-control"/>
                    <label for="housekeeping" class="form-control-label mt-2">Housekeeping:</label>
                    <textarea rows="2" cols="10" id="housekeeping" name="housekeeping" class="form-control"></textarea>
                    <label for="medicalServices" class="form-control-label mt-2">Medical Services, First Aid and Emergency, Fire and Evacuation Procedures:</label>
                    <textarea rows="3" cols="10" id="medicalServices" name="medicalServices" class="form-control"></textarea>
                </div><!--end form group-->
                <div class="row mt-md-4 justify-content-md-around">
                    <div class="col-md-3"><h5>Attendees:</h5></div>
                    <div class="col-md-4 small font-italic">(Please record the names of all attendees)</div>
                </div><!--end row--->
                <div id="attendees" class="form-group">
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName1" id="attendeeName1" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName2" id="attendeeName2" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName3" id="attendeeName3" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName4" id="attendeeName4" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName5" id="attendeeName5" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName6" id="attendeeName6" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName7" id="attendeeName7" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName8" id="attendeeName8" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName9" id="attendeeName9" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName10" id="attendeeName10" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendeeName11" id="attendeeName11" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendeeName12" id="attendeeName12" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                </div><!--end form group attendees-->
                <div class="row mt-md-5 justify-content-md-center">
                    <div class="col-md-8 mb-1">
                        <input type="checkbox" name="terms" id="terms" onchange="activateButton(this)"> I, <?php echo $assoc['firstName'] ." " .$assoc['lastName']; ?>, submit this form as accurate and true.
                        <br/><span class="small font-italic">(Click checkbox to confirm)</span>
                    </div>
                    <div class="col-md-1 mr-md-3 mb-1">
                        <button id="submit" name="submit" class="btn btn-success" type="submit">SUBMIT</button>
                    </div>
                    <div class="col-md-1 mb-1">
                        <button class="btn btn-success" type="button" onclick="window.history.back()">GO BACK</button>
                    </div>
                </div><!--end row-->
            </form><!--end form-->
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>