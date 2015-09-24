<?php

include_once './uapi_phpSample_Airasia_logid.php';

$sessonId = ReturnSessionId();

$message = <<<EOM
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:air="AirAsia.ARMS.NewSkies">
<soapenv:Header/>
<soapenv:Body>
<air:GetAvailability>
<air:NSReq>
<air:AvailabilityRequests>
<!-- Zero or more repetitions: -->
<air:AvailabilityRequest>
<air:ArrivalStation>KUL</air:ArrivalStation>
<air:ArrivalStations>
<!-- Zero or more repetitions: -->
<air:string>KUL</air:string>
</air:ArrivalStations>
<air:AvailabilityFilter>Default</air:AvailabilityFilter>
<air:AvailabilityType>Default</air:AvailabilityType>
<air:BeginDate>2016-01-20</air:BeginDate>
<air:CarrierCode/>
<air:CurrencyCode>LKR</air:CurrencyCode>
<air:DepartureStation>CMB</air:DepartureStation>
<air:DepartureStations>
<!-- Zero or more repetitions: -->
<air:string>CMB</air:string>
</air:DepartureStations>
<air:DiscountCode/>
<air:DisplayCurrencyCode/>
<air:Dow>Daily</air:Dow>
<air:EndDate>2016-01-20</air:EndDate>
<air:FareClassControl>Default</air:FareClassControl>
<air:FareClasses/>
<air:FareTypes/>
<air:FlightNumber/>
<air:FlightType>All</air:FlightType>
<air:InboundOutbound>None</air:InboundOutbound>
<air:IncludeAllotments>true</air:IncludeAllotments>
<air:IncludeTaxesAndFees>true</air:IncludeTaxesAndFees>
<air:JourneySortKeys>LowestFare</air:JourneySortKeys>
<air:MaximumConnectingFlights>4</air:MaximumConnectingFlights>
<air:MaximumFarePrice>0.0</air:MaximumFarePrice>
<air:MinimumFarePrice>0.0</air:MinimumFarePrice>
<air:NightsStay>0</air:NightsStay>
<air:PaxCount>1</air:PaxCount>
<air:SSRCollectionsMode>All</air:SSRCollectionsMode>
<air:FareGroups/>
</air:AvailabilityRequest>
</air:AvailabilityRequests>
</air:NSReq>
<air:SessionID>$sessonId</air:SessionID>
</air:GetAvailability>
</soapenv:Body>
</soapenv:Envelope>
EOM;

//API access url
$url = curl_init("https://testarms.airasia.com/aaws/ARMSWS.asmx");

// This is the header of the request
$result = GetSoapResponce($message, $url);

echo htmlentities($result);

//echo htmlentities($result);
//$result = preg_replace("/<.*(xmlns *= *[\"'].[^\"']*[\"']).[^>]*>/i", "", $result); // This removes ALL default namespaces.
//$result = str_replace('</soap:', '</', $result);
//$result = simplexml_load_string(trim($result));
//echo htmlentities($result);

echo '<hr>';

$doc = new DOMDocument();
$doc->loadXML($result);

$ActionStatusCodes = $doc->getElementsByTagName("ActionStatusCode");
$DepartureDates = $doc->getElementsByTagName("TADepartureDate");
$ArrivalStations = $doc->getElementsByTagName("ArrivalStation");
$DepartureStations = $doc->getElementsByTagName("DepartureStation");
$CarrierCodes = $doc->getElementsByTagName("CarrierCode");
$FlightNumber = $doc->getElementsByTagName("FlightNumber");
$SegmentSellKeys = $doc->getElementsByTagName("SegmentSellKey");


$domLength = $SegmentSellKeys->length;

for ($index = 0; $index < $domLength; $index++) {
    echo '<hr>';
    
    echo 'Action StatusCode : '.$ActionStatusCodes->item($index)->nodeValue.'<br>';
    echo 'Arrival Station   : '.$ArrivalStations->item($index)->nodeValue.'<br>';
    echo 'Departure Station : '.$DepartureStations->item($index)->nodeValue.'<br>';
    echo 'Departure Date    : '.$DepartureDates->item($index)->nodeValue.'<br>';
    echo 'Segment Sell Key  : '.$SegmentSellKeys->item($index)->nodeValue.'<br>';
    echo 'Carrier           : '.$CarrierCodes->item($index)->nodeValue.'-'.$FlightNumber->item($index)->nodeValue;
}


//$LoginResult = $ArrivalStations->item(0)->nodeValue;



//echo 'ArrivalStation :'.$LoginResult.'<br>';

//while ($LoginResult) {
//
//    echo $LoginResult . '-<br>';
//
//    $itemNo++;
//    $LoginResult = $ArrivalStations->item($itemNo)->nodeValue;
//}
?>