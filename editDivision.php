<?php
error_reporting(E_ALL);
session_start();
if (isset($_GET['divisionId'])) {
    $divisionId = $_GET['divisionId'];
}

require_once 'connectdb.php';
$division = getDivisonSingle ($dbconn, $divisionId);
$oldHeadId = $division['divisionHeadId'];


try {

    //set variables
    $divisionName = mysqli_real_escape_string($dbconn, trim($_POST['divisionName']));
    $description = mysqli_real_escape_string($dbconn, trim($_POST['description']));
    $divisionHeadId = $_POST['divisionHeadId'];
    //Update the division table
    $sqlUpdateDiv = "UPDATE divisions SET divisionName='$divisionName', description='$description', divisionHeadId='$divisionHeadId', modifyDate=NOW()
                     WHERE divisionId='$divisionId'";
    $dbconn->query($sqlUpdateDiv);
    //update permission level of the old head
    $sqlUpdateOldHead = "UPDATE users SET permissionLevel='asc' WHERE userId='$oldHeadId'";
    $dbconn->query($sqlUpdateOldHead);
    //update permission level of the new head
    $sqlUpdateNewHead = "UPDATE users SET permissionLevel='mgr' WHERE userId='$divisionHeadId'";
    $dbconn->query($sqlUpdateNewHead);

    header("location: admindivision.php?divisionId=$divisionId");

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

