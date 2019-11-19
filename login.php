<?php
if (isset($_GET['logout'])) {
    session_destroy();
}

//start session
session_start();
require_once 'connectdb.php';
$safetyTip = getSafetyTip ($dbconn);

try {

    if (isset($_POST['submit'])) {
        //validate email input
        if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "*Please use a valid email.";
        } else { //Valid email is in the db
            $userEmail = mysqli_real_escape_string($dbconn, $_POST['userEmail']);
            $user = getUser($dbconn, $userEmail);
            if (!empty($user)) {
                //set the session variables.
                $_SESSION['userId'] = $user['userId'];
                $_SESSION['permissionLevel'] = $user['permissionLevel'];
                //1st login for user
                if ($_POST['userPassword'] == 'safety') {
                    if ($_POST['userPassword'] == $user['userPassword']) {
                        $userId = $user['userId'];
                        header("location: setPassword.php?userId=$userId");
                    } else {  //User logged in previously but using default password again
                        echo "<script>
                            var x;
                            if (confirm('Your entry does not match the number we have in our system. Please contact the office.') == true) {
//                                window.location.href = 'index.php'
                            }
                       </script>";
                    }
                } else {  //email correct; password incorrect
                    $userPassword = (trim($_POST['userPassword']));
                    if ($userPassword !== $user['userPassword']) {
                        echo "<script>
                            var x;
                            if (confirm('Your entry does not match the number we have in our system. Please contact the office.') == true) {
//                                window.location.href = 'index.php'
                            }
                       </script>";
                    } else { //email and password correct
                        $userId = $user['userId'];
                        $permissionLevel = $user['permissionLevel'];
                        if ($permissionLevel == 'adm') {
                            header("location: dashboardadmin.php");
                        } elseif ($permissionLevel == 'mgr') {
                            header("location: dashboarddivmgr.php?userId=$userId&permissionLevel=$permissionLevel");
                        } elseif ($permissionLevel == 'asc') {
                            header("location: associate.php?userId=$userId&permissionLevel=$permissionLevel");
                        }
                    }
                }
            } else { //Email not in the db
                $errors['email'] = 'Your email address is not in our system.  Please contact the office.';
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
    <title>MS Engineering Safety</title>
    <link rel="stylesheet" href="css/login.css" />

</head>
<body>
<div align="center">
    <div class="logo">
        <a href="http://www.msengr.com/" title="M & S Engineering" target="_blank"><img src="images/logo.png" alt="M&S Engineering"/></a>
    </div><!--end mbllogoI-->
    <br/><br/>
    <div>
        <form action="" method="post">
            <input type="text" id="userEmail" name="userEmail" placeholder="Email Address" required="required"/>
            <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span><br/><br/>
            <input type="text" id="userPassword" name="userPassword" placeholder="Password" required="required"/>
            <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['userPassword'])) {
                            echo $errors['userPassword'];
                        }
                        ?>
                    </span><br/><br/>
            <input type="submit" id="submit" name="submit" class="btn" value="Log In"/>
            <div style="height: 5px;">&nbsp;</div><!--end spacer-->
<!--            <a href="forgotPass.php" class="sub" style="font-style: italic; font-size: 10px;">Forgot Password?</a><br/>-->
        </form><br/>
        <a href="https://desk.zoho.com/portal/texasnetworkgroup" target="_blank"><span style="color: red">Click here to submit a help desk request.</span></a>

    </div><!--end mblcontentI-->
</div><!--end mbodyleftI-->
</body>