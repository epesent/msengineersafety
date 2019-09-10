
<!--Created by Robert Armstrong-->
<!--User: rea-->
<!--Date: 8/23/18-->
<!--Used to show report of the expiring certifications for all divisions-->

<?php
require_once 'connectdb.php';
require_once 'scripts/expiringCertificationsListSC.php';
?>

<html>
<head>
</head>
<body>
<h2>30 Day Expiring Equipment Issued as of: <?php echo date('M-d-Y');?></h2>
<table width='90%' border='0'
<tr>
    <th>Division</th>
    <th>Name</th>
    <th>User ID</th>
    <th>Equipment</th>
    <th>Equip Type</th>
    <th>Serial Number</th>
    <th>Date Issued</th>
    <th>Exp Date</th>
</tr><hr>
<?php
foreach ($sqlElectrical AS $rowE) {
    ?>
    <tr>
        <td align='center'><?php echo $rowE['divisionName']; ?></td>
        <td align='center'><?php echo $rowE['fullName']; ?></td>
        <td align='center'><?php echo $rowE['userId']; ?></td>
        <td align='center'><?php echo $rowE['equipName']; ?></td>
        <td align='center'><?php echo $rowE['equipType']; ?></td>
        <td align='center'><?php echo $rowE['serialNumber']; ?></td>
        <td align='center'><?php echo $rowE['issueDate']; ?></td>
        <td align='center'><?php echo $rowE['expDate']; ?></td>
    </tr>
<?php } ?>
</table><br/><hr>
</body>
</html>
