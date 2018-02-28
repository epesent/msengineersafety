<?php

require_once 'connectdb.php';

if (isset($_POST['divName'])) {
    $divisionName = mysqli_real_escape_string($dbconn, trim($_POST['divName']));
}
if (isset($_POST['description'])) {
    $description = mysqli_real_escape_string($dbconn, trim($_POST['description']));
}


$sqlInsertD = "INSERT INTO divisions (divisionName, description) VALUES ('$divisionName', NULLIF('$description', ''))";
$dbconn->query($sqlInsertD);

header("location: dashboardadmin.php");