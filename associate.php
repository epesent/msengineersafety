<?php

    session_start();
    require_once 'connectdb.php';
    $user = getAsc ($dbconn, $_SESSION['userId']);
    if (isset($_GET['assocId'])) {
        $assocId = $_GET['assocId'];
    } else {
        $assocId = $_SESSION['userId'];
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    } else {
        $divisionId = $user['divisionId'];
    }
    $ascQuals = getQualbyAsc ($dbconn, $assocId);
    $division = getDivisonSingle ($dbconn, $divisionId);
    $assoc = getAsc ($dbconn, $assocId);
    $ascEquip = getAscEquip ($dbconn, $assocId);
    $ascNotes = getAscNotes ($dbconn, $assocId);
try {
    if (isset($_POST['send'])) {
        //set variables
        $from = $assoc['userEmail'];
        $comment = htmlspecialchars($_POST['comment']);

        $to = "stevesmith@epesent.com";
        $subject = "Safety Suggestion or Comment";
        $message = $assoc['firstName'] ." " . $assoc['lastName'] ." has the following comments.\r\n";
        $message .= "\r\n";
        $message .= $comment;
        $headers = "From: " .$from . "\r\n" .'Reply-To ' .$from ."\r\n";

        if (mail($to,$subject,$message,$headers)) {
            echo "<script language='JavaScript'>alert('Thank you for you comments.')</script>";
        } else {
            echo "<script language='JavaScript'>alert('The message did not send.  Please contact the office.')</script>";
        }
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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">

        <?php
        if ($_SESSION['permissionLevel'] =='mgr') {
            include_once 'includes/inc.divmgrnav.php';
        } else {
            include_once "includes/inc.assocnav.php";
        } ?>

        <div id="mbodyright1">
            <div id="mbr1content">
                <h3>Associate Name: <?php echo $assoc['firstName'] ." " .$assoc['lastName'];?>&nbsp;&nbsp;&nbsp;
                    ID#: <?php echo $assoc['last4SSN']; ?><br/>
                    Assigned Division: <?php echo $division['divisionName'];?>&nbsp;&nbsp;&nbsp;Associate Email:&nbsp;&nbsp;<?php echo $assoc['userEmail']; ?></h3>
                <p>&nbsp;</p>
                <h2>Associate Qualifications</h2>
                <table width="80%" border="0">
                    <tr>
                        <th>Qualification</th>
                        <th>Abbrev</th>
                        <th>Method</th>
                        <th>Date Qualified</th>
                        <th>Renewal Date</th>
                    </tr>
                    <?php
                    foreach ($ascQuals as $rowQ) {
//                           format dates
                        $qualDate = strtotime($rowQ['qualDate']);
                        $formatqualDate = date('m/d/Y', $qualDate);
                        $dueDate = strtotime($rowQ['dueDate']);
                        $formatdueDate = date('m/d/Y', $dueDate);?>
                        <tr>
                            <td align="center"><?php echo $rowQ['qualName'];?></td>
                            <td align="center"><?php echo $rowQ['qualAbbreviation']; ?></td>
                            <td align="center"><?php echo $rowQ['qualMethod']; ?></td>
                            <td align="center"><?php echo $formatqualDate; ?></td>
                            <?php
                            $linitDate = date('Y-m-d', strtotime("+30 days"));
                            if(strtotime($rowQ['dueDate']) < strtotime($linitDate)) { ?>
                                <td align="center" class="error"><?php echo $formatdueDate; ?></td>
                            <?php } else { ?>
                                <td align="center"><?php echo $formatdueDate; ?></td>
                            <?php } ?>
                        </tr>
                    <?php    } ?>
                </table><br/>
                <div style="height: 30px;"></div><!--spacer-->
                <h2>Equipment Issued</h2>
                <table width="80%" border="0">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Serial Number</th>
                        <th>Date Issued</th>
                        <th>Service/Exp Date</th>
                    </tr>
                    <?php
                    foreach ($ascEquip AS $rowE) {
                        $issueDate = strtotime($rowE['issueDate']);
                        $formatIssueDate = date('m/d/Y', $issueDate);
                        $expDate = strtotime($rowE['expDate']);
                        $formatExpDate = date('m/d/Y', $expDate);
                        ?>
                        <tr>
                            <td align="center"><?php echo $rowE['equipName']; ?></td>
                            <td align="center"><?php echo $rowE['serialNumber']; ?></td>
                            <td align="center"><?php echo $formatIssueDate; ?></td>
                            <?php
                            $expires = date('Y-m-d', strtotime("+30 days"));
                            if (strtotime($rowE['expDate']) < strtotime($expires)) { ?>
                                <td align="center" class="error"><?php echo $formatExpDate; ?></td>
                            <?php } else { ?>
                                <td align="center"><?php echo $formatExpDate; ?></td>
                            <?php    } ?>
                        </tr>
                    <?php } ?>
                </table><br/>
            </div><!--end mbr1content-->
            <?php if ($_SESSION['permissionLevel'] == 'asc') { ?>
                <div id="mbr1Suggesstions">
                    <h2>Send us your comments or suggestions.</h2>
                    <h4><em>(To update your qualifications or equipment please use the <a href="changeRequest.php" class="wrapLink" title="Change Request">Change Request</a> form.)</em></h4><br/>
                    <form action="" method="post">
                        <textarea rows="20" cols="80" id="comment" name="comment"></textarea><br/>
                        <input type="submit" id="send" name="send" class="btn3" value="Send Comment"/>
                    </form>
                </div><!--end mbr1Suggestions-->
            <?php } ?>
            <div style="height: 20px;">&nbsp;</div><!--spacer-->
        </div><!--end mbodyright-->


        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>