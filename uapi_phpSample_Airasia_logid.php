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

    $doc = new DOMDocument();
    $doc->loadXML($result);

    $LoginResults = $doc->getElementsByTagName("SessionID");
    $LoginResult = $LoginResults->item(0)->nodeValue;


    return $LoginResult;
}

//echo ReturnSessionId($message, $url);
?>