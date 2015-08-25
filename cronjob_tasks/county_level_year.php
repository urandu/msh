<?php
include('connect.php');
// Make a MySQL Connection
$query = "SELECT period FROM county_level_data ORDER BY period DESC LIMIT 1"; 
	 
$result = mysql_query($query);
$period = array();
while($row = mysql_fetch_array($result)){
	
	$period[] = "{$row['period']}";
	
}
//convert the array into json for access in javascript
$period_json = json_encode($period);

//echo $period_json;
?>

 