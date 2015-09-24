<?php

require_once './server-utilityl.php.php';

//Disable error reporting
error_reporting(0);

//Get respond
Function ReturnSessionId() {

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

//Server call url
    $url = curl_init("https://testarms.airasia.com/aaws/ARMSWS.asmx");

    $result = GetSoapResponce($message, $url);

//echo htmlentities($result);
//echo '<hr>'

//    $doc = new DOMDocument();
//    $doc->loadXML($result);
//
//    $LoginResults = $doc->getElementsByTagName("SessionID");
//    $LoginResult = $LoginResults->item(0)->nodeValue;
    
    return $result;
          
}

$resultee =  ReturnSessionId($message, $url);

echo htmlentities($resultee);
echo '<hr>';

$result = preg_replace("/<.*(xmlns *= *[\"'].[^\"']*[\"']).[^>]*>/i", "", $resultee); // This removes ALL default namespaces.
$result = str_replace('</soap:', '</', $result);
$result = '<?xml version="1.0" encoding="utf-8"?><Envelope><Body><LoginResponse><LoginResult>'.$result;

$result = trim($result);

echo htmlentities($result);
echo '<hr>';

$XML = simplexml_load_string($result);
var_dump($XML);

echo '<hr>';

echo $XML->Body->LoginResponse->LoginResult->SessionID;

?>