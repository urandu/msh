<?php
include('connect.php');

//HTTP GET request -Using Curl -Response JSON

$url="https://hiskenya.org/api/analytics?dimension=dx:JPaviRmSsJW&dimension=pe:LAST_12_MONTHS&filter=ou:HfVjCurKxh2&displayProperty=NAME";

// initailizing curl
$ch = curl_init();
//curl options
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
//execute
$result = curl_exec($ch);

//close connection
curl_close($ch);

if ($result){

	$result=json_decode($result,true);
	$json=$result['rows'];

	 foreach($json as $row)
    {

    $periodic = $row[1];
    $reportvalue = $row[2];

    $sql = "INSERT INTO facility_level_reporting_rates(reporting_rate_value,period)VALUES('$reportvalue','$periodic')";
    if(mysql_query($sql,$con))
    {
    	echo ("inserted successfully <br>");
        
    }else
       die('Error : ' . mysql_error()); 

    }

}

else{

    echo -1;
}

?>

