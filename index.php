<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>NY Covid Data</title>
    <link rel="shortcut icon" href="https://www.stephenmccready.asia/covid/favicon.ico" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
.chartContainer { float: left; margin: 0.5em; padding: 0.5em; text-align: center; border: 1px solid #DCDCDC;}
</style>
</head>
<body>
<div class="chartContainer">
	<select id="zipcodes0" onchange="drawChart('0');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput0"></div>
</div>
<div class="chartContainer">
	<select id="zipcodes1" onchange="drawChart('1');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput1"></div>
</div>
<div class="chartContainer">
	<select id="zipcodes2" onchange="drawChart('2');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput2"></div>
</div>
<div class="chartContainer">
	<select id="zipcodes3" onchange="drawChart('3');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput3"></div>
</div>
<div class="chartContainer">
	<select id="zipcodes4" onchange="drawChart('4');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput4"></div>
</div>
<div class="chartContainer">
	<select id="zipcodes5" onchange="drawChart('5');"><?php include('php/zipCodeList.php'); ?></select>
	<div class="chart" id="chartOutput5"></div>
</div>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
$(document).ready(function() {
	$('#zipcodes0').val('10011');
	$('#zipcodes1').val('10467');	// Bronx
	$("#zipcodes2").val('11219');	// Brooklyn
	$("#zipcodes3").val('10024');	// Manhattan
	$("#zipcodes4").val('11368');	// Queens
	$("#zipcodes5").val('10314');	// Staten Island
	google.setOnLoadCallback(drawChart("0"));
	google.setOnLoadCallback(drawChart("1"));
	google.setOnLoadCallback(drawChart("2"));
	google.setOnLoadCallback(drawChart("3"));
	google.setOnLoadCallback(drawChart("4"));
	google.setOnLoadCallback(drawChart("5"));
});

function drawChart(chartNum) {
	// Get the Data from csv file into a table
	var oReq = new XMLHttpRequest(); //New request object
	oReq.onload = function() {  
    	// Get and format the data into the zipArray
    	var phpData = this.responseText;
    	var zipArray = phpData.split("\r\n");
    	// Create the dataTable
    	var data = new google.visualization.DataTable();
    	data.addColumn('string', 'Date');
    	data.addColumn('number', 'Positive');
		data.addColumn({ type: 'string', role: 'style' });
    	data.addColumn('number', 'Negative');
		data.addColumn({ type: 'string', role: 'style' });
    	data.addColumn('number', 'Total Tests');
		data.addColumn({ type: 'string', role: 'style' });    
    	var cumulativeNegative = 0;
    	var cumulativePositive = 0;
    	// Populate the dataTable from the zipArray
    	for(var i=0;i<zipArray.length-1;i++) {
    		var zip=zipArray[i].split(",");
    		var testedPositive = parseInt(zip[2]);
    		var testedNegative = parseInt(zip[3]) - parseInt(zip[2]);
    		var testedTotal = testedPositive + testedNegative;
      		data.addRow([ zip[1], testedPositive, 'color: red', testedNegative, 'color: green', testedTotal, 'color: purple']);
    	}
    	var options = {
        	min: 0,
        	max: 3000,
    		legend: {position: 'top'},
			'width':375,
			'height':240,
			colors: ['red', 'green', 'purple'],
			hAxis: {slantedText:true, slantedTextAngle:90 },
			'chartArea': {'width': '80%', 'height': '75%'},
			pointSize: 5,
    	};   
		var chart = new google.visualization.LineChart(document.getElementById('chartOutput'+chartNum));
		chart.draw(data, options);
	};
	var phpURL="php/getCOVIDNYforAZip.php?ZipCode=" + $("#zipcodes"+chartNum).val();
	oReq.open("get", phpURL, true);
	oReq.send();
}
</script>
</body>
</html>
