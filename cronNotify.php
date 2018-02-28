<?php
/**
 * Created by PhpStorm.
 * User: rea
 * Date: 1/17/18
 * Time: 3:34 PM
 */
require_once 'connectdb.php';
require_once 'scripts/cronNotifySC.php';

$to = "rea@texasnetworkgroup.com, stevesmith@epesent.com";
$subject = "Cron Job for M&S Engineering Reporting";

//cronNotify1.php is where the actual message is created.
//  cronNotify1.php allows for preview of the message without actually emailing it.
//ob_start allow for the capture of the following lines and saved in the variable $message for emailing.
ob_start();
include 'cronNotify1.php';
$message = ob_get_contents();

//Always set the content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <rea@rswebdata.com>' . "\r\n";

mail($to,$subject,$message,$headers);
?>