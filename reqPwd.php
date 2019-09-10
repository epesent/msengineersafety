<?php

    session_start();
    require_once 'connectdb.php';
    if (isset($_GET['userEmail'])) {
        $userEmail = $_GET['userEmail'];
    }
    if (isset($_GET['expired'])) {
        echo "<script>alert('The link has expired please resubmit form for a new link.')</script>";
    }
try {
    $user = getUser($dbconn, $userEmail);
    if (isset($_POST['submit'])) {
        $code = rand() ."-" .$user['userId'];
        $sqlInsert = "INSERT INTO pwdReset (code) VALUE ('$code')";
        $dbconn->query($sqlInsert);

        $to = $userEmail;
        $subject = "M&S Engineering Safety";
        $message =
            "Please go to http://rswebdata.com/msengrsafety/resetPassword.php?code=" .$code ." to reset your password.  This link will only be active for 2 hours.";
        $headers = "From: saftey@msengr.com \r\n";

        if (mail($to,$subject,$message,$headers)) { ?>
            <script type="text/javascript">
                alert('The link has been sent.  It will be valid for two hours only.');
                window.location.href = "index.php";
            </script>
            <?php
        } else { ?>
            <script type="text/javascript">
                alert('We were not able to send a link.  Please contact our office.');
                window.location.href = "index.php";
            </script>
            <?php
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
    <title>MS Engineering Safety Reset Password</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
    <style type="text/css">
        #logOut {
            display: none;
        }
    </style>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <div id="mbodyleft" class="bg-dark text-light">
            <div id="mblcontent">
                <ul>
                    <li><a href="download.php" class="sidebar" title="Download Forms">Download Forms</a></li>
                </ul>
            </div><!--end mblcontent-->
        </div><!--end mbodyleft-->
        <div id="mbodyright1">
            <div id="mbr1content">
                <h2 align="center">Reset Your Password</h2><br/>
                <h3 align="center">A link will be sent to <?php echo $userEmail; ?>.<br/> Please click on the link and reset your password.  The link will only be valid for 2 hours.</h3><br/><br/>
                <form action="" method="post" style="width: 50%; margin: 0 auto 0 auto;">
                    <input type="submit" id="submit" name="submit" class="btn" value="Submit"/><br/>
                    <input type="button" id="cancel" name="cancel" class="btn" value="Cancel" onclick="window.history.go(-1); return false;"/>
                </form>
            </div><!--end mbr1content-->
        </div><!--end mbodyright1-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
