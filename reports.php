<?php
    session_start();
    require_once 'connectdb.php';
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    } else {
        $year = date('Y');
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
        $sqlDivName = "SELECT divisionName FROM divisions WHERE divisionId='$divisionId'";
        $divName = $dbconn->query($sqlDivName);
        $divisionName = mysqli_fetch_assoc($divName);
        $jsaReports = getDivJsaReports ($dbconn, $divisionId, $year);
        $jsTaReports = getDivJsaTReports ($dbconn, $divisionId, $year);
    }

    $allDivisions = getDivisions ($dbconn);

try {
    if (isset($_POST['go'])) {
        $divisionId = $_POST['division'];
        $year = $_POST['year'];
        if ($divisionId == 'all') {
            header ("location: reports.php?year=$year");
        } else {
            header ("location: reports.php?divisionId=$divisionId&year=$year");
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
    <title>M&S Engineering Uploaded Reports</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php
        if ($_SESSION['permissionLevel'] =='mgr') {
            include_once 'includes/inc.divmgrnav.php';
        } else {
            include_once "includes/inc.adminnav.php";
        } ?>
        <div id="mbodyright1">
            <div id="mbr1content" align="center">
                <h2 style="margin-bottom: 20px;">UPLOADED REPORTS</h2>
                <form action="" method="post">
                    <select id="division" name="division">
                        <?php if ($_SESSION['permissionLevel'] == 'adm') {
                            if (isset($_GET['divisionId'])) { //make sure division agrees with selection ?>
                                <option value="<?php echo $divisionId; ?>" selected="selected"><?php echo $divisionName['divisionName']; ?></option>
                            <?php } else { ?>
                                <option value="all">Select Division</option>
                            <?php } ?>
                            <?php //options for selection
                                foreach ($allDivisions as $rowDiv) {
                                    echo "<option value='" .$rowDiv['divisionId'] ."'>" .$rowDiv['divisionName'] ."</option>";
                                }
                        } else { ?>
                            <option value="<?php echo $divisionId; ?>" selected="selected" disabled><?php echo $divisionName['divisionName']; ?></option>
                        <?php } ?>

                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <select id="year" name="year">
                        <?php if (isset($_GET['year'])) { //Make sure year agrees with selection ?>
                            <option value="<?php echo $_GET['year']; ?>" selected="selected"><?php echo $_GET['year']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                        <?php } ?>
                        <?php
                            $earliest = 2014;
                            foreach (range(date('Y'), $earliest) as $x) {
                                echo "<option value='" .$x ."'>".$x ."</option>";
                            }
                        ?>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" id="go" name="go" class="btn3" value="GO"/>
                </form><br/>
                <?php if (isset($_GET['divisionId'])) { ?>
                    <h2 style="margin: 20px 0 10px 0;">Job Safety Analysis Reports - <?php echo $year; ?></h2>
                    <?php foreach ($jsaReports as $jsa) {
                        $date = strtotime($jsa['jobDate']);
                        $jobDate = date("m/d/Y", $date);
                        $user = getAsc ($dbconn, $jsa['userId']);

                        echo "<a href='jsaReport.php?jsaId=" .$jsa['jsaId'] ."' target='_blank'>" .$jobDate ." - " .$user['firstName'] ." " .$user['lastName'] ." - " .$jsa['workLocation'] ."</a><br>";
                    } ?>

                    <h2 style="margin: 20px 0 10px 0;">Job Safety Task Analysis Reports - <?php echo $year; ?></h2>
                    <?php foreach ($jsTaReports as $jsTa) {
                        $date = strtotime($jsTa['jobDate']);
                        $jobDate = date("m/d/Y", $date);
                        $user = getAsc ($dbconn, $jsTa['userId']);

                        echo "<a href='jstaReport.php?jsaTaskId=" .$jsTa['jsaTaskId'] ."' target='_blank'>" .$jobDate ." - " .$user['firstName'] ." " .$user['lastName'] ." - " .$jsTa['customer'] ."</a><br>";
                    } ?>
                <?php } ?>
            </div><!--end mbr1content-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>