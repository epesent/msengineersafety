<?php

    session_start();
    if (isset($_GET['qualificationId'])) {
        $qualificationId = $_GET['qualificationId'];
    }
    require_once 'connectdb.php';
    $qual = getSpecQualification ($dbconn, $qualificationId);

try {
    if (isset($_POST['update'])) {
        //set variables
        $qualName = mysqli_real_escape_string($dbconn, trim($_POST['qualName']));
        $qualAbbreviation = mysqli_real_escape_string($dbconn, trim($_POST['qualAbbreviation']));
        $qualMethod = mysqli_real_escape_string($dbconn, trim($_POST['qualMethod']));
        $qualRequireInterval = mysqli_real_escape_string($dbconn, trim($_POST['qualRequireInterval']));

        $sqlUpdate = "UPDATE qualifications SET qualName='$qualName', qualAbbreviation='$qualAbbreviation', qualMethod='$qualMethod', qualRequireInterval='$qualRequireInterval'
                      WHERE qualificationId='$qualificationId'";
        $dbconn->query($sqlUpdate);

        header("location: qualifications.php");
    } elseif (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM qualifications WHERE qualificationId='$qualificationId'";
        $dbconn->query($sqlDelete);

        header("location: qualifications.php");
    } elseif (isset($_POST['cancel'])) {
        header("location: qualifications.php");
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
    <title>M&S Engineering Edit Qualification</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php include_once "includes/inc.adminnav.php"; ?>
    <div id="mbodyright1">
        <div id="mbr1content">
            <h2>UPDATE THE QUALIFICATION</h2><br><br>
            <form action="" name="edit" id="edit" method="post">
                <table width="80%" border="0" align="center">
                    <tr>
                        <th>Qualification Name</th>
                        <th>Abbrviation</th>
                        <th>Method</th>
                        <th>Renewal Interval Months</th>
                    </tr>
                    <tr>
                        <td align="center" style="padding-right: 10px"><input type="text" name="qualName" id="qualName" value="<?php echo $qual['qualName']; ?>"/></td>
                        <td align="center" style="padding-right: 10px"><input type="text" name="qualAbbreviation" id="qualAbbreviation" value="<?php echo $qual['qualAbbreviation']; ?>"/></td>
                        <td align="center" style="padding-right: 10px"><input type="text" name="qualMethod" id="qualMethod" value="<?php echo $qual['qualMethod']; ?>"/></td>
                        <td align="center"><input type="text" name="qualRequireInterval" id="qualRequireInterval" value="<?php echo $qual['qualRequireInterval']; ?>"/></td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <td align="center"><input type="submit" name="update" id="update" class="btn" value="Update"/></td>
                        <td align="center"><input type="submit" name="delete" id="delete" class="btn" onclick="return confirm('Are you sure you want to delete this qualification from the list?');"
                                   value="Delete"/></td>
                        <td align="center"><input type="submit" name="cancel" id="cancel" class="btn" value="Cancel"/></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div><!--end mbr1content-->
    </div><!--end mbodyright-->
    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
