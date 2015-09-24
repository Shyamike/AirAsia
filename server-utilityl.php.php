<?php

/*
 * Author : Gayan Shyamike
 * Date   : 07 07 2015
 * Conpany: Knight Bridge Technologies
 */

//Connect and get server responce.
function GetSoapResponce($message,$soap_do) {
    
    //Header description
    $header = array(
        "Content-Type: text/xml;charset=UTF-8",
        "Accept: gzip,deflate",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "Connection: Keep-Alive",
        "Content-length: " . strlen($message),
    );

    curl_setopt($soap_do, CURLOPT_VERBOSE, 1);               // For debugging purposes (read CURL manual for nore info)
    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 30);       // Timeout options
    curl_setopt($soap_do, CURLOPT_TIMEOUT, 30);
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);        // Verify nothing about peer certificates
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 0);        // Verify nothing about host certificates
    curl_setopt($soap_do, CURLOPT_POST, 1);                 // Sending post variables
    curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);     // Post variable being sent (The XML request)
    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);       // cuel_exec function will show the response directly on the page (if set to 0 curl_exec function will return the result)
    curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Authentication is BASIC
    curl_setopt($soap_do, CURLOPT_SSLVERSION, 3);            // SSL version to use (3.0)
    curl_setopt($soap_do, CURLOPT_PORT, 443);                // SSL port to use (443)
    curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);      // Headers sent to the server
// Make the request and CURL will show it on the page, if you want it into a variable to process it see the line 77, the CURL_RETURNTRANSFER option

    $resultSet = curl_exec($soap_do);
    
    return $resultSet;
}

?>