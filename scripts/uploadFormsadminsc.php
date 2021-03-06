<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
$errors = array();

try {

    if (isset($_POST['upload'])) {
        //verify file choice
        if ($_POST['formId'] == '') {
            $errors['form'] = 'Please select a form';
        } else {
            $formId = $_POST['formId'];
        }
        if ($_POST['formId'] =='5') {
            if ($_POST['facility'] == '') {
                $errors['facility'] = 'Please input a Facility Name';
            } else {
                $facility = $_POST['facility'];
            }
        }
        if ($_POST['divisionId'] == '') {
            $errors['division'] = 'Please select a division';
        } else {
            $divisionId = $_POST['divisionId'];
        }
        //verify pdf file
        $allowed = array('pdf');
        $fileName = $_FILES['fileLocation']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        //get Form Name
        $aform = getaForm ($dbconn, $formId);
        $formAbbrev = $aform['formAbbrev'];
        //get Division Name
        $div = getDivisonSingle ($dbconn, $divisionId);
        $divisionName = $div['divisionName'];
        if (!in_array($ext, $allowed)) {
            $errors['fileError'] = $ext ."Please upload pdf files only.";
        } else {
            //upload file section
            $target_path = "uploads/";
            if (!empty($_POST['facility'])) {
                $target_pathU = $target_path .$divisionName ."-" .$formAbbrev ."-" .date('Y-m-d h:i:sa') ."-" . basename( $_FILES['fileLocation']['name']);
                $nameForm = $divisionName ."-" .$formAbbrev ."-" .date('Y-m-d h:i:sa') ."-ADM-" .$facility ;
            } else {
                $target_pathU = $target_path .$divisionName ."-" .$formAbbrev ."-" .date('Y-m-d h:i:sa') ."-" . basename( $_FILES['fileLocation']['name']);
                $nameForm = $divisionName ."-" .$formAbbrev ."-" .date('Y-m-d h:i:sa') ."-ADM";
            }
//            echo $nameForm;

            if(move_uploaded_file($_FILES['fileLocation']['tmp_name'], $target_pathU)) {
                $url = $target_pathU;
            } else{
                $errors['fileError'] = "The file has not been uploaded. Please contact the office.";
            }
        }
        if (!$errors) {
            $sqlInsert = "INSERT INTO uploaded (userId, divisionId, link, uploadName) VALUES ('$userId', '$divisionId', '$url', '$nameForm')";
            $dbconn->query($sqlInsert);

            header("Location: dashboardadmin.php");
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}