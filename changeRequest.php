<?php
    session_start();
    require_once 'connectdb.php';
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    $user = getAsc ($dbconn, $_SESSION['userId']);
    $division = getDivisonSingle ($dbconn, $divisionId);
    $divMgr = getAsc ($dbconn, $division['userId']);
    $divMgrEmail = $divMgr['userEmail'];


//$to = '"stevesmith@epesent.com, ' .$divMgrEmail  .'"';
//echo $to;
//echo $division['userId'];
//echo " and " .$divMgr['userEmail'];

try {
    if (isset($_POST['mail'])) {
        //if from associate
        if ($_SESSION['permissionLevel'] == 'asc') {
            $to = "stevesmith@epesent.com, " .$divMgrEmail;
            $from = $user['userEmail'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $headers = "From: " .$from . "\r\n" .'Reply-To ' .$from ."\r\n";
            if (mail($to,$subject,$message,$headers)) {
                echo '<script type="text/javascript">';
                echo 'alert("Thank you for your request");';
                echo 'window.location.href = "associate.php";';
                echo '</script>';
            } else {
                echo "<script language='JavaScript'>alert('The message did not send.  Please contact the office.')</script>";
            }

            header("location: associate.php");
        } else {
            //if from manager
            $to = "stevesmith@epesent.com";
            $from = $user['userEmail'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $headers = "From: " .$from . "\r\n" .'Reply-To ' .$from ."\r\n";

            if (mail($to,$subject,$message,$headers)) {
                echo '<script type="text/javascript">';
                echo 'alert("Thank you for your request");';
                echo 'window.location.href = "dashboarddivmgr.php";';
                echo '</script>';
            } else {
                echo "<script language='JavaScript'>alert('The message did not send.  Please contact the office.')</script>";
            }

//            header("location: dashboarddivmgr.php");
        }

    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Safety Change Request</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
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
            <div id="mbr1content">
                <h2>SEND A CHANGE REQUEST</h2><br/>
                <form action="" method="post">
                    <input type="text" id="subject" name="subject" style="width: 30%;" placeholder="Subject"/><br/><br/>
                    <h4>Type Message</h4>
                    <textarea id="message" name="message" rows="20" cols="80"></textarea><br/><br/>
                    <input type="submit" id="mail" name="mail" class="btn3" value="Send Email"/>
                </form>
            </div><!--end mbr1content-->
            <div style="height: 20px;">&nbsp;</div><!--spacer-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>