<?php
error_reporting(E_ALL);
session_start();
    $errors = array();
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    require_once 'connectdb.php';
    $assoc = getAsc ($dbconn, $assocId);
    $div = getDivisonSingle ($dbconn, $divisionId);
    $divisions = getDivisions ($dbconn);

try {
    if (isset($_POST['update'])) {
        //validate variables
        //Validate inputs
        $fn = trim($_POST['firstName']); //eliminate accidental space
        if (empty($fn)) {
            $errors['firstName'] = 'Please enter your first name.';
        } else {
            if (!preg_match("/^([a-zA-Z]+[\'-]?[a-zA-Z]+[ ]?)+$/", $_POST['firstName'])) {
                $errors['firstName'] = 'Please use correct characters.';
            }
        }
        $ln = trim($_POST['lastName']); //eliminate accidental space
        if (empty($ln)) {
            $errors['lastName'] = 'Please enter your last name.';
        } else {
            if (!preg_match("/^[a-z0-9\040\.\-]+$/i", $_POST['lastName'])) {
                $errors['lastName'] = 'Please use correct characters.';
            }
        }
        $tssn = trim($_POST['last4SSN']);
        if (empty($tssn)) {
            $errors['ssn'] = 'Please enter the last 4 digits of associate ssn#.';
        } else {
            if (!preg_match("/^[0-9]*$/", $_POST['last4SSN'])) {
                $errors['ssn'] = 'Please use numbers only.';
            }
        }
        if (!$errors) {
            //set variables
            $firstName = mysqli_real_escape_string($dbconn, trim($_POST['firstName']));
            $lastName = mysqli_real_escape_string($dbconn, trim($_POST['lastName']));
            $last4SSN = mysqli_real_escape_string($dbconn, trim($_POST['last4SSN']));
            $newDiv = $_POST['divisionId'];

            $sqlUpdate = "UPDATE contacts SET firstName='$firstName', lastName='$lastName', divisionId='$newDiv', last4SSN='$last4SSN'
                          WHERE userId='$assocId'";
            $dbconn->query($sqlUpdate);
            header("Location: adminassociate.php?assocId=$assocId&divisionId=$newDiv");
        }
    }
    if (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM notes WHERE userId='$assocId'";
        $dbconn->query($sqlDelete);
        $sqlDelete = "DELETE FROM qualRecord WHERE userId='$assocId'";
        $dbconn->query($sqlDelete);
        $sqlDelete = "DELETE FROM equipRecord WHERE userId='$assocId'";
        $dbconn->query($sqlDelete);
        $sqlDelete = "DELETE FROM contacts WHERE userId='$assocId'";
        $dbconn->query($sqlDelete);
        header("Location: admindivision.php?divisionId=$divisionId");
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
    <title>M&S Engineering Edit Associate</title>
    <link rel="stylesheet" href="css/main.css" />
    <!--Script for jquery ui-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="" src="js/datepicker.js"></script>
    <style type="text/css">
        select {
            width: 60%;
        }
    </style>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php include_once "includes/inc.adminnav.php"; ?>
        <div id="mbodyright1" align="center">
            <div id="mbr1content">
                <h2>Edit / Delete the Associate</h2>
                <form action="" method="post">
                    <table width="80%" border="0">
                        <tr align="center">
                            <th>First Name:</th>
                            <th>Last Name:</th>
                            <th>Id #:</th>
                            <th>Assigned Division:</th>
                        </tr>
                        <tr align="center">
                            <td><input type="text" id="firstName" name="firstName" class="modInput" value="<?php if ($_POST && $errors) {
                                    echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');} else { echo $assoc['firstName'];} ?>"/>
                                <span class="error" style="font-size: 10px; font-style: italic;">
                                    <?php
                                    if ($_POST && isset($errors['firstName'])) {
                                        echo "<br/>" .$errors['firstName'];
                                    } ?>
                                </span>
                            </td>
                            <td><input type="text" id="lastName" name="lastName" class="modInput" value="<?php if ($_POST && $errors) {
                                    echo htmlentities($_POST['lastName'], ENT_COMPAT, 'UTF-8');} else { echo $assoc['lastName'];} ?>"/>
                                <span class="error" style="font-size: 10px; font-style: italic;">
                                    <?php
                                    if ($_POST && isset($errors['lastName'])) {
                                        echo "<br/>" .$errors['lastName'];
                                    } ?>
                                </span>
                            </td>
                            <td><input type="text" id="last4SSN" name="last4SSN" class="modInput" value="<?php if ($_POST && $errors) {
                                    echo htmlentities($_POST['last4SSN'], ENT_COMPAT, 'UTF-8');} else { echo $assoc['last4SSN'];} ?>"/>
                                <span class="error" style="font-size: 10px; font-style: italic;">
                                    <?php
                                    if ($_POST && isset($errors['ssn'])) {
                                        echo "<br/>" .$errors['ssn'];
                                    } ?>
                                </span>
                            </td>
                            <td>
                                <select name="divisionId" id="divisionId">
                                    <option value="<?php echo $div['divisionId'] ?>"><?php echo $div['divisionName']; ?></option>
                                    <?php
                                    foreach ($divisions AS $row) { ?>
                                        <option value="<?php echo $row['divisionId']; ?>"><?php echo $row['divisionName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr align="center">
                            <td><input type="submit" id="update" name="update" class="btn4" value="Update Associate"/></td>
                            <td><input type="submit" id="delete" name="delete" class="btn4" onclick="confirm('Are you sure you want to delete this associate?')" value="Delete Associate"/></td>
                            <td><a href="adminassociate.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" class="btn2">Back</a></td>
                        </tr>
                    </table>
                </form>
            </div><!--end mbr1content-->
        </div><!--en mbodyright1-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
