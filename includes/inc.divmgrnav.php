<?php

?>

<div id="mbodyleft" class="bg-dark text-light">

    <div id="mblcontent">
        <ul>
            <li><a href="dashboarddivmgr.php" class="sidebar" title="Dashboard">Dashboard</a></li>
            <li><a href="download.php" class="sidebar" title="Download Forms">Download Forms</a></li>
            <li><a href="uploadForms.php" class="sidebar" title="Upload Forms">UpLoad Forms</a></li>
            <?php
            if ($_SESSION['permissionLevel'] == 'asc') { ?>
                <li><a href="changeRequest.php?divisionId=<?php echo $divisionId; ?>" class="sidebar" title="Change Request">Change Request</a></li>
            <?php } else { ?>
                <li><a href="changeRequest.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" class="sidebar" title="Change Request">Change Request</a></li>
            <?php } ?>
            <li><a href="reports.php?divisionId=<?php echo $divisionId; ?>"  class="sidebar" title="Reports">Reports</a></li>
            <li><a href="documentsTips.php"  class="sidebar" title="Safety Documents">Tips/Documents</a></li>
        </ul>
    </div><!--end mblcontent-->
</div><!--end mbodyleft-->
