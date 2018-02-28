<?php

    session_start();
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];

    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];

    }
    require_once 'connectdb.php';
    if (isset($_POST['qualificationId'])) {
        $qualificationId = $_POST['qualificationId'];
    }
    if (isset($_POST['qualDate'])) {
        $qualDate = $_POST['qualDate'];
    }
    $specQual = getSpecQualification ($dbconn, $qualificationId);
    $qDate = date('m/d/Y', strtotime($qualDate));
    $qualRequireInterval = $specQual['qualRequireInterval'];
    $interval = "+" .$qualRequireInterval ."months";

    //set variables
    $pqdate = new DateTime($_POST['qualDate']);
    $qualDate = $pqdate->format('Y-m-d');
    $dDate = strtotime(date('Y-m-d', strtotime($qualDate)) .$interval);
    $dueDate = date('Y-m-d', $dDate);

    $sqlInsert = "INSERT INTO qualRecord (qualificationId, userId, qualDate, dueDate, dateModified) VALUES ('$qualificationId', '$assocId', '$qualDate', '$dueDate', CURDATE())";
    $dbconn->query($sqlInsert);

    header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");