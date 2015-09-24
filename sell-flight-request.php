<?php
session_start();

include_once './uapi_phpSample_Airasia_logid.php';

$sessonId = $_SESSION['airsession'];

echo $sessonId;

echo '<hr>';

$message = <<<EOM
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:air="AirAsia.ARMS.NewSkies">
<soapenv:Header/>
<soapenv:Body>
<air:Sell>
<air:SessionID>$sessonId</air:SessionID>
<air:sellRequestData>
<air:SellBy>Journey</air:SellBy>
<air:SellJourneyRequest>
<air:SellJourneyRequestData>
<!-- Optional: -->
<air:ActionStatusCode>NN</air:ActionStatusCode>
<!-- Optional: -->
<air:CurrencyCode>MYR</air:CurrencyCode>
<!-- Optional: -->
<air:Journeys>
<!-- Zero or more repetitions: -->
<air:SellJourney>
<air:State>New</air:State>
<air:NotForGeneralUse>0</air:NotForGeneralUse>
<!-- Optional: -->
<air:Segments>
<air:SellSegment>
<air:State>New</air:State>
<!-- Optional: -->
<air:ActionStatusCode>NN</air:ActionStatusCode>
<!-- Optional: -->
<air:ArrivalStation>KUL</air:ArrivalStation>
<!-- Optional: -->
<air:CabinOfService/>
<!-- Optional: -->
<air:DepartureStation>MEL</air:DepartureStation>
<!-- Optional: -->
<air:Fare>
<air:State>New</air:State>
<!-- Optional: -->
<air:CarrierCode>D7</air:CarrierCode>
<!-- Optional: -->
<air:ClassOfService>A</air:ClassOfService>
<air:FareApplicationType>Route</air:FareApplicationType>
<!-- Optional: -->
<air:FareBasisCode>A00H04</air:FareBasisCode>
<air:FareSequence>0</air:FareSequence>
<air:IsAllotmentMarketFare>0</air:IsAllotmentMarketFare>
<!-- Optional: -->
<air:ProductClass/>
<!-- Optional: -->
<air:RuleNumber/>
<!-- Optional: -->
<air:RuleTariff/>
</air:Fare>
<air:FlightDesignator>
<air:CarrierCode>D7</air:CarrierCode>
<air:FlightNumber>2723</air:FlightNumber>
</air:FlightDesignator>
<air:STA>2010-10-24T07:00:00</air:STA>
<air:STD>2010-10-24T01:45:00</air:STD>
</air:SellSegment>
</air:Segments>
</air:SellJourney>
</air:Journeys>
<!-- Optional: -->
<air:Passengers>
<air:Passenger>
<air:PassengerNumber>0</air:PassengerNumber>
<air:FamilyNumber>1</air:FamilyNumber>
<air:PaxPriceType>
<air:PaxType>ADT</air:PaxType>
</air:PaxPriceType>
<air:State>New</air:State>
<air:PassengerID>0</air:PassengerID>
<air:PsuedoPassenger>0</air:PsuedoPassenger>
</air:Passenger>
</air:Passengers>
<air:PaxCount>1</air:PaxCount>
</air:SellJourneyRequestData>
</air:SellJourneyRequest>
</air:sellRequestData>
</air:Sell>
</soapenv:Body>
</soapenv:Envelope>
EOM;

//API access url
$url = curl_init("https://testarms.airasia.com/aaws/ARMSWS.asmx");

// This is the header of the request
$resultee = GetSoapResponce($message, $url);

echo htmlentities($resultee);
echo '<hr>';

$result = preg_replace("/<.*(xmlns *= *[\"'].[^\"']*[\"']).[^>]*>/i", "", $resultee); // This removes ALL default namespaces.
$result = str_replace('</soap:', '</', $result);
$result = '<?xml version="1.0" encoding="utf-8"?><Envelope><Body><GetAvailabilityResponse><GetAvailabilityResult>'.$result;

$result = trim($result);

echo htmlentities($result);
echo '<hr>';

$XML = simplexml_load_string($result);
var_dump($XML);

echo '<hr>';

//echo $XML->Body->





?>