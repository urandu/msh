<?php
/**
 * Created by IntelliJ IDEA.
 * User: urandu
 * Date: 7/16/15
 * Time: 1:03 AM
 */

//interval in months
function subtract_date($date,$interval)
{
    $date = "201505";
    $date = substr_replace($date, "-", 4, 0);
//echo($date);
    $newdate = strtotime ( '-6 month' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m' , $newdate );

    return str_replace("-",null,$newdate);
}

