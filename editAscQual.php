<?php
error_reporting(E_ALL);
    session_start();
    if (isset($_GET['recordQualId'])) {
        $recordQualId = $_GET['recordQualId'];
    }
    require_once 'connectdb.php';
    $ascQualification = getSpecAscQual ($dbconn, $recordQualId);
    $qDate = date('m/d/Y', strtotime($ascQualification['qualDate']));
    $qualRequireInterval = $ascQualification['qualRequireInterval'];
    $interval = "+" .$qualRequireInterval ."months";
    $assocId = $ascQualification['userId'];
    $divisionId = $ascQualification['divisionId'];

try {
    if (isset($_POST['update'])) {
        //set variables
        $pqdate = new DateTime($_POST['qualDate']);
        $qualDate = $pqdate->format('Y-m-d');
        $dDate = strtotime(date('Y-m-d', strtotime($qualDate)) .$interval);
        $dueDate = date('Y-m-d', $dDate);

        $sqlUpdate = "UPDATE qualRecord SET qualDate='$qualDate', dueDate='$dueDate', dateModified=CURDATE() WHERE recordQualId = '$recordQualId'";
        $dbconn->query($sqlUpdate);
        header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");
    } elseif (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM qualRecord WHERE recordQualId='$recordQualId'";
        $dbconn->query($sqlDelete);
        header("location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");
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
    <title>M&S Engineering Associate</title>
    <link rel="stylesheet" href="css/main.css" />
    <!--Script for jquery ui-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="" src="js/datepicker.js"></script>
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php include_once "includes/inc.adminnav.php"; ?>
    <div id="mbodyright1" align="center">
        <div id="mbr1content">
            <h2>Update the <?php echo $ascQualification['qualName']; ?> Qualification Date for <?php echo $ascQualification['firstName'] ." " .$ascQualification['lastName']; ?></h2><br>
            <form action="" method="post">
                <table width="80%" border="0">
                    <tr>
                        <th>Qualification</th>
                        <th>Abbreviation</th>
                        <th>Method</th>
                        <th>Pick New<br/>Date</th>
                    </tr>
                    <tr>
                        <td align="center"><?php echo $ascQualification['qualName']; ?></td>
                        <td align="center"><?php echo $ascQualification['qualAbbreviation']; ?></td>
                        <td align="center"><?php echo $ascQualification['qualMethod']; ?></td>
                        <td align="center"><input type="text" id="qualDate" name="qualDate" class="pickDate" value="Previous Date: <?php echo $qDate; ?>"/></td>
                    </tr>
                </table><br/>
                <input type="submit" id="update" name="update" class="btn3" value="Update Date"/> &nbsp;&nbsp;
                <input type="submit" id="delete" name="delete" class="btn3" onclick="confirm('Are you sure you want to delete this quailification for this associate?')" value="Delete Qualification"/>&nbsp;&nbsp;
<!--                <button class="btn3" onclick="history.go(-1);">Back </button>-->
                <a href="adminassociate.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" class="btn3">Back</a>

            </form>
        </div><!--end mbr1content-->
    </div><!--end mbodyright1-->
    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
