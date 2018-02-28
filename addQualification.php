<?php
error_reporting(E_ALL);
    session_start();
    require_once 'connectdb.php';
try {
    //set variables
    $qualAbbreviation = mysqli_real_escape_string($dbconn, trim($_POST['qualAbbreviation']));
    $qualName = mysqli_real_escape_string($dbconn, trim($_POST['qualName']));
    $qualMethod = mysqli_real_escape_string($dbconn, trim($_POST['qualMethod']));
    $qualRequireInterval = mysqli_real_escape_string($dbconn, trim($_POST['qualRequireInterval']));

    $sqlInsert = "INSERT INTO qualifications (qualAbbreviation, qualName, qualMethod, qualRequireInterval) VALUES ('$qualAbbreviation', '$qualName', '$qualMethod', '$qualRequireInterval')";
    $dbconn->query($sqlInsert);

    header("location: qualifications.php");

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}