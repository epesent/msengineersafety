<?php
$errors = array();

try {
    if (isset($_POST['addasc'])) {

        //Validate inputs
        $fn = trim($_POST['firstName']); //eliminate accidental space
        if (empty($fn)) {
            $errors['firstName'] = 'Please enter your first name.';
        } else {
            if (!preg_match("/^([a-zA-Z]+[\'-]?[a-zA-Z]+[ ]?)+$/", $_POST['firstName'])) {
                $errors['firstName'] = 'Please use correct characters.';
            }
        }
        $ln = trim($_POST['lastName']); //eliminate accidental space
        if (empty($ln)) {
            $errors['lastName'] = 'Please enter your last name.';
        } else {
            if (!preg_match("/^[a-z0-9\040\.\-]+$/i", $_POST['lastName'])) {
                $errors['lastName'] = 'Please use correct characters.';
            }
        }
        $temail = trim($_POST['userEmail']);
        if (empty($temail)) {
            $errors['userEmail'] = 'Please enter your email address.';
        } else {
            if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
                $errors['userEmail'] = "Please use a valid email format.";
            }
        }
        $tssn = trim($_POST['last4ssn']);
        if (empty($tssn)) {
            $errors['ssn'] = 'Please enter the last 4 digits of associate ssn#.';
        } else {
            if (!preg_match("/^[0-9]*$/", $_POST['last4ssn'])) {
                $errors['ssn'] = 'Please use numbers only.';
            }
        }
        //if no errors
        if (!$errors) {
            //declare variables
            $firstName = mysqli_real_escape_string($dbconn, trim($_POST['firstName']));
            $lastName = mysqli_real_escape_string($dbconn, trim($_POST['lastName']));
            $userEmail = mysqli_real_escape_string($dbconn, trim($_POST['userEmail']));
            $last4ssn = mysqli_real_escape_string($dbconn, trim($_POST['last4ssn']));
            //create new associate user
            $sqlInsertU = "INSERT INTO users (userEmail, userPassword, permissionLevel) VALUES ('$userEmail', '$last4ssn', 'asc')";
            $dbconn->query($sqlInsertU);
            //Get last inserted Id
            $assocId = mysqli_insert_id($dbconn);
            if (!empty($assocId)) {
                //create new associate contact
                $sqlInsertC = "INSERT INTO contacts (userId,firstName, lastName, divisionId, last4SSN)
                              VALUES ('$assocId','$firstName', '$lastName', '$divisionId', '$last4ssn')";
                $dbconn->query($sqlInsertC);
                //return to division page
                header("location: admindivision.php?divisionId=$divisionId");
            }
        }
    }
    if (isset($_POST['addsub'])) {
        $subcontractorId = $_POST['subcontractorId'];
        $sqlInsertSub = "INSERT INTO divSubJoin (divisionId, subcontractorId) VALUES ('$divisionId', '$subcontractorId')";
        $dbconn->query($sqlInsertSub);

        header("location: admindivision.php?divisionId=$divisionId");
    }
} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}