<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
$errors = array();

try {

    if (isset($_POST['upload'])) {
        //verify inputs
        if (empty($_POST['uploadName'])) {
            $errors['uploadName'] = "Please give a name";
        }
        if (empty($_POST['description'])) {
            $errors['description'] = "Please give a brief description";
        }
        //set variables
        $userId = $_SESSION['userId'];
        $uploadName = mysqli_real_escape_string($dbconn, trim($_POST['uploadName']));
        $description = mysqli_real_escape_string($dbconn, trim($_POST['description']));
        $position = $_POST['position'];

        if (!$errors) {
            //verify pdf file
            $allowed = array('pdf');
            $fileName = $_FILES['fileLocation']['name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            //verify file has been chosen and then if it is pdf.
            if (empty($ext)) {
                $errors['fileError'] = "Please choose a file to upload.";
            } elseif (!in_array($ext, $allowed)) {
                $errors['fileError'] = "This is a ." . $ext . " - Please upload .pdf files only.";
            } else {
                //upload file
                $target_path = "uploadSafety/";
                $target_pathU = $target_path . basename($_FILES['fileLocation']['name']);

                if (move_uploaded_file($_FILES['fileLocation']['tmp_name'], $target_pathU)) {

                } else {
                    $errors['fileError'] = "There was an error, the file has not been uploaded.";
                }
            }
            //put informatiop into database
            if (!$errors) {
                $sqlInsert = "INSERT INTO safetyUploads (userId, link, uploadName, description, position) VALUES ('$userId', '$target_pathU', '$uploadName', '$description', '$position')";
                $dbconn->query($sqlInsert);
                echo '<script type="text/javascript">alert("Your File has been uploaded");
                            window.location.href = "dashboardadmin.php";
                            </script>';
            }
        }
    }
} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}