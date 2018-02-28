<?php
error_reporting(E_ALL);
    $errors = array();
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
    }
    $yesCode = checkResetCode ($dbconn, $code);
    $prId = $yesCode['pwdResetId'];
    $split = explode("-", $code);
    $userId = $split[1];
    $user = getUserwId ($dbconn, $userId);
    $userEmail = $user['userEmail'];
    if (empty($prId)) {
        echo "<script>
            var x;
            if (confirm('Your link has expired. Please get a new one.') == true) {
                window.location.href = 'reqPwd.php?userEmail=$userEmail'
            }
        </script>";
//        header("location:reqPwd.php?userEmail=$userEmail&expired");
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