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
        $pqdate = new DateTime($_POST['reportDate']);
        $reportDate = $pqdate->format('Y-m-d');
        $vehicleNo = mysqli_real_escape_string($dbconn, trim($_POST['vehicleNo']));
        $odometerReading = mysqli_real_escape_string($dbconn, trim($_POST['odometerReading']));
        $tires = $_POST['tires'];
        $tiresComments = mysqli_real_escape_string($dbconn, trim($_POST['tiresComments']));
        $windshield = $_POST['windshield'];
        $windshieldComments = mysqli_real_escape_string($dbconn, trim($_POST['windshieldComments']));
        $windshieldWipers = $_POST['windshieldWipers'];
        $oilLevel = $_POST['oilLevel'];
        $lights = $_POST['lights'];
        $turnSignals = $_POST['turnSignals'];
        $horn = $_POST['horn'];
        $registration = $_POST['registration'];
        $inspection = $_POST['inspection'];
        $enterpriseCards = $_POST['enterpriseCards'];
        $clientRequiredDocuments = $_POST['clientRequiredDocuments'];
        $clientRequiredPPE = $_POST['clientRequiredPPE'];
        $fireExtinguisher = $_POST['fireExtinguisher'];
        $safetyCones = $_POST['safetyCones'];
        $firstAidKit = $_POST['firstAidKit'];
        $objectsSecured = $_POST['objectsSecured'];
        $walkAround = $_POST['walkAround'];
        $suppliesFirstAidKit = mysqli_real_escape_string($dbconn, trim($_POST['suppliesFirstAidKit']));
        $otherComments = mysqli_real_escape_string($dbconn, trim($_POST['otherComments']));
        $damageDesc = mysqli_real_escape_string($dbconn, trim($_POST['damageDesc']));

        //add to db
        $sqlInsert = "INSERT INTO vehicleReport (divisionId, userId, reportDate, vehicleNo, odometerReading, tires, tiresComments, windshield, windshieldComments, windshieldWipers, 
                        oilLevel, lights, turnSignals, horn, registration, inspection, enterpriseCards, clientRequiredDocuments, clientRequiredPPE, fireExtinguisher, safetyCones, firstAidKit, 
                        objectsSecured, walkAround, suppliesFirstAidKit, otherComments, damageDesc) VALUES ('$divisionId', '$userId', '$reportDate', '$vehicleNo', '$odometerReading',
                        NULLIF ('$tires', ''), NULLIF ('$tiresComments', ''), NULLIF ('$windshield', ''), NULLIF ('$windshieldComments', ''), NULLIF ('$windshieldWipers', ''), 
                        NULLIF ('$oilLevel', ''), NULLIF ('$lights', ''), NULLIF ('$turnSignals', ''), NULLIF ('$horn', ''), NULLIF ('$registration', ''), NULLIF ('$inspection', ''), 
                        NULLIF ('$enterpriseCards', ''), NULLIF ('$clientRequiredDocuments', ''), NULLIF ('$clientRequiredPPE', ''), NULLIF ('$fireExtinguisher', ''), 
                        NULLIF ('$safetyCones', ''), NULLIF ('$firstAidKit', ''), NULLIF ('$objectsSecured', ''), NULLIF ('$walkAround', ''), NULLIF ('$suppliesFirstAidKit', ''), 
                        NULLIF ('$otherComments', ''), NULLIF ('$damageDesc', ''))";
        $dbconn->query($sqlInsert);

        $vehicleReportId = mysqli_insert_id($dbconn);

        //email notice to NLutz
        $associateName = $assoc['firstName'] ." " .$assoc['lastName'];
        $subject = 'New Vehicle Report';
        $message = "$associateName with Division $divisionId just filled out vehicle a vehicle report. \n".
                    "Please login to the safety database to see the report";
        $to = 'nlutz@msengr.com, stevesmith@epesent.com';
        mail($to, $subject, $message);

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
    <title>VEHICLE FORM</title>
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
                <div class="col-md-5"><h4>Vehicle Report</h4></div>
            </div><!--end row-->
            <form action="" method="post">
                <div id="general" class="form-group">
                    <div class="form-row mb-md-3">
                        <label for="reportDate" class="col-md-1 form-control-label form-control-sm ml-md-5">Date:</label>
                        <input type="text" id="reportDate" name="reportDate" class="col-md-2 form-control form-control-sm pickDate"/>
                    </div><!--end form row-->
                    <div class="form-row mb-md-3">
                        <label for="vehicleNo" class="col-md-1 form-control-label form-control-sm ml-md-5">Vehicle No.:</label>
                        <input type="text" id="vehicleNo" name="vehicleNo" class="col-md-2 form-control form-control-sm"/>
                        <label for="odometerReading" class="col-md-2 form-control-label form-control-sm text-md-right">Odometer Reading:</label>
                        <input type="text" id="odometerReading" name="odometerReading" class="col-md-3 form-control form-control-sm"/>
                    </div><!--end form row-->
                </div>
                <div class="row mt-md-4">
                    <div class="col-md-6 ml-md-5 mt-md-3"><h5>General Working Condition of Vehicle:</h5></div>
                </div><!--end row--->
                <div id="workingCondition" class="form-group">
                    <div class="row mb-md-3 ml-md-5">
                        <div class="col-md-2 form-control-sm">Tires:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="tires" id="T1" value="wc">
                                <label class="form-check-label form-control-sm" for="T1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="tires" id="T2" value="nr">
                                <label class="form-check-label form-control-sm" for="T2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="form-row mb-md-3 ml-md-5">
                        <label for="tiresComments" class="col-md-1 form-control-label form-control-sm">Comments:</label>
                        <input type="text" id="tiresComments" name="tiresComments" class="col-md-8 form-control form-control-sm"/>
                    </div><!--end form row-->

                    <div class="row mb-md-3 ml-md-5">
                        <div class="col-md-2 form-control-sm">Windshield:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="windshield" id="WS1" value="wc">
                                <label class="form-check-label form-control-sm" for="WS1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="windshield" id="WS2" value="nr">
                                <label class="form-check-label form-control-sm" for="WS2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="form-row mb-md-3 ml-md-5">
                        <label for="windshieldComments" class="col-md-1 form-control-label form-control-sm">Comments:</label>
                        <input type="text" id="windshieldComments" name="windshieldComments" class="col-md-8 form-control form-control-sm"/>
                    </div><!--end form row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Windshield Wipers:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="windshieldWipers" id="WW1" value="wc">
                                <label class="form-check-label form-control-sm" for="WW1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="windshieldWipers" id="WW2" value="nr">
                                <label class="form-check-label form-control-sm" for="WW2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Oil Level:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="oilLevel" id="OL1" value="wc">
                                <label class="form-check-label form-control-sm" for="OL1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="oilLevel" id="OL2" value="nr">
                                <label class="form-check-label form-control-sm" for="OL2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Lights:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="lights" id="lights1" value="wc">
                                <label class="form-check-label form-control-sm" for="lights1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="lights" id="lights2" value="nr">
                                <label class="form-check-label form-control-sm" for="lights2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Turn Signals:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="turnSignals" id="TS1" value="wc">
                                <label class="form-check-label form-control-sm" for="TS1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="turnSignals" id="TS2" value="nr">
                                <label class="form-check-label form-control-sm" for="TS2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Horn:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="horn" id="horn1" value="wc">
                                <label class="form-check-label form-control-sm" for="horn1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="horn" id="horn2" value="nr">
                                <label class="form-check-label form-control-sm" for="horn2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Registration:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="registration" id="reg1" value="wc">
                                <label class="form-check-label form-control-sm" for="reg1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="registration" id="reg2" value="nr">
                                <label class="form-check-label form-control-sm" for="reg2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Inspection:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="inspection" id="insp1" value="wc">
                                <label class="form-check-label form-control-sm" for="insp1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="inspection" id="insp2" value="nr">
                                <label class="form-check-label form-control-sm" for="insp2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Enterprise Cards:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="enterpriseCards" id="EC1" value="wc">
                                <label class="form-check-label form-control-sm" for="EC1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="enterpriseCards" id="EC2" value="nr">
                                <label class="form-check-label form-control-sm" for="EC2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->
                </div><!--end general -->

                <div class="row mt-md-4">
                    <div class="col-md-6 ml-md-5 mt-md-3"><h5>Safety Supplies:</h5></div>
                </div><!--end row--->
                <div id="supplies" class="form-group">
                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Client Required Documents:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="clientRequiredDocuments" id="CRD1" value="yes">
                                <label class="form-check-label form-control-sm" for="CRD1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="clientRequiredDocuments" id="CRD2" value="no">
                                <label class="form-check-label form-control-sm" for="CRD2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Client Required PPE:<br><span class="small font-italic">(Personal Protective Equipment)</span></div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="clientRequiredPPE" id="CRP1" value="yes">
                                <label class="form-check-label form-control-sm" for="CRP1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="clientRequiredPPE" id="CRP2" value="no">
                                <label class="form-check-label form-control-sm" for="CRP2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Fire Extinguisher:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="fireExtinguisher" id="FE1" value="wc">
                                <label class="form-check-label form-control-sm" for="FE1">Working Condition</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="fireExtinguisher" id="FE2" value="nr">
                                <label class="form-check-label form-control-sm" for="FE2">Needs Repair</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Safety Cones:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="safetyCones" id="SC1" value="yes">
                                <label class="form-check-label form-control-sm" for="SC1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="safetyCones" id="SC2" value="no">
                                <label class="form-check-label form-control-sm" for="SC2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">First Aid Kit:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="firstAidKit" id="FAK1" value="yes">
                                <label class="form-check-label form-control-sm" for="FAK1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="firstAidKit" id="FAK2" value="no">
                                <label class="form-check-label form-control-sm" for="FAK2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">Objects In Truck Secure:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="objectsSecured" id="OS1" value="yes">
                                <label class="form-check-label form-control-sm" for="OS1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="objectsSecured" id="OS2" value="no">
                                <label class="form-check-label form-control-sm" for="OS2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row ml-md-5">
                        <div class="col-md-2 form-control-sm">360 Walk Around:</div>
                        <div class="col-md-3 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="walkAround" id="WA1" value="yes">
                                <label class="form-check-label form-control-sm" for="WA1">YES</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-control-sm" type="radio" name="walkAround" id="W2" value="no">
                                <label class="form-check-label form-control-sm" for="W2">NO</label>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="form-row mb-md-3 ml-md-5">
                        <label for="suppliesFirstAidKit" class="col-md-6 form-control-label form-control-sm">Supplies Needed for First Aid Kit:</label>
                        <input type="text" id="suppliesFirstAidKit" name="suppliesFirstAidKit" class="col-md-10 form-control form-control-sm"/>
                    </div><!--end form row-->

                    <div class="form-row mb-md-3 ml-md-5">
                        <label for="otherComments" class="form-control-label form-control-sm col-md-8">Other Comments or items than need attention/repaired on vehicle:</label>
                        <textarea rows="3" cols="20" name="otherComments" id="otherComments" class="form-control form-control-sm col-md-10"></textarea>
                    </div><!--end row-->

                    <div class="form-row mb-md-3 ml-md-5">
                        <label for="damageDesc" class="form-control-label form-control-sm col-md-8">Please describe any current damage and location on vehicle:</label>
                        <textarea rows="3" cols="20" name="damageDesc" id="damageDesc" class="form-control form-control-sm col-md-10"></textarea>
                    </div><!--end row-->

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
                </div><!--end supplies-->
            </form><!--end form-->
            <div class="row justify-content-md-center mt-md-5">
                <div class="col-md-8"><img src="images/vehicleDiagram.png" alt="Vehicle Diagram" class="img-fluid"/></div>
            </div>
        </div><!--end container-fluid-->
    </div><!--end wrapper-->
</body>
</html>