<div class="fsearch">
	<form method="GET" action="index.php?acid=<?php echo $acid; ?>&amp;al=<?php echo $al; ?>">
		<input type="radio" id="radio1" name="actiongroup" value="arrivals"checked><label for="radio1">Arrivals</label>
		<input type="radio" id="radio2" name="actiongroup" value="departures"><label for="radio2">Departures</label>
    	<label for="al" class="selector"><span>Choose Airline</span><select name="al" id="al"><option value="">Choose Airline</option><option value="G4">Allegiant Air</option><option value="AA">American Airlines</option><option value="DL">Delta Airlines</option><option value="WN">Southwest Airlines</option><option value="UA">United Airlines</option></select></label>
    	<input type="text" name="acid" placeholder="Flight Number">
    	<input type="submit" value="Track Flight">
    </form>
</div>
<?php
$airline = $_GET["al"];
$flightnumber = $_GET["acid"];

if (isset($airline, $flightnumber)) {

$day = date("Ymd");
if ($_GET['actiongroup']=="arrivals") {
	$arrurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&acid='.$flightnumber.'&arrap=lga&arrdate='.$day.'&al='.$airline.'';
} else {
	$arrurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&acid='.$flightnumber.'&depap=lga&depdate='.$day.'&al='.$airline.'';
}
$xml = file_get_contents($arrurl);
$feed = simplexml_load_string($xml);
foreach ($feed->Flight as $arrival) {
	$tz = 'America/Chicago';
	$airline = $arrival->FlightId->CommercialAirline->AirlineName;
	$flnum = $arrival->FlightId->FlightNumber;
	$depcity = $arrival->Departure->Airport->AirportLocation->CityName;
	$depstate = $arrival->Departure->Airport->AirportLocation->StateId;
	$depschtime = $arrival->Departure->DateTime[0]->Time;
	$dschtime = $depschtime;
	$depscheduled = new DateTime($dschtime, new DateTimeZone($tz));
	$depacttime = $arrival->Departure->DateTime[1]->Time;
	$dacttime = $depacttime;
	$depactual = new DateTime($dacttime, new DateTimeZone($tz));
	$depgate = $arrival->Departure->Airport->Gate;
	$arrcity = $arrival->Arrival->Airport->AirportLocation->CityName;
	$arrstate = $arrival->Arrival->Airport->AirportLocation->StateId;
	$arrschtime = $arrival->Arrival->DateTime[0]->Time;
	$aschtime = $arrschtime;
	$arrcheduled = new DateTime($aschtime, new DateTimeZone($tz));
	$arracttime = $arrival->Arrival->DateTime[1]->Time;
	$aacttime = $arracttime;
	$arractual = new DateTime($aacttime, new DateTimeZone($tz));
	$arrstatus = $arrival->FlightStatus;
	foreach ($arrstatus->children() as $child) {
		if ($child->getName() == 'InGate') {
			$arrrealstatus = 'In Gate';
		} elseif ($child->getName() == 'Landed') {
			$arrrealstatus = 'Landed';
		} elseif ($child->getName() == 'Scheduled') {
			$arrrealstatus = 'Scheduled';
		} elseif ($child->getName() == 'Proposed') {
			$arrrealstatus = 'Proposed';
		} elseif ($child->getName() == 'InAir') {
			$arrrealstatus = 'In Air';
		} elseif ($child->getName() == 'Cancelled') {
			$arrrealstatus = 'Cancelled';
		} elseif ($child->getName() == 'NoTakeoffInfo') {
			$arrrealstatus = 'No Takeoff Info';
		} elseif ($child->getName() == 'Delayed') {
			$arrrealstatus = 'Delayed';
		} elseif ($child->getName() == 'Unknown') {
			$arrrealstatus = 'Unknown';
		} elseif ($child->getName() == 'Outage') {
			$arrrealstatus = 'Outage';
		} elseif ($child->getName() == 'Expected') {
			$arrrealstatus = 'Expected';
		} elseif ($child->getName() == 'PastFlight') {
			$arrrealstatus = 'Past Flight';
		}
	}
}

echo '<div class="fresults">';
echo '<h2>'.$airline.' Flight #'.$flnum.'</h2>';
echo '<div class="flinfobox"><div class="flinfoheader">';
echo '<h4>Departure</h4></div>';
echo '<div class="flinfobody"><p><span>Airport:</span> '.$depcity.', '.$depstate.'</p>';
echo '<p><span>Scheduled Time:</span> '.$depscheduled->format('g:i a').'</p>';
echo '<p><span>Actual Time:</span> '.$depactual->format('g:i a').'</p>';
echo '<p><span>Gate:</span> '.$depgate.'</p></div></div>';
echo '<div class="flinfobox"><div class="flinfoheader">';
echo '<h4>Arrival</h4></div>';
echo '<div class="flinfobody"><p><span>Airport:</span> '.$arrcity.', '.$arrstate.'</p>';
echo '<p><span>Scheduled Time:</span> '.$arrcheduled->format('g:i a').'</p>';
echo '<p><span>Actual Time:</span> '.$arractual->format('g:i a').'</p>';
echo '<p><span>Status:</span> '.$arrrealstatus.'</p></div></div>';
echo '</div>';

} else {
	echo '<div class="fresults">';
	echo '<p class="noresults">Track a flight using the form to the left</p>';
	echo '</div>';
}
?>