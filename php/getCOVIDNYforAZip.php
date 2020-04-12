<?php
include('mysqli.php');

$sql = "Select * From COVIDTestsByZip Where ZipCode='" . $_GET['ZipCode'] . "' Order By DateOfExtraction";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
	while($record = $result->fetch_assoc())
	{
		echo $record['ZipCode'] . ',' . date("n/j", strtotime($record['DateOfExtraction'])) . ',' . $record['TestedPositive'] . ',' . $record['Tested'] . "\r\n";
	}
} else {
	echo 0;
}
