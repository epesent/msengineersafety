<?php
    session_start();
    $permissionLevel = $_SESSION['permissionLevel'];
    if (empty($permissionLevel)) {
        header("location:index.php");
    }
    if (isset($_GET['jsaTaskId'])) {
        $jsaTaskId = $_GET['jsaTaskId'];
    }

    require_once 'connectdb.php';
    $jsaT = getJSATRep ($dbconn, $jsaTaskId);
    $userId = $jsaT['userId'];
    $assoc = getAsc ($dbconn, $userId);
    $divisionId = $assoc['divisionId'];


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
        @media print {
            #back {
                display: none;
            }
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
                <div class="col-md-6 text-center"><h4>Job Safety Task Analysis</h4></div>
            </div><!--end row-->
            <div class="row justify-content-md-center mb-md-4">
                <div class="col-md-6 text-center">Submitted by: <?php echo $assoc['firstName'] . " " .$assoc['lastName']; ?></div>
            </div><!--end row-->


            <div id="generalInfo" class="form-group">
                <div class="row">
                    <div class="col-md-1  ml-md-5">Date:</div>
                    <div class="col-md-2"><?php echo $jsaT['jobDate']; ?></div>
                    <div class="col-md-2">Customer:</div>
                    <div class="col-md-3"><?php echo $jsaT['customer']; ?></div>
                    <div class="col-md-1">Job No.:</div>
                    <div class="col-md-1"><?php echo $jsaT['jobNo']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-2  ml-md-5">Crew Leader:</div>
                    <div class="col-md-3"><?php echo $jsaT['crewLeader']; ?></div>
                    <div class="col-md-1">Weather:</div>
                    <div class="col-md-4"><?php echo $jsaT['currentWeather']; ?></div>
                </div><!--end row-->


                <div class="form-row mb-md-3">
                    <div class="form-check-inline mt-3 mt-md-0 mb-3 mb-md-0">
                        <label for="permitRequired" class="form-check-label ml-md-5">
                            <input type="checkbox" id="permitRequired" name="permitRequired" class="form-check-input"
                                <?php if ($jsaT['permitRequired'] === '1') {echo "checked=checked";} ?> disabled>Permit Required
                        </label>
                    </div>
                    <div class="col-md-1">Permit Type:</div>
                    <div class="col-md-4"><?php echo $jsaT['permitType']; ?></div>
                </div>
            </div><!--end group general info-->

            <div class="row mt-md-4">
                <div class="col-md-3"><h5>Job Hazards:</h5></div>
            </div><!--end row--->
            <div id="jobHazards" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="fire" class="form-check-label">
                                <input id="fire" name="fire" type="checkbox" class="form-check-input" <?php if ($jsaT['fire'] === '1') {echo "checked=checked";} ?> disabled>Fire
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noise" class="form-check-label">
                                <input id="noise" name="noise" type="checkbox" class="form-check-input" <?php if ($jsaT['noise'] === '1') {echo "checked=checked";} ?> disabled>Noise
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="energizedCircuits" class="form-check-label">
                                <input id="energizedCircuits" name="energizedCircuits" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['energizedCircuits'] === '1') {echo "checked=checked";} ?> disabled>Energized Circuits
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="electrical" class="form-check-label">
                                <input id="electrical" name="electrical" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['electrical'] === '1') {echo "checked=checked";} ?> disabled>Electrical
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="weather" class="form-check-label">
                                <input id="weather" name="weather" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['weather'] === '1') {echo "checked=checked";} ?> disabled>Weather
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="minimumDistance" class="form-check-label">
                                <input id="minimumDistance" name="minimumDistance" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['minimumDistance'] === '1') {echo "checked=checked";} ?> disabled>Minimum Distance
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="mechanical" class="form-check-label">
                                <input id="mechanical" name="mechanical" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['mechanical'] === '1') {echo "checked=checked";} ?> disabled>Mechanical
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="slips_trips_falls" class="form-check-label">
                                <input id="slips_trips_falls" name="slips_trips_falls" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['slips_trips_falls'] === '1') {echo "checked=checked";} ?> disabled>Slips, Trips, Falls
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="lead" class="form-check-label">
                                <input id="lead" name="lead" type="checkbox" class="form-check-input" <?php if ($jsaT['lead'] === '1') {echo "checked=checked";} ?> disabled>Lead
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="chemical" class="form-check-label">
                                <input id="chemical" name="chemical" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['chemical'] === '1') {echo "checked=checked";} ?> disabled>Chemical
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="congestedArea" class="form-check-label">
                                <input id="congestedArea" name="congestedArea" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['congestedArea'] === '1') {echo "checked=checked";} ?> disabled>Congested Area
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="othersInArea" class="form-check-label">
                                <input id="othersInArea" name="othersInArea" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['othersInArea'] === '1') {echo "checked=checked";} ?> disabled>Others in Area
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end group job hazards-->

            <div class="row mt-md-4">
                <div class="col-md-8"><h5>Personal Protective and Safety Equipment Required:</h5></div>
            </div><!--end row--->
            <div id="PPSE" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hardHat" class="form-check-label">
                                <input id="hardHat" name="hardHat" type="checkbox" class="form-check-input" <?php if ($jsaT['hardHat'] === '1') {echo "checked=checked";} ?> disabled>Hard Hat
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="frc" class="form-check-label">
                                <input id="frc" name="frc" type="checkbox" class="form-check-input" <?php if ($jsaT['frc'] === '1') {echo "checked=checked";} ?> disabled>FRC
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyGlasses" class="form-check-label">
                                <input id="safetyGlasses" name="safetyGlasses" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['safetyGlasses'] === '1') {echo "checked=checked";} ?> disabled>Safety Glasses
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyToeShoes" class="form-check-label">
                                <input id="safetyToeShoes" name="safetyToeShoes" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['safetyToeShoes'] === '1') {echo "checked=checked";} ?> disabled>Safety Toe Shoes
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="monogoggles" class="form-check-label">
                                <input id="monogoggles" name="monogoggles" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['monogoggles'] === '1') {echo "checked=checked";} ?> disabled>Monogoggles
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyHarness" class="form-check-label">
                                <input id="safetyHarness" name="safetyHarness" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['safetyHarness'] === '1') {echo "checked=checked";} ?> disabled>Safety Harness
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="faceShields" class="form-check-label">
                                <input id="faceShields" name="faceShields" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['faceShields'] === '1') {echo "checked=checked";} ?> disabled>Face Shields
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hotStick" class="form-check-label">
                                <input id="hotStick" name="hotStick" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['hotStick'] === '1') {echo "checked=checked";} ?> disabled>Hot Stick
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hearingProtection" class="form-check-label">
                                <input id="hearingProtection" name="hearingProtection" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['hearingProtection'] === '1') {echo "checked=checked";} ?> disabled>Hearing Protection
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="grounds" class="form-check-label">
                                <input id="grounds" name="grounds" type="checkbox" class="form-check-input" <?php if ($jsaT['grounds'] === '1') {echo "checked=checked";} ?> disabled>Grounds
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="fireExtinguisher" class="form-check-label">
                                <input id="fireExtinguisher" name="fireExtinguisher" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['fireExtinguisher'] === '1') {echo "checked=checked";} ?> disabled>Fire Extinguisher
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="rubberGloves" class="form-check-label">
                                <input id="rubberGloves" name="rubberGloves" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['rubberGloves'] === '1') {echo "checked=checked";} ?> disabled>Rubber Gloves
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="barricades_sign" class="form-check-label">
                                <input id="barricades_sign" name="barricades_sign" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['barricades_sign'] === '1') {echo "checked=checked";} ?> disabled>Barricades & Signs
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="workGloves" class="form-check-label">
                                <input id="workGloves" name="workGloves" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['workGloves'] === '1') {echo "checked=checked";} ?> disabled>Work Gloves
                            </label>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyVest" class="form-check-label">
                                <input id="safetyVest" name="safetyVest" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['safetyVest'] === '1') {echo "checked=checked";} ?> disabled>Safety Vest
                            </label>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-3">&nbsp;</div>
                </div><!--end row-->
                <div class="row mt-2">
                    <div class="col-md-5 mt-md-2 ml-md-3"><span>Other FR Clothing Check</span></div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="shirtTuckedIn" class="form-check-label">
                                <input id="shirtTuckedIn" name="shirtTuckedIn" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['shirtTuckedIn'] === '1') {echo "checked=checked";} ?> disabled>Shirt Tucked In
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noStains" class="form-check-label">
                                <input id="noStains" name="noStains" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['noStains'] === '1') {echo "checked=checked";} ?> disabled>No Stains
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noTears_holes_frayedEdges" class="form-check-label">
                                <input id="noTears_holes_frayedEdges" name="noTears_holes_frayedEdges" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['noTears_holes_frayedEdges'] === '1') {echo "checked=checked";} ?> disabled>No Tears/Holes/Frayed Edges
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noContactWithBleach" class="form-check-label">
                                <input id="noContactWithBleach" name="noContactWithBleach" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['noContactWithBleach'] === '1') {echo "checked=checked";} ?> disabled>No Contact with Bleach
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noContactWithDEET" class="form-check-label">
                                <input id="noContactWithDEET" name="noContactWithDEET" type="checkbox" class="form-check-input"
                                    <?php if ($jsaT['noContactWithDEET'] === '1') {echo "checked=checked";} ?> disabled>No Contact with DEET
                            </label>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-4">&nbsp;</div>
                </div><!--end row-->
            </div><!--end group ppse-->

            <div id="comments">
                <div class="row">
                    <div class="col-md-5 ml-md-5">Inspection of Tools and Other Equipment to be used:</div>
                </div><!--end row--->
                <div class="row">
                    <div class="col-md-10 ml-md-5"><?php echo $jsaT['inspectionOfTools'];  ?>></div>
                </div><!--end row--->
                <div class="row">
                    <div class="col-md-5 ml-md-5">Housekeeping:</div>
                </div><!--end row--->
                <div class="row">
                    <div class="col-md-10 ml-md-5"><?php echo $jsaT['housekeeping'];  ?>></div>
                </div><!--end row--->
                <div class="row">
                    <div class="col-md-7 ml-md-5">Medical Services, First Aid and Emergency, Fire and Evacuation Procedures:</div>
                </div><!--end row--->
                <div class="row">
                    <div class="col-md-10 ml-md-5"><?php echo $jsaT['medicalServices'];  ?>></div>
                </div><!--end row--->
            </div><!--end group-->

            <div class="row mt-md-4 justify-content-md-around">
                <div class="col-md-3"><h5>Attendees:</h5></div>
            </div><!--end row--->

            <div id="attendees">
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName1'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName2']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName3'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName4']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName5'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName6']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName7'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName8']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName9'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName10']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-5 ml-md-5"><?php echo $jsaT['attendeeName11'] ?></div>
                    <div class="col-md-5"><?php echo $jsaT['attendeeName12']; ?></div>
                </div><!--end row-->
            </div><!--end group attendees-->
                <div class="row mt-md-5 justify-content-md-center">
<!--                    <div class="col-md-1 mb-1">-->
<!--                        <button id="back" class="btn btn-success" type="button" onclick="window.history.back()">GO BACK</button>-->
<!--                    </div>-->
                </div><!--end row-->
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>