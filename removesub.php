<?php

    session_start();
    if (isset($_GET['subcontractorId'])) {
        $subcontractorId = $_GET['subcontractorId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    require_once 'connectdb.php';

try {
    $sqlDelete = "DELETE FROM divSubJoin WHERE divisionId='$divisionId' AND subcontractorId= '$subcontractorId'";
    $dbconn->query($sqlDelete);

    header("location: admindivision.php?divisionId=$divisionId");


} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}