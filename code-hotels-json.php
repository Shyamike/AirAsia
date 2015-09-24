<?php

$newStdRate = ''; //Fill with new rate
$refNo = ''; //Fill with the post values

/**
 * Get 64Base string
 */
try {
    $stmt = $dbh->prepare("SELECT spldisjson FROM fmh_bookings WHERE RefNo='?'");
    $stmt->execute(array($refNo));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed' . $e->getMessage();
}
/**
 * Convert 64base string
 */
$BaseString = $result[0]['spldisjson'];

/**
 * Convert Json string
 */
$jsonString = base64_decode($BaseString);

/**
 * Convert normal Array
 */
$dataArray = json_decode($jsonString, TRUE);

/**
 * Set new SCB discounted rate
 */
$dataArray[4][1] = $newStdRate;

/**
 * Convert to Json
 */
$newJson = json_encode($dataArray);

/**
 * Convert to base64
 */
$newBitString = base64_encode($newJson);

/**
 * Update the database
 */
try {
    $executeQuery = $fmfdb_cms_ful->prepare('UPDATE fmh_bookings SET spldisjson=? WHERE RefNo= ?');
    $executeQuery->execute(array($newBitString, $refNo));
} catch (PDOException $e) {
    echo 'Query failed' . $e->getMessage();
}
?>