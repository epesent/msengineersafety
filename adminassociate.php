<?php

    session_start();
    if (isset($_GET['assocId'])) {
        //assocId = associate userId.  Name change to avoid confusion with admin userId
        $assocId = $_GET['assocId'];
//        $userId = $assocId;
    }
    if (isset($_GET['divisionId'])) {
        $divisionId = $_GET['divisionId'];
    }
    require_once 'connectdb.php';
    require_once 'scripts/adminassociatesc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Associate</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
    <!--Script for jquery ui-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--date picker-->
    <script type="" src="js/datepicker.js"></script>
    <!--Text Editor Script-->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <!--    Modal Scripts-->
    <script type="text/javascript">
        $(function() {
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 400,
                width: 700,
                modal: true
            });

            $("#addQualification").click(function() {
                $("#dialog-form").dialog("open");
            });
        });

        $(function() {
            $( "#dialog-form2" ).dialog({
                autoOpen: false,
                height: 300,
                width: 700,
                modal: true
            });

            $("#addEquipment").click(function() {
                $("#dialog-form2").dialog("open");
            });
        });

        $(function() {
            $( "#dialog-form3" ).dialog({
                autoOpen: false,
                height: 400,
                width: 700,
                modal: true
            });

            $("#addNote").click(function() {
                $("#dialog-form3").dialog("open");
            });
        });

        $(function() {
            $( "#dialog-form4" ).dialog({
                autoOpen: false,
                height: 400,
                width: 700,
                modal: true
            });

            $("#addEps").click(function() {
                $("#dialog-form4").dialog("open");
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
                <h3>Associate Name: <?php echo $assoc['firstName'] ." " .$assoc['lastName'];?>&nbsp;&nbsp;&nbsp;
                    ID#: <?php echo $assoc['last4SSN']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="admindivision.php?divisionId=<?php echo $divisionId; ?>" class="wrapLink">Back to Division</a> <br/>
                    Assigned Division: <?php echo $division['divisionName'];?> &nbsp;&nbsp;&nbsp;Associate Email:&nbsp;&nbsp;<?php echo $assoc['userEmail']; ?></h3>
                    <a href='editAssoc.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>' class="wrapLink dialOpen">Update/Delete</a>
                <p>&nbsp;</p>
                <h2>Associate Qualifications</h2>
                <table width="100%" border="0">
                    <tr>
                        <th>Qualification</th>
                        <th>Abbreviation</th>
                        <th>Method</th>
                        <th>Date Qualified</th>
                        <th>Renewal Date</th>
                    </tr>
                    <?php
                        foreach ($ascQuals as $rowQ) {
//                           format dates
                            $qualDate = strtotime($rowQ['qualDate']);
                            $formatqualDate = date('m/d/Y', $qualDate);
//                            $dueDate = strtotime($rowQ['dueDate']);
                            $dueDate = strtotime(date("Y-m-d", strtotime($rowQ['qualDate'])) ." +".$rowQ['qualRequireInterval'] ." months");
//                            $formatdueDate = date('m/d/Y', $dueDate);
                            $formatdueDate = date('m/d/Y', $dueDate);
                            $testDD = date('Y-m-d', $dueDate);
//                            echo $rowQ['dueDate'] ." test". $testDD;
                            $recordQualId = $rowQ['recordQualId'];
                            $certLink = getCertLink ($dbconn, $recordQualId);
                            $count = mysqli_num_rows($certLink);
                            ?>
                            <tr>
                                <?php if (!empty($certLink)) { ?>
                                    <td><a href="<?php echo $certLink['link']; ?>" target="_blank"><?php echo $rowQ['qualName'];?></a></td>
                                <?php } else { ?>
                                    <td><?php echo $rowQ['qualName'];?></td>
                                <?php }?>
                                <td><?php echo $rowQ['qualAbbreviation']; ?></td>
                                <td><?php echo $rowQ['qualMethod']; ?></td>
                                <td><?php echo $formatqualDate; ?></td>
                                <?php
                                $linitDate = date('Y-m-d', strtotime("+30 days"));
                                if(strtotime($testDD) < strtotime($linitDate)) { ?>
                                    <td class="error"><?php echo $formatdueDate; ?></td>
                                <?php } else { ?>
                                    <td><?php echo $formatdueDate; ?></td>
                                <?php } ?>
                                <td><a href='editAscQual.php?recordQualId=<?php echo $rowQ['recordQualId']; ?>' class="wrapLink dialOpen">Update/Delete</a></td>
                            </tr>
                    <?php    } ?>
                </table><br/>
                <button id="addQualification" class="btn3">Add Qualification</button><br/><br/>
                <div style="height: 40px; border-top: solid 2px #000000"></div><!--spacer-->
                <h2>Equipment Issued</h2><br/>

                <h3>Personal Protective Equipment - PPE</h3>
                <table width="90%" border="0">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Date Issued</th>
                        <th>Serial Number</th>
                        <th></th>
                    </tr>
                    <?php foreach ($ascEpsEq AS $rowEps) {
                        $dateIssued = strtotime($rowEps['dateIssued']);
                        $formatID = date('m/d/Y', $dateIssued); ?>
                        <tr>
                            <td><?php echo $rowEps['epsDesc']; ?></td>
                            <td><?php echo $formatID; ?></td>
                            <td><?php echo (!empty($rowEps['serialNo'])?$rowEps['serialNo']:"N/A"); ?></td>
                            <td><a href="editAscEpsEquip.php?epsEquipId=<?php echo $rowEps['epsEquipId']; ?>&divisionId=<?php echo $divisionId; ?>" class="wrapLink">Update/Delete</a></td>
                        </tr>
                    <?php } ?>

                </table><br/>
                <button id="addEps" class="btn3">Add PPE</button><br/><br/>
                <h3>Specialized Equipment</h3>
                <table width="90%" border="0">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Serial Number</th>
                        <th>Date Issued</th>
                        <th>Service/Exp Date</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($ascEquip AS $rowE) {
                        $issueDate = strtotime($rowE['issueDate']);
                        $formatIssueDate = date('m/d/Y', $issueDate);
                        $expDate = strtotime($rowE['expDate']);
                        $formatExpDate = date('m/d/Y', $expDate);
                        ?>
                        <tr>
                            <td><?php echo $rowE['equipName']; ?></td>
                            <td><?php echo $rowE['serialNumber']; ?></td>
                            <td><?php echo $formatIssueDate; ?></td>
                            <?php
                            $expires = date('Y-m-d', strtotime("+30 days"));
                            if (strtotime($rowE['expDate']) < strtotime($expires)) { ?>
                                <td class="error"><?php echo $formatExpDate; ?></td>
                            <?php } else { ?>
                                <td><?php echo $formatExpDate; ?></td>
                            <?php    } ?>
                            <td><a href="editAscEquip.php?equipRecordId=<?php echo $rowE['equipRecordId']; ?>&divisionId=<?php echo $divisionId; ?>" class="wrapLink">Update/Delete</a></td>
                        </tr>
                    <?php } ?>
                </table><br/>
                <button id="addEquipment" class="btn3">Add Equipment</button><br/><br/>


                <div style="height: 40px; border-top: solid 2px #000000"></div><!--spacer-->
                <h2>Notes&nbsp;&nbsp;<button id="addNote" class="btn3">Add Note</button></h2><br/>
                <div id="noteScroll">
                    <?php
                        foreach ($ascNotes AS $rowN) {
                            $noteDate = strtotime($rowN['noteDate']);
                            $formatNoteDate = date('m/d/Y', $noteDate);
                            ?>
                            <h3><?php echo $formatNoteDate; ?></h3>
                            <h4><?php echo $rowN['note']; ?></h4><br/>
                        <?php } ?>
                </div><!--end noteScroll-->
            </div><!--end mbr1content-->
            <div style="height: 20px;"></div><!--spacer-->
        </div><!--end mbodyright-->
        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
    <div id="dialog-form" title="Add Qualification">
        <br/>
        <form action="addAscQual.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" method="post" id="addqual">
            <select name="qualificationId">
                <option value="">Select the qualification</option>
                <?php
                    foreach ($allQual AS $rowAQ) {
                        echo "<option value='" .$rowAQ['qualificationId'] ."'>" .$rowAQ['qualName'] ."</option>";
                    }
                ?>
            </select><br/><br/>
            <input type="text" id="qualDate" name="qualDate" class="pickDate modInput" placeholder="Date Qualified"/><br/><br/>
            Upload Certificate <input type="checkbox" name="certificate" value="upload"/><br/><br/>
            <input type="submit" id="addQ" name="addQ" class="btn" value="Add Qualification"/>
        </form>
    </div><!--end dialog-form-->
    <div id="dialog-form2" title="Add Equipment">
        <br/>
        <form action="addAscEquip.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" method="post" id="addEquip">
            <select name="equipmentId">
                <option value="">Select the Equipment</option>
                <?php
                foreach ($allEquip AS $rowAE) {
                    echo "<option value='" .$rowAE['equipmentId'] ."'>" .$rowAE['equipName'] ."</option>";
                }
                ?>
            </select><br/><br/>
            <input type="text" id="issueDate" name="issueDate" class="pickDate modInput" placeholder="Date Issued"/><br/><br/>
            <input type="text" id="expDate" name="expDate" class="pickDate modInput" placeholder="Service/Expiration Date"/><br/><br/>
            <input type="submit" id="addE" name="addE" class="btn" value="Add Equipment"/>
        </form>
    </div><!--end dialog-form2-->
    <div id="dialog-form3" title="Add Note">
        <br/>
        <form action="addAscNote.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" method="post" id="addNote">
            <h4>Type your note here.</h4>
            <textarea name="note" rows="10" cols="60"></textarea><br/><br/>
            <input type="submit" id="addN" name="addN" class="btn" value="Add Note"/>
        </form>
    </div><!--end dialog-form3-->
    <div id="dialog-form4" title="Add PPE Equipment">
        <br/>
        <form action="addEpsEquip.php?assocId=<?php echo $assocId; ?>&divisionId=<?php echo $divisionId; ?>" method="post" id="addEpsEquip">
            <select id="epsDesc" name="epsDesc">
                <option value="">Select the equipment</option>
                <option value="Hard Hat">Hard Hat</option>
                <option value="ANSI 2-87 Safety Glasses">ANSI 2-87 Safety Glasses</option>
                <option value="Safety Vest">Safety Vest</option>
                <option value="FR Jeans">FR Jeans</option>
                <option value="FR Shirt">FR Shirt</option>
                <option value="Safety Footwear">Safety Footwear</option>
            </select><br/><br/>

<!--            <input type="text" id="epsDesc" name="epsDesc" placeholder="Equipment Description" required="required"/><br/><br/>-->


            <input type="text" id="dateIssued" name="dateIssued" class="pickDate modInput" placeholder="Date Issued"/><br/><br/>
            <input type="text" id="serialNo" name="serialNo" class="modInput" placeholder="Serial No (if needed)"/><br/><br/>
            <input type="submit" id="epsSubmit" name="epsSubmit" class="btn" value="Add Equipment"/>
        </form>
    </div><!--end dialog-form4-->
</body>
</html>