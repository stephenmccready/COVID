# COVID
<h5>COVID 19 Test Results for New York City</h5>
<p>
Using data from: https://github.com/nychealth/coronavirus-data/blob/master/tests-by-zcta.csv<br/>
<br/>
https://www.stephenmccready.asia/covid/<br/>
Displays a graph of cumululative COVID 19 test results per NYC zip code for up to 6 zip codes<br/>
Uses jQuery & google visualization<br/>
</p>
Contents:<br/>
index.php: HTML, CSS & Javascript<br/>
createTables.sql: Code to create MySQL tables<br/>
zipcodelist.php: Gets a list of NYC zip codes for a drop down list<br/>
getCOVIDNYforAZip.php: Gets the historical cumulative COVID test results for a zip code<br/>
nyczipcodes.txt: tab delimited file of NYC zip codes, city and county<br/>
