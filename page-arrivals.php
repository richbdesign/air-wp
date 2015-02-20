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
					$arrurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&arrap=lga&arrdate=20150218&arrhr=1200';
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
						$arrscheduled = date('g:i a', strtotime($arrtime));
						$arrgate = $arrival->Arrival->Airport->Gate;
						$counter +=1;
						if ($counter == 2) {
							$counter = "0";
							echo '<div class="flight even">';
						} else {
							echo '<div class="flight">';
						}
						echo '<div class="flightvalue c1">'.$airline.'</div><div class="flightvalue c2">'.$flnum.'</div><div class="flightvalue c3">'.$origincity.', '.$originstate.'</div>';
						if ($arrstatus == 'AO') {
						    echo '<div class="flightvalue c4">On-Time</div>';
						} elseif ($arrstatus == 'AE') {
						    echo '<div class="flightvalue c4">Early</div>';
						} elseif ($arrstatus == 'AD') {
						    echo '<div class="flightvalue c4">Delayed</div>';
						} else {
						    echo '<div class="flightvalue c4">On-Time</div>';
						}
						//echo '<div class="flightvalue c4">'.$arrstatus.'</div>';
						echo '<div class="flightvalue c5">'.$arrscheduled.'</div><div class="flightvalue c6">'.$arrgate.'</div></div>';
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
				</div>
				<?php
					$depurl = 'http://xml.flightview.com/fvXMLDemoConsis/fvxml.exe?a=fvxmldemoConse&b=thr324$sk94jh&depap=lga&depdate=20150219&dephr=0000';
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
						$depscheduled = date('g:i a', strtotime($deptime));
						$depgate = $dep->Arrival->Airport->Gate;
						$dstatus = $dep->FlightStatus;
						$counter +=1;
						if ($counter == 2) {
							$counter = "0";
							echo '<div class="flight even">';
						} else {
							echo '<div class="flight">';
						}
						echo '<div class="flightvalue c1">'.$dairline.'</div><div class="flightvalue c2">'.$dflnum.'</div><div class="flightvalue c3">'.$dorigincity.', '.$doriginstate.'</div>';
						if ($depstatus == 'DO') {
						    echo '<div class="flightvalue c4">On-Time</div>';
						} elseif ($depstatus == 'DE') {
						    echo '<div class="flightvalue c4">Early</div>';
						} elseif ($depstatus == 'DD') {
						    echo '<div class="flightvalue c4">Delayed</div>';
						} else {
						    echo '<div class="flightvalue c4">On-Time</div>';
						}
						//echo '<div class="flightvalue c4">'.$depstatus.'</div>';
						echo '<div class="flightvalue c5">'.$depscheduled.'</div>'.$dstatus.'</div>';
					}
					echo '</div>';
				?>
			</div>
		</div>
	</section>
</div><!-- landing -->

<?php get_footer(); ?>