<?php
$url = 'http://api.openweathermap.org/data/2.5/weather?q=Wichita,ks';
$content = file_get_contents($url);
$json = json_decode($content, true);
//$cities = $json['current'];
$city = $json['name'];
$temp = $json['main']['temp'];
$condid = $json['weather'][0]['id'];
$cond = $json['weather'][0]['main'];

function k_to_f($temp) {
    if ( !is_numeric($temp) ) { return false; }
    echo round((($temp - 273.15) * 1.8) + 32);
}

?>
<div class="weatherinfo">
	<?php
		if($condid > 799 and $condid < 801) {
			echo '<p class="clear wstatus">';
		}
		elseif($condid > 800 and $condid < 802) {
			echo '<p class="fewclouds wstatus">';
		}
		elseif($condid > 801 and $condid < 806) {
			echo '<p class="cloudy wstatus">';
		}
		elseif($condid > 199 and $condid < 233) {
			echo '<p class="storm wstatus">';
		}
		elseif($condid > 299 and $condid < 322) {
			echo '<p class="rain wstatus">';
		}
		elseif($condid > 499 and $condid < 532) {
			echo '<p class="rain wstatus">';
		}
		elseif($condid > 599 and $condid < 623) {
			echo '<p class="snow wstatus">';
		}
		elseif($condid > 700 and $condid < 782) {
			echo '<p class="alert wstatus">';
		}
		elseif($condid > 899 and $condid < 963) {
			echo '<p class="alert wstatus">';
		}
		else {
			echo '<p class="noinfo wstatus">';
		}
	?>
		<?php echo $cond; ?>
	</p>
	<p class="temp"><?php k_to_f($temp); ?>&deg<span>F</span></p>
</div>