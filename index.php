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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MS Engineering Safety</title>
    <link rel="stylesheet" href="css/index.css" />

</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <div id="mbodyleftI">
            <div id="mbllogoI">
                <a href="http://www.msengr.com/" title="M & S Engineering" target="_blank"><img src="images/logo.png" alt="M&S Engineering"/></a>
            </div><!--end mbllogoI-->
            <div id="mblcontentI">
                <form action="" method="post">
                    <input type="text" id="userEmail" name="userEmail" placeholder="Email Address" required="required"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span><br/>
                    <input type="password" id="userPassword" name="userPassword" placeholder="Password" required="required"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['userPassword'])) {
                            echo $errors['userPassword'];
                        }
                        ?>
                    </span><br/>
                    <input type="submit" id="submit" name="submit" class="btn" value="Log In"/>
                    <div style="height: 5px;">&nbsp;</div><!--end spacer-->
                    <a href="forgotPass.php" class="sub" style="font-style: italic; font-size: 10px;">Forgot Password?</a><br/>
                </form><br/>

                <ul>
                    <li><a href="download.php" class="sidebar" title="Download Forms">Download Forms</a></li>
                </ul>
                <div id="mblPicI"><img src="images/SafetyEverybody.png" alt="M&S Engineering"/></div><!--end mblPicI-->
            </div><!--end mblcontentI-->
        </div><!--end mbodyleftI-->

<!--MISSION STATEMENT ON THE TOP MIDDLE-->
        <div id="mbodycenter">
            <div id="mbc1content">
                <div style="height: 100px;"></div><!--spacer-->
                <h1 align="center">SAFETY MISSION STATEMENT</h1><br/>
                <h3 align="justify">M&S Engineering is dedicated to protecting the safety and health of its employees. We have established a safety and health program to prevent injuries
                   and illnesses due to hazards. Employee involvement at all levels of the company is critical for us to be successful in this effort and to create an effective safety culture.<br/><br/>
                   Our goal is to promote a pro-active environment that will effectively identify and manage risk through <em>recognition, evaluation, and education.</em> We strive to remain in compliance
                   with federal, state, and local safety and health regulations as well as the latest professional practices to ensure every worker goes home safely.<br/><br/>
                   <b>Ken Means - Safety Manager</b>
                </h3>

                <div id="spacer1" style="height: 80px;"></div><!--spacer-->

            </div><!--end mbc1content-->

        </div><!--end mbodycenter-->

<!--STAR LOGO AND IMAGES ON THE RIGHT SIDE-->
        <div id="mbodyright2">
            <div id="mbr2logo">
                <a href="http://www.msengr.com/" title="M & S Engineering" target="_blank"><img src="images/logo.png" alt="M&S Engineering"/></a>
            </div><!--end mbr2logo-->
            <div style="height: 100px;"></div><!--spacer-->
            <div id="mbr2Pics"><img src="images/substation.png" alt="M&S Engineering"/></div><!--end mbr2Pics-->
            <div id="mbr2Pics"><img src="images/Bandera-Substation.jpg" alt="M&S Engineering"/></div><!--end mbr2Pics-->

            <div id="spacer1" style="height: 80px;"></div><!--spacer-->
        </div><!--end mbodyright2-->

<!--SAFETY MESSAGE TEXT BOX AND IMAGES-->
        <div style=clear:both;>
            <div id="mbcST">
                <div id="mbcSTPicL">
                    <div id="mbcSTImages"><img src="images/safetyfirst.png"/></div><!--end mbcSTImages-->
                </div><!--end mbcSTPicL-->
                <div id="mbcSTTitle"><h1 align="center">SAFETY TOPIC OF THE WEEK</h1></div><!--end mbcSTTitle-->
                <div id="mbcSTPicL">
                    <div id="mbcSTImages"><img src="images/safetyfirst.png"/><p></p></div><!--end mbcSTImages-->
                </div><!--end mbcSTPicL-->
                <h4 style="clear:both;" align="center">
                    <?php echo $safetyTip['tipContent'] ?>
                </h4>
            </div><!--end mbcST-->
        </div>

        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>