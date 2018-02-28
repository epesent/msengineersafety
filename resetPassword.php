<?php
session_start();
require_once 'connectdb.php';

$sqlDelete = "DELETE FROM pwdReset WHERE created < NOW() - interval 2 HOUR ";
$dbconn->query($sqlDelete);

require_once 'scripts/resetPasswordsc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MS Engineering Safety Reset Password</title>
    <link rel="stylesheet" href="css/main.css" />

</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <div id="mbodyleft">
        <div id="mbllogo">
            <a href="http://www.msengr.com/" title="M & S Engineering" target="_blank"><img src="images/logo.png" alt="M&S Engineering"/></a>
        </div><!--end mbllogo-->
        <div id="mblcontent">
            <ul>
                <li><a href="download.php" class="sidebar" title="Download Forms">Download Forms</a></li>
            </ul>
        </div><!--end mblcontent-->
    </div><!--end mbodyleft-->
    <div id="mbodyright1">
        <div id="mbr1content">
            <h2 align="center">Please enter a new password.</h2>
            <h4 align="center"><em>(Minimum 8 characters with at least one upper and lower case letter, one number, and one special character.)</em></h4><br/>
            <div style="width: 30%; margin: 0 auto 0 auto;">
                <form action="" method="post" id="resetForm" name="resetForm">
                    <input type="password" name="userPassword" id="userPassword" placeholder="New Password"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['userPassword'])) {
                            echo $errors['userPassword'];
                        }
                        ?>
                    </span><br/><br/>
                    <input type="password" name="pwd2" id="pwd2" placeholder="Confirm Password"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['pwdMatch'])) {
                            echo $errors['pwdMatch'];
                        }
                        ?>
                    </span><br/><br/>
                    <input type="submit" id="reset" name="reset" class="btn" value="Reset Password"/>
                </form>
            </div><!--sizing div-->
        </div><!--end mbr1content-->
    </div><!--end mbodyright1-->
    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>