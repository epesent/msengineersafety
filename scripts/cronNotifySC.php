<?php
/**
 * Created by PhpStorm.
 * User: rea
 * Date: 1/19/18
 * Time: 4:36 PM
 */

error_reporting(E_ALL);

    $sqlElectrical = getElectricalEquip ($dbconn);



try {

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}