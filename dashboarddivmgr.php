<?php
    session_start();

    require_once 'connectdb.php';
    $user = getAsc ($dbconn, $_SESSION['userId']);
    $divisionId = $user['divisionId'];
    $division = getDivisonSingle ($dbconn, $divisionId);
    $assoc = getAssocbyDivision ($dbconn, $divisionId);
    $subcontractors = getSubbyDivision ($dbconn, $divisionId);

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
        <?php include_once "includes/inc.divmgrnav.php"; ?>

        <div id="mbodyright1">
            <div id="mbr1content">
                <h3>Division Name: <?php echo $division['divisionName']; ;?><br/>
                Division Manager: <?php echo $division['firstName'] ." " .$division['lastName'];?></h3>
                <p>&nbsp;</p>
                <h3>Current Associates</h3>
                <table width="100%" border="0"><tr>
                        <?php
                        //assocId = associate userId.  Name change to avoid confusion with admin userId
                        $count = 0;
                        $max = 3;
                        while ($row = $assoc->fetch_assoc()) {
                            $count++; ?>
                            <td><a href="associate.php?assocId=<?php echo $row['userId']; ?>&divisionId=<?php echo $divisionId; ?>" class="wrapLink"><?php echo $row['firstName'] ." " .$row['lastName']; ?></a></td>
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
                <h3>Current Sub-Contractors</h3><br/>
                <?php
                foreach ($subcontractors as $rowSC) {
                    echo "<a href=subContractorInfo.php?subcontractorId=" .$rowSC['subcontractorId'] ." class='shl'>"
                        .$rowSC['subName'] ."</a><br/>";
                }
                ?><br/>
            </div><!--end mbr1content-->
        </div><!--end mbodyright-->


        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>