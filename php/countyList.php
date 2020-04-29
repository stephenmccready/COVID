<?php
include('mysqli.php');

$sql = "SELECT DISTINCT RTrim(Z.County) As County, Sum(Case When CZ.DateOfExtraction=(SELECT MAX(DateOfExtraction) FROM COVIDTestsByZip) THEN CZ.TestedPositive ELSE 0 END) AS TestedPositive FROM zipcode AS Z LEFT OUTER JOIN COVIDTestsByZip AS CZ ON CZ.ZipCode = Z.Zip WHERE CZ.Tested > 0 GROUP BY Z.County ORDER BY Z.County";
$result = $connect->query($sql);

echo "<option value='All'>All NYC</option>";

if ($result->num_rows > 0) {
		while($record = $result->fetch_assoc())
		{
			$County = ucwords(strToLower(rTrim($record['County']))) . " County";
			echo "<option value='" . rTrim($record['County']) . "'>" . $County . " (" . number_format($record['TestedPositive']) . ")</option>";
		}
} else {
	echo 0;
}
