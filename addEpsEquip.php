<?php
    session_start();
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];

    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];

    }
    require_once 'connectdb.php';


    if (isset($_POST['epsDesc'])) {
        $epsDesc = $_POST['epsDesc'];
    }
    if (isset($_POST['dateIssued'])) {
        $issueDate = $_POST['dateIssued'];
    }
    if (isset($_POST['serialNo'])) {
        $serialNo = $_POST['SerialNo'];
    }
    //set variables
    $epsDes = mysqli_real_escape_string($dbconn, trim($_POST['epsDesc']));
    $idate = new DateTime($_POST['dateIssued']);
    $formatDateIssued = $idate->format('Y-m-d');
    $serialNo = mysqli_real_escape_string($dbconn, trim($_POST['serialNo']));

    $sqlInsert = "INSERT INTO epsEquip (userId, epsDesc, dateIssued, serialNo) VALUES ('$assocId', '$epsDesc', '$formatDateIssued', NULLIF('$serialNo', ''))";
    $dbconn->query($sqlInsert);

    header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");