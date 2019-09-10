<?php
    session_start();
    if (isset($_GET['subcontractorId'])) {
        $subcontractorId = $_GET['subcontractorId'];
    }
    require_once 'connectdb.php';
    $spSub = getSpecSub ($dbconn, $subcontractorId);
    $emp = getSubEmp ($dbconn, $subcontractorId);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Sub-Contractor</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php if ($_SESSION['permissionLevel'] == 'adm') {
        include_once "includes/inc.adminnav.php";
    } else {
        include_once "includes/inc.divmgrnav.php";
    }
    ?>
    <div id="mbodyright1">
        <div id="mbr1content">
            <h2>Sub-Contractor: <?php echo $spSub['subName']; ?></h2><br/>
            <h3>Employees</h3><br/>
            <table width="100%" border="0">
                <tr>
                    <th>&nbsp;</th>
                    <th>Qualification</th>
                    <th>Date Qualified</th>
                    <th>Expiration Date</th>
                </tr>
            <?php
                foreach ($emp AS $rowE) { ?>
                    <tr>
                        <td><?php echo $rowE['subFirstName'] ." " .$rowE['subLastName']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    $subContactsId = $rowE['subContactsId'];
                    $seQual = getSEQualifications ($dbconn, $subContactsId);
                    foreach ($seQual as $rowSEQ) {
                        $qualDate = strtotime($rowSEQ['qualDate']);
                        $formatqualDate = date('m/d/Y', $qualDate);
                        $dueDate = strtotime($rowSEQ['dueDate']);
                        $formatdueDate = date('m/d/Y', $dueDate); ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="center"><?php echo $rowSEQ['qualName']; ?></td>
                            <td align="center"><?php echo $formatqualDate; ?></td>
                            <?php
                            //check for dates less than 30 days from today
                            $linitDate = date('Y-m-d', strtotime("+30 days"));
                            if(strtotime($rowSEQ['dueDate']) < strtotime($linitDate)) { ?>
                                <td align="center" class="error"><?php echo $formatdueDate; ?></td>
                            <?php } else { ?>
                                <td align="center"><?php echo $formatdueDate; ?></td>
                            <?php } ?>
                        </tr>
                    <?php }
                }
            ?>
            </table>
        </div><!--mbr1content-->
    </div><!--end mbodyright-->
    <?php include_once "includes/inc.shlinks.php"; ?>
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
