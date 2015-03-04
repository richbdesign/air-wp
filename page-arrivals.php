<?php
/**
 * Template Name: Arrivals Page
 * Description: Arrivals page template
 *
 * @package WordPress
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

<?php the_post(); ?>
</div><!-- headerpic -->
<?php $pageheader = get_field('page_header_image');
if (!empty($pageheader)):
    //$size = 'full';
    $large = $pageheader['url'];
        echo '<div class="banner" style="background: url('.$large.') no-repeat center center; background-size: cover;">';
    else :
        echo '<div class="banner">'; ?>
<?php endif; ?>
	<section>
		<div class="col-12">
			<ul class="tabs">
				<li><a href="#arrivals">Arrivals</a></li>
				<li><a href="#departures">Departures</a></li>
			</ul>
		</div>
	</section>
</div><!-- banner -->
<div class="content bluecontent">
	<section>
		<div class="col-12">
			<?php the_content(); ?>
			<div id="arrivals">
				
				<div id="ResultsHeader" class="header">
					<div class="flightfield c1">Airline</div>
					<div class="flightfield c2">Flight</div>
					<div class="flightfield c3">Origin</div>
					<div class="flightfield c4">Status</div>
					<div class="flightfield c5">Scheduled</div>
					<div class="flightfield c6">Gate</div>
				</div>
				<?php
					$day = date("Ymd");
					$arrurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&arrap=lga&arrdate='.$day.'&arrhr=1200';
					$xml = file_get_contents($arrurl);
					$feed = simplexml_load_string($xml);
					echo '<div id="Data" class="arrivaldata">';
					$counter = "0";
					foreach ($feed->Flight as $arrival) {
						$airline = $arrival->FlightId->CommercialAirline->AirlineName;
						$flnum = $arrival->FlightId->FlightNumber;
						$origincity = $arrival->Departure->Airport->AirportLocation->CityName;
						$originstate = $arrival->Departure->Airport->AirportLocation->StateId;
						$arrstatus = $arrival->Arrival->ArrivalScheduleStatus;
						$arrtime = $arrival->Arrival->DateTime[1]->Time;
						$tz = 'America/Chicago';
						$timestamp = $arrtime;
						$arrscheduled = new DateTime($timestamp, new DateTimeZone($tz));
						$arrgate = $arrival->Arrival->Airport->Gate;
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
						$counter +=1;
						if ($counter == 2) {
							$counter = "0";
							echo '<div class="flight even">';
						} else {
							echo '<div class="flight">';
						}
						echo '<div class="flightvalue c1">'.$airline.'</div><div class="flightvalue c2"><span>Flight</span>'.$flnum.'</div><div class="flightvalue c3"><span>Origin</span>'.$origincity.', '.$originstate.'</div><div class="flightvalue c4"><span>Status</span>'.$arrrealstatus.'</div><div class="flightvalue c5"><span>Schedule</span>'.$arrscheduled->format('g:i a').'</div><div class="flightvalue c6"><span>Gate</span>'.$arrgate.'</div></div>';
					}
					echo '</div>';
				?>

			</div>
			<div id="departures">
				<div id="ResultsHeader" class="header">
					<div class="flightfield c1">Airline</div>
					<div class="flightfield c2">Flight</div>
					<div class="flightfield c3">To</div>
					<div class="flightfield c4">Status</div>
					<div class="flightfield c5">Scheduled</div>
					<div class="flightfield c6">Gate</div>
				</div>
				<?php
					$depurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&depap=lga&depdate='.$day.'&dephr=0000';
					$dxml = file_get_contents($depurl);
					$dfeed = simplexml_load_string($dxml);
					echo '<div id="Data" class="arrivaldata">';
					$counter = "0";
					foreach ($dfeed->Flight as $dep) {
						$dairline = $dep->FlightId->CommercialAirline->AirlineName;
						$dflnum = $dep->FlightId->FlightNumber;
						$dorigincity = $dep->Arrival->Airport->AirportLocation->CityName;
						$doriginstate = $dep->Arrival->Airport->AirportLocation->StateId;
						$depstatus = $dep->Departure->DepartureScheduleStatus;
						$deptime = $dep->Departure->DateTime[1]->Time;
						$dtz = 'America/Chicago';
						$dtimestamp = $deptime;
						$depscheduled = new DateTime($dtimestamp, new DateTimeZone($dtz));
						$depgate = $dep->Departure->Airport->Gate;
						$dstatus = $dep->FlightStatus;
						foreach ($dstatus->children() as $child) {
							if ($child->getName() == 'InGate') {
								$realstatus = 'In Gate';
							} elseif ($child->getName() == 'Landed') {
								$realstatus = 'Landed';
							} elseif ($child->getName() == 'Scheduled') {
								$realstatus = 'Scheduled';
							} elseif ($child->getName() == 'Proposed') {
								$realstatus = 'Proposed';
							} elseif ($child->getName() == 'InAir') {
								$realstatus = 'In Air';
							} elseif ($child->getName() == 'Cancelled') {
								$realstatus = 'Cancelled';
							} elseif ($child->getName() == 'NoTakeoffInfo') {
								$realstatus = 'No Takeoff Info';
							} elseif ($child->getName() == 'Delayed') {
								$realstatus = 'Delayed';
							} elseif ($child->getName() == 'Unknown') {
								$realstatus = 'Unknown';
							} elseif ($child->getName() == 'Outage') {
								$realstatus = 'Outage';
							} elseif ($child->getName() == 'Expected') {
								$realstatus = 'Expected';
							} elseif ($child->getName() == 'PastFlight') {
								$realstatus = 'Past Flight';
							}
						}
						$counter +=1;
						if ($counter == 2) {
							$counter = "0";
							echo '<div class="flight even">';
						} else {
							echo '<div class="flight">';
						}
						echo '<div class="flightvalue c1">'.$dairline.'</div><div class="flightvalue c2"><span>Flight</span>'.$dflnum.'</div><div class="flightvalue c3"><span>Origin</span>'.$dorigincity.', '.$doriginstate.'</div><div class="flightvalue c4"><span>Status</span>'.$realstatus.'</div><div class="flightvalue c5"><span>Scheduled</span>'.$depscheduled->format('g:i a').'</div><div class="flightvalue c6"><span>Gate</span>'.$depgate.'</div></div>';
					}
					echo '</div>';
				?>
			</div>
		</div>
	</section>
</div><!-- landing -->

<?php get_footer(); ?>