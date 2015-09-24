<?php

/**
 * Convert 64base string
 */
$BaseString = "W3sicmVndWxhckRpc2NvdW50IjoiMTUifSx7ImJhbmtTcERpc2NvdW50IjoiNSJ9LHsic3BlY2lsRGlzQWxsb2V3ZCI6IjEifSxbImJhbmtJZCIsIjEiXSxbInJhdGVXaXRoU2NiRGlzY291bnQiLCIxNjAwMCJdXQ==";

/**
 * Convert Json string
 */
$jsonString = base64_decode($BaseString);

//echo $jsonString;

/**
 * Convert normal Array
 */
$dataArray = json_decode($jsonString, TRUE);

//var_dump($dataArray);

//echo $dataArray[4][1];

/**
 * Set new SCB discounted rate
 */
$dataArray[4][1] = '25487';

/**
 * Convert to Json
 */
$newJson = json_encode($dataArray);

echo $newJson;

/**
 * Convert to base64
 */
$newBitString = base64_encode($newJson);