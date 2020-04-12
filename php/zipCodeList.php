<?php
include('mysqli.php');

$sql = "SELECT DISTINCT Z.Zip, Z.City, Z.County, Max(CZ.TestedPositive) As TestedPositive FROM zipcode As Z JOIN COVIDTestsByZip AS CZ On CZ.ZipCode = Z.Zip Group By Z.Zip, Z.City, Z.County";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
		while($record = $result->fetch_assoc())
		{
			if(rTrim($record['City']) == rTrim($record['County'])) {
				$cityCounty = ucwords(strToLower(rTrim($record['City']))) . " County";
			} else {
				$cityCounty = ucwords(strToLower(rTrim($record['City']) . ", " . rTrim($record['County']))) . " County";
			}
		
			echo "<option value='" . rTrim($record['Zip']) . "'>" . rTrim($record['Zip']) . " " . $cityCounty . " (" . number_format($record['TestedPositive']) . ")</option>";
		}
} else {
	echo 0;
}
