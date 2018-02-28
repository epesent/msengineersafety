<?php

    session_start();
    require_once 'connectdb.php';

try {
    //set variables
    $equipName = mysqli_real_escape_string($dbconn, trim($_POST['equipName']));
    $equipType = $_POST['equipType'];
    $dueDateInterval = mysqli_real_escape_string($dbconn, trim($_POST['dueDateInterval']));


    $sqlInsert = "INSERT INTO equipment (equipName, equipType, dueDateInterval) VALUES ('$equipName', '$equipType', '$dueDateInterval')";
    $dbconn->query($sqlInsert);

    header("location: equipment.php");

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}
