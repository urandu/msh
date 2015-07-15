<?php
class Report_model extends CI_Model 
{

	
	function __construct()
    {
       parent::__construct();
        
    }
    function get_central_level_periods()
    {
      $query="SELECT DISTINCT report_date FROM central_level_data ORDER by report_date DESC";

        $result=$this->db->query($query);

        return $result->result();

    }

   function get_national_level_mos($period)
    {




    }



    function get_central_level_mos($period)
    {




    }

    function get_county_periods()
    {

        $query="SELECT DISTINCT period FROM county_level_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();
    }

   function get_county_names()
    {

        $query="SELECT * FROM counties ORDER by county_name ASC";

        $result=$this->db->query($query);

        return $result->result();
    }

    public function get_county_mos($period,$county)
    {
        $period1=$period-1;
        $period2=$period-2;
        $period3=$period-3;

        $sql="
SELECT
  county_drugs_id,
  drug_id                                                                                             AS ddd,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = drug_id)                                                                        AS commodity_name,
  period,
  drug_category_id ,
  drug_value,

  (SELECT
  reporting_rate_value
   FROM county_level_reporting_rates
   WHERE period = {$period} AND county_id = '{$county}')                                               AS reporting_rate,



  ((((SELECT
  drug_value
     FROM county_level_data
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period1}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_level_reporting_rates
                                         WHERE period = {$period1} AND county_id = '{$county}')) * 100)  +(((SELECT
  drug_value
     FROM county_level_data
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period2}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_level_reporting_rates
                                         WHERE period = {$period2} AND county_id = '{$county}')) * 100)+(((SELECT
  drug_value
     FROM county_level_data
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period3}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_level_reporting_rates
                                         WHERE period = {$period3} AND county_id = '{$county}')) * 100)  )/3 AS AAC,





(((SELECT
                                                                                                             drug_value
                                                                                                                FROM county_level_data
                                                                                                                WHERE
                                                                                                                  drug_category_id = 'rPAsF4cpNxm' AND drug_id = ddd AND period = {$period}
                                                                                                                  AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                                                                                                                                    FROM county_level_reporting_rates
                                                                                                                                                    WHERE period = {$period} AND county_id = '{$county}')) * 100) as SOH
FROM `county_level_data`
WHERE period = {$period} AND (drug_category_id = 'w77uMi1KzOH' ) AND
      county_id = '{$county}'
ORDER BY drug_id ASC, drug_category_id ASC;";
        $result=$this->db->query($sql);
        return $result->result();

    }



 public function get_facility_level_mos($period)
    {
      $period1=$period-1;
      $period2=$period-2;
      $period3=$period-3;
      $period4=$period-4;
      $period5=$period-5;
      $sql="SELECT central_drugs_id,drug_id as ddd,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id=drug_id ) as commodity_name,period,drug_category_id,drug_value as physical_count,(SELECT reporting_rate_value FROM facility_level_reporting_rates where period ='{$period}') as reporting_rate ,((SELECT  drug_value   FROM facility_level_data WHERE drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = '{$period}' )/(SELECT reporting_rate_value FROM facility_level_reporting_rates where period ='{$period}')) as adjusted_facility_amc FROM `facility_level_data` where period='{$period}' and (drug_category_id= 'rPAsF4cpNxm' ) order by drug_id asc , drug_category_id asc";
        $result=$this->db->query($sql);
        return $result->result();

    }








//function to fetch periods in facility level data table
 function get_facility_level_periods()
    {


        $query="SELECT DISTINCT period FROM facility_level_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }




   
    function get_forecast_commodity_data_periods()
    {


        $query="SELECT DISTINCT forecast_start_date FROM commodity_forecast_data ORDER by forecast_start_date DESC";

        $result=$this->db->query($query);

        return $result->result();

    }
    public function get_forecast_commodity_data_mos($period)
    {

        $sql="SELECT commodity_forecast_data_id,forecast_start_date,forecast_period,commodity_id as cid,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id=cid) as commodity_name,forecast_monthly_consumption,(SELECT drug_value  FROM facility_level_data WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid )as physical_count FROM commodity_forecast_data WHERE forecast_start_date ='{$period}' order by cid";
        $result=$this->db->query($sql);
        return $result->result();

    }


  

}

?>