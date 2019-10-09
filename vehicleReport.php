<?php
    session_start();
    $permissionLevel = $_SESSION['permissionLevel'];
    if (empty($permissionLevel)) {
        header("location:index.php");
    }
    if (isset($_GET['vehicleReportId'])) {
        $vehicleReportId = $_GET['vehicleReportId'];
    }

    require_once 'connectdb.php';
    $vehicleReport = getVehicleReport ($dbconn, $vehicleReportId);
    $userId = $vehicleReport['userId'];
    $assoc = getAsc ($dbconn, $userId);
    $divisionId = $assoc['divisionId'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>VEHICLE REPORT</title>
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
                /*margin-top: 50px;*/
            }
        }
    </style>

</head>
<body>
    <div id="topbannerForms" class="container-fluid text-white" style="font-family: Georgia, Times New Roman, Times, serif;">
        <div class="row pt-3 pb-3 align-items-end">
            <div class="col-md-4">
                <span>M&S ENGINEERING</span>
            </div>
            <div class="col-md-4"><span>Safety and Compliance Database</span></div>
<!--            <div class="col-md-2 text-md-center"><a href="javascript:history.back()" class="nav-item nav-link shl" title="LOG OUT" id="logOut">Go Back</a></div>-->
            <div class="col-md-2 text-md-center"><a href="index.php?logout=yes" class="nav-item nav-link shl" title="LOG OUT" id="logOut">Log Out</a></div>
        </div><!--end Row-->
    </div>

    <div class="bg-light pb-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-2 pt-md-5 mb-md-3">
                <div class="col-md-5"><h4>Vehicle Report</h4></div>
            </div><!--end row-->
            <div class="row justify-content-md-center mb-md-4">
                <div class="col-md-5">Submitted by: <?php echo $assoc['firstName'] . " " .$assoc['lastName']; ?></div>
            </div><!--end row-->
            <div id="general" class="form-group">
                <div class="row ml-md-5">
                    <?php
                    $pDate = new DateTime($vehicleReport['reportDate']) ;
                    $date = $pDate->format('m/d/Y');
                    ?>
                    <div class="col-md-1">Date:</div>
                    <div class="col-md-4"><?php echo $date; ?></div>
                </div><!--end row-->
                <div class="row ml-md-5">
                    <div class="col-md-1">Vehicle No:</div>
                    <div class="col-md-3"><?php echo $vehicleReport['vehicleNo']; ?></div>
                    <div class="col-md-2">Odometer Reading:</div>
                    <div class="col-md-3"><?php echo $vehicleReport['odometerReading']; ?></div>
                </div><!--end row-->
            </div>
            <div class="row mt-md-4">
                <div class="col-md-6 ml-md-5 mt-md-3"><h5>General Working Condition of Vehicle:</h5></div>
            </div><!--end row--->
            <div id="workingCondition" class="form-group">
                <div class="row mb-md-2 ml-md-5">
                    <div class="col-md-3">Tires:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tires" id="T1" value="wc"
                            <?php if ($vehicleReport['tires'] == 'wc') {echo 'checked=checked';} ?>
                            >
                            <label class="form-check-label" for="T1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tires" id="T2" value="nr"
                                <?php if ($vehicleReport['tires'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="T2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row mb-md-2 ml-md-5">
                    <div class="col-md-2">Comments:</div>
                    <div class="col-md-8 border border-dark"><?php echo $vehicleReport['tiresComments']; ?></div>
                </div><!--end row-->

                <div class="row mb-md-3 ml-md-5">
                    <div class="col-md-3">Windshield:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="windshield" id="WS1" value="wc"
                                <?php if ($vehicleReport['windshield'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="WS1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="windshield" id="WS2" value="nr"
                                <?php if ($vehicleReport['windshield'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="WS2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row mb-md-2 ml-md-5">
                    <div class="col-md-2">Comments:</div>
                    <div class="col-md-8 border border-dark"><?php echo $vehicleReport['windshieldComments']; ?></div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Windshield Wipers:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="windshieldWipers" id="WW1" value="wc"
                                <?php if ($vehicleReport['windshieldWipers'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="WW1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="windshieldWipers" id="WW2" value="nr"
                                <?php if ($vehicleReport['windshieldWipers'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="WW2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Oil Level:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="oilLevel" id="OL1" value="wc"
                                <?php if ($vehicleReport['oilLevel'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="OL1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="oilLevel" id="OL2" value="nr"
                                <?php if ($vehicleReport['oilLevel'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="OL2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Lights:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="lights" id="lights1" value="wc"
                                <?php if ($vehicleReport['lights'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="lights1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="lights" id="lights2" value="nr"
                                <?php if ($vehicleReport['lights'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="lights2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Turn Signals:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnSignals" id="TS1" value="wc"
                                <?php if ($vehicleReport['turnSignals'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="TS1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnSignals" id="TS2" value="nr"
                                <?php if ($vehicleReport['turnSignals'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="TS2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Horn:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="horn" id="horn1" value="wc"
                                <?php if ($vehicleReport['horn'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="horn1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="horn" id="horn2" value="nr"
                                <?php if ($vehicleReport['horn'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="horn2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Registration:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="registration" id="reg1" value="wc"
                                <?php if ($vehicleReport['registration'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="reg1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="registration" id="reg2" value="nr"
                                <?php if ($vehicleReport['registration'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="reg2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Inspection:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inspection" id="insp1" value="wc"
                                <?php if ($vehicleReport['inspection'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="insp1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inspection" id="insp2" value="nr"
                                <?php if ($vehicleReport['inspection'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="insp2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Enterprise Cards:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="enterpriseCards" id="EC1" value="wc"
                                <?php if ($vehicleReport['enterpriseCards'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="EC1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="enterpriseCards" id="EC2" value="nr"
                                <?php if ($vehicleReport['enterpriseCards'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="EC2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end general -->

            <div class="row mt-md-4">
                <div class="col-md-6 ml-md-5 mt-md-3"><h5>Safety Supplies:</h5></div>
            </div><!--end row--->
            <div id="supplies" class="form-group">
                <div class="row ml-md-5">
                    <div class="col-md-3">Client Required Documents:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="clientRequiredDocuments" id="CRD1" value="yes"
                                <?php if ($vehicleReport['clientRequiredDocuments'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="CRD1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="clientRequiredDocuments" id="CRD2" value="no"
                                <?php if ($vehicleReport['clientRequiredDocuments'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="CRD2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Client Required PPE:<br><span class="small font-italic">(Personal Protective Equipment)</span></div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="clientRequiredPPE" id="CRP1" value="yes"
                                <?php if ($vehicleReport['clientRequiredPPE'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="CRP1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="clientRequiredPPE" id="CRP2" value="no"
                                <?php if ($vehicleReport['clientRequiredPPE'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="CRP2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Fire Extinguisher:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fireExtinguisher" id="FE1" value="wc"
                                <?php if ($vehicleReport['fireExtinguisher'] == 'wc') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="FE1">Working Condition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fireExtinguisher" id="FE2" value="nr"
                                <?php if ($vehicleReport['fireExtinguisher'] == 'nr') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="FE2">Needs Repair</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Safety Cones:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="safetyCones" id="SC1" value="yes"
                                <?php if ($vehicleReport['safetyCones'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="SC1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="safetyCones" id="SC2" value="no"
                                <?php if ($vehicleReport['safetyCones'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="SC2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">First Aid Kit:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="firstAidKit" id="FAK1" value="yes"
                                <?php if ($vehicleReport['firstAidKit'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="FAK1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="firstAidKit" id="FAK2" value="no"
                                <?php if ($vehicleReport['firstAidKit'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="FAK2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row ml-md-5">
                    <div class="col-md-3">Objects In Truck Secure:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="objectsSecured" id="OS1" value="yes"
                                <?php if ($vehicleReport['objectsSecured'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="OS1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="objectsSecured" id="OS2" value="no"
                                <?php if ($vehicleReport['objectsSecured'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="OS2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row mb-md-4 ml-md-5">
                    <div class="col-md-3">360 Walk Around:</div>
                    <div class="col-md-6 form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="walkAround" id="WA1" value="yes"
                                <?php if ($vehicleReport['walkAround'] == 'yes') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="WA1">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="walkAround" id="W2" value="no"
                                <?php if ($vehicleReport['walkAround'] == 'no') {echo 'checked=checked';} ?>>
                            <label class="form-check-label" for="W2">NO</label>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row mb-md-2 ml-md-5">
                    <div class="col-md-6">Supplies Needed for First Aid Kit:</div>
                    <div class="col-md-10 border border-dark"><?php echo $vehicleReport['suppliesFirstAidKit']; ?></div>
                </div><!--end row-->
                <div class="row mb-md-2 ml-md-5">
                    <div class="col-md-8">Other Comments or items than need attention/repaired on vehicle:</div>
                    <div class="col-md-10 border border-dark"><?php echo $vehicleReport['otherComments']; ?></div>
                </div><!--end row-->
                <div class="row mb-md-5 ml-md-5">
                    <div class="col-md-8">Please describe any current damage and location on vehicle:</div>
                    <div class="col-md-10 border border-dark"><?php echo $vehicleReport['damageDesc']; ?></div>
                </div><!--end row-->
            </div><!--end supplies-->

            <!--This spacer is put here to allow for a page break when printing the report -->
            <div class="page-break"></div>
            <div class="printSpace" style="height: 50px;">&nbsp;</div>

            <div class="row printSpace">
                <?php
                $pDate = new DateTime($vehicleReport['reportDate']) ;
                $date = $pDate->format('m/d/Y');
                ?>
                <div class="col-md-10">Date: &nbsp;&nbsp;<?php echo $date; ?></div>
            </div><!--end row-->
            <div class="row printSpace">
                <div class="col-md-10">Vehicle No: &nbsp;&nbsp;<?php echo $vehicleReport['vehicleNo']; ?></div>
            </div><!--end row-->
            <div class="row justify-content-md-center mt-md-5">
                <div class="col-md-8"><img src="images/vehicleDiagram.png" alt="Vehicle Diagram" class="img-fluid"/></div>
            </div>
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>