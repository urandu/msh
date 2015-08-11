<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function is_logged_in()
{
    $CI = &get_instance ();
    $user_data = $CI->session->all_userdata ();

    return isset ($user_data ['user_id']);
}


function subtract_date($date,$interval)
{
    $date = $date;
    $date = substr_replace($date, "-", 4, 0);
//echo($date);
    $newdate = strtotime ( '-'.$interval.' month' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m' , $newdate );

    return str_replace("-",null,$newdate);
}
/*date("Y/m/d")*/

function get_months($date){
$d1 = new DateTime($date);
$current_time = date("Y-m-d");
$d2 = new DateTime($current_time);
       

        //var_dump($d1->diff($d2)->m); // int(4)
return ($d1->diff($d2)->m + ($d1->diff($d2)->y*12));


}

function add_date($date,$interval)
{
    $date = $date;
    $date = substr_replace($date, "-", 4, 0);
//echo($date);
    $newdate = strtotime ( '+'.$interval.' month' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m' , $newdate );

    return str_replace("-",null,$newdate);
}



function get_color($color_id)
{
    $CI=get_instance();
    $CI->db->where('color_id',$color_id);
    $colors=$CI->db->get('mos_color_codes');
    return $colors->result()[0]->color;
}

function get_county_name($county_id)
{
    $CI=get_instance();
    $CI->load->model("report_model");
    return $CI->report_model->get_county_name($county_id);
}

function facility_level_period_exists($date)
{
    $CI=get_instance();
    $CI->db->where("period",$date);
    $result=$CI->db->get("facility_level_data");

    if($result->num_rows()>0)
    {
        return true;
    }
    else
    {

        return false;
    }
}


function central_level_period_exists($date)
{
    $CI=get_instance();
    $CI->db->where("period",$date);
    $result=$CI->db->get("current_stock");

    if($result->num_rows()>0)
    {
        return true;
    }
    else
    {

        return false;
    }
}

function county_level_period_exists($date)
{
    $CI=get_instance();
    $CI->db->where("period",$date);
    $result=$CI->db->get("county_level_data");

    if($result->num_rows()>0)
    {
        return true;
    }
    else
    {

        return false;
    }

}



function get_commodity_alias($commodity_name)
{
    $CI=get_instance();
    //$CI->db->where('commodity_name',$commodity_name);
    $colors=$CI->db->query("SELECT * FROM  malaria_commodities WHERE commodity_id =  '{$commodity_name}'");
    //print_r($colors->result());
    return $colors->result()[0]->alt_name;

}