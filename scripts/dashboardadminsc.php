<?php

error_reporting(E_ALL);

    $divisions = getDivisions ($dbconn);

try {

   if (isset($_POST['addnote'])) {
        //set variables
       $userId = $_SESSION['userId'];
       $tipTitle = mysqli_real_escape_string($dbconn, trim($_POST['tipTitle']));
       $tipContent = mysqli_real_escape_string($dbconn, trim($_POST['tipContent']));

       $sqlInsert = "INSERT INTO safetytips (userId, tipTitle, tipContent) VALUES ('$userId', '$tipTitle', '$tipContent')";
       $dbconn->query($sqlInsert);

       echo "<script> alert('Thank you for your tip')</script>";
   }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}