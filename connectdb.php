<?php

$hostname = "localhost";
$username = "mssafety";
$password = "2@safety@2";
$dbname = "mssafety";

//connection to the database
$dbconn = mysqli_connect($hostname, $username, $password, $dbname) or die("Unable to connect to MySQL");

//if (mysqli_connect_errno()) {
//    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//} else {
//    echo "good connection";
//}

//get user by email
function getUser ($dbconn, $userEmail) {
    $sqlgetUser = "SELECT * FROM users WHERE userEmail = '$userEmail'";
    $result = $dbconn->query($sqlgetUser);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
//get user by id
function getUserwId ($dbconn, $userId) {
    $sqlgetUser = "SELECT * FROM users WHERE userId = '$userId'";
    $result = $dbconn->query($sqlgetUser);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
//Check to see if reset code still valid
function checkResetCode ($dbconn, $code) {
    $sqlCheckC = "SELECT * FROM pwdReset WHERE code = '$code'";
    $result = $dbconn->query($sqlCheckC);
    $check = mysqli_fetch_assoc($result);
    return $check;
}
//get all divisions for admin
function getDivisions ($dbconn) {
    $sqlDivisions = "SELECT divisions.*, contacts.contactId, contacts.userId, contacts.firstName, contacts.lastName 
                      FROM divisions 
                      LEFT JOIN contacts ON contacts.userId=divisions.divisionHeadId
                      ORDER BY divisions.divisionName ASC";
    $result = $dbconn->query($sqlDivisions);
    return $result;
}
//get single division
function getDivisonSingle ($dbconn, $divisionId) {
    $sqlDivision = "SELECT * FROM divisions LEFT JOIN contacts ON contacts.userId=divisions.divisionHeadId WHERE divisions.divisionId='$divisionId'";
    $result = $dbconn->query($sqlDivision);
    $divis = mysqli_fetch_assoc($result);
    return $divis;
}
//get associates by division
function getAssocbyDivision ($dbconn, $divisionId) {
    $sqlGAD = "SELECT * FROM contacts WHERE divisionId = '$divisionId' ORDER BY lastName ASC";
    $results = $dbconn->query($sqlGAD);
    return $results;
}
//get single associate
function getAsc ($dbconn, $userId) {
    $sqlAsc = "SELECT * FROM users LEFT JOIN contacts ON contacts.userId=users.userId WHERE users.userId = '$userId'";
    $result = $dbconn->query($sqlAsc);
    $Asc = mysqli_fetch_assoc($result);
    return $Asc;
}
//get single user
function getSingUser ($dbconn, $userId) {
    $sqlSingUser = "SELECT * FROM users WHERE userId = '$userId'";
    $result = $dbconn->query($sqlSingUser);
    $user= mysqli_fetch_assoc($result);
    return $user;
}
//qualifications by associate
function getQualbyAsc ($dbconn, $userId) {
    $sqlQBA = "SELECT * FROM qualRecord LEFT JOIN qualifications ON qualifications.qualificationId=qualRecord.qualificationId
               WHERE qualRecord.userId = '$userId' ORDER BY qualName ASC";
    $result = $dbconn->query($sqlQBA);
    return $result;
}
//get specific associate qualification
function getSpecAscQual ($dbconn, $recordQualId) {
    $getSAQ = "SELECT * FROM qualRecord
                LEFT JOIN qualifications ON qualifications.qualificationId = qualRecord.qualificationId
                LEFT JOIN contacts ON contacts.userId = qualRecord.userId
                WHERE qualRecord.recordQualId = '$recordQualId'";
    $result = $dbconn->query($getSAQ);
    $SAQ = mysqli_fetch_assoc($result);
    return $SAQ;
}
//get certificate link
function getCertLink ($dbconn, $recordQualId) {
    $sqlCL = "SELECT link FROM certificateUploads WHERE recordQualId = '$recordQualId'";
    $result = $dbconn->query($sqlCL);
    $cl = mysqli_fetch_assoc($result);
    return $cl;
}
//get all qualifications
function getQualifications ($dbconn) {
    $sqlQual = "SELECT * FROM qualifications ORDER BY qualAbbreviation ASC";
    $result = $dbconn->query($sqlQual);
    return $result;
}
//get specific qualification
function getSpecQualification ($dbconn, $qualificationId) {
    $sqlgSQ = "SELECT * FROM qualifications WHERE qualificationId = '$qualificationId'";
    $result = $dbconn->query($sqlgSQ);
    $GSQ = mysqli_fetch_assoc($result);
    return $GSQ;
}
//get eps equipment by associate
function getAscEpsEquip ($dbconn, $userId) {
    $sqlGet = "SELECT * FROM epsEquip WHERE userId = '$userId'";
    $result = $dbconn->query($sqlGet);
    return $result;
}
//get specific eps equipment by associtate
function getSpEpsEuip ($dbconn, $epsEquipId) {
    $sqlGetEQ = "SELECT * FROM epsEquip WHERE epsEquipId = '$epsEquipId'";
    $result = $dbconn->query($sqlGetEQ);
    $gEq = mysqli_fetch_assoc($result);
    return $gEq;
}
//get equipment by associate
function getAscEquip ($dbconn, $userId) {
    $sqlGAE = "SELECT * FROM equipRecord LEFT JOIN equipment ON equipment.equipmentId = equipRecord.equipmentId WHERE equipRecord.userId = '$userId' ";
    $result = $dbconn->query($sqlGAE);
    return $result;
}
//get specific associate equipment
function getSpecAscEquip ($dbconn, $equipRecordId) {
    $sqlSAE = "SELECT * FROM equipRecord LEFT JOIN equipment ON equipment.equipmentId = equipRecord.equipmentId WHERE equipRecord.equipRecordId = '$equipRecordId'";
    $result = $dbconn->query($sqlSAE);
    $SAE = mysqli_fetch_assoc($result);
    return $SAE;
}
//get All equipment
function getAllEquip ($dbconn) {
    $sqlEquip = "SELECT * FROM equipment ORDER BY equipName ASC";
    $result = $dbconn->query($sqlEquip);
    return $result;
}
//get specific equipment
function getSpecEquip ($dbconn, $equipmentId) {
    $sqlGSEq = "SELECT * FROM equipment WHERE equipmentId='$equipmentId'";
    $result = $dbconn->query($sqlGSEq);
    $GSEq = mysqli_fetch_assoc($result);
    return $GSEq;
}


//get equipment that is to expire in 30 days or less to send email notification (electrical only)
//Added by Robert Armstrong - Jan 19, 2018
function getElectricalEquip ($dbconn) {
    $sqlGetEE = "SELECT divisions.divisionName,
                             CONCAT(contacts.firstName ,  ' ' , contacts.lastName) AS fullName,
                             equipRecord.userId,
                             equipment.equipName,
                             equipment.equipType,
                             equipRecord.serialNumber,
                             equipRecord.issueDate,
                             equipRecord.expDate
                        FROM contacts
                          LEFT JOIN equipRecord ON contacts.userId = equipRecord.userId
                          LEFT JOIN equipment ON equipRecord.equipmentId = equipment.equipmentId
                          LEFT JOIN divisions ON contacts.divisionId = divisions.divisionId
                          WHERE equipType = 'electrical' AND DATEDIFF(expDate,NOW())<31
                          ORDER BY divisionName
                    ";
    $result = $dbconn->query($sqlGetEE);
    return $result;
}

//get equipment list to show expiry dates for all divisions and all dates
//Added by Robert Armstrong - Aug 23, 2018
function getEquipForAll ($dbconn) {
    $sqlGetEquip = "SELECT divisions.divisionName,
                             CONCAT(contacts.firstName ,  ' ' , contacts.lastName) AS fullName,
                             equipRecord.userId,
                             equipment.equipName,
                             equipment.equipType,
                             equipRecord.serialNumber,
                             equipRecord.issueDate,
                             equipRecord.expDate
                        FROM contacts
                          LEFT JOIN equipRecord ON contacts.userId = equipRecord.userId
                          LEFT JOIN equipment ON equipRecord.equipmentId = equipment.equipmentId
                          LEFT JOIN divisions ON contacts.divisionId = divisions.divisionId
                          WHERE divisionHeadId is not null
                          ORDER BY divisionName,contacts.userId
                    ";
    $result = $dbconn->query($sqlGetEquip);
    return $result;
}



//get safety tip for home page - select only last tip in list
function getSafetyTip ($dbconn) {
    $sqlTip = "SELECT * FROM safetytips ORDER BY tipId DESC LIMIT 1";
    $result = $dbconn->query($sqlTip);
    $Tip = mysqli_fetch_assoc($result);
    return $Tip;
}
//get safety tips for tip page - sort by date
function getAllTips ($dbconn) {
    $sqlATips = "SELECT * FROM safetytips ORDER BY created DESC";
    $result = $dbconn->query($sqlATips);
    return $result;
}
//get company safety documents
function getAllCompSafetydocs ($dbconn) {
    $sqlACD = "SELECT * FROM safetyUploads WHERE position = 'company' ORDER BY uploadDate ASC";
    $result = $dbconn->query($sqlACD);
    return $result;
}
//get external safety documents
function getAllExtSafetydocs ($dbconn) {
    $sqlAED = "SELECT * FROM safetyUploads WHERE position = 'external' ORDER BY uploadDate ASC";
    $result = $dbconn->query($sqlAED);
    return $result;
}
//get assoc notes.
function getAscNotes ($dbconn, $userId) {
    $sqlAN = "SELECT * FROM notes WHERE userId = '$userId' ORDER BY noteDate DESC";
    $result = $dbconn->query($sqlAN);
    return $result;
}
//get All SubContractors
function getSubs ($dbconn) {
    $sqlGS = "SELECT * FROM subcontractor ORDER BY subName ASC";
    $result = $dbconn->query($sqlGS);
    return ($result);
}
//get Specific SubContractor
function getSpecSub ($dbconn, $subcontractorId) {
    $sqlGSS = "SELECT * FROM subcontractor WHERE subcontractorId='$subcontractorId'";
    $result = $dbconn->query($sqlGSS);
    $GSS = mysqli_fetch_assoc($result);
    return $GSS;
}
//get subcontractor employees
function getSubEmp ($dbconn, $subcontractorId) {
    $sqlSubE = "SELECT * FROM subContacts WHERE subcontractorId = '$subcontractorId'";
    $result = $dbconn->query($sqlSubE);
    return $result;
}
//get sub-contractor employee qualifications
function getSEQualifications ($dbconn, $subContactsId) {
    $sqlSEQ = "SELECT * FROM qualRecord LEFT JOIN qualifications ON qualifications.qualificationId=qualRecord.qualificationId
              WHERE qualRecord.subContactsId = '$subContactsId'";
    $result = $dbconn->query($sqlSEQ);
    return $result;
}
//get sub-contractors by division
function getSubbyDivision ($dbconn, $divisionId) {
    $sqlGSBD = "SELECT * FROM divSubJoin LEFT JOIN subcontractor on subcontractor.subcontractorId = divSubJoin.subcontractorId
                LEFT JOIN divisions on divisions.divisionId = divSubJoin.divisionId WHERE divSubJoin.divisionId = '$divisionId'";
    $result = $dbconn->query($sqlGSBD);
    return $result;
}
//get download forms list
function getForms ($dbconn) {
    $sqlGetForms = "SELECT * FROM forms ORDER BY formName ASC";
    $result = $dbconn->query($sqlGetForms);
    return $result;
}
//get specific form
function getaForm ($dbconn, $formId) {
    $sqlGF = "SELECT * FROM forms WHERE formId = '$formId'";
    $result = $dbconn->query($sqlGF);
    $GF = mysqli_fetch_assoc($result);
    return $GF;
}
//get specific jsa Report
function getJSARep ($dbconn, $jsaId) {
    $sqljsaSpec = "SELECT * FROM jobSafetyAnalysis WHERE jsaId = $jsaId";
    $result = $dbconn->query($sqljsaSpec);
    $jsa = mysqli_fetch_assoc($result);
    return $jsa;
}
//get specific jsaT Report
function getJSATRep ($dbconn, $jsaTaskId) {
    $sqljsaTSpec = "SELECT * FROM jsaTaskAnalysis WHERE jsaTaskId = $jsaTaskId";
    $result = $dbconn->query($sqljsaTSpec);
    $jsaT = mysqli_fetch_assoc($result);
    return $jsaT;
}
//get specific vehicle report
function getVehicleReport ($dbconn, $vehicleReportId) {
    $sqlVR = "SELECT * FROM vehicleReport WHERE vehicleReportId = $vehicleReportId";
    $result = $dbconn->query($sqlVR);
    $VR = mysqli_fetch_assoc($result);
    return $VR;
}
//get all jsa reports by division by year
function getDivJsaReports ($dbconn, $divisionId, $year) {
    $sqlDJR = "SELECT * FROM jobSafetyAnalysis WHERE divisionId = $divisionId AND YEAR(jobDate) = $year ORDER BY jobDate ASC, userId";
    $result = $dbconn->query($sqlDJR);
    return $result;
}
//get all jsa reports by division by year
function getDivJsaTReports ($dbconn, $divisionId, $year) {
    $sqlDJTR = "SELECT * FROM jsaTaskAnalysis WHERE divisionId = $divisionId AND YEAR(jobDate) = $year ORDER BY jobDate ASC, userId";
    $result = $dbconn->query($sqlDJTR);
    return $result;
}
//get all vehicle reports by division by year
function getDivVehReports ($dbconn, $divisionId, $year) {
    $sqlDVR = "SELECT * FROM vehicleReport WHERE divisionId = $divisionId AND YEAR(reportDate) = $year ORDER BY reportDate ASC, userId";
    $result = $dbconn->query($sqlDVR);
    return $result;
}
