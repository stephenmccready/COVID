<?php
include('mysqli.php');

$sql = "SELECT DateOfExtraction, Sum(TestedPositive) AS TestedPositive, Sum(Tested) AS Tested "
		. "FROM COVIDTestsByZip " 
		. "WHERE DateOfExtraction NOT IN('2020-04-16','2020-04-26') "
		. "GROUP BY DateOfExtraction";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
	if($_GET['type'] == "cumulative") {
		while($record = $result->fetch_assoc())	{
			if($row != 0) {
				echo 'All,' . date("n/j", strtotime($record['DateOfExtraction'])) 
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
				echo 'All,' . date("n/j", strtotime($record['DateOfExtraction'])) 
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
