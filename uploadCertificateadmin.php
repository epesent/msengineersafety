<?php
session_start();
require_once 'connectdb.php';

if (isset($_GET['assocId'])) {
    //associate Id is the same as the user Id on the user table.  Done to fix confusion with user id from session variable.
    $assocId = $_GET['assocId'];
}
if (isset($_GET['divisionId'])) {
    $divisionId = $_GET['divisionId'];
}
if (isset($_GET['qualificationId'])) {
    $qualificationId = $_GET['qualificationId'];
}
if (isset($_GET['lastId'])) {
    $recordQualId = $_GET['lastId'];
}
$associate = getAsc ($dbconn, $assocId);
$qualification = getSpecQualification ($dbconn, $qualificationId);

require_once 'scripts/uploadCertificateadminsc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Upload</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper" style="min-height: 500px;">
        <?php
        if ($_SESSION['permissionLevel'] =='mgr') {
            include_once 'includes/inc.divmgrnav.php';
        } elseif ($_SESSION['permissionLevel'] =='adm') {
            include_once "includes/inc.adminnav.php";
        } else {
            include_once "includes/inc.assocnav.php";
        } ?>

        <div id="mbodyright1">
            <div id="mbr1content" style="padding-left: 30%">
                <h1>Upload Certificates</h1><br/><br/>
                <h2>Upload certificate to the record of <?php echo $associate['firstName'] ." " .$associate['lastName']; ?><br/>
                    <span style="font-size: 10px; font-style: italic">(pdf, jpg, jpeg, png)</span><br/><br/>
                    The certificate is for the <?php echo $qualification['qualName']; ?>
                </h2><br/><br/>
                <form action="" method="post" name="upFile" enctype="multipart/form-data" >
                    <input type="file" id="fileLocation" name="fileLocation"/>
                    <div style="height: 10px"></div><!--spacer-->
                    <input type="submit" id="upload" name="upload" class="btn3" value="Upload Certificate" />
                    <!--File type error warning-->
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php if ($_POST && isset($errors['file'])) {
                            echo $errors['file'];
                        } elseif ($_POST && isset($errors['fileError'])) {
                            echo $errors['fileError'];
                        }
                        ?></span>
                    <br/>
                    <input type="button" name="back" id="back" class="btn3" value="Go Back" onclick="history.go(-1);"/>
                </form>
            </div>
        </div>

        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
