<?php
 session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MS Engineering Safety</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <div id="mbodyleftI">
            <div id="mbllogoI">
                &nbsp;
            </div><!--end mbllogoI-->
            <?php if (isset($_SESSION['userId'])) { ?>
                <div id="mblcontentI">&nbsp;</div>
            <?php } else { ?>
            <div id="mblcontentI">
                <form action="" method="post">
                    <input type="text" id="userEmail" name="userEmail" placeholder="Email Address" required="required"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span><br/>
                    <input type="password" id="userPass" name="userPass" placeholder="Password" required="required"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['userPass'])) {
                            echo $errors['userPass'];
                        }
                        ?>
                    </span><br/>
                    <input type="submit" id="submit" name="submit" class="btn" value="Log In"/>
                </form><br/>
            </div><!--end mblcontentI-->
            <?php } ?>
        </div><!--end mbodyleftI-->
        <div id="mbodyright1" align="center">
            <div id="mbr1content">
                <h1>Forms</h1><br/>
                <h4>Click on the form that you need.</h4><br/><br/>
                <a href="forms/JSA.pdf" class="wrapLink" target="_blank" title="JSA Form">JSA Form</a><br/><br/>
                <a href="forms/Roster.pdf" class="wrapLink" target="_blank" title="Roster Form">Roster Form</a><br/><br/>
                <a href="forms/VehicleReport.pdf" class="wrapLink" target="_blank" title="Vehicle Report Form">Vehicle Report Form</a><br/><br/>
                <?php if (isset($_SESSION['permissionLevel'])) {
                    if ($_SESSION['permissionLevel'] == 'adm') {
                        echo "<a href='dashboardadmin.php' class='btn2'>Go Back</a>";
                    } elseif ($_SESSION['permissionLevel'] == 'mgr') {
                        echo "<a href='dashboarddivmgr.php' class='btn2'>Go Back</a>";
                    } else {
                        echo "<a href='associate.php' class='btn2'>Go Back</a>";
                    }
                } else {
                    echo "<a href='index.php' class='btn2'>Go Back</a>";
                }
                ?>
            </div><!--end mbr1content-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>