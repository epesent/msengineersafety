<?php

    session_start();
    require_once 'connectdb.php';
    $errors = array();
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    }

try {
    if (isset($_POST['reset'])) {
        //password strength validation
        $tpw = trim($_POST['userPassword']); //eliminate accidental space
        if (empty($tpw)) {
            $errors['userPassword'] = 'Please create a password';
        } else {
            if (!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['userPassword'])) {
                $errors['userPassword'] = 'Must contain upper and lower case letter, numbers, and special characters.';
            }
        }

        if ($_POST['pwd2'] !== $_POST['userPassword']) {
            $errors['pwdMatch'] = "Passwords do not match";
        }
        if (!$errors) {
            $pwd = md5($_POST['userPassword']);

            $sqlUpdate = "UPDATE users SET userPassword = '$pwd' WHERE userId = '$userId'";
            $dbconn->query($sqlUpdate);
            $result = mysqli_query($dbconn, "SELECT * FROM users WHERE userId='$userId'");
            $user = mysqli_fetch_assoc($result);

            $_SESSION['userId'] = $user['userId'];
            $_SESSION['permissionLevel'] = $user['permissionLevel'];

            $permissionLevel = $user['permissionLevel'];
            if ($permissionLevel == 'adm') {
                header("location: dashboardadmin.php");
            } elseif ($permissionLevel == 'mgr') {
                header("location: dashboarddivmgr.php");
            } elseif ($permissionLevel == 'asc') {
                header("location: associate.php");
            }
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
                <h2 align="center">Please set a new password</h2>
                <div style="width: 50%; margin: 30px auto 0 auto;">
                    <form action="" method="post">
                        <input type="password" id="userPassword" name="userPassword" placeholder="Input New Password"/>
                        <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['userPassword'])) {
                            echo $errors['userPassword'];
                        }
                        ?>
                    </span><br/>
                        <input type="password" id="pwd2" name="pwd2" placeholder="Confirm Password"/>
                        <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['pwdMatch'])) {
                            echo $errors['pwdMatch'];
                        }
                        ?>
                    </span><br/><br/>
                        <input type="submit" id="reset" name="reset" class="btn" value="Set Password"/>
                    </form>
                </div><!--centering div-->
            </div><!--mbr1content-->
        </div><!--end mbodyright1-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
