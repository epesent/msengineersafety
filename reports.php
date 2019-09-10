<?php
    session_start();
    require_once 'connectdb.php';
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
        $sqlDivName = "SELECT divisionName FROM divisions WHERE divisionId='$divisionId'";
        $divName = $dbconn->query($sqlDivName);
        $divisionName = mysqli_fetch_assoc($divName);
    }
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
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
                <h2>UPLOADED REPORTS</h2>
                <form action="" method="post">
                    <select id="division" name="division">
                        <?php if (isset($_GET['divisionId'])) { //make sure division agrees with selection ?>
                            <option value="<?php echo $divisionId; ?>" selected="selected"><?php echo $divisionName['divisionName']; ?></option>
                        <?php } else { ?>
                            <option value="all">All Divisions</option>
                        <?php } ?>

                        <?php
                            foreach ($allDivisions as $rowDiv) {
                                echo "<option value='" .$rowDiv['divisionId'] ."'>" .$rowDiv['divisionName'] ."</option>";
                            }
                        ?>
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
                <h4><em>(Report names are labeled by "Division Name", "Report Abbreviation", and date/time uploaded.)</em></h4>
                <br/><br/>

                <?php
//Division is chosen (year is also chosen because of code)
                    if (isset($_GET['divisionId'])) {
                        $divisionId = $_GET['divisionId'];
                        if (isset($_GET['year'])) {
                            $year = $_GET['year'];
                        }
                        echo "<h2>Division Name: " .$divisionName['divisionName'] ."</h2>";
                        //get div reports by year
                        $sqldivReportsbyYear = "SELECT * FROM uploaded WHERE YEAR(uploadDate) = '$year' AND divisionId = '$divisionId' ORDER BY uploadDate ASC";
                        $divReportsbyYear = $dbconn->query($sqldivReportsbyYear);
                        //Separate and print reports by month
                        echo "<h3><b>January " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '01') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>February " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '02') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>March " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '03') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>April " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '04') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>May " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '05') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>June " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '06') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>July " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '07') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>August " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '08') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>September " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '09') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>October " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '10') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>November " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '11') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";
                        echo "<h3><b>December " .$year ."</b></h3><br/>";
                        foreach ($divReportsbyYear as $rowR) {
                            //explode name of file to extract the month
                            $m = explode('-', $rowR['uploadName']);
                            $month = $m[3];
                            if ($month == '12') {
                                echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                            }
                        } echo "<br/>";

//No Division set but year is set
                    } else {
                        if (isset($_GET['year'])) {
                            $year = $_GET['year'];
                            //Get all reports by year
                            $sqlreportsbyYear = "SELECT * FROM uploaded WHERE YEAR(uploadDate) = '$year' ORDER BY uploadDate ASC";
                            $reportsbyYear = $dbconn->query($sqlreportsbyYear);
                            //Separate and print reports by month
                            echo "<h3><b>January " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '01') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>February " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '02') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>March " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '03') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>April " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '04') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>May " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '05') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>June " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '06') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>July " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '07') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>August " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '08') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>September " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '09') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>October " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '10') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>November " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '11') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>December " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '12') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";


//No division or Year set - Default setting of page
                        } else {
                            $year = date('Y');
                            //Get all reports by year
                            $sqlreportsbyYear = "SELECT * FROM uploaded WHERE YEAR(uploadDate) = '$year' ORDER BY uploadDate ASC";
                            $reportsbyYear = $dbconn->query($sqlreportsbyYear);
                            //Separate and print reports by month
                            echo "<h3><b>January " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '01') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>February " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '02') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>March " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '03') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>April " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '04') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>May " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '05') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>June " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '06') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>July " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '07') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>August " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '08') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>September " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '09') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>October " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '10') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>November " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '11') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                            echo "<h3><b>December " .$year ."</b></h3><br/>";
                            foreach ($reportsbyYear as $rowR) {
                                //explode name of file to extract the month
                                $m = explode('-', $rowR['uploadName']);
                                $month = $m[3];
                                if ($month == '12') {
                                    echo "<a href='" .$rowR['link'] ."' class='wrapLink' target='_blank'>" .$rowR['uploadName'] ."</a><br/>";
                                }
                            } echo "<br/>";
                        }
                    }
                ?>
            </div><!--end mbr1content-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>