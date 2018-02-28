<?php
error_reporting(E_ALL);
    session_start();
    require_once 'connectdb.php';
    $equipment = getAllEquip ($dbconn);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Associate</title>
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
                width: 450,
                modal: true
            });

            $("#addEquipment").click(function() {
                $("#dialog-form").dialog("open");
            });
        });
    </script>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php include_once "includes/inc.adminnav.php"; ?>
        <div id="mbodyright1" align="center">
            <div id="mbr1content">
                <h2>Current Equipment List</h2><br/>
                <table width="70%" border="0">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Equipment Type</th>
                        <th>Service/Exp Interval</th>
                        <th></th>
                    </tr>
                    <?php foreach ($equipment as $row) { ?>
                        <tr>
                            <td align="center"><?php echo $row['equipName']; ?></td>
                            <td align="center"><?php echo ucfirst($row['equipType']); ?></td>
                            <td align="center"><?php echo $row['dueDateInterval'] ." month(s)";?></td>
                            <td align="center"><a href="editEquipment.php?equipmentId=<?php echo $row['equipmentId']; ?>" class="sidebar">Edit/Delete</a></td>
                        </tr>
                    <?php } ?>
                </table><br/>
                <button id="addEquipment" class="btn3">Add Equipment</button>
            </div><!--end mbr1content-->
        </div><!--end mbodyright1-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
    <div id="dialog-form" title="Add Equipment">
        <br/>
        <form action="addEquipment.php?>" method="post" id="addEquip">
            <label for="equipName">Equipment Name:</label><br/>
            <input type="text" id="equipName" name="equipName" class="modInput" required="required" placeholder="Equipment Name"/><br/><br/>
            <label for="equipType">Equipment Type:</label><br/>
            <select name="equipType" id="equipType">
                <option value="eletrical">Electrical</option>
                <option value="other">Other</option>
            </select><br/><br/>
            <label for="dueDateInterval">Service / Expiration Interval (mos.):</label><br/>
            <input type="text" id="dueDateInterval" name="dueDateInterval" class="modInput" required="required" placeholder="#Months before Service/Expiration"/><br/><br/>
            <input type="submit" id="addE" name="addE" class="btn" value="Add Equipment"/>
        </form>
    </div><!--end dialog-form-->
</body>
</html>
