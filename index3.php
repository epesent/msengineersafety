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


<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M&S Safety Database</title>
    <link href="css/index3.css" rel="stylesheet" type="text/css">
    <script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>

</head>

<body>

<header>

    <!--HOME PAGE IMAGE AND LOGO-->
    <div id="pageImage">
        <img src="images/logo.png">
    </div>


<!--NAVIGATION AND TOP BANNER-->
<nav id="nav">

    <ul>
        <li><a href="login.php">Login</a> </li>
    </ul>

</nav>

</header>

<!--SAFETY MISISON STATEMENT-->
<div id="missionStatement">

    <div id="missionStatementText">

        <p><h2><i>SAFETY MISSION STATEMENT</i></h2></p>
    M&S Engineering is dedicated to protecting the safety and health of its employees. We have established a safety and health program to prevent injuries
    and illnesses due to hazards. Employee involvement at all levels of the company is critical for us to be successful in this effort and to create an effective safety culture.<br/><br/>
    Our goal is to promote a pro-active environment that will effectively identify and manage risk through <em>recognition, evaluation, and education.</em> We strive to remain in compliance
    with federal, state, and local safety and health regulations as well as the latest professional practices to ensure every worker goes home safely.<br/><br/>
        <b><i>Ken Means - Safety Manager</i></b>
    </div>
</div>

<!--SAFETY TIPS AND UPDATES-->
<div id="safetyTip">
    <p><h3>Safety Tips &amp; Updates</h3></p>
    <p class="safetyTipDisplay"><?php echo $safetyTip['tipContent'] ?></p>
</div>

<!--FOOTER-->
<div id="bottomBanner">
    <p><?php include_once "includes/inc.shlinks.php"; ?></p>
    <p>&copy;2015 - <strong>M & S Engineering</strong></p>
</div>


</body>
</html>
