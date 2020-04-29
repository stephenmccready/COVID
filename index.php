<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NYC COVID Data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="https://www.stephenmccready.asia/covid/favicon.ico" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<style>
*{padding:0;margin-top:0.25em;text-align:center;font-family:Verdana,sans-serif;}
.chartContainer{float:left;margin-bottom:1em;text-align:center;}
.clearfix{overflow:auto;width:100%;}
#wholepage{width:100%;}
.footing{font-size:9px;}
select{font-size:12px;}
</style>
</head>
<body>
<header>
<div class="container">
  <div class="row">
    <div class="col-sm-7">
  	COVID testing data from NYC Dept. of Health and Mental Hygiene's <a href="https://github.com/nychealth/coronavirus-data">github</a>
    </div>
    <div class="col-sm-5">
    	<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
  			<label class="btn btn-sm btn-secondary active" id="labCumulative">
    			<input type="radio" name="options1" id="Cumulative" autocomplete="off" checked>Cumulative</label>
 			<label class="btn btn-sm btn-outline-secondary" id="labNew">
    			<input type="radio" name="options1" id="New" autocomplete="off">New Cases</label>
		</div>
    	<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
 			<label class="btn btn-sm btn-secondary active" id="labZips">
    			<input type="radio" name="options2" id="Zips" autocomplete="off" checked>Zips</label>
  			<label class="btn btn-sm btn-outline-secondary" id="labCounties">
    			<input type="radio" name="options2" id="Counties" autocomplete="off">Counties</label>
		</div>
	</div>
  </div>
</div>

</header>
<div class="container-fluid clearfix" id="wholepage">
	<div class="chartContainer">
		<select id="zipcodes0" onchange="drawChart('0');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput0"></div>
	</div>
	<div class="chartContainer">
		<select id="zipcodes1" onchange="drawChart('1');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput1"></div>
	</div>
	<div class="chartContainer">
		<select id="zipcodes2" onchange="drawChart('2');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput2"></div>
	</div>
	<div class="chartContainer">
		<select id="zipcodes3" onchange="drawChart('3');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput3"></div>
	</div>
	<div class="chartContainer">
		<select id="zipcodes4" onchange="drawChart('4');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput4"></div>
	</div>
	<div class="chartContainer">
		<select id="zipcodes5" onchange="drawChart('5');"><?php include('php/countyList.php'); include('php/zipCodeList.php'); ?></select>
		<div class="chart" id="chartOutput5"></div>
	</div>
</div>
<div class="clearfix footing">You can view more data on the <br/><a href="https://www1.nyc.gov/site/doh/covid/covid-19-data.page">NYC Department of Health's website</a><br/><br/></div>
<div hidden>
	<input type="text" id="type" value="cumulative">
</div>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
$(document).ready(function() {
	$('#zipcodes0').val('All');
	$('#zipcodes1').val('10467');	// Bronx
	$("#zipcodes2").val('11219');	// Brooklyn
	$("#zipcodes3").val('10032');	// Manhattan
	$("#zipcodes4").val('11368');	// Queens
	$("#zipcodes5").val('10314');	// Staten Island
	google.setOnLoadCallback(drawChart('0'));
	google.setOnLoadCallback(drawChart('1'));
	google.setOnLoadCallback(drawChart('2'));
	google.setOnLoadCallback(drawChart('3'));
	google.setOnLoadCallback(drawChart('4'));
	google.setOnLoadCallback(drawChart('5'));
});

$('#Cumulative').click(function() {
	$('#labCumulative').removeClass("btn-outline-secondary").addClass("btn-secondary active");
	$('#labNew').removeClass("btn-secondary active").addClass("btn-outline-secondary");
	$("#type").val("cumulative");
	google.setOnLoadCallback(drawChart('0'));
	google.setOnLoadCallback(drawChart('1'));
	google.setOnLoadCallback(drawChart('2'));
	google.setOnLoadCallback(drawChart('3'));
	google.setOnLoadCallback(drawChart('4'));
	google.setOnLoadCallback(drawChart('5'));
});

$('#New').click(function() {
	$('#labNew').removeClass("btn-outline-secondary").addClass("btn-secondary active");
	$('#labCumulative').removeClass("btn-secondary active").addClass("btn-outline-secondary");
	$("#type").val("new");
	google.setOnLoadCallback(drawChart('0'));
	google.setOnLoadCallback(drawChart('1'));
	google.setOnLoadCallback(drawChart('2'));
	google.setOnLoadCallback(drawChart('3'));
	google.setOnLoadCallback(drawChart('4'));
	google.setOnLoadCallback(drawChart('5'));
});

$('#Counties').click(function() {
	$('#labCounties').removeClass("btn-outline-secondary").addClass("btn-secondary active");
	$('#labZips').removeClass("btn-secondary active").addClass("btn-outline-secondary");
	$('#zipcodes0').val('All');
	$('#zipcodes1').val('BRONX');		// Bronx
	$("#zipcodes2").val('KINGS');		// Brooklyn
	$("#zipcodes3").val('NEW YORK');	// Manhattan
	$("#zipcodes4").val('QUEENS');		// Queens
	$("#zipcodes5").val('RICHMOND');	// Staten Island
	google.setOnLoadCallback(drawChart('0'));
	google.setOnLoadCallback(drawChart('1'));
	google.setOnLoadCallback(drawChart('2'));
	google.setOnLoadCallback(drawChart('3'));
	google.setOnLoadCallback(drawChart('4'));
	google.setOnLoadCallback(drawChart('5'));
});

$('#Zips').click(function() {
	$('#labZips').removeClass("btn-outline-secondary").addClass("btn-secondary active");
	$('#labCounties').removeClass("btn-secondary active").addClass("btn-outline-secondary");
	$('#zipcodes0').val('All');
	$('#zipcodes1').val('10467');	// Bronx
	$("#zipcodes2").val('11219');	// Brooklyn
	$("#zipcodes3").val('10032');	// Manhattan
	$("#zipcodes4").val('11368');	// Queens
	$("#zipcodes5").val('10314');	// Staten Island
	google.setOnLoadCallback(drawChart('0'));
	google.setOnLoadCallback(drawChart('1'));
	google.setOnLoadCallback(drawChart('2'));
	google.setOnLoadCallback(drawChart('3'));
	google.setOnLoadCallback(drawChart('4'));
	google.setOnLoadCallback(drawChart('5'));
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
    	var	txtBold=false;
    	var maxNum=4000;
    	
    	if($("#type").val()=="new"){
			maxNum=400;
		} else {
			maxNum=5000;
		}
    	if($("#zipcodes"+chartNum).val()=='All'){
    		txtBold=true;
    		if($("#type").val()=="new"){
				maxNum=2000;
			} else {
				maxNum=250000;
			}
    	} else {
			if (isNaN($("#zipcodes"+chartNum).val()) !== false) {	
    			if($("#type").val()=="new"){
					maxNum=7000;
				} else {
					maxNum=60000;
				}
			}
		}
    	var options = {
    		min: 0,
    		max: maxNum,
    		legend: {position: 'top'},
			'width':385,
			'height':185,
			colors: ['red', 'green', 'purple'],
			hAxis: {slantedText:true, slantedTextAngle:90 },
			vAxis: {format: 'short', textStyle: {bold: txtBold} },
			'chartArea': {'width': '80%', 'height': '60%'},
			pointSize: 5,
    	};
		var chart = new google.visualization.LineChart(document.getElementById('chartOutput'+chartNum));
		chart.draw(data, options);
	};
	var phpURL="php/getCOVIDNYforAZip.php?ZipCode=" + $("#zipcodes"+chartNum).val() + "&type=" + $("#type").val();
	if($("#zipcodes"+chartNum).val()=='All'){
		var phpURL="php/getCOVIDAll.php?type=" + $("#type").val();;
	} else {
		if (isNaN($("#zipcodes"+chartNum).val()) !== false) {	
			var phpURL="php/getCOVIDForACounty.php?County="+$("#zipcodes"+chartNum).val() + "&type=" + $("#type").val();;
		}
	}
	console.log(phpURL);
	oReq.open("get", phpURL, true);
	oReq.send();
}
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
