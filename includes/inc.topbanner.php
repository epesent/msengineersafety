<?php

?>
<div id="topbanner">
    <div style="height: 10px;"></div><!--spacer-->
    <div id="tbleft">&nbsp;</div><!--end tbleft-->
    <div id="tbcenter">
        <h1 align="center">M&S ENGINEERING</h1><br><h2 align="center">SAFETY AND COMPLIANCE DATABASE</h2>
    </div><!--end tbcenter-->
    <div id="tbright">
        <?php if (isset($_SESSION['userId'])) { ?>
        <h3 align="center"><a href="index.php?logout=yes" class="nav" title="LOG OUT">Log Out</a></h3>
        <?php } ?>
    </div><!--end tbright-->
</div><!--end topbanner-->
