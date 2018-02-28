<?php
error_reporting(E_ALL);
    session_start();
    if (isset($_GET['equipRecordId'])) {
        $equipRecordId = $_GET['equipRecordId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    require_once 'connectdb.php';
    $specEquip = getSpecAscEquip ($dbconn, $equipRecordId);
    $assoc = getAsc ($dbconn, $specEquip['userId']);
    $assocId = $assoc['userId'];
    $iDate = date('m/d/Y', strtotime($specEquip['issueDate']));
    $eDate = date('m/d/Y', strtotime($specEquip['expDate']));

try {
    if (isset($_POST['update'])) {
        //set variables
        $ED = new DateTime($_POST['expDate']);
        $expDate = $ED->format('Y-m-d');

        $sqlUpdate = "UPDATE equipRecord SET issueDate=CURDATE(), expDate='$expDate', modifiedDate=CURDATE() WHERE equipRecordId='$equipRecordId'";
        $dbconn->query($sqlUpdate);
        header("location:adminassociate.php?assocId=$assocId&divisionId=$divisionId");
    } elseif (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM equipRecord WHERE equipRecordId='$equipRecordId'";
        $dbconn->query($sqlDelete);
        header("location:adminassociate.php?assocId=$assocId&divisionId=$divisionId");
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
                <h2 align="center">Update the Service/Expiration Date of the <?php echo $specEquip['equipName']; ?> issued to <?php echo $assoc['firstName'] ." " .$assoc['lastName']; ?></h2><br/>
                <form action="" method="post">
                    <table width="80%" border="0" align="center">
                        <tr>
                            <th>Serial Number</th>
                            <th>Date<br/>Issue/Renew</th>
                            <th>New<br/>Service/Expiration<br/>Date</th>
                        </tr>
                        <tr>
                            <td align="center"><?php echo $specEquip['serialNumber']; ?></td>
                            <td align="center"><?php echo $iDate; ?></td>
                            <td align="center"><input type="text" id="expDate" name="expDate" class="pickDate" value="Previous Date: <?php echo $eDate; ?>"/></td>
                        </tr>
                    </table><br/>
                    <div align="center">
                        <input type="submit" id="update" name="update" class="btn3" value="Update Date"/> &nbsp;&nbsp;
                        <input type="submit" id="delete" name="delete" class="btn3" onclick="return confirm('Are you sure you want to delete this equipment from this associate?');" value="Delete Equipment"/>&nbsp;&nbsp;
<!--                        <button class="btn3" onclick="javascript:history.go(-1);">Back </button>-->
                        <a href="adminassociate.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" class="btn3">Back</a>
                    </div><!--centering div-->
                </form>
            </div><!--end mbr1content-->
        </div><!--end mbodyright1-->

        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
