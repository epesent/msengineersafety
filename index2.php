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
                            if (confirm('Your password does not match would you like to reset it.') == true) {
                                window.location.href = 'reqPwd.php?userEmail=$userEmail'
                            }
                       </script>";
                    }
                } else {  //email correct; password incorrect
                    $userPassword = md5(trim($_POST['userPassword']));
                    if ($userPassword !== $user['userPassword']) {
                        echo "<script>
                            var x;
                            if (confirm('Your password does not match would you like to reset it.') == true) {
                                window.location.href = 'reqPwd.php?userEmail=$userEmail'
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Robert Armstrong - RSWebData.com">
    <title>MS Engineering Safety</title>
    <link rel="stylesheet" href="css/newindex.css" />
</head>
    <body>

    <div id="topbanner"></div>
    Top Banner
    <div id="topimage"></div>
    Top Image
    <div id="safetymission"></div>
    Safety Mission Statement
    <div id="safetytip"></div>
    Safety Tip
    <div id="bottombanner"></div>
    Bottom Banner




    </body>
</html>

