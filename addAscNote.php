<?php

session_start();
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];

    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];

    }
    require_once 'connectdb.php';
    //set variables
    $note = mysqli_real_escape_string($dbconn, trim($_POST['note']));
    $authorId = $_SESSION['userId'];

    $sqlInsert = "INSERT INTO notes (userId, note, noteDate, authorId) VALUES ('$assocId', '$note', NOW(), '$authorId')";
    $dbconn->query($sqlInsert);
    header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");

