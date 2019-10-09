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
        $workLocation = mysqli_real_escape_string($dbconn, trim($_POST['workLocation']));
        $jobTime = $_POST['jobTime'];
        $latitude = mysqli_real_escape_string($dbconn, trim($_POST['latitude']));
        $longitude = mysqli_real_escape_string($dbconn, trim($_POST['longitude']));
        if (!empty($_POST['nineEleven'])) {$nineEleven = $_POST['nineEleven'];} else {$nineEleven = 0;}
        if (!empty($_POST['cell'])) {$cell = $_POST['cell'];} else {$cell = 0;}
        if (!empty($_POST['radio'])) {$radio = $_POST['radio'];} else {$radio = 0;}
        if (!empty($_POST['subPhone'])) {$subPhone = $_POST['subPhone'];} else {$subPhone = 0;}
        if (!empty($_POST['facility_shopPhone'])) {$facility_shopPhone = $_POST['facility_shopPhone'];} else {$facility_shopPhone = 0;}
        $hospital = mysqli_real_escape_string($dbconn, trim($_POST['hospital']));
        $location = mysqli_real_escape_string($dbconn, trim($_POST['location']));
        $personPerformingJobBriefing = mysqli_real_escape_string($dbconn, trim($_POST['personPerformingJobBriefing']));
        $personInChargeOfWork = mysqli_real_escape_string($dbconn, trim($_POST['personInChargeOfWork']));
        if (!empty($_POST['operatorMaintenance'])) {$operatorMaintenance = $_POST['operatorMaintenance'];} else {$operatorMaintenance = 0;}
        if (!empty($_POST['internalMaintenance'])) {$internalMaintenance = $_POST['internalMaintenance'];} else {$internalMaintenance = 0;}
        if (!empty($_POST['XFER_LTC_Maintenance'])) {$XFER_LTC_Maintenance = $_POST['XFER_LTC_Maintenance'];} else {$XFER_LTC_Maintenance = 0;}
        if (!empty($_POST['circuitSwitchMaintenance'])) {$circuitSwitchMaintenance = $_POST['circuitSwitchMaintenance'];} else {$circuitSwitchMaintenance = 0;}
        if (!empty($_POST['installPortable_XFMR'])) {$installPortable_XFMR = $_POST['installPortable_XFMR'];} else {$installPortable_XFMR = 0;}
        if (!empty($_POST['lowSideVoltageWork'])) {$lowSideVoltageWork = $_POST['lowSideVoltageWork'];} else {$lowSideVoltageWork = 0;}
        if (!empty($_POST['regularMaintenance'])) {$regularMaintenance = $_POST['regularMaintenance'];} else {$regularMaintenance = 0;}
        if (!empty($_POST['haulMaterial'])) {$haulMaterial = $_POST['haulMaterial'];} else {$haulMaterial = 0;}
        if (!empty($_POST['liftSteel'])) {$liftSteel = $_POST['liftSteel'];} else {$liftSteel = 0;}
        $otherDescriptionOfWork = mysqli_real_escape_string($dbconn, trim($_POST['otherDescriptionOfWork']));
        if (!empty($_POST['energizedApparatus'])) {$energizedApparatus = $_POST['energizedApparatus'];} else {$energizedApparatus = 0;}
        if (!empty($_POST['electrical_OVHTransmissionLines'])) {$electricalOVHTransmissionLines = $_POST['electrical_OVHTransmissionLines'];} else {$electricalOVHTransmissionLines = 0;}
        if (!empty($_POST['heavyObjects'])) {$heavyObjects = $_POST['heavyObjects'];} else {$heavyObjects = 0;}
        if (!empty($_POST['electrical_busWork'])) {$electricalbusWork = $_POST['electrical_busWork'];} else {$electricalbusWork = 0;}
        if (!empty($_POST['equipmentInMotion'])) {$equipmentInMotion = $_POST['equipmentInMotion'];} else {$equipmentInMotion = 0;}
        if (!empty($_POST['noise'])) {$noise = $_POST['noise'];} else {$noise = 0;}
        if (!empty($_POST['electricalDistributionLines'])) {$electricalDistributionLines = $_POST['electricalDistributionLines'];} else {$electricalDistributionLines = 0;}
        if (!empty($_POST['highAirPressureSystem'])) {$highAirPressureSystem = $_POST['highAirPressureSystem'];} else {$highAirPressureSystem = 0;}
        if (!empty($_POST['sharp_pointedEdges'])) {$sharp_pointedEdges = $_POST['sharp_pointedEdges'];} else {$sharp_pointedEdges = 0;}
        if (!empty($_POST['slip_tripOnUnevenGround'])) {$slip_tripOnUnevenGround = $_POST['slip_tripOnUnevenGround'];} else {$slip_tripOnUnevenGround = 0;}
        if (!empty($_POST['falling'])) {$falling = $_POST['falling'];} else {$falling = 0;}
        if (!empty($_POST['fallingObjects'])) {$fallingObjects = $_POST['fallingObjects'];} else {$fallingObjects = 0;}
        if (!empty($_POST['snakes_wasps'])) {$snakes_wasps = $_POST['snakes_wasps'];} else {$snakes_wasps = 0;}
        if (!empty($_POST['holes_excavations'])) {$holes_excavations = $_POST['holes_excavations'];} else {$holes_excavations = 0;}
        if (!empty($_POST['hydraulicPressureSystem'])) {$hydraulicPressureSystem = $_POST['hydraulicPressureSystem'];} else {$hydraulicPressureSystem = 0;}
        if (!empty($_POST['traps'])) {$traps = $_POST['traps'];} else {$traps = 0;}
        $otherHazard = mysqli_real_escape_string($dbconn, trim($_POST['otherHazard']));
        if (!empty($_POST['health_safetyHandbook'])) {$health_safetyHandbook = $_POST['health_safetyHandbook'];} else {$health_safetyHandbook = 0;}
        if (!empty($_POST['meter_verifyBeforeGrounding'])) {$meter_verifyBeforeGrounding = $_POST['meter_verifyBeforeGrounding'];} else {$meter_verifyBeforeGrounding = 0;}
        if (!empty($_POST['visuallyIDPotentialEnergySources'])) {$visuallyIDPotentialEnergySources = $_POST['visuallyIDPotentialEnergySources'];} else {$visuallyIDPotentialEnergySources = 0;}
        if (!empty($_POST['errorEliminationTools'])) {$errorEliminationTools = $_POST['errorEliminationTools'];} else {$errorEliminationTools = 0;}
        $otherSpecificWorkProcedures = mysqli_real_escape_string($dbconn, trim($_POST['otherSpecificWorkProcedures']));
        if (!empty($_POST['step_touchPotential'])) {$step_touchPotential = $_POST['step_touchPotential'];} else {$step_touchPotential = 0;}
        if (!empty($_POST['backing'])) {$backing = $_POST['backing'];} else {$backing = 0;}
        if (!empty($_POST['wet_muddy'])) {$wet_muddy = $_POST['wet_muddy'];} else {$wet_muddy = 0;}
        if (!empty($_POST['bucketEmergencyLetDownUnderstood'])) {$bucketEmergencyLetDownUnderstood = $_POST['bucketEmergencyLetDownUnderstood'];} else {$bucketEmergencyLetDownUnderstood = 0;}
        if (!empty($_POST['heatStress'])) {$heatStress = $_POST['heatStress'];} else {$heatStress = 0;}
        if (!empty($_POST['weather'])) {$weather = $_POST['weather'];} else {$weather = 0;}
        if (!empty($_POST['bucketEmergencyControlsTestedAndVerified'])) {$bucketEmergencyControlsTestedAndVerified = $_POST['bucketEmergencyControlsTestedAndVerified'];} else {$bucketEmergencyControlsTestedAndVerified = 0;}
        if (!empty($_POST['positionOfEquipment'])) {$positionOfEquipment = $_POST['positionOfEquipment'];} else {$positionOfEquipment = 0;}
        $otherSpecialConditionsOrConcerns = mysqli_real_escape_string($dbconn, trim($_POST['otherSpecialConditionsOrConcerns']));
        if (!empty($_POST['345kv'])) {$onekv = $_POST['345kv'];} else {$onekv = 0;}
        if (!empty($_POST['138kv'])) {$twokv = $_POST['138kv'];} else {$twokv = 0;}
        if (!empty($_POST['69kv'])) {$threekv = $_POST['69kv'];} else {$threekv = 0;}
        if (!empty($_POST['24_9kv'])) {$fourkv = $_POST['24_9kv'];} else {$fourkv = 0;}
        if (!empty($_POST['14_4kv'])) {$fivekv = $_POST['14_4kv'];} else {$fivekv = 0;}
        if (!empty($_POST['12_5kv'])) {$sixkv = $_POST['12_5kv'];} else {$sixkv = 0;}
        if (!empty($_POST['7_2kv'])) {$sevenkv = $_POST['7_2kv'];} else {$sevenkv = 0;}
        if (!empty($_POST['480vac'])) {$onevac = $_POST['480vac'];} else {$onevac = 0;}
        if (!empty($_POST['120vac'])) {$twovac = $_POST['120vac'];} else {$twovac = 0;}
        if (!empty($_POST['130vdc'])) {$onevdc = $_POST['130vdc'];} else {$onevdc = 0;}
        if (!empty($_POST['345kvSafeDistance'])) {
            $onekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['345kvSafeDistance']));
        } else {
            $onekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['345kvSafeDistanceM']));
        }
        if (!empty($_POST['138kvSafeDistance'])) {
            $twokvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['138kvSafeDistance']));
        } else {
            $twokvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['138kvSafeDistanceM']));
        }
        if (!empty($_POST['69kvSafeDistance'])) {
            $threekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['69kvSafeDistance']));
        } else {
            $threekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['69kvSafeDistanceM']));
        }
        if (!empty($_POST['24_9kvSafeDistance'])) {
            $fourkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['24_9kvSafeDistance']));
        } else {
            $fourkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['24_9kvSafeDistanceM']));
        }
        if (!empty($_POST['14_4kvSafeDistance'])) {
            $fivekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['14_4kvSafeDistance']));
        } else {
            $fivekvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['14_4kvSafeDistanceM']));
        }
        if (!empty($_POST['12_5kvSafeDistance'])) {
            $sixkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['12_5kvSafeDistance']));
        } else {
            $sixkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['12_5kvSafeDistanceM']));
        }
        if (!empty($_POST['7_2kvSafeDistance'])) {
            $sevenkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['7_2kvSafeDistance']));
        } else {
            $sevenkvSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['7_2kvSafeDistanceM']));
        }
        if (!empty($_POST['480vacSafeDistance'])) {
            $onevacSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['480vacSafeDistance']));
        } else {
            $onevacSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['480vacSafeDistanceM']));
        }
        if (!empty($_POST['120vacSafeDistance'])) {
            $twovacSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['120vacSafeDistance']));
        } else {
            $twovacSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['120vacSafeDistanceM']));
        }
        if (!empty($_POST['130vdcSafeDistance'])) {
            $onevdcSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['130vdcSafeDistance']));
        } else {
            $onevdcSafeDistance = mysqli_real_escape_string($dbconn, trim($_POST['130vdcSafeDistanceM']));
        }
        if (!empty($_POST['lightning'])) {$lightning = $_POST['lightning'];} else {$lightning = 0;}
        if (!empty($_POST['induction'])) {$induction = $_POST['induction'];} else {$induction = 0;}
        if (!empty($_POST['faultOnLine_Apparatus'])) {$faultOnLine_Apparatus = $_POST['faultOnLine_Apparatus'];} else {$faultOnLine_Apparatus = 0;}
        if (!empty($_POST['static'])) {$static = $_POST['static'];} else {$static = 0;}
        $otherEnergySource = mysqli_real_escape_string($dbconn, trim($_POST['otherEnergySource']));
        if (!empty($_POST['hydraulic'])) {$hydraulic = $_POST['hydraulic'];} else {$hydraulic = 0;}
        if (!empty($_POST['pneumatic'])) {$pneumatic = $_POST['pneumatic'];} else {$pneumatic = 0;}
        if (!empty($_POST['chemical'])) {$chemical = $_POST['chemical'];} else {$chemical = 0;}
        if (!empty($_POST['mechanical'])) {$mechanical = $_POST['mechanical'];} else {$mechanical = 0;}
        if (!empty($_POST['notifySocc'])) {$notifySocc = $_POST['notifySocc'];} else {$notifySocc = 0;}
        if (!empty($_POST['notifyCustomers'])) {$notifyCustomers = $_POST['notifyCustomers'];} else {$notifyCustomers = 0;}
        if (!empty($_POST['vdi'])) {$vdi = $_POST['vdi'];} else {$vdi = 0;}
        if (!empty($_POST['grounding'])) {$grounding = $_POST['grounding'];} else {$grounding = 0;}
        if (!empty($_POST['barrier'])) {$barrier = $_POST['barrier'];} else {$barrier = 0;}
        if (!empty($_POST['lockout_tagout'])) {$lockout_tagout = $_POST['lockout_tagout'];} else {$lockout_tagout = 0;}
        if (!empty($_POST['coverup'])) {$coverup = $_POST['coverup'];} else {$coverup = 0;}
        if (!empty($_POST['safeDistance'])) {$safeDistance = $_POST['safeDistance'];} else {$safeDistance = 0;}
        if (!empty($_POST['confinedSpace'])) {$confinedSpace = $_POST['confinedSpace'];} else {$confinedSpace = 0;}
        if (!empty($_POST['clearanceNumber'])) {$clearanceNumber = $_POST['clearanceNumber'];} else {$clearanceNumber = 0;}
        if (!empty($_POST['hotLineHoldNumber'])) {$hotLineHoldNumber = $_POST['hotLineHoldNumber'];} else {$hotLineHoldNumber = 0;}
        $otherControlsToBeUsed = mysqli_real_escape_string($dbconn, trim($_POST['otherControlsToBeUsed']));
        if (!empty($_POST['hardHat'])) {$hardHat = $_POST['hardHat'];} else {$hardHat = 0;}
        if (!empty($_POST['boots'])) {$boots = $_POST['boots'];} else {$boots = 0;}
        if (!empty($_POST['leatherGloves'])) {$leatherGloves = $_POST['leatherGloves'];} else {$leatherGloves = 0;}
        if (!empty($_POST['harness_lanyard'])) {$harness_lanyard = $_POST['harness_lanyard'];} else {$harness_lanyard = 0;}
        if (!empty($_POST['safetyGlasses'])) {$safetyGlasses = $_POST['safetyGlasses'];} else {$safetyGlasses = 0;}
        if (!empty($_POST['cottonClothing'])) {$cottonClothing = $_POST['cottonClothing'];} else {$cottonClothing = 0;}
        if (!empty($_POST['rubberGloves_Sleeves'])) {$rubberGloves_Sleeves = $_POST['rubberGloves_Sleeves'];} else {$rubberGloves_Sleeves = 0;}
        if (!empty($_POST['hearingProtection'])) {$hearingProtection = $_POST['hearingProtection'];} else {$hearingProtection = 0;}
        if (!empty($_POST['frc'])) {$frc = $_POST['frc'];} else {$frc = 0;}
        if (!empty($_POST['safetyVest'])) {$safetyVest = $_POST['safetyVest'];} else {$safetyVest = 0;}
        $otherPersonalProtectiveEquipment = mysqli_real_escape_string($dbconn, trim($_POST['otherPersonalProtectiveEquipment']));
        if (!empty($_POST['frShirtTuckedIn'])) {$frShirtTuckedIn = $_POST['frShirtTuckedIn'];} else {$frShirtTuckedIn = 0;}
        if (!empty($_POST['clothingHasNoTears'])) {$clothingHasNoTears = $_POST['clothingHasNoTears'];} else {$clothingHasNoTears = 0;}
        if (!empty($_POST['noContactWithBleachOrDEET'])) {$noContactWithBleachOrDEET = $_POST['noContactWithBleachOrDEET'];} else {$noContactWithBleachOrDEET = 0;}
        if (!empty($_POST['noStainsOnClothing'])) {$noStainsOnClothing = $_POST['noStainsOnClothing'];} else {$noStainsOnClothing = 0;}
        $additionalInformationAsNecessary = mysqli_real_escape_string($dbconn, trim($_POST['additionalInformationAsNecessary']));
        $crewMemberName1 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName1']));
        $crewMemberName2 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName2']));
        $crewMemberName3 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName3']));
        $crewMemberName4 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName4']));
        $crewMemberName5 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName5']));
        $crewMemberName6 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName6']));
        $crewMemberName7 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName7']));
        $crewMemberName8 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName8']));
        $crewMemberName9 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName9']));
        $crewMemberName10 = mysqli_real_escape_string($dbconn, trim($_POST['crewMemberName10']));

        //insert to db
        $sqlInsert= "INSERT INTO jobSafetyAnalysis (divisionId, userId, jobDate, workLocation, jobTime, latitude, longitude, nineEleven, cell, radio, subPhone, facility_shopPhone, hospital, location,
                    personPerformingJobBriefing, personInChargeOfWork, operatorMaintenance, internalMaintenance, XFER_LTC_Maintenance, circuitSwitchMaintenance, installPortable_XFMR, lowSideVoltageWork,
                    regularMaintenance, haulMaterial, liftSteel, otherDescriptionOfWork, energizedApparatus, electrical_OVHTransmissionLines, heavyObjects, electrical_busWork, equipmentInMotion,
                    noise, electricalDistributionLines, highAirPressureSystem, sharp_pointedEdges, slip_tripOnUnevenGround, falling, fallingObjects, snakes_wasps, holes_excavations, hydraulicPressureSystem,
                    traps, otherHazard, health_safetyHandbook, meter_verifyBeforeGrounding, visuallyIDPotentialEnergySources, errorEliminationTools, otherSpecificWorkProcedures, step_touchPotential, backing,
                    wet_muddy, bucketEmergencyLetDownUnderstood, heatStress, weather, bucketEmergencyControlsTestedAndVerified, positionOfEquipment, otherSpecialConditionsOrConcerns, 345kv, 138kv, 69kv,
                    24_9kv, 14_4kv, 12_5kv, 7_2kv, 480vac, 120vac, 130vdc, 345kvSafeDistance, 138kvSafeDistance, 69kvSafeDistance, 24_9kvSafeDistance, 14_4kvSafeDistance,
                    12_5kvSafeDistance, 7_2kvSafeDistance, 480vacSafeDistance, 120vacSafeDistance, 130vdcSafeDistance, lightning, induction, faultOnLine_Apparatus, static, otherEnergySource,
                    hydraulic, pneumatic, chemical, mechanical, notifySocc, notifyCustomers, vdi, grounding, barrier, lockout_tagout, liveLineTool, coverup, safeDistance, confinedSpace, clearanceNumber,
                    hotLineHoldNumber, otherControlsToBeUsed, hardHat, boots, leatherGloves, harness_lanyard, safetyGlasses, cottonClothing, rubberGloves_Sleeves, hearingProtection, frc, safetyVest,
                    otherPersonalProtectiveEquipment, frShirtTuckedIn, clothingHasNoTears, noContactWithBleachOrDEET, noStainsOnClothing, additionalInformationAsNecessary, crewMemberName1, crewMemberName2,
                    crewMemberName3, crewMemberName4, crewMemberName5, crewMemberName6, crewMemberName7, crewMemberName8, crewMemberName9, crewMemberName10) VALUES ('$divisionId', '$userId', '$jobDate', NULLIF('$workLocation', ''), NULLIF ('$jobTime', ''), NULLIF ('$latitude', ''),
                    NULLIF ('$longitude', ''), '$nineEleven', '$cell', '$radio', '$subPhone', '$facility_shopPhone', NULLIF ('$hospital', ''), NULLIF ('$location', ''), NULLIF ('$personPerformingJobBriefing',''),
                    NULLIF ('$personInChargeOfWork', ''), '$operatorMaintenance', '$internalMaintenance', '$XFER_LTC_Maintenance', '$circuitSwitchMaintenance', '$installPortable_XFMR', '$lowSideVoltageWork',
                    '$regularMaintenance', '$haulMaterial', '$liftSteel', NULLIF ('$otherDescriptionOfWork', ''), '$energizedApparatus', '$electricalOVHTransmissionLines', '$heavyObjects', '$electricalbusWork',
                    '$equipmentInMotion', '$noise', '$electricalDistributionLines', '$highAirPressureSystem', '$sharp_pointedEdges', '$slip_tripOnUnevenGround', '$falling', '$fallingObjects', '$snakes_wasps', '$holes_excavations',
                    '$hydraulicPressureSystem', '$traps', NULLIF ('$otherHazard', ''), '$health_safetyHandbook', '$meter_verifyBeforeGrounding', '$visuallyIDPotentialEnergySources', '$errorEliminationTools',
                    NULLIF ('$otherSpecificWorkProcedures', ''), '$step_touchPotential', '$backing', '$wet_muddy', '$bucketEmergencyLetDownUnderstood', '$heatStress', '$weather', '$bucketEmergencyControlsTestedAndVerified',
                    '$positionOfEquipment', NULLIF ('$otherSpecialConditionsOrConcerns', ''), '$onekv', '$twokv', '$threekv', '$fourkv', '$fivekv', '$sixkv', '$sevenkv', '$onevac', '$twovac', '$onevdc',
                    NULLIF ('$onekvSafeDistance', ''), NULLIF ('$twokvSafeDistance', ''), NULLIF ('$threekvSafeDistance', ''), NULLIF ('$fourkvSafeDistance', ''), NULLIF ('$fivekvSafeDistance', ''),
                    NULLIF ('$sixkvSafeDistance', ''), NULLIF ('$sevenkvSafeDistance', ''), NULLIF ('$onevacSafeDistance', ''), NULLIF ('$twovacSafeDistance', ''), NULLIF ('$onevdcSafeDistance', ''),
                    '$lightning', '$induction', '$faultOnLine_Apparatus', '$static', NULLIF ('$otherEnergySource', ''), '$hydraulic', '$pneumatic', '$chemical', '$mechanical', '$notifySocc', '$notifyCustomers', '$vdi',
                    '$grounding', '$barrier', '$lockout_tagout', '$coverup', '$safeDistance', '$safeDistance', '$confinedSpace', '$clearanceNumber', '$hotLineHoldNumber', NULLIF ('$otherControlsToBeUsed', ''),
                    '$hardHat', '$boots', '$leatherGloves', '$harness_lanyard', '$safetyGlasses', '$cottonClothing', '$rubberGloves_Sleeves', '$hearingProtection', '$frc', '$safetyVest',
                    NULLIF ('$otherPersonalProtectiveEquipment', ''), '$frShirtTuckedIn', '$clothingHasNoTears', '$noContactWithBleachOrDEET', '$noStainsOnClothing', NULLIF ('$additionalInformationAsNecessary', ''),
                    NULLIF ('$crewMemberName1', ''), NULLIF ('$crewMemberName2', ''), NULLIF ('$crewMemberName3', ''), NULLIF ('$crewMemberName4', ''), NULLIF ('$crewMemberName5', ''), NULLIF ('$crewMemberName6', ''),
                    NULLIF ('$crewMemberName7', ''), NULLIF ('$crewMemberName8', ''), NULLIF ('$crewMemberName9', ''), NULLIF ('$crewMemberName10', ''))";

        $dbconn->query($sqlInsert);
//
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
                                <label for="radio" class="form-check-label form-control-sm">
                                    <input id="radio" name="radio" type="checkbox" class="form-check-input" value="1">Radio
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
                                <label for="electrical_OVHTransmissionLines" class="form-check-label form-control-sm">
                                    <input id="electrical_OVHTransmissionLines" name="electrical_OVHTransmissionLines" type="checkbox" class="form-check-input" value="1">Electrical-OVH Transmission Lines
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
                        <input type="text" id="345kvSafeDistanceM" name="345kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="138kv" class="form-check-label form-control-sm ml-3">
                            <input id="138kv" name="138kv" type="checkbox" class="form-check-input" value="1">138 kv
                        </label>
                        <input type="text" id="138kvSafeDistanceM" name="138kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="69kv" class="form-check-label form-control-sm ml-3">
                            <input id="69kv" name="69kv" type="checkbox" class="form-check-input" value="1">69 kv
                        </label>
                        <input type="text" id="69kvSafeDistanceM" name="69kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="24_9kv" class="form-check-label form-control-sm ml-3">
                            <input id="24_9kv" name="24_9kv" type="checkbox" class="form-check-input" value="1">24.9 kv
                        </label>
                        <input type="text" id="24_9kvSafeDistanceM" name="24_9kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="14_4kv" class="form-check-label form-control-sm ml-3">
                            <input id="14_4kv" name="14_4kv" type="checkbox" class="form-check-input" value="1">14.4 kv
                        </label>
                        <input type="text" id="14_4kvSafeDistanceM" name="14_4kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="12_5kv" class="form-check-label form-control-sm ml-3">
                            <input id="12_5kv" name="12_5kv" type="checkbox" class="form-check-input" value="1">12.5 kv
                        </label>
                        <input type="text" id="12_5kvSafeDistanceM" name="12_5kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="7_2kv" class="form-check-label form-control-sm ml-3">
                            <input id="7_2kv" name="7_2kv" type="checkbox" class="form-check-input" value="1">7.2 kv
                        </label>
                        <input type="text" id="7_2kvSafeDistanceM" name="7_2kvSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="14-4kv" class="form-check-label form-control-sm ml-3">
                            <input id="480vac" name="480vac" type="checkbox" class="form-check-input" value="1">480 VAC
                        </label>
                        <input type="text" id="480vacSafeDistanceM" name="480vacSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="120vac" class="form-check-label form-control-sm ml-3">
                            <input id="120vac" name="120vac" type="checkbox" class="form-check-input" value="1">120 VAC
                        </label>
                        <input type="text" id="120vacSafeDistanceM" name="120vacSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
                        <label for="130vdc" class="form-check-label form-control-sm ml-3">
                            <input id="130vdc" name="130vdc" type="checkbox" class="form-check-input" value="1">130 VDC
                        </label>
                        <input type="text" id="130vdcSafeDistanceM" name="130vdcSafeDistanceM" class="form-control form-control-sm" placeholder="Safe Distance"/>
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
                                <label for="cottonClothing" class="form-check-label form-control-sm">
                                    <input id="cottonClothing" name="cottonClothing" type="checkbox" class="form-check-input" value="1">Cotton Clothing
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
                    <textarea rows="10" cols="10" id="additionalInformationAsNecessary" name="additionalInformationAsNecessary" class="form-control form-control-sm"></textarea>
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

