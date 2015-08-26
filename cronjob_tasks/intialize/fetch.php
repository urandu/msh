
<?php
require "connect.php";
// Make a MySQL Connection
$query = "SELECT county_id FROM counties"; 
	 
$result = mysql_query($query);
$county = array();
while($row = mysql_fetch_array($result)){
	
	$county[] = "{$row['county_id']}";
	
}
//convert the array into json for access in javascript
$county_json = json_encode($county);

// echo $county_json;
?>

 