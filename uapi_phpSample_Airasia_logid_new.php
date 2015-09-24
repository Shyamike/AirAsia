<?php


$message = <<<EOM
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:air="AirAsia.ARMS.NewSkies">
<soapenv:Header/>
<soapenv:Body>
<air:Login>
<air:NSReq>
<air:Username>APIFINDMYFARE</air:Username>
<air:Password>Fin@MyF@r3</air:Password>
</air:NSReq>
</air:Login>
</soapenv:Body>
</soapenv:Envelope>
EOM;


    $soap_do = curl_init ("https://testarms.airasia.com/aaws/ARMSWS.asmx");
//
// This is the header of the request
//
    $header = array(
      "Content-Type: text/xml;charset=UTF-8",
      "Accept: gzip,deflate",
      "Cache-Control: no-cache",
      "Pragma: no-cache",
      "Connection: Keep-Alive",
      "Content-length: " . strlen($message),
    );
//
    curl_setopt($soap_do, CURLOPT_VERBOSE, 1);               // For debugging purposes (read CURL manual for nore info)
    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 30);       // Timeout options
    curl_setopt($soap_do, CURLOPT_TIMEOUT, 30); 
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);        // Verify nothing about peer certificates
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 0);        // Verify nothing about host certificates
    curl_setopt($soap_do, CURLOPT_POST, 1 );                 // Sending post variables
    curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);     // Post variable being sent (The XML request)
    //curl_setopt($soap_do, CURLOPT_HEADER, 1 );
    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER,1 );       // cuel_exec function will show the response directly on the page (if set to 0 curl_exec function will return the result)
    curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Authentication is BASIC
    //curl_setopt($soap_do, CURLOPT_USERPWD, $CREDENTIALS);    // The credentials username:password (CURL will encode this automatically)
    curl_setopt($soap_do, CURLOPT_SSLVERSION, 3);            // SSL version to use (3.0)
    curl_setopt($soap_do, CURLOPT_PORT, 443);                // SSL port to use (443)
    curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);      // Headers sent to the server
//
// Make the request and CURL will show it on the page, if you want it into a variable to process it see the line 77, the CURL_RETURNTRANSFER option
//
  $result=  curl_exec($soap_do); 
  
  htmlentities($result);
  
  if (curl_errno($soap_do) != '') 
{
	print curl_errno($soap_do) . ' - ' . curl_error($soap_do) . '<br/>';
}
  curl_close($soap_do);
  
  
  $result = str_replace(' xmlns="AirAsia.ARMS.NewSkies"', '', $result);
  
  

$xml     = simplexml_load_string($result);



echo "<hr>";

echo "SessionID : ".$xml->xpath('//LoginResponse/LoginResult/SessionID')[0];
echo "<BR><BR><BR>";
echo "CompanyName : ".$xml->xpath('//LoginResponse/LoginResult/CompanyName')[0];



?>