<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
$errors = array();

try {

    if (isset($_POST['upload'])) {
//        if (empty($_POST['fileLocation'])) {
//            //Check that file is chosen
//            $errors['file'] = 'Please select a file';
//        } else {
            //verify pdf file
            $allowed = array("pdf", "png", "jpg", "jpeg");
            $fileName = $_FILES['fileLocation']['name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);


            if (!in_array($ext, $allowed)) {
                $errors['fileError'] = $ext ." - Please upload correct file format only.";
            } else {
                //upload file section
                $target_path = "uploads/";
                $target_pathU = $target_path .$assocId .'-' .$divisionId .'-' .$qualificationId .date('Y-m-d h:i:sa') .basename( $_FILES['fileLocation']['name']) ;

                if(move_uploaded_file($_FILES['fileLocation']['tmp_name'], $target_pathU)) {
                    $url = $target_pathU;
                } else{
                    $errors['fileError'] = "The file has not been uploaded. Please contact the office.";
                }
                if (!$errors) {
                    $sqlInsert = "INSERT INTO certificateUploads (userId, recordQualId, link, qualificationId, divisionId) VALUES ('$assocId', '$recordQualId', '$target_pathU', '$qualificationId', '$divisionId')";
                    $dbconn->query($sqlInsert);

                    header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");
                }
            }

//        }



    }


} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}