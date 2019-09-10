<?php

session_start();
if (isset($_GET['equipmentId'])) {
    $equipmentId = $_GET['equipmentId'];
}
require_once 'connectdb.php';
$equip = getSpecEquip ($dbconn, $equipmentId);

try {
    if (isset($_POST['update'])) {
        //set variables
        $equipName = mysqli_real_escape_string($dbconn, trim($_POST['equipName']));
        $equipType = $_POST['equipType'];
        $dueDateInterval = mysqli_real_escape_string($dbconn, trim($_POST['dueDateInterval']));

        $sqlUpdate = "UPDATE equipment SET equipName='$equipName', equipType='$equipType', dueDateInterval='$dueDateInterval' WHERE equipmentId='$equipmentId'";
        $dbconn->query($sqlUpdate);
        header("location: equipment.php");
    } elseif (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM equipment WHERE equipmentId='$equipmentId'";
        $dbconn->query($sqlDelete);
        header("location: equipment.php");
    } elseif (isset($_POST['cancel'])) {
        header("location: equipment.php");
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
    <title>M&S Engineering Edit Equipment</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php include_once "includes/inc.adminnav.php"; ?>
    <div id="mbodyright1">
        <div id="mbr1content">
            <h2>UPDATE THE EQUIPMENT</h2><br><br>
            <form action="" name="edit" id="edit" method="post">
                <table width="80%" border="0" align="center">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Equipment Type</th>
                        <th>Service/Exp Interval</th>
                    </tr>
                    <tr>
                        <td align="center" style="padding-right: 10px"><input type="text" name="equipName" id="equipName" value="<?php echo $equip['equipName']; ?>"/></td>
                        <td align="center" style="padding-right: 10px">
                            <select name="equipType" id="equipType">
                                <option value="<?php echo $equip['equipType']; ?>"><?php echo ucfirst($equip["equipType"]); ?></option>
                                <option value="electrical">Electrical</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                        <td align="center"><input type="text" name="dueDateInterval" id="dueDateInterval" value="<?php echo $equip['dueDateInterval']; ?>"/></td>
                    </tr>
                    <tr style="height:20px;"></tr>
                    <tr>
                        <td align="center"><input type="submit" name="update" id="update" class="btn2" value="Update"/></td>
                        <td align="center"><input type="submit" name="delete" id="delete" class="btn2" onclick="return confirm('Are you sure you want to delete this equipment from the list?');"
                                                              value="Delete"/></td>
                        <td align="center"><input type="submit" name="cancel" id="cancel" class="btn2" value="Cancel"/></td>
                    </tr>
                    <tr>

                    </tr>
                    <tr>

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