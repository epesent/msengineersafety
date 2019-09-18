<?php
    session_start();
//    $permissionLevel = $_SESSION['permissionLevel'];
//    if (empty($permissionLevel)) {
//        header("location:index.php");
//    }
    $userId = $_SESSION['userId'];
    require_once 'connectdb.php';
    $assoc = getAsc ($dbconn, $userId);
    $divisionId = $assoc['divisionId'];

try {
    if (isset($_POST['submit'])) {
        //set variables


        //insert to db
        $sqlInsert= "";
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
                        <label for="date" class="col-md-1 form-control-label ml-md-5">Date:</label>
                        <input type="text" id="date" name="date" class="col-md-2 form-control pickDate"/>
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
                    <label for="inspectionOfTools" class="form-control-label">Inspection of Tools and Other Equipment to be used"</label>
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
                        <input type="text" name="attendee1" id="attendee1" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee2" id="attendee2" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendee3" id="attendee3" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee4" id="attendee4" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendee5" id="attendee5" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee6" id="attendee6" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendee7" id="attendee7" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee8" id="attendee8" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendee9" id="attendee9" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee10" id="attendee10" class="col-md-4" placeholder="Attendee Name"/>
                    </div><!--end form row-->
                    <div class="form-row justify-content-md-around mb-md-1">
                        <input type="text" name="attendee11" id="attendee11" class="col-md-4" placeholder="Attendee Name"/>
                        <input type="text" name="attendee12" id="attendee12" class="col-md-4" placeholder="Attendee Name"/>
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