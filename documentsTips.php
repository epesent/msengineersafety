<?php
    session_start();
    require_once 'connectdb.php';
    $tips = getAllTips ($dbconn);
    $compDocs = getAllCompSafetydocs ($dbconn);
    $extDocs = getAllExtSafetydocs ($dbconn);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Safety Information</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />

</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">
        <?php if ($_SESSION['permissionLevel'] == 'adm') {
            include_once "includes/inc.adminnav.php";
        } elseif ($_SESSION['permissionLevel'] == 'mgr') {
            include_once "includes/inc.divmgrnav.php";
        } else {
            include_once "includes/inc.assocnav.php";
        } ?>
        <div id="mbodyright1">
            <div id="mbr1content">
                <h2>Company Safety Documents</h2>
                <div class="rowL" style="margin-top: 10px">
                    <div class="col-md-1">&nbsp;</div><!--end grid spacer-->
                    <div class="col-md-5"><u>Name:</u></div><!--end grid div-->
                    <div class="col-md-6"><u>Description:</u></div><!--end grid div-->
                </div><!--end rowL-->
                <?php foreach ($compDocs AS $rowC) {?>
                    <div class="rowL">
                        <div class="col-md-1">&nbsp;</div><!--end grid spacer-->
                        <div class="col-md-5">
                            <a href="<?php echo $rowC['link']; ?>" class="tipLink" target="_blank"><?php echo $rowC['uploadName']; ?></a>
                        </div><!--end grid div-->
                        <div class="col-md-6"><h4><?php echo $rowC['description']; ?></h4></div><!--end grid div-->
                    </div><!--end rowL-->
                <?php } ?>
                <h2 style="margin-top: 20px">Other Safety Documents</h2>
                <div class="rowL" style="margin-top: 10px">
                    <div class="col-md-1">&nbsp;</div><!--end grid spacer-->
                    <div class="col-md-5"><u>Name:</u></div><!--end grid div-->
                    <div class="col-md-6"><u>Description:</u></div><!--end grid div-->
                </div><!--end rowL-->
                <?php foreach ($extDocs AS $rowE) {?>
                    <div class="rowL">
                        <div class="col-md-1">&nbsp;</div><!--end grid spacer-->
                        <div class="col-md-5">
                            <a href="<?php echo $rowE['link']; ?>" class="tipLink" target="_blank"><?php echo $rowE['uploadName']; ?></a>
                        </div><!--end grid div-->
                        <div class="col-md-6"><h4><?php echo $rowE['description']; ?></h4></div><!--end grid div-->
                    </div><!--end rowL-->
                <?php } ?>
                <h2 style="margin: 50px 0 0 0;">Safety Tips:</h2>
                <div style="overflow: scroll; max-height: 600px;">
                <?php foreach ($tips AS $rowT) { ?>
                    <div class="rowNotes">
                        <h3 style="font-weight: bold; color: #cd2b03;"><?php echo $rowT['tipTitle']; ?></h3><br/>
                        <h4><?php echo $rowT['tipContent']; ?></h4>
                    </div><!--end rowL-->
                <?php } ?>
                </div>
            </div><!--end mbr1content-->
            <div style="height: 50px;">&nbsp;</div>
        </div><!--end mbodyright-->


        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>