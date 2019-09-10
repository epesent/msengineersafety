<?php

error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['permissionLevel'])) {
        if ($_SESSION['permissionLevel'] !== 'adm') {
            header("location:index.php");
        }
    } else {
        header("location:index.php");
    }

    require_once 'connectdb.php';
    require_once 'scripts/safetyUploadssc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Safety Uploads</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php include_once "includes/inc.adminnav.php"; ?>
        <div id="mbodyright1">
            <div id="mbr1content" style="padding-left: 30%">
                <h2>Upload Safety Files</h2>
                <h4 style="font-style: italic">(PDF files only)</h4>
                <div style="height: 30px;">&nbsp;</div><!--end spacer-->
                <form action="" method="post" name="upFile" enctype="multipart/form-data" >
                    <label for="uploadName">Name:</label>
                    <input type="text" id="uploadName" name="uploadName" placeholder="File Name" style="width: 50%" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['uploadName'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['uploadName'])) {
                            echo "<br/>" .$errors['uploadName'];
                        }
                        ?>
                    </span><br/>
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" maxlength="256" placeholder="Brief Description (256 Characters max)" style="width: 50%" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['description'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['description'])) {
                            echo "<br/>" .$errors['description'];
                        }
                        ?>
                    </span><br/>
                    <label for="position">Source:&nbsp;&nbsp;&nbsp;</label>
                    <select name="position" id="position">
                        <option value="external">External Source</option>
                        <option value="company">Company Document</option>
                    </select>
                    <br/><br/>
                    <input type="file" id="fileLocation" name="fileLocation" /><br>
                    <div style="height: 20px;">&nbsp;</div><!--end spacer-->
                    <input type="submit" id="upload" name="upload" class="btn3" value="Upload File" />
                    <!--File type error warning-->
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['fileError'])) {
                            echo $errors['fileError'];
                        }
                        ?></span>
                    <br/>
                    <input type="button" name="back" id="back" class="btn3" value="Cancel" onclick="history.go(-1);"/>
                </form>
            </div><!--end mbodyright1-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>