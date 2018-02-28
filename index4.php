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

<html>
<head>
    <title>M & S Engineering Safety and Compliance Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('images/Grande-Tyler.jpg');">

    <div class="wrapper row1">
        <header id="header" class="hoc clear">

            <div id="logo" align="center">
                <h1><a href="index.html"><img src="images/logo.png" width="100"> </a></h1>
            </div>

        </header>
    </div>

    <div id="pageintro" class="hoc clear">

        <article class="introtxt">
            <h2 class="heading">M&S Engineering</h2>
            <p>Safety and Compliance Database</p>
            <footer>
                <a class="btn inverse" href="login.php">Login</a>
                <a class="btn inverse" href="download.php">Download Forms</a>
            </footer>
        </article>
        <div class="clear"></div>
    </div>

</div>
<!-- End Top Background Image Wrapper -->

<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <div class="group center">
            <p><h2><i>SAFETY MISSION STATEMENT</i></h2></p>
            M&S Engineering is dedicated to protecting the safety and health of its employees. We have established a safety and health program to prevent injuries
            and illnesses due to hazards. Employee involvement at all levels of the company is critical for us to be successful in this effort and to create an effective safety culture.<br/><br/>
            Our goal is to promote a pro-active environment that will effectively identify and manage risk through <em>recognition, evaluation, and education.</em> We strive to remain in compliance
            with federal, state, and local safety and health regulations as well as the latest professional practices to ensure every worker goes home safely.<br/><br/>
            <b><i>Ken Means - Safety Manager</i></b>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<div class="wrapper bgded overlay coloured" style="background-image:url('images/Salado-Hutto.jpg');">
    <div class="hoc container clear">
        <article id="safetytip" class="center">
            <p><b><h2><u>Safety Tips of the Day</u></h2></b></p>
            <p><?php echo $safetyTip['tipContent'] ?></p>
        </article>
        <p></p>
    </div>

</div>

<div class="wrapper row4">
    <footer id="footer safetylinks" class="hoc clear">
        <div class="one_seventh"><a href="http://www.osha.gov/" id="footer contact" target="_blank" ">OSHA</a></div>
        <div class="one_seventh"><a href="http://www.msha.gov/" id="footer contact"  target="_blank">MSHA</a></div>
        <div class="one_seventh"><a href="http://www.dot.gov/" id="footer contact"  target="_blank">U.S.DOT</a></div>
        <div class="one_seventh"><a href="http://www.cdc.gov/niosh/homepage.html" id="footer contact"  target="_blank">NIOSH</a></div>
        <div class="one_seventh"><a href="http://www.epa.gov/" id="footer contact"  target="_blank">EPA</a></div>
        <div class="one_seventh"><a href="http://www.nsc.org/" id="footer contact"  target="_blank">N.S.C.</a></div>
        <div class="one_seventh"><a href="https://search.osha.gov/search?affiliate=usdoloshapublicwebsite&query=hazcom" id="footer contact"  target="_blank">HAZCOM</a></div>
    </footer>
</div>

<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">M&S Engineering</a></p>
        <p class="fl_right">Designed by <a target="_blank" href="http://www.rswebdata.com/" title="Designed by RS WebData">RS WebData</a></p>
    </div>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>