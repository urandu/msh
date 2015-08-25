<?php
include('connect.php');
include('facility_level_reporting_rates_year.php');
//API login Credentials
$username="Bootcamp";
$password="Bootcamp2015";
$html=json_decode($period_json);
function add_date($date,$interval)
{
    $date = $date;
    $date = substr_replace($date, "-", 4, 0);
//echo($date);
    $newdate = strtotime ( '+'.$interval.' month' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m' , $newdate );

    return str_replace("-",null,$newdate);
}
$last_month=add_date($html[0],1);

//HTTP GET request -Using Curl -Response JSON

$url="http://test.hiskenya.org/api/analytics?dimension=dx:JPaviRmSsJW&dimension=pe:LAST_12_MONTHS&filter=ou:HfVjCurKxh2&displayProperty=NAME";
// $url_orgUnit="http://test.hiskenya.org/api/organisationUnits";

// $data = array("dataSet" => "$dataset", "period" => "$period", "orgUnit" => "$orgUnit");
// $data_string = http_build_query($data);
// $url.="$data_string";

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
	//print_r($json);

	 foreach($json as $row)
    { 
     if($row[1]==$last_month)
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

}

else{

    echo -1;
}

?>

