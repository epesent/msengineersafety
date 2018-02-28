<?php
error_reporting(E_ALL);
session_start();
if (isset($_GET['subcontractorId'])) {
    $subcontractorId = $_GET['subcontractorId'];
}
require_once 'connectdb.php';

try {

    $sqlDelete = "DELETE FROM subcontractor WHERE subcontractorId = '$subcontractorId'";
    $dbconn->query($sqlDelete);

    header("location: subContractors.php");

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}