<?php
error_reporting(E_ALL);
    session_start();
    $errors = array();
    if (isset($_GET['epsEquipId'])) {
        $epsEquipId = $_GET['epsEquipId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    require_once 'connectdb.php';
    $epsEq = getSpEpsEuip ($dbconn, $epsEquipId);
    $assoc = getAsc ($dbconn, $epsEq['userId']);
    $assocId = $assoc['userId'];
    $dateIssued = date('m/d/Y', strtotime($epsEq['dateIssued']));


try {
    if (isset($_POST['update'])) {
        //verify input
        if (empty($_POST['epsDesc'])) {
            $errors['epsDesc'] = "Please input a description/name.";
        }
        if(!$errors) {
            //set variables
            $epsDesc = mysqli_real_escape_string($dbconn, trim($_POST['epsDesc']));
            if (!empty($_POST['dateIssued'])) {
                $DI = new DateTime($_POST['dateIssued']);
                $dateIssued = $DI->format('Y-m-d');
            } else {
                $dateIssued = date('Y-m-d');
            }
            if ($_POST['serialNo'] == 'N/A') {
                $serialNo = '';
            } else {
                $serialNo = mysqli_real_escape_string($dbconn, trim($_POST['serialNo']));
            }
            $sqlUpdate = "UPDATE epsEquip SET epsDesc='$epsDesc', dateIssued='$dateIssued', serialNo=NULLIF('$serialNo', '') WHERE epsEquipId='$epsEquipId'";
            $dbconn->query($sqlUpdate);
            header("Location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");
        }
    }
    if (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM epsEquip WHERE epsEquipId='$epsEquipId'";
        $dbconn->query($sqlDelete);
        header("Location: adminassociate.php?assocId=$assocId&divisionId=$divisionId");
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
    <title>Edit EPS Equipment</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!--date picker-->
    <script type="" src="js/datepicker.js"></script>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php include_once "includes/inc.adminnav.php"; ?>

        <div id="mbodyright1" align="center">
            <div id="mbr1content">
                <h2 align="center">Update / Delete the Employee Safety Equipment (EPS) issued to <?php echo $assoc['firstName'] ." " .$assoc['lastName']; ?></h2>
                <div style="height: 40px;">&nbsp;</div><!--end spacer-->
                <form action="" method="post">
                    <table width="80%" border="0" align="center">
                        <tr>
                            <th>Equipment Description</th>
                            <th>Date Issued</th>
                            <th>Identification/Serial No</th>
                        </tr>
                        <tr>
                            <td><input type="text" id="epsDesc" name="epsDesc" class="modInput" value="<?php
                                if (!$errors) {
                                    echo $epsEq['epsDesc'];
                                } else {
                                    echo $_POST['epsDesc'];
                                } ?>"/>
                                <span class="error">
                                    <?php
                                    if ($_POST && isset($errors['epsDesc'])) {
                                        echo "<br/>" .$errors['epsDesc'];
                                    }
                                    ?>
                                </span>
                            </td>
                            <td><input type="text" id="dateIssued" name="dateIssued" class="pickDate modInput" placeholder="The default is today's date." value="<?php
                                if (!$errors) {
                                    echo $dateIssued;
                                } else {
                                    echo $_POST['dateIssued'];
                                } ?>"/>
                                <span class="error">
                                    <?php
                                    if ($_POST && isset($errors['dateIssued'])) {
                                        echo "<br/>" .$errors['dateIssued'];
                                    }
                                    ?>
                                </span>
                            </td>
                            <td>
                                <input type="text" id="serialNo" name="serialNo" value="<?php
                                if (!$errors) {
                                    echo (!empty($epsEq['serialNo'])?$epsEq['serialNo']:'N/A');
                                } else {
                                    echo $_POST['serialNo'];
                                } ?>"/>
                                <span class="error">
                                    <?php
                                    if ($_POST && isset($errors['serialNo'])) {
                                        echo "<br/>" .$errors['serialNo'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <div align="center" style="margin-top: 15px;">
                        <input type="submit" id="update" name="update" class="btn3" value="Update EPS"/>&nbsp;&nbsp;
                        <input type="submit" id="delete" name="delete" class="btn3" onclick="return confirm('Are you sure you want to delete this equipment from this associate?');" value="Delete Equipment"/>&nbsp;&nbsp;
                        <a href="adminassociate.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" class="btn3">Back</a>
                    </div><!--end div-->
                </form>
            </div><!--end mbr1content-->
        </div><!--end mbodyright-->


        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>