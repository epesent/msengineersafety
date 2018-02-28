<?php
    session_start();
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];

    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];

    }
    require_once 'connectdb.php';
    if (isset($_POST['equipmentId'])) {
        $equipmentId = $_POST['equipmentId'];
    }
    if (isset($_POST['issueDate'])) {
        $issueDate = $_POST['issueDate'];
    }
    if (isset($_POST['expDate'])) {
        $expDate = $_POST['expDate'];
    }
    //set variables
    $idate = new DateTime($_POST['issueDate']);
    $formatIssueDate = $idate->format('Y-m-d');
    $edate = new DateTime($_POST['expDate']);
    $formatExpDate = $edate->format('Y-m-d');

    $sqlInsert = "INSERT INTO equipRecord (equipmentId, userId, issueDate, expDate, modifiedDate) VALUES ('$equipmentId', '$assocId', '$formatIssueDate', '$formatExpDate', CURDATE())";
    $dbconn->query($sqlInsert);

    header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");