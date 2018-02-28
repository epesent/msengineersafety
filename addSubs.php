<?php

session_start();
require_once 'connectdb.php';

try {
    //set variables
    $subName = mysqli_real_escape_string($dbconn, trim($_POST['subName']));

    $sqlInsert = "INSERT INTO subcontractor (subName) VALUES ('$subName')";
    $dbconn->query($sqlInsert);

    header("location: subContractors.php");

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}
