<?php

    session_start();
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }

    require_once 'connectdb.php';
    require_once 'scripts/admindivisionsc.php';
    $division = getDivisonSingle ($dbconn, $divisionId);
    $assoc = getAssocbyDivision ($dbconn, $divisionId);
    $countA = mysqli_num_rows($assoc);
    $subcontractors = getSubbyDivision ($dbconn, $divisionId);
    $allSubs = getSubs ($dbconn);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Associate</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
    <!--Script for jquery ui for the dialog box-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--    Modal Scripts-->
    <script type="text/javascript">
        $(function() {
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 400,
                width: 350,
                modal: true
            });

            $("#editDivision").click(function() {
                $("#dialog-form").dialog("open");
            });
        });
    </script>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php include_once "includes/inc.adminnav.php"; ?>

        <div id="mbodyright1">
            <div id="mbr1content">
                <h3>Division Name: <?php echo $division['divisionName'] ;?><br/>
                    Division Description: <?php echo $division['description'];?><br/>
                    Division Manager:
                    <?php
                    if (empty($division['firstName'])) {
                        echo 'Brian Meuth';
                    } else {
                        echo $division['firstName'] . " " . $division['lastName'];
                    } ?></h3><br/>
                <button id="editDivision" class="btn3">EDIT</button>
                <p>&nbsp;</p>
                <h3>Current Associates</h3><br/><br/>
                    <table width="100%" border="0"><tr>
                    <?php
                    //assocId = associate userId.  Name change to avoid confusion with admin userId
                        $count = 0;
                        $max = 3;
                        while ($row = $assoc->fetch_assoc()) {
                            $count++; ?>
                            <td><a href="adminassociate.php?assocId=<?php echo $row['userId']; ?>&divisionId=<?php echo $divisionId; ?>" class="wrapLink"><?php echo $row['firstName'] ." " .$row['lastName']; ?></a></td>
                    <?php
                            if($count >= $max){
                                //reset counter
                                $count = 0;
                                //end and restart
                                echo '</tr><tr>';
                            }
                        }
                    ?>
                    </tr></table>
                <p>&nbsp;</p>
                <h3>Add Associate</h3>
                <form action="" id="addASC" name="addASC" method="post">
                    <input type="text" id="firstName" name="firstName" class="inputwidth" placeholder="First Name" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['firstName'])) {
                            echo $errors['firstName'];
                        }
                        ?>
                    </span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="lastName" name="lastName" class="inputwidth" placeholder="Last Name" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['lastName'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['lastName'])) {
                            echo $errors['lastName'];
                        }
                        ?>
                    </span><br/>
                    <input type="text" id="userEmail" name="userEmail" class="inputwidth" placeholder="Email Address" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['userEmail'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['userEmail'])) {
                            echo $errors['userEmail'];
                        }
                        ?>
                    </span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="last4ssn" name="last4ssn" class="inputwidth" maxlength="4" placeholder="Last 4 of SSN#" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['last4ssn'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error" style="font-size: 10px; font-style: italic;">
                        <?php
                        if ($_POST && isset($errors['ssn'])) {
                            echo $errors['ssn'];
                        }
                        ?>
                    </span><br/><br/>
                    <input type="submit" id="addasc" name="addasc" class="btn3" value="Add Associate"/><br/>
                    <h4><em>The associate's default password will be 'safety' (case sensitive)</em></h4>
                </form><br/><br/>
                <h3>Current Assigned Sub-Contractors</h3><br/>
                <?php
                    foreach ($subcontractors as $rowSC) {
                        echo "<a href=subContractorInfo.php?subcontractorId=" .$rowSC['subcontractorId'] ." class='wraplink'>"
                            .$rowSC['subName'] ."</a>&nbsp;&nbsp;<a href='removesub.php?subcontractorId=" .$rowSC['subcontractorId']
                            ."&divisionId=" .$divisionId ."' class='sub' onclick=\"return confirm('Are you sure you want to delete this equipment from the list?');\">REMOVE</a><br/>";
                    }
                ?><br/>
                <h3>Assign Sub-Contractor</h3><br/>
                <form action="" id="addSC" name="addSC" method="post">
                    <select id="subcontractorId" name="subcontractorId">
                        <option value="">Please select an existing Sub-Contractor</option>
                        <?php
                            foreach ($allSubs AS $rowAll) {
                                echo "<option value='" .$rowAll['subcontractorId'] ."'>" .$rowAll['subName'] ."</option>";
                            }
                        ?>
                    </select>&nbsp;&nbsp;&nbsp;
                    <input type="submit" id="addsub" name="addsub" class="btn3" value="Assign Sub"/>
                </form>
                <h4><em>Enter new sub-contractors <a href="subContractors.php" class="wrapLink">HERE</a></em></h4>
            </div><!--end mbr1content-->
            <div style="height: 20px;">&nbsp;</div><!--spacer-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
    <div id="dialog-form" title="EDIT DIVISION">
        <br/>
        <form action="editDivision.php?divisionId=<?php echo $divisionId; ?>" id="editdiv" name="editdiv" method="post">
            <label for="divName">Division Name:</label><br/>
            <input type="text" id="divisionName" name="divisionName" class="modInput" value="<?php echo $division['divisionName']; ?>"/><br/><br/>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" class="modInput" value="<?php echo $division['description'] ?>"/><br/><br/>
            <label for="divisionHeadId">Division Head:</label><br/>
            <?php if ($countA == 0) {
                echo "<span class=\"error\" style=\"font-size: 10px; font-style: italic;\">There are no associates assigned to this division.  The division head must be assigned to this division.  Please add an 
                    associate first.</span><br/><br/>";
            } else {?>
                <select name="divisionHeadId">
                    <option value="<?php echo $division['divisionHeadId']; ?>" selected="selected"><?php echo $division['firstName'] ." " .$division['lastName']; ?></option>
                    <?php
                        foreach ($assoc as $rowA) {
                            echo "<option value='" .$rowA['userId'] ."'>" .$rowA['firstName'] ." " .$rowA['lastName'] ."</option>";
                        }
                    ?>
                </select><br/><br/>
            <?php } ?>
            <input type="submit" id="editDiv" name="editDiv" class="btn" value="Edit Division" />
        </form>
    </div><!--end dialog-form-->
</body>
</html>