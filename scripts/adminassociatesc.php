<?php
error_reporting(E_ALL);

    $ascQuals = getQualbyAsc ($dbconn, $assocId);
    $division = getDivisonSingle ($dbconn, $divisionId);
    $assoc = getAsc ($dbconn, $assocId);
    $allQual = getQualifications ($dbconn);
    $ascEquip = getAscEquip ($dbconn, $assocId);
    $allEquip = getAllEquip ($dbconn);
    $ascNotes = getAscNotes ($dbconn, $assocId);
    $ascEpsEq = getAscEpsEquip ($dbconn, $assocId);



try {

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}