<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
$errors = array();

try {
    if (isset($_POST['upload'])) {
        //verify pdf file
        $allowed = array('pdf');
        $fileName = $_FILES['fileLocation']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($ext, $allowed)) {
            $errors['fileError'] = $ext ."Please upload pdf files only.";
        } else {
            //upload file section
            $target_path = "uploads/";

            $target_pathU = $target_path . basename( $_FILES['fileLocation']['name']);

            if(move_uploaded_file($_FILES['fileLocation']['tmp_name'], $target_pathU)) {
                $linkOriginal = $target_pathU;
            } else{
                $errors['fileError'] = "The file has not been uploaded. Please contact the office.";
            }
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}