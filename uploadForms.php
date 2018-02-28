<?php
session_start();
require_once 'connectdb.php';
$userId = $_SESSION['userId'];
$user = getAsc ($dbconn, $_SESSION['userId']);
$divisionId = $user['divisionId'];
$division = getDivisonSingle ($dbconn, $divisionId);
$divisionName = $division['divisionName'];
$forms = getForms ($dbconn);
require_once 'scripts/uploadFormssc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Upload</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php
    if ($_SESSION['permissionLevel'] =='mgr') {
        include_once 'includes/inc.divmgrnav.php';
    } else {
        include_once "includes/inc.assocnav.php";
    } ?>

    <div id="mbodyright1">
        <div id="mbr1content" style="padding-left: 30%">
            <h2>Upload Forms</h2><br/>
            <form action="" method="post" name="upFile" enctype="multipart/form-data" >
                <select id="formId" name="formId">
                    <option value="">Select Form</option>
                    <?php
                        if ($_SESSION['permissionLevel'] =='adm') {
                            foreach ($forms as $row) {
                                echo "<option value='" . $row['formId'] . "'>" . $row['formName'] . "</option>";
                            }
                        } else {
                            foreach ($forms AS $row) {
                                if ($row['adminUse'] !== 'yes') {
                                    echo "<option value='" . $row['formId'] . "'>" . $row['formName'] . "</option>";
                                }
                            }
                        };
                    ?>
                </select><span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['form'])) {
                            echo $errors['form'];
                        }
                        ?></span><br/><br/><input type="file" id="fileLocation" name="fileLocation"/>
                <div style="height: 10px"></div><!--spacer-->
                <input type="submit" id="upload" name="upload" class="btn3" value="Upload Report" />
                <!--File type error warning-->
                        <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['fileError'])) {
                            echo $errors['fileError'];
                        }
                        ?></span>
                <br/>
                <input type="button" name="back" id="back" class="btn3" value="Go Back" onclick="history.go(-1);"/>
            </form>
        </div><!--mbr1content-->
    </div><!--end mbodyright-->


    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>