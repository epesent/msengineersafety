<?php
    session_start();
    $permissionLevel = $_SESSION['permissionLevel'];
    if (empty($permissionLevel)) {
        header("location:index.php");
    }
    if (isset($_GET['jsaId'])) {
        $jsaId = $_GET['jsaId'];
    }


    $jsaId = 8;

    require_once 'connectdb.php';
    $jsa = getJSARep ($dbconn, $jsaId);
    $userId = $jsa['userId'];
    $assoc = getAsc ($dbconn, $userId);
    $divisionId = $jsa['divisionId'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>JSA Report</title>
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
        .printSpace {
            display: none;
        }

        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
            .printSpace {
                display: block;
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
            <div class="row justify-content-center pt-2 pt-md-3">
                <div class="col-md-5 text-center"><h4>M&S Power Services<br>Job Safety Analysis</h4></div>
            </div><!--end row-->
            <div class="row justify-content-md-center mb-md-4">
                <div class="col-md-6 text-center">Submitted by: <?php echo $assoc['firstName'] . " " .$assoc['lastName']; ?></div>
            </div><!--end row-->

            <div class="row mb-md-3">
                <div class="col-md-1 ml-md-5">Date:</div>
                <?php
                    $pDate = new DateTime($jsa['jobDate']) ;
                    $date = $pDate->format('m/d/Y');
                ?>
                <div class="col-md-2"><?php echo $date; ?></div>
                <div class="col-md-2">Work Location:</div>
                <div class="col-md-5"><?php echo $jsa['workLocation'] ?></div>
            </div><!--end row-->
            <div class="row mb-md-3">
                <div class="col-md-1 ml-md-5">Time:</div>
                <?php
                    $pTime = new DateTime($jsa['jobTime']);
                    $jobTime = $pTime->format('h:i a');
                ?>
                <div class="col-md-2"><?php echo $jobTime; ?></div>
                <div class="col-md-2">Latitude:</div>
                <div class="col-md-2"><?php echo $jsa['latitude']; ?></div>
                <div class="col-md-2">Longitude:</div>
                <div class="col-md-2"><?php echo $jsa['longitude']; ?></div>
            </div><!--end row-->
            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Emergency Information / Plan:</h5></div>
            </div><!--end row--->

            <div id="EmergencyInfo">
                <div class="form-row justify-content-md-center mb-md-3">
                    <div class="col-md-2">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="nineEleven" class="form-check-label form-control-sm">
                                <input id="nineEleven" name="nineEleven" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['nineEleven'] === '1') {echo "checked=checked";} ?> disabled>911
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="cell" class="form-check-label form-control-sm">
                                <input id="cell" name="cell" type="checkbox" class="form-check-input" <?php if ($jsa['cell'] === '1') {echo "checked=checked";} ?> disabled>Cell
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="radio" class="form-check-label form-control-sm">
                                <input id="radio" name="radio" type="checkbox" class="form-check-input" <?php if ($jsa['radio'] === '1') {echo "checked=checked";} ?> disabled>Radio
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="subPhone" class="form-check-label form-control-sm">
                                <input id="subPhone" name="subPhone" type="checkbox" class="form-check-input" <?php if ($jsa['subPhone'] === '1') {echo "checked=checked";} ?> disabled>Sub Phone
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="facility_shopPhone" class="form-check-label form-control-sm">
                                <input id="facility_shopPhone" name="facility_shopPhone" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['facility_shopPhone'] === '1') {echo "checked=checked";} ?> disabled>Facility/Shop Phone
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="row">
                    <div class="col-md-3 ml-md-5">Hospital:</div>
                    <div class="col-md-8"><?php echo $jsa['latitude']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-3 ml-md-5">Location:</div>
                    <div class="col-md-8"><?php echo $jsa['location']; ?></div>
                </div><!--end row-->
            </div><!--end group emergencyInfo-->

            <div id="peopleInCharge">
                <div class="row">
                    <div class="col-md-3 ml-md-5">Person Performing Job Briefing:</div>
                    <div class="col-md-8"><?php echo $jsa['personPerformingJobBriefing']; ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-3 ml-md-5">Person in Charge of Work:</div>
                    <div class="col-md-8"><?php echo $jsa['personInChargeOfWork']; ?></div>
                </div><!--end row-->
            </div><!--end group people in charge-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Description of Work:</h5></div>
            </div><!--end row--->
            <div id="descriptionWork">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="operatorMaintenance" class="form-check-label form-control-sm">
                                <input id="operatorMaintenance" name="operatorMaintenance" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['operatorMaintenance'] === '1') {echo "checked=checked";} ?> disabled>Operator Maint.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="internalMaintenance" class="form-check-label form-control-sm">
                                <input id="internalMaintenance" name="internalMaintenance" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['internalMaintenance'] === '1') {echo "checked=checked";} ?> disabled>Internal Maint.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="XFER_LTC_Maintenance" class="form-check-label form-control-sm">
                                <input id="XFER_LTC_Maintenance" name="XFER_LTC_Maintenance" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['XFER_LTC_Maintenance'] === '1') {echo "checked=checked";} ?> disabled>XFER/LTC Maint.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="circuitSwitchMaintenance" class="form-check-label form-control-sm">
                                <input id="circuitSwitchMaintenance" name="circuitSwitchMaintenance" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['circuitSwitchMaintenance'] === '1') {echo "checked=checked";} ?> disabled>Circuit Switch Maint.
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="installPortable_XFMR" class="form-check-label form-control-sm">
                                <input id="installPortable_XFMR" name="installPortable_XFMR" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['installPortable_XFMR'] === '1') {echo "checked=checked";} ?> disabled>Install Portable/XFMR
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="lowSideVoltageWork" class="form-check-label form-control-sm">
                                <input id="lowSideVoltageWork" name="lowSideVoltageWork" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['lowSideVoltageWork'] === '1') {echo "checked=checked";} ?> disabled>Low Side Voltage Work
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="regularMaintenance" class="form-check-label form-control-sm">
                                <input id="regularMaintenance" name="regularMaintenance" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['regularMaintenance'] === '1') {echo "checked=checked";} ?> disabled>Regular Maint.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="haulMaterial" class="form-check-label form-control-sm">
                                <input id="haulMaterial" name="haulMaterial" type="checkbox" class="form-check-input" <?php if ($jsa['haulMaterial'] === '1') {echo "checked=checked";} ?> disabled>Haul Material
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="liftSteel" class="form-check-label form-control-sm">
                                <input id="liftSteel" name="liftSteel" type="checkbox" class="form-check-input" <?php if ($jsa['liftSteel'] === '1') {echo "checked=checked";} ?> disabled>Lift Steel
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-8"><?php echo $jsa['otherDescriptionOfWork']; ?></div>
                </div><!--end  row-->
            </div><!--end group description work-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Hazards Associated with Work:</h5></div>
            </div><!--end row--->
            <div id="hazardsWork">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="energizedApparatus" class="form-check-label form-control-sm">
                                <input id="energizedApparatus" name="energizedApparatus" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['energizedApparatus'] === '1') {echo "checked=checked";} ?> disabled>Energized Apparatus
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="electrical_OVHTransmissionLines" class="form-check-label form-control-sm">
                                <input id="electrical_OVHTransmissionLines" name="electrical_OVHTransmissionLines" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['electrical_OVHTransmissionLines'] === '1') {echo "checked=checked";} ?> disabled>Electrical-OVH Transmission Lines
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="heavyObjects" class="form-check-label form-control-sm">
                                <input id="heavyObjects" name="heavyObjects" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['heavyObjects'] === '1') {echo "checked=checked";} ?> disabled>Heavy Objects
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="electrical-busWork" class="form-check-label form-control-sm">
                                <input id="electrical_busWork" name="electrical_busWork" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['electrical_busWork'] === '1') {echo "checked=checked";} ?> disabled>Electrical-bus Work
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="equipmentInMotion" class="form-check-label form-control-sm">
                                <input id="equipmentInMotion" name="equipmentInMotion" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['equipmentInMotion'] === '1') {echo "checked=checked";} ?> disabled>Equipment in Motion
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noise" class="form-check-label form-control-sm">
                                <input id="noise" name="noise" type="checkbox" class="form-check-input" <?php if ($jsa['noise'] === '1') {echo "checked=checked";} ?> disabled>Noise
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="electricalDistributionLines" class="form-check-label form-control-sm">
                                <input id="electricalDistributionLines" name="electricalDistributionLines" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['electricalDistributionLines'] === '1') {echo "checked=checked";} ?> disabled>Electrical Distribution Lines
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="highAirPressureSystem" class="form-check-label form-control-sm">
                                <input id="highAirPressureSystem" name="highAirPressureSystem" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['highAirPressureSystem'] === '1') {echo "checked=checked";} ?> disabled>High Air Pressure System
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="sharp_pointedEdges" class="form-check-label form-control-sm">
                                <input id="sharp_pointedEdges" name="sharp_pointedEdges" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['sharp_pointedEdges'] === '1') {echo "checked=checked";} ?> disabled>Sharp/Pointed Edges
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="slip_tripOnUnevenGround" class="form-check-label form-control-sm">
                                <input id="slip_tripOnUnevenGround" name="slip_tripOnUnevenGround" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['slip_tripOnUnevenGround'] === '1') {echo "checked=checked";} ?> disabled>Slip/Trip on Uneven Ground
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="falling" class="form-check-label form-control-sm">
                                <input id="falling" name="falling" type="checkbox" class="form-check-input" <?php if ($jsa['falling'] === '1') {echo "checked=checked";} ?> disabled>Falling
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="fallingObjects" class="form-check-label form-control-sm">
                                <input id="fallingObjects" name="fallingObjects" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['fallingObjects'] === '1') {echo "checked=checked";} ?> disabled>Falling Objects
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="snakes_wasps" class="form-check-label form-control-sm">
                                <input id="snakes_wasps" name="snakes_wasps" type="checkbox" class="form-check-input" <?php if ($jsa['snakes_wasps'] === '1') {echo "checked=checked";} ?> disabled>Snakes/Wasps
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="holes_excavations" class="form-check-label form-control-sm">
                                <input id="holes_excavations" name="holes_excavations" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['holes_excavations'] === '1') {echo "checked=checked";} ?> disabled>Holes/Excavations
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hydraulicPressureSystem" class="form-check-label form-control-sm">
                                <input id="hydraulicPressureSystem" name="hydraulicPressureSystem" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['hydraulicPressureSystem'] === '1') {echo "checked=checked";} ?> disabled>Hydraulic Pressure System
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="traps" class="form-check-label form-control-sm">
                                <input id="traps" name="traps" type="checkbox" class="form-check-input" <?php if ($jsa['traps'] === '1') {echo "checked=checked";} ?> disabled>Traps
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-7"><?php echo $jsa['otherHazard'] ?></div>
                </div><!--end row-->
            </div><!--end group hazards work-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Specific Work Procedures:</h5></div>
            </div><!--end row--->
            <div id="specificProcedures" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="health_safetyHandbook" class="form-check-label form-control-sm">
                                <input id="health_safetyHandbook" name="health_safetyHandbook" type="checkbox" class="form-check-input "
                                    <?php if ($jsa['health_safetyHandbook'] === '1') {echo "checked=checked";} ?> disabled>Health/Safety Handbook
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="meter_verifyBeforeGrounding" class="form-check-label form-control-sm">
                                <input id="meter_verifyBeforeGrounding" name="meter_verifyBeforeGrounding" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['meter_verifyBeforeGrounding'] === '1') {echo "checked=checked";} ?> disabled>Meter/Verify Before Grounding
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="visuallyIDPotentialEnergySources" class="form-check-label form-control-sm pl-0">
                                <input id="visuallyIDPotentialEnergySources" name="visuallyIDPotentialEnergySources" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['visuallyIDPotentialEnergySources'] === '1') {echo "checked=checked";} ?> disabled>Visually ID Potential Energy Sources
                            </label>
                        </div>
                    </div>
                </div><!--end from row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="errorEliminationTools" class="form-check-label form-control-sm">
                                <input id="errorEliminationTools" name="errorEliminationTools" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['errorEliminationTools'] === '1') {echo "checked=checked";} ?> disabled>Error Elimination Tools
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-8"><?php echo $jsa['otherSpecificWorkProcedures']; ?></div>
                </div><!--end from row-->
            </div><!--end group specific procedures-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Special Conditions or Concerns:</h5></div>
            </div><!--end row--->
            <div id="specialConditions" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="step_touchPotential" class="form-check-label form-control-sm">
                                <input id="step_touchPotential" name="step_touchPotential" type="checkbox" class="form-check-input "
                                    <?php if ($jsa['step_touchPotential'] === '1') {echo "checked=checked";} ?> disabled>Step/Touch Potential
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="backing" class="form-check-label form-control-sm">
                                <input id="backing" name="backing" type="checkbox" class="form-check-input"  <?php if ($jsa['backing'] === '1') {echo "checked=checked";} ?> disabled>Backing
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="wet_muddy" class="form-check-label form-control-sm pl-0">
                                <input id="wet_muddy" name="wet_muddy" type="checkbox" class="form-check-input"  <?php if ($jsa['wet_muddy'] === '1') {echo "checked=checked";} ?> disabled>Wet/Muddy
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="bucketEmergencyLetDownUnderstood" class="form-check-label form-control-sm">
                                <input id="bucketEmergencyLetDownUnderstood" name="bucketEmergencyLetDownUnderstood" type="checkbox" class="form-check-input "
                                    <?php if ($jsa['bucketEmergencyLetDownUnderstood'] === '1') {echo "checked=checked";} ?> disabled>Bucket Emergency Let Down Understood
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="heatStress" class="form-check-label form-control-sm">
                                <input id="heatStress" name="heatStress" type="checkbox" class="form-check-input" <?php if ($jsa['heatStress'] === '1') {echo "checked=checked";} ?> disabled>Heat Stress
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="weather" class="form-check-label form-control-sm pl-0">
                                <input id="weather" name="weather" type="checkbox" class="form-check-input" <?php if ($jsa['weather'] === '1') {echo "checked=checked";} ?> disabled>Weather
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="bucketEmergencyControlsTestedAndVerified" class="form-check-label form-control-sm">
                                <input id="bucketEmergencyControlsTestedAndVerified" name="bucketEmergencyControlsTestedAndVerified" type="checkbox" class="form-check-input "
                                    <?php if ($jsa['bucketEmergencyControlsTestedAndVerified'] === '1') {echo "checked=checked";} ?> disabled>Bucket Emergency Controls Tested & Verified
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="positionOfEquipment" class="form-check-label form-control-sm">
                                <input id="positionOfEquipment" name="positionOfEquipment" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['positionOfEquipment'] === '1') {echo "checked=checked";} ?> disabled>Position of Equipment
                            </label>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-3">
                        &nbsp;
                    </div>
                </div><!--end row-->
                <div class="row mt-md-2">
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-11"><?php echo $jsa['otherSpecialConditionsOrConcerns']; ?></div>
                </div><!--end row-->
            </div><!--end group special conditions-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Energy Sources:</h5></div>
            </div><!--end row--->
            <div id="energySources" class="form-group">
                <!--this section is only seen md and above due to the arrangement of the "Safe Distance" columns underneath the voltage checkboxes-->
                <div id="showMD" class="d-none d-md-block ">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="345kv" class="form-check-label form-control-sm">
                                    <input id="345kv" name="345kv" type="checkbox" class="form-check-input" <?php if ($jsa['345kv'] === '1') {echo "checked=checked";} ?> disabled>345 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="138kv" class="form-check-label form-control-sm">
                                    <input id="138kv" name="138kv" type="checkbox" class="form-check-input" <?php if ($jsa['138kv'] === '1') {echo "checked=checked";} ?> disabled>138 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="69kv" class="form-check-label form-control-sm">
                                    <input id="69kv" name="69kv" type="checkbox" class="form-check-input" <?php if ($jsa['69kv'] === '1') {echo "checked=checked";} ?> disabled>69 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="24-9kv" class="form-check-label form-control-sm">
                                    <input id="24_9kv" name="24_9kv" type="checkbox" class="form-check-input" <?php if ($jsa['24_9kv'] === '1') {echo "checked=checked";} ?> disabled>24.9 kv
                                </label>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-md-2">Safe Distance:</div>
                        <div class="col-md-2"><?php if(!empty($jsa['345kvSafeDistance'])) {echo $jsa['345kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['138kvSafeDistance'])) {echo $jsa['138kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['69kvSafeDistance'])) {echo $jsa['69kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['24_9kvSafeDistance'])) {echo $jsa['24_9kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    </div><!--end row-->
                    <div class="form-row justify-content-md-center mt-3">
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="14_4kv" class="form-check-label form-control-sm">
                                    <input id="14_4kv" name="14_4kv" type="checkbox" class="form-check-input" <?php if ($jsa['14_4kv'] === '1') {echo "checked=checked";} ?> disabled>14.4 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="12_5kv" class="form-check-label form-control-sm">
                                    <input id="12_5kv" name="12_5kv" type="checkbox" class="form-check-input" <?php if ($jsa['12_5kv'] === '1') {echo "checked=checked";} ?> disabled>12.5 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="7_2kv" class="form-check-label form-control-sm">
                                    <input id="7_2kv" name="7_2kv" type="checkbox" class="form-check-input" <?php if ($jsa['7_2kv'] === '1') {echo "checked=checked";} ?> disabled>7.2 kv
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 d-none d-md-block">
                            &nbsp;
                        </div>
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-md-2">Safe Distance:</div>
                        <div class="col-md-2"><?php if(!empty($jsa['14_4kvSafeDistance'])) {echo $jsa['14_4kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['12_5kvSafeDistance'])) {echo $jsa['12_5kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['7_2kvSafeDistance'])) {echo $jsa['7_2kvSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2 d-none d-md-block">&nbsp;</div>
                    </div><!--end row-->

                    <div class="form-row justify-content-md-center mt-3">
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="480vac" class="form-check-label form-control-sm">
                                    <input id="480vac" name="480vac" type="checkbox" class="form-check-input" <?php if ($jsa['480vac'] === '1') {echo "checked=checked";} ?> disabled>480 VAC
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="120vac" class="form-check-label form-control-sm">
                                    <input id="120vac" name="120vac" type="checkbox" class="form-check-input" <?php if ($jsa['120vac'] === '1') {echo "checked=checked";} ?> disabled>120 VAC
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="130vdc" class="form-check-label form-control-sm">
                                    <input id="130vdc" name="130vdc" type="checkbox" class="form-check-input" <?php if ($jsa['130vdc'] === '1') {echo "checked=checked";} ?> disabled>130 VDC
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            &nbsp;
                        </div>
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-md-2">Safe Distance:</div>
                        <div class="col-md-2"><?php if(!empty($jsa['480vacSafeDistance'])) {echo $jsa['480vacSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['120vacSafeDistance'])) {echo $jsa['120vacSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2"><?php if(!empty($jsa['130vdcSafeDistance'])) {echo $jsa['130vdcSafeDistance'];} else {echo "N/A";}  ?></div>
                        <div class="col-md-2 d-none d-md-block">&nbsp;</div>
                    </div><!--end row-->
                </div><!--end showMD-->
                <!--this section is only seen sm and below due to the arrangement of the "Safe Distance" columns underneath the voltage checkboxes-->
                <div id="showMobile" class="d-md-none">
                    <label for="345kv" class="form-check-label form-control-sm ml-3">
                        <input id="345kv" name="345kv" type="checkbox" class="form-check-input" value="1">345 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['345kvSafeDistance'])) {echo $jsa['345kvSafeDistance'];} else {echo "N/A";}  ?></div>

                    <label for="138kv" class="form-check-label form-control-sm ml-3">
                        <input id="138kv" name="138kv" type="checkbox" class="form-check-input" value="1">138 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['138kvSafeDistance'])) {echo $jsa['138kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="69kv" class="form-check-label form-control-sm ml-3">
                        <input id="69kv" name="69kv" type="checkbox" class="form-check-input" value="1">69 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['69kvSafeDistance'])) {echo $jsa['69kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="24_9kv" class="form-check-label form-control-sm ml-3">
                        <input id="24_9kv" name="24_9kv" type="checkbox" class="form-check-input" value="1">24.9 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['24_9kvSafeDistance'])) {echo $jsa['24_9kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="14_4kv" class="form-check-label form-control-sm ml-3">
                        <input id="14_4kv" name="14_4kv" type="checkbox" class="form-check-input" value="1">14.4 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['14_4kvSafeDistance'])) {echo $jsa['14_4kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="12_5kv" class="form-check-label form-control-sm ml-3">
                        <input id="12_5kv" name="12_5kv" type="checkbox" class="form-check-input" value="1">12.5 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['12_5kvSafeDistance'])) {echo $jsa['12_5kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="7_2kv" class="form-check-label form-control-sm ml-3">
                        <input id="7_2kv" name="7_2kv" type="checkbox" class="form-check-input" value="1">7.2 kv
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['7_2kvSafeDistance'])) {echo $jsa['7_2kvSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="480vac" class="form-check-label form-control-sm ml-3">
                        <input id="480vac" name="480vac" type="checkbox" class="form-check-input" value="1">480 VAC
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['480vacSafeDistance'])) {echo $jsa['480vacSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="120vac" class="form-check-label form-control-sm ml-3">
                        <input id="120vac" name="120vac" type="checkbox" class="form-check-input" value="1">120 VAC
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['120vacSafeDistance'])) {echo $jsa['120vacSafeDistance'];} else {echo "N/A";}  ?></div>
                    <label for="130vdc" class="form-check-label form-control-sm ml-3">
                        <input id="130vdc" name="130vdc" type="checkbox" class="form-check-input" value="1">130 VDC
                    </label>
                    <div>Safe Distance: <?php if(!empty($jsa['130vdcSafeDistance'])) {echo $jsa['130vdcSafeDistance'];} else {echo "N/A";}  ?></div>
                </div><!--end showMobile-->
                <div class="form-row justify-content-md-center mt-md-3">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="lightning" class="form-check-label form-control-sm">
                                <input id="lightning" name="lightning" type="checkbox" class="form-check-input " <?php if ($jsa['lightning'] === '1') {echo "checked=checked";} ?> disabled>Lightning
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="induction" class="form-check-label form-control-sm">
                                <input id="induction" name="induction" type="checkbox" class="form-check-input" <?php if ($jsa['induction'] === '1') {echo "checked=checked";} ?> disabled>Induction
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="faultOnLine_Apparatus" class="form-check-label form-control-sm pl-0">
                                <input id="faultOnLine_Apparatus" name="faultOnLine_Apparatus" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['faultOnLine_Apparatus'] === '1') {echo "checked=checked";} ?> disabled>Fault on Line/Apparatus
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="static" class="form-check-label form-control-sm">
                                <input id="static" name="static" type="checkbox" class="form-check-input" <?php if ($jsa['static'] === '1') {echo "checked=checked";} ?> disabled>Static
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row mt-md-2">
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-10"><?php echo $jsa['otherEnergySource'] ?></div>
                </div><!--end row-->
            </div><!--end energy sources-->
            <!--This spacer is put here to allow for a page break when printing the report -->
            <div class="page-break"></div>
            <div class="printSpace" style="height: 50px;">&nbsp;</div>
            <div class="row mt-md-5">
                <div class="col-md-6"><h5>Other Energy Sources:</h5></div>
            </div><!--end row--->
            <div id="otherEnergy" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hydraulic" class="form-check-label form-control-sm">
                                <input id="hydraulic" name="hydraulic" type="checkbox" class="form-check-input" <?php if ($jsa['hydraulic'] === '1') {echo "checked=checked";} ?> disabled>Hydraulic
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="pneumatic" class="form-check-label form-control-sm">
                                <input id="pneumatic" name="pneumatic" type="checkbox" class="form-check-input" <?php if ($jsa['pneumatic'] === '1') {echo "checked=checked";} ?> disabled>Pneumatic
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="chemical" class="form-check-label form-control-sm">
                                <input id="chemical" name="chemical" type="checkbox" class="form-check-input" <?php if ($jsa['chemical'] === '1') {echo "checked=checked";} ?> disabled>Chemical
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="mechanical" class="form-check-label form-control-sm">
                                <input id="mechanical" name="mechanical" type="checkbox" class="form-check-input" <?php if ($jsa['mechanical'] === '1') {echo "checked=checked";} ?> disabled>Mechanical
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end group other energy-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Controls to be Used:</h5></div>
            </div><!--end row--->
            <div id="controlsUsed" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="notifySocc" class="form-check-label form-control-sm">
                                <input id="notifySocc" name="notifySocc" type="checkbox" class="form-check-input" <?php if ($jsa['notifySocc'] === '1') {echo "checked=checked";} ?> disabled>Notify Socc
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="notifyCustomers" class="form-check-label form-control-sm">
                                <input id="notifyCustomers" name="notifyCustomers" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['notifyCustomers'] === '1') {echo "checked=checked";} ?> disabled>Notify Customers
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="vdi" class="form-check-label form-control-sm">
                                <input id="vdi" name="vdi" type="checkbox" class="form-check-input" <?php if ($jsa['vdi'] === '1') {echo "checked=checked";} ?> disabled>VDI
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="grounding" class="form-check-label form-control-sm">
                                <input id="grounding" name="grounding" type="checkbox" class="form-check-input" <?php if ($jsa['grounding'] === '1') {echo "checked=checked";} ?> disabled>Grounding
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="barrier" class="form-check-label form-control-sm">
                                <input id="barrier" name="barrier" type="checkbox" class="form-check-input" <?php if ($jsa['barrier'] === '1') {echo "checked=checked";} ?> disabled>Barrier
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="lockout_tagout" class="form-check-label form-control-sm">
                                <input id="lockout_tagout" name="lockout_tagout" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['lockout_tagout'] === '1') {echo "checked=checked";} ?> disabled>Lockout/Tagout
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="liveLineTool" class="form-check-label form-control-sm">
                                <input id="liveLineTool" name="liveLineTool" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['liveLineTool'] === '1') {echo "checked=checked";} ?> disabled>Live Line Tool
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="coverup" class="form-check-label form-control-sm">
                                <input id="coverup" name="coverup" type="checkbox" class="form-check-input" <?php if ($jsa['coverup'] === '1') {echo "checked=checked";} ?> disabled>Cover-up
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safeDistance" class="form-check-label form-control-sm">
                                <input id="safeDistance" name="safeDistance" type="checkbox" class="form-check-input" <?php if ($jsa['safeDistance'] === '1') {echo "checked=checked";} ?> disabled>Safe Distance
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="confinedSpace" class="form-check-label form-control-sm">
                                <input id="confinedSpace" name="confinedSpace" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['confinedSpace'] === '1') {echo "checked=checked";} ?> disabled>Confined Space
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="clearanceNumber" class="form-check-label form-control-sm">
                                <input id="clearanceNumber" name="clearanceNumber" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['clearanceNumber'] === '1') {echo "checked=checked";} ?> disabled>Clearance #
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hotLineHoldNumber" class="form-check-label form-control-sm">
                                <input id="hotLineHoldNumber" name="hotLineHoldNumber" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['hotLineHoldNumber'] === '1') {echo "checked=checked";} ?> disabled>Hot Line Hold #
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row mt-md-2">
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-10"><?php echo $jsa['otherControlsToBeUsed']; ?></div>
                </div><!--end row-->
            </div><!--end group controls used-->

            <div class="row mt-md-4">
                <div class="col-md-6"><h5>Personal Protective Equipment:</h5></div>
            </div><!--end row--->
            <div id="personalProtective" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hardHat" class="form-check-label form-control-sm">
                                <input id="hardHat" name="hardHat" type="checkbox" class="form-check-input" <?php if ($jsa['hardHat'] === '1') {echo "checked=checked";} ?> disabled>Hard Hat
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="boots" class="form-check-label form-control-sm">
                                <input id="boots" name="boots" type="checkbox" class="form-check-input" <?php if ($jsa['boots'] === '1') {echo "checked=checked";} ?> disabled>Boots
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="leatherGloves" class="form-check-label form-control-sm">
                                <input id="leatherGloves" name="leatherGloves" type="checkbox" class="form-check-input" <?php if ($jsa['leatherGloves'] === '1') {echo "checked=checked";} ?> disabled>Leather Gloves
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="harness_lanyard" class="form-check-label form-control-sm">
                                <input id="harness_lanyard" name="harness_lanyard" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['harness_lanyard'] === '1') {echo "checked=checked";} ?> disabled>Harness/Lanyard
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyGlasses" class="form-check-label form-control-sm">
                                <input id="safetyGlasses" name="safetyGlasses" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['safetyGlasses'] === '1') {echo "checked=checked";} ?> disabled>Safety Glasses
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="cottonClothing" class="form-check-label form-control-sm">
                                <input id="cottonClothing" name="cottonClothing" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['cottonClothing'] === '1') {echo "checked=checked";} ?> disabled>Cotton Clothing
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="rubberGloves_sleeves" class="form-check-label form-control-sm">
                                <input id="rubberGloves_sleeves" name="rubberGloves_sleeves" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['rubberGloves_sleeves'] === '1') {echo "checked=checked";} ?> disabled>Rubber Gloves/Sleeves
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="hearingProtection" class="form-check-label form-control-sm">
                                <input id="hearingProtection" name="hearingProtection" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['hearingProtection'] === '1') {echo "checked=checked";} ?> disabled>Hearing Protection
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="frc" class="form-check-label form-control-sm">
                                <input id="frc" name="frc" type="checkbox" class="form-check-input" <?php if ($jsa['frc'] === '1') {echo "checked=checked";} ?> disabled>FRC
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="safetyVest" class="form-check-label form-control-sm">
                                <input id="safetyVest" name="safetyVest" type="checkbox" class="form-check-input" <?php if ($jsa['safetyVest'] === '1') {echo "checked=checked";} ?> disabled>Safety Vest
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1">Other:</div>
                    <div class="col-md-5"><?php echo $jsa['otherPersonalProtectiveEquipment']; ?></div>
                </div><!--end row-->
            </div><!--end group personal protective-->

            <div class="row mt-md-4">
                <div class="col-md-8"><h5>Personal Protective Equipment Visual FR Clothing Check:</h5></div>
            </div><!--end row--->
            <div id="ppeVisual" class="form-group">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="frShirtTuckedIn" class="form-check-label form-control-sm">
                                <input id="frShirtTuckedIn" name="frShirtTuckedIn" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['frShirtTuckedIn'] === '1') {echo "checked=checked";} ?> disabled>FR Shirt Tucked In
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="clothingHasNoTears" class="form-check-label form-control-sm">
                                <input id="clothingHasNoTears" name="clothingHasNoTears" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['clothingHasNoTears'] === '1') {echo "checked=checked";} ?> disabled>Clothing has no Tears/Holes/Frayed Edges
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="form-row justify-content-md-center">
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noContactWithBleachOrDEET" class="form-check-label form-control-sm">
                                <input id="noContactWithBleachOrDEET" name="noContactWithBleachOrDEET" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['noContactWithBleachOrDEET'] === '1') {echo "checked=checked";} ?> disabled>No Contact With Bleach or DEET
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                            <label for="noStainsOnClothing" class="form-check-label form-control-sm">
                                <input id="noStainsOnClothing" name="noStainsOnClothing" type="checkbox" class="form-check-input"
                                    <?php if ($jsa['noStainsOnClothing'] === '1') {echo "checked=checked";} ?> disabled>No Stains on Clothing
                            </label>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end group ppe Visual-->

            <div class="row mt-md-4">
                <div class="col-md-8"><h5>Additional Information As Necessary:</h5></div>
            </div><!--end row--->
            <div class="row justify-content-md-center">
                <div class="col-md-10"><?php echo $jsa['additionalInformationAsNecessary']; ?></div>
            </div><!--end row-->
            <div class="row mt-md-4">
                <div class="col-md-8"><h5>Crew Members (and Others) Participating in Job Briefings:</h5></div>
            </div><!--end row--->
            <div id="participants" class="form-group">
                <div class="row">
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName1'])) {echo $jsa['crewMemberName1'];}else{echo "&nbsp;";} ?></div>
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName2'])) {echo $jsa['crewMemberName2'];}else{echo "&nbsp;";} ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName3'])) {echo $jsa['crewMemberName3'];}else{echo "&nbsp;";} ?></div>
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName4'])) {echo $jsa['crewMemberName4'];}else{echo "&nbsp;";} ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName5'])) {echo $jsa['crewMemberName5'];}else{echo "&nbsp;";} ?></div>
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName6'])) {echo $jsa['crewMemberName6'];}else{echo "&nbsp;";} ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName7'])) {echo $jsa['crewMemberName7'];}else{echo "&nbsp;";} ?></div>
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName8'])) {echo $jsa['crewMemberName8'];}else{echo "&nbsp;";} ?></div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName9'])) {echo $jsa['crewMemberName9'];}else{echo "&nbsp;";} ?></div>
                    <div class="col-md-6"><?php if (!empty($jsa['crewMemberName10'])) {echo $jsa['crewMemberName10'];}else{echo "&nbsp;";} ?></div>
                </div><!--end row-->
            </div><!--end group participants-->
            <div id="procedures" class="small">
                <p><span class="font-weight-bold">Procedures:</span> A job briefing, or tailboard session, is a meeting that takes place before the work begins to discuss the work, procedures, hazards,
                safety controls, and other information to assist the worker or crew. The assessment and job briefing is typically done by the person in charge of the work. The briefing helps to define how
                the work will be performed, who is involved, individual responsibilities, etc. This job briefing procedure is intended to be applied to all work, but is focused on field work and jobs of
                higher risk. The following are procedures that must be followed.</p>
                <p>A job briefing shall be held daily. Job briefings shall be documented on this or similar form containing the same information. More than one job briefing may be necessary. It is
                the responsibility of the person in charge of the work to determine whether additional job briefings are necessary. Additional job briefings shall be held if significant changes which might
                affect the worker of public safety have occurred. However, any crew member may request a job briefing, or perform a job briefing. The person in charge of the work shall ensure that all
                job briefings are complete, accurate, and suitable.</p>
                <p><span class="font-weight-bold">Recordkeeping:</span> Completed forms shall be maintained for the work day. They should be turned into the responsible safety officer weekly (RSO).
                 If an incident or near miss has occurred, the form shall be attached to the incident report and turned into RSO.</p>
            </div><!--end procedures-->
            <div class="row mt-md-5 justify-content-md-center">
                <div class="col-md-1 mb-1">
<!--                    <button class="btn btn-success" type="button" onclick="window.history.back()">GO BACK</button>-->
                </div>
            </div><!--end row-->
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>

