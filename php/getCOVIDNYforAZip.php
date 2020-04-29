<?php
include('mysqli.php');

$sql = "SELECT * FROM COVIDTestsByZip WHERE ZipCode='" . $_GET['ZipCode'] . "' "
		. "AND DateOfExtraction NOT IN('2020-04-16','2020-04-26') "
		. "ORDER BY DateOfExtraction";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
	if($_GET['type'] == "cumulative") {
		while($record = $result->fetch_assoc())	{
			if($row != 0) {
				echo $record['ZipCode'] . ',' . date("n/j", strtotime($record['DateOfExtraction'])) 
					. ',' . $record['TestedPositive'] . ',' . $record['Tested'] . "\r\n";
			}
			$row++;
		}
	} else {
		$row=0; $storeTestedPositive=0; $storeTested=0;
		while($record = $result->fetch_assoc())
		{
			if($row != 0) {
				$TestedPositive = $record['TestedPositive'] - $storeTestedPositive;
				$Tested = $record['Tested'] - $storeTested;			
				echo $record['ZipCode'] . ',' . date("n/j", strtotime($record['DateOfExtraction'])) 
					. ',' . $TestedPositive . ',' . $Tested . "\r\n";
			}	
			$storeTestedPositive = $record['TestedPositive'];
			$storeTested = $record['Tested'];
			$row++;
		}
	}
} else {
	echo 0;
}
