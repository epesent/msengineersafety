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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>JSA FORM</title>
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
                <div class="col-md-5 text-center"><h4>M&S Power Services<br>Job Safety Analysis</h4></div>
            </div><!--end row-->
            <form action="" method="post">
                <div id="generalInfo" class="form-group">
                    <div class="form-row mb-md-3">
                        <label for="jobDate" class="col-md-1 form-control-label form-control-sm ml-md-5">Date:</label>
                        <input type="text" id="jobDate" name="jobDate" class="col-md-2 form-control form-control-sm pickDate"/>
                        <label for="workLocation" class="col-md-2 form-control-label form-control-sm text-md-right">Work Location:</label>
                        <input type="text" id="workLocation" name="workLocation" class="col-md-5 form-control"/>
                    </div><!--end from row-->
                    <div class="form-row mb-md-3">
                        <label for="jobTime" class="col-md-1 form-control-label form-control-sm ml-md-5">Time:</label>
                        <input type="time" name="jobTime" id="jobTime" class="col-md-2 form-control"/>
                        <label for="latitude" class="col-md-2 form-control-label form-control-sm text-md-right">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" class="col-md-2 form-control form-control-sm"/>
                        <label for="longitude" class="col-md-2 form-control-label form-control-sm text-md-right">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" class="col-md-2 form-control form-control-sm"/>
                    </div><!--end from row-->
                </div><!--end form group general info-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Emergency Information / Plan:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="EmergencyInfo" class="form-group">
                    <div class="form-row justify-content-md-center mb-md-3">
                        <div class="col-md-2">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="nineEleven" class="form-check-label form-control-sm">
                                    <input id="nineEleven" name="nineEleven" type="checkbox" class="form-check-input" value="1">911
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="cell" class="form-check-label form-control-sm">
                                    <input id="cell" name="cell" type="checkbox" class="form-check-input" value="1">Cell
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="Radio" class="form-check-label form-control-sm">
                                    <input id="Radio" name="Radio" type="checkbox" class="form-check-input" value="1">Radio
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="subPhone" class="form-check-label form-control-sm">
                                    <input id="subPhone" name="subPhone" type="checkbox" class="form-check-input" value="1">Sub Phone
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="facility_shopPhone" class="form-check-label form-control-sm">
                                    <input id="facility_shopPhone" name="facility_shopPhone" type="checkbox" class="form-check-input" value="1">Facility/Shop Phone
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row mb-md-3">
                        <label for="hospital" class="col-md-2 form-control-label form-control-sm ml-md-5">Hospital:</label>
                        <input type="text" id="hospital" name="hospital" class="col-md-8 form-control"/>
                    </div><!--end form row-->
                    <div class="form-row mb-md-3">
                        <label for="location" class="col-md-2 form-control-label form-control-sm ml-md-5">Location:</label>
                        <input type="text" id="location" name="location" class="col-md-8 form-control form-control-sm"/>
                    </div><!--end form row-->
                </div><!--end form group emergencyInfo-->
                <div id="peopleInCharge" class="form-group">
                    <div class="form-row mb-md-3">
                        <label for="personPerformingJobBriefing" class="col-md-3 form-control-label form-control-sm ml-md-5">Person Performing Job Briefing:</label>
                        <input type="text" id="personPerformingJobBriefing" name="personPerformingJobBriefing" class="col-md-6 form-control form-control-sm"/>
                    </div><!--end form row-->
                    <div class="form-row mb-md-3">
                        <label for="personInChargeOfWork" class="col-md-3 form-control-label form-control-sm ml-md-5">Person in Charge of Work:</label>
                        <input type="text" id="personInChargeOfWork" name="personInChargeOfWork" class="col-md-6 form-control form-control-sm"/>
                    </div><!--end form row-->
                </div><!--end form group people in charge-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Description of Work:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="descriptionWork" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="operatorMaintenance" class="form-check-label form-control-sm">
                                    <input id="operatorMaintenance" name="operatorMaintenance" type="checkbox" class="form-check-input" value="1">Operator Maint.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="internalMaintenance" class="form-check-label form-control-sm">
                                    <input id="internalMaintenance" name="internalMaintenance" type="checkbox" class="form-check-input" value="1">Internal Maint.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="XFER_LTC_Maintenance" class="form-check-label form-control-sm">
                                    <input id="XFER_LTC_Maintenance" name="XFER_LTC_Maintenance" type="checkbox" class="form-check-input" value="1">XFER/LTC Maint.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="circuitSwitchMaintenance" class="form-check-label form-control-sm">
                                    <input id="circuitSwitchMaintenance" name="circuitSwitchMaintenance" type="checkbox" class="form-check-input" value="1">Circuit Switch Maint.
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="installPortable_XFMR" class="form-check-label form-control-sm">
                                    <input id="installPortable_XFMR" name="installPortable_XFMR" type="checkbox" class="form-check-input" value="1">Install Portable/XFMR
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="lowSideVoltageWork" class="form-check-label form-control-sm">
                                    <input id="lowSideVoltageWork" name="lowSideVoltageWork" type="checkbox" class="form-check-input" value="1">Low Side Voltage Work
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="regularMaintenance" class="form-check-label form-control-sm">
                                    <input id="regularMaintenance" name="regularMaintenance" type="checkbox" class="form-check-input" value="1">Regular Maint.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="haulMaterial" class="form-check-label form-control-sm">
                                    <input id="haulMaterial" name="haulMaterial" type="checkbox" class="form-check-input" value="1">Haul Material
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="liftSteel" class="form-check-label form-control-sm">
                                    <input id="liftSteel" name="liftSteel" type="checkbox" class="form-check-input" value="1">Lift Steel
                                </label>
                            </div>
                        </div>
                        <label for="otherDescriptionOfWork" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherDescriptionOfWork" name="otherDescriptionOfWork" class="form-control col-md-8"/>
                    </div><!--end from row-->
                </div><!--end form group description work-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Hazards Associated with Work:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="hazardsWork" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="energizedApparatus" class="form-check-label form-control-sm">
                                    <input id="energizedApparatus" name="energizedApparatus" type="checkbox" class="form-check-input" value="1">Energized Apparatus
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="electrical-OVHTransmissionLines" class="form-check-label form-control-sm">
                                    <input id="electrical-OVHTransmissionLines" name="electrical-OVHTransmissionLines" type="checkbox" class="form-check-input" value="1">Electrical-OVH Transmission Lines
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="heavyObjects" class="form-check-label form-control-sm">
                                    <input id="heavyObjects" name="heavyObjects" type="checkbox" class="form-check-input" value="1">Heavy Objects
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="electrical-busWork" class="form-check-label form-control-sm">
                                    <input id="electrical_busWork" name="electrical_busWork" type="checkbox" class="form-check-input" value="1">Electrical-bus Work
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="equipmentInMotion" class="form-check-label form-control-sm">
                                    <input id="equipmentInMotion" name="equipmentInMotion" type="checkbox" class="form-check-input" value="1">Equipment in Motion
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noise" class="form-check-label form-control-sm">
                                    <input id="noise" name="noise" type="checkbox" class="form-check-input" value="1">Noise
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="electricalDistributionLines" class="form-check-label form-control-sm">
                                    <input id="electricalDistributionLines" name="electricalDistributionLines" type="checkbox" class="form-check-input" value="1">Electrical Distribution Lines
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="highAirPressureSystem" class="form-check-label form-control-sm">
                                    <input id="highAirPressureSystem" name="highAirPressureSystem" type="checkbox" class="form-check-input" value="1">High Air Pressure System
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="sharp_pointedEdges" class="form-check-label form-control-sm">
                                    <input id="sharp_pointedEdges" name="sharp_pointedEdges" type="checkbox" class="form-check-input" value="1">Sharp/Pointed Edges
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="slip_tripOnUnevenGround" class="form-check-label form-control-sm">
                                    <input id="slip_tripOnUnevenGround" name="slip_tripOnUnevenGround" type="checkbox" class="form-check-input" value="1">Slip/Trip on Uneven Ground
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="falling" class="form-check-label form-control-sm">
                                    <input id="falling" name="falling" type="checkbox" class="form-check-input" value="1">Falling
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="fallingObjects" class="form-check-label form-control-sm">
                                    <input id="fallingObjects" name="fallingObjects" type="checkbox" class="form-check-input" value="1">Falling Objects
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="snakes_wasps" class="form-check-label form-control-sm">
                                    <input id="snakes_wasps" name="snakes_wasps" type="checkbox" class="form-check-input" value="1">Snakes/Wasps
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="holes_excavations" class="form-check-label form-control-sm">
                                    <input id="holes_excavations" name="holes_excavations" type="checkbox" class="form-check-input" value="1">Holes/Excavations
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hydraulicPressureSystem" class="form-check-label form-control-sm">
                                    <input id="hydraulicPressureSystem" name="hydraulicPressureSystem" type="checkbox" class="form-check-input" value="1">Hydraulic Pressure System
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="traps" class="form-check-label form-control-sm">
                                    <input id="traps" name="traps" type="checkbox" class="form-check-input" value="1">Traps
                                </label>
                            </div>
                        </div>
                        <label for="otherHazard" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherHazard" name="otherHazard" class="form-control form-control-sm col-md-7"/>
                    </div><!--end from row-->
                </div><!--end form group hazards work-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Specific Work Procedures:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="specificProcedures" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="health_safetyHandbook" class="form-check-label form-control-sm">
                                    <input id="health_safetyHandbook" name="health_safetyHandbook" type="checkbox" class="form-check-input " value="1">Health/Safety Handbook
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="meter_verifyBeforeGrounding" class="form-check-label form-control-sm">
                                    <input id="meter_verifyBeforeGrounding" name="meter_verifyBeforeGrounding" type="checkbox" class="form-check-input" value="1">Meter/Verify Before Grounding
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="visuallyIDPotentialEnergySources" class="form-check-label form-control-sm pl-0">
                                    <input id="visuallyIDPotentialEnergySources" name="visuallyIDPotentialEnergySources" type="checkbox" class="form-check-input" value="1">Visually ID Potential Energy Sources
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="errorEliminationTools" class="form-check-label form-control-sm">
                                    <input id="errorEliminationTools" name="errorEliminationTools" type="checkbox" class="form-check-input" value="1">Error Elimination Tools
                                </label>
                            </div>
                        </div>
                        <label for="otherSpecificWorkProcedures" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherSpecificWorkProcedures" name="otherSpecificWorkProcedures" class="form-control form-control-sm col-md-8"/>
                    </div><!--end from row-->
                </div><!--end form group specific procedures-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Special Conditions or Concerns:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="specialConditions" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="step_touchPotential" class="form-check-label form-control-sm">
                                    <input id="step_touchPotential" name="step_touchPotential" type="checkbox" class="form-check-input " value="1">Step/Touch Potential
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="backing" class="form-check-label form-control-sm">
                                    <input id="backing" name="backing" type="checkbox" class="form-check-input" value="1">Backing
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="wet_muddy" class="form-check-label form-control-sm pl-0">
                                    <input id="wet_muddy" name="wet_muddy" type="checkbox" class="form-check-input" value="1">Wet/Muddy
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="bucketEmergencyLetDownUnderstood" class="form-check-label form-control-sm">
                                    <input id="bucketEmergencyLetDownUnderstood" name="bucketEmergencyLetDownUnderstood" type="checkbox" class="form-check-input " value="1">Bucket Emergency Let Down Understood
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="heatStress" class="form-check-label form-control-sm">
                                    <input id="heatStress" name="heatStress" type="checkbox" class="form-check-input" value="1">Heat Stress
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="weather" class="form-check-label form-control-sm pl-0">
                                    <input id="weather" name="weather" type="checkbox" class="form-check-input" value="1">Weather
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="bucketEmergencyControlsTestedAndVerified" class="form-check-label form-control-sm">
                                    <input id="bucketEmergencyControlsTestedAndVerified" name="bucketEmergencyControlsTestedAndVerified" type="checkbox" class="form-check-input " value="1">Bucket Emergency
                                    Controls Tested & Verified
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="positionOfEquipment" class="form-check-label form-control-sm">
                                    <input id="positionOfEquipment" name="positionOfEquipment" type="checkbox" class="form-check-input" value="1">Position of Equipment
                                </label>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-3">
                            &nbsp;
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <label for="otherSpecialConditionsOrConcerns" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherSpecialConditionsOrConcerns" name="otherSpecialConditionsOrConcerns" class="form-control form-control-sm col-md-11"/>
                    </div><!--end form row-->
                </div><!--end form group special conditions-->
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
                                        <input id="345kv" name="345kv" type="checkbox" class="form-check-input" value="1">345 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="138kv" class="form-check-label form-control-sm">
                                        <input id="138kv" name="138kv" type="checkbox" class="form-check-input" value="1">138 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="69kv" class="form-check-label form-control-sm">
                                        <input id="69kv" name="69kv" type="checkbox" class="form-check-input" value="1">69 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="24-9kv" class="form-check-label form-control-sm">
                                        <input id="24_9kv" name="24_9kv" type="checkbox" class="form-check-input" value="1">24.9 kv
                                    </label>
                                </div>
                            </div>
                        </div><!--end form row-->
                        <div class="form-row justify-content-md-center">
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="345kvSafeDistance" name="345kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="138kvSafeDistance" name="138kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="69kvSafeDistance" name="69kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="24_9kvSafeDistance" name="24_9kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                        </div><!--end form row-->
                        <div class="form-row justify-content-md-center mt-3">
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="14_4kv" class="form-check-label form-control-sm">
                                        <input id="14_4kv" name="14_4kv" type="checkbox" class="form-check-input" value="1">14.4 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="12_5kv" class="form-check-label form-control-sm">
                                        <input id="12_5kv" name="12_5kv" type="checkbox" class="form-check-input" value="1">12.5 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="7_2kv" class="form-check-label form-control-sm">
                                        <input id="7_2kv" name="7_2kv" type="checkbox" class="form-check-input" value="1">7.2 kv
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                &nbsp;
                            </div>
                        </div><!--end form row-->
                        <div class="form-row justify-content-md-center">
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="14_4kvSafeDistance" name="14_4kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="12_5kvSafeDistance" name="12_5kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="7_2kvSafeDistance" name="7_2kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                        </div><!--end form row-->
                        <div class="form-row justify-content-md-center mt-3">
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="480vac" class="form-check-label form-control-sm">
                                        <input id="480vac" name="480vac" type="checkbox" class="form-check-input" value="1">480 VAC
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="120vac" class="form-check-label form-control-sm">
                                        <input id="120vac" name="120vac" type="checkbox" class="form-check-input" value="1">120 VAC
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                    <label for="130vdc" class="form-check-label form-control-sm">
                                        <input id="130vdc" name="130vdc" type="checkbox" class="form-check-input" value="1">130 VDC
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                &nbsp;
                            </div>
                        </div><!--end form row-->
                        <div class="form-row justify-content-md-center">
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="480vacSafeDistance" name="480vacSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="120vacSafeDistance" name="120vacSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2 border border-dark">
                                <input type="text" id="130vdcSafeDistance" name="130vdcSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                            </div>
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                        </div><!--end form row-->
                    </div><!--end showMD-->
                    <!--this section is only seen sm and below due to the arrangement of the "Safe Distance" columns underneath the voltage checkboxes-->
                    <div id="showMobile" class="d-md-none">
                        <label for="345kv" class="form-check-label form-control-sm ml-3">
                            <input id="345kv" name="345kv" type="checkbox" class="form-check-input" value="1">345 kv
                        </label>
                        <input type="text" id="345kvSafeDistance" name="345kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="138kv" class="form-check-label form-control-sm ml-3">
                            <input id="138kv" name="138kv" type="checkbox" class="form-check-input" value="1">138 kv
                        </label>
                        <input type="text" id="138kvSafeDistance" name="138kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="69kv" class="form-check-label form-control-sm ml-3">
                            <input id="69kv" name="69kv" type="checkbox" class="form-check-input" value="1">69 kv
                        </label>
                        <input type="text" id="69kvSafeDistance" name="69kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="24_9kv" class="form-check-label form-control-sm ml-3">
                            <input id="24_9kv" name="24_9kv" type="checkbox" class="form-check-input" value="1">24.9 kv
                        </label>
                        <input type="text" id="24_9kvSafeDistance" name="24_9kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="14_4kv" class="form-check-label form-control-sm ml-3">
                            <input id="14_4kv" name="14_4kv" type="checkbox" class="form-check-input" value="1">14.4 kv
                        </label>
                        <input type="text" id="14_4kvSafeDistance" name="14_4kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="12_5kv" class="form-check-label form-control-sm ml-3">
                            <input id="12_5kv" name="12_5kv" type="checkbox" class="form-check-input" value="1">12.5 kv
                        </label>
                        <input type="text" id="12_5kvSafeDistance" name="12_5kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="7_2kv" class="form-check-label form-control-sm ml-3">
                            <input id="7_2kv" name="7_2kv" type="checkbox" class="form-check-input" value="1">7.2 kv
                        </label>
                        <input type="text" id="7_2kvSafeDistance" name="7_2kvSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="14-4kv" class="form-check-label form-control-sm ml-3">
                            <input id="480vac" name="480vac" type="checkbox" class="form-check-input" value="1">480 VAC
                        </label>
                        <input type="text" id="480vacSafeDistance" name="480vacSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="120vac" class="form-check-label form-control-sm ml-3">
                            <input id="120vac" name="120vac" type="checkbox" class="form-check-input" value="1">120 VAC
                        </label>
                        <input type="text" id="120vacSafeDistance" name="120vacSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="130vdc" class="form-check-label form-control-sm ml-3">
                            <input id="130vdc" name="130vdc" type="checkbox" class="form-check-input" value="1">130 VDC
                        </label>
                        <input type="text" id="130vdcSafeDistance" name="130vdcSafeDistance" class="form-control form-control-sm" placeholder="Safe Distance"/>
                    </div><!--end showMobile-->
                    <div class="form-row justify-content-md-center mt-md-3">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="lightning" class="form-check-label form-control-sm">
                                    <input id="lightning" name="lightning" type="checkbox" class="form-check-input " value="1">Lightning
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="induction" class="form-check-label form-control-sm">
                                    <input id="induction" name="induction" type="checkbox" class="form-check-input" value="1">Induction
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="faultOnLine_Apparatus" class="form-check-label form-control-sm pl-0">
                                    <input id="faultOnLine_Apparatus" name="faultOnLine_Apparatus" type="checkbox" class="form-check-input" value="1">Fault on Line/Apparatus
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="static" class="form-check-label form-control-sm">
                                    <input id="static" name="static" type="checkbox" class="form-check-input" value="1">Static
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center mt-md-1">
                        <label for="otherEnergySource" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherEnergySource" name="otherEnergySource" class="form-control form-control-sm col-md-10"/>
                    </div><!--end from row-->
                </div><!--end form-group energy sources-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Other Energy Sources:</h5></div>
                </div><!--end row--->
                <div id="otherEnergy" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hydraulic" class="form-check-label form-control-sm">
                                    <input id="hydraulic" name="hydraulic" type="checkbox" class="form-check-input" value="1">Hydraulic
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="pneumatic" class="form-check-label form-control-sm">
                                    <input id="pneumatic" name="pneumatic" type="checkbox" class="form-check-input" value="1">Pneumatic
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="chemical" class="form-check-label form-control-sm">
                                    <input id="chemical" name="chemical" type="checkbox" class="form-check-input" value="1">Chemical
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="mechanical" class="form-check-label form-control-sm">
                                    <input id="mechanical" name="mechanical" type="checkbox" class="form-check-input" value="1">Mechanical
                                </label>
                            </div>
                        </div>
                    </div><!--end from row-->
                </div><!--end form group other energy-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Controls to be Used:</h5></div>
                </div><!--end row--->
                <div id="controlsUsed" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="notifySocc" class="form-check-label form-control-sm">
                                    <input id="notifySocc" name="notifySocc" type="checkbox" class="form-check-input" value="1">Notify Socc
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="notifyCustomers" class="form-check-label form-control-sm">
                                    <input id="notifyCustomers" name="notifyCustomers" type="checkbox" class="form-check-input" value="1">Notify Customers
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="vdi" class="form-check-label form-control-sm">
                                    <input id="vdi" name="vdi" type="checkbox" class="form-check-input" value="1">VDI
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="grounding" class="form-check-label form-control-sm">
                                    <input id="grounding" name="grounding" type="checkbox" class="form-check-input" value="1">Grounding
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="barrier" class="form-check-label form-control-sm">
                                    <input id="barrier" name="barrier" type="checkbox" class="form-check-input" value="1">Barrier
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="lockout_tagout" class="form-check-label form-control-sm">
                                    <input id="lockout_tagout" name="lockout_tagout" type="checkbox" class="form-check-input" value="1">Lockout/Tagout
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="liveLineTool" class="form-check-label form-control-sm">
                                    <input id="liveLineTool" name="liveLineTool" type="checkbox" class="form-check-input" value="1">Live Line Tool
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="coverup" class="form-check-label form-control-sm">
                                    <input id="coverup" name="coverup" type="checkbox" class="form-check-input" value="1">Cover-up
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safeDistance" class="form-check-label form-control-sm">
                                    <input id="safeDistance" name="safeDistance" type="checkbox" class="form-check-input" value="1">Safe Distance
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="confinedSpace" class="form-check-label form-control-sm">
                                    <input id="confinedSpace" name="confinedSpace" type="checkbox" class="form-check-input" value="1">Confined Space
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="clearanceNumber" class="form-check-label form-control-sm">
                                    <input id="clearanceNumber" name="clearanceNumber" type="checkbox" class="form-check-input" value="1">Clearance #
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hotLineHoldNumber" class="form-check-label form-control-sm">
                                    <input id="hotLineHoldNumber" name="hotLineHoldNumber" type="checkbox" class="form-check-input" value="1">Hot Line Hold #
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center mt-md-1">
                        <label for="otherControlsToBeUsed" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherControlsToBeUsed" name="otherControlsToBeUsed" class="form-control form-control-sm col-md-10"/>
                    </div><!--end from row-->
                </div><!--end form group controls used-->
                <div class="row mt-md-4">
                    <div class="col-md-6"><h5>Personal Protective Equipment:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="personalProtective" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hardHat" class="form-check-label form-control-sm">
                                    <input id="hardHat" name="hardHat" type="checkbox" class="form-check-input" value="1">Hard Hat
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="boots" class="form-check-label form-control-sm">
                                    <input id="boots" name="boots" type="checkbox" class="form-check-input" value="1">Boots
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="leatherGloves" class="form-check-label form-control-sm">
                                    <input id="leatherGloves" name="leatherGloves" type="checkbox" class="form-check-input" value="1">Leather Gloves
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="harness_lanyard" class="form-check-label form-control-sm">
                                    <input id="harness_lanyard" name="harness_lanyard" type="checkbox" class="form-check-input" value="1">Harness/Lanyard
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyGlasses" class="form-check-label form-control-sm">
                                    <input id="safetyGlasses" name="safetyGlasses" type="checkbox" class="form-check-input" value="1">Safety Glasses
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="cottonCLothing" class="form-check-label form-control-sm">
                                    <input id="cottonCLothing" name="cottonCLothing" type="checkbox" class="form-check-input" value="1">Cotton Clothing
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="rubberGloves_sleeves" class="form-check-label form-control-sm">
                                    <input id="rubberGloves_sleeves" name="rubberGloves_sleeves" type="checkbox" class="form-check-input" value="1">Rubber Gloves/Sleeves
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="hearingProtection" class="form-check-label form-control-sm">
                                    <input id="hearingProtection" name="hearingProtection" type="checkbox" class="form-check-input" value="1">Hearing Protection
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="frc" class="form-check-label form-control-sm">
                                    <input id="frc" name="frc" type="checkbox" class="form-check-input" value="1">FRC
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="safetyVest" class="form-check-label form-control-sm">
                                    <input id="safetyVest" name="safetyVest" type="checkbox" class="form-check-input" value="1">Safety Vest
                                </label>
                            </div>
                        </div>
                        <label for="otherPersonalProtectiveEquipment" class="form-control-label form-control-sm col-md-1">Other:</label>
                        <input type="text" id="otherPersonalProtectiveEquipment" name="otherPersonalProtectiveEquipment" class="form-control form-control-sm col-md-5"/>
                    </div><!--end form row-->
                </div><!--end form group personal protective-->
                <div class="row mt-md-4">
                    <div class="col-md-8"><h5>Personal Protective Equipment Visual FR Clothing Check:</h5></div>
                    <div class="col-md-4 small font-italic">(Select all that apply)</div>
                </div><!--end row--->
                <div id="ppeVisual" class="form-group">
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="frShirtTuckedIn" class="form-check-label form-control-sm">
                                    <input id="frShirtTuckedIn" name="frShirtTuckedIn" type="checkbox" class="form-check-input" value="1">FR Shirt Tucked In
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="clothingHasNoTears" class="form-check-label form-control-sm">
                                    <input id="clothingHasNoTears" name="clothingHasNoTears" type="checkbox" class="form-check-input" value="1">Clothing has no Tears/Holes/Frayed Edges
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-center">
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noContactWithBleachOrDEET" class="form-check-label form-control-sm">
                                    <input id="noContactWithBleachOrDEET" name="noContactWithBleachOrDEET" type="checkbox" class="form-check-input" value="1">No Contact With Bleach or DEET
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-check-inline mt-2 mt-md-0 mb-2 mb-md-0">
                                <label for="noStainsOnClothing" class="form-check-label form-control-sm">
                                    <input id="noStainsOnClothing" name="noStainsOnClothing" type="checkbox" class="form-check-input" value="1">No Stains on Clothing
                                </label>
                            </div>
                        </div>
                    </div><!--end form row-->
                </div><!--end form group ppe Visual-->
                <div class="row mt-md-4">
                    <div class="col-md-8"><h5>Additional Information As Necessary:</h5></div>
                </div><!--end row--->
                <div id="additionInfo" class="form-group">
                    <textarea rows="10" cols="10" id="additionInformationAsNecessary" name="additionInformationAsNecessary" class="form-control form-control-sm"></textarea>
                </div><!--end form group additional information-->
                <div class="row mt-md-4">
                    <div class="col-md-8"><h5>Crew Members (and Others) Participating in Job Briefings:</h5></div>
                </div><!--end row--->
                <div id="participants" class="form-group">
                    <div class="form-row">
                        <input type="text" id="crewMemberName1" name="crewMemberName1" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #1"/>
                        <input type="text" id="crewMemberName2" name="crewMemberName2" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #2"/>
                        <input type="text" id="crewMemberName3" name="crewMemberName3" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #3"/>
                        <input type="text" id="crewMemberName4" name="crewMemberName4" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #4"/>
                        <input type="text" id="crewMemberName5" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #5"/>
                        <input type="text" id="crewMemberName6" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #6"/>
                        <input type="text" id="crewMemberName7" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #7"/>
                        <input type="text" id="crewMemberName8" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #8"/>
                        <input type="text" id="crewMemberName9" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #9"/>
                        <input type="text" id="crewMemberName10" name="crewMemberName5" class=" col-md-6 form-control form-control-sm" placeholder="Crew Member #10"/>
                    </div><!--end form row-->
                </div><!--end form group participants-->
                <div class="row mt-md-5 justify-content-md-center">
                    <div class="col-md-7 mb-1">
                        <input type="checkbox" name="terms" id="terms" onchange="activateButton(this)"> I, <?php echo $assoc['firstName'] ." " .$assoc['lastName']; ?>, submit this form as accurate and true.
                        <br/><span class="small font-italic">(Click checkbox to confirm)</span>
                    </div>
                    <div class="col-md-2 mr-md-3 mb-1">
                        <input name="submit" id="submit" class="btn btn-success" type="submit" value="SUBMIT"/>
                    </div>
                    <div class="col-md-1 mb-1">
                        <button class="btn btn-success" type="button" onclick="window.history.back()">GO BACK</button>
                    </div>
                </div><!--end row-->
            </form><!--end form-->
            <div id="procedures" class="mt-md-3 small">
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
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>

