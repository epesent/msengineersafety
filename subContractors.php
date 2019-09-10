<?php
    session_start();
    require_once 'connectdb.php';
    $subs = getSubs ($dbconn);


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
                height: 300,
                width: 350,
                modal: true
            });

            $("#addSub").click(function() {
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
            <h2>Current Sub-Contractors</h2><br/>
            <table width="40%" border="0">
                    <?php foreach ($subs AS $row) { ?>
                    <tr>
                        <td align="left"><a href="subContractorInfo.php?subcontractorId=<?php echo $row['subcontractorId']; ?>" class="wrapLink"><?php echo $row['subName']; ?></a></td>
                        <td align="left"><a href="deleteSubs.php?subcontractorId=<?php echo $row['subcontractorId']; ?>" onclick="return confirm('Are you sure you want to delete this Sub-Contractor from the list?');" class="sub">Delete</a></td>
                    <tr>
                    <?php } ?>
            </table><br>
            <button id="addSub" class="btn2">Add Sub-Contractor</button>
            <button id="goBack" class="btn2" onclick="goBack()">Cancel</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div><!--end mbr1content-->
    </div><!--end mbodyright1-->
    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
<div id="dialog-form" title="Add Equipment">
    <br/>
    <form action="addSubs.php?>" method="post" id="addSub">
        <input type="text" id="subName" name="subName" class="modInput" required="required" placeholder="Sub-Contractor Name"/><br/><br/>
        <input type="submit" id="addS" name="addS" class="btn" value="Add Sub-Contractor"/>
    </form>
</div><!--end dialog-form-->
</body>
</html>
