<?php
    session_start();
    require_once 'connectdb.php';
    $allQual = getQualifications ($dbconn);

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

            $("#addQualification").click(function() {
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
                <h2>Current Available Qualifications</h2><br/>
                <table width="100%" border="0">
                    <tr>
                        <th>Qualification</th>
                        <th>Abbreviation</th>
                        <th>Method</th>
                        <th>Renewal Interval</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($allQual as $rowQ) { ?>
                        <tr>
                            <td><?php echo $rowQ['qualName']; ?></td>
                            <td><?php echo $rowQ['qualAbbreviation']; ?></td>
                            <td><?php echo $rowQ['qualMethod']; ?></td>
                            <td><?php echo $rowQ['qualRequireInterval']; ?></td>
                            <td><a href="editQualification.php?qualificationId=<?php echo $rowQ['qualificationId']; ?>" class="wrapLink">Edit/Delete</a></td>
                        </tr>
                    <?php    } ?>
                </table><br/>
                <button id="addQualification" class="btn3">Add Qualification</button>
            </div><!--end mbr1content-->
            <div style="height: 20px;">&nbsp;</div><!--spacer-->
        </div><!--end mbodyright1-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
    <div id="dialog-form" title="Add Qualification">
        <br/>
        <form action="addQualification.php?>" method="post" id="addQual">
            <input type="text" id="qualName" name="qualName" required="required" placeholder="Qualification Name"/><br/><br/>
            <input type="text" id="qualAbbreviation" name="qualAbbreviation" required="required" placeholder="Abbreviation"/><br/><br/>
            <input type="text" id="qualMethod" name="qualMethod" required="required" placeholder="Method"/><br/><br/>
            <input type="text" id="qualRequireInterval" name="qualRequireInterval" required="required" placeholder="Months between certifications"/><br/><br/><br/>
            <input type="submit" id="addQ" name="addQ" class="btn" value="Add Qualification"/>
        </form>
    </div><!--end dialog-form-->
</body>
</html>
