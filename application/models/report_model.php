<?php
class Forecast_model extends CI_Model 
{

	
	function __construct()
    {
       parent::__construct();
        
    }


public function get_pending_shipment_totals(){
	$this->db->select('*,SUM(pending_deliveries) AS PendingTotal');
	$this->db->group_by('commodity_id');
	$this->db->order_by('PendingTotal', 'desc'); 
	$query=$this->db->get('central_level_pending_stock',10);
	/*return $query->result();*/
	return $query->result();

  }



    public function get_facility_level_afc($period)
    {

        $sql="SELECT central_drugs_id,drug_id as ddd ,(SELECT mapping_name FROM mapping_drugs_category2 WHERE mapping_id=drug_id ) as commodity_name,period,drug_category_id,drug_value,(SELECT reporting_rate_value FROM central_reporting_rates where period ='{$period}') as reporting_rate ,((drug_value/(SELECT reporting_rate_value FROM central_reporting_rates where period ='{$period}'))*100) as AAC ,(((SELECT  drug_value   FROM central_level_drugs
                      WHERE
                        drug_category_id = 'rPAsF4cpNxm' AND drug_id = ddd AND period = '{$period}'
                     )/(SELECT reporting_rate_value FROM central_reporting_rates where period ='{$period}'))*100) as SOH FROM `central_level_drugs` where period='{$period}' and (drug_category_id= 'w77uMi1KzOH' ) order by drug_id asc , drug_category_id asc";
        $result=$this->db->query($sql);
        return $result->result();

    }














    public function get_county_level_acc($period,$county)
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
   FROM mapping_drugs_category2
   WHERE mapping_id = drug_id)                                                                        AS commodity_name,
  period,
  drug_category_id ,
  drug_value,

  (SELECT
  reporting_rate_value
   FROM county_reporting_rates
   WHERE period = {$period} AND county_id = '{$county}')                                               AS reporting_rate,



  ((((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period1}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period1} AND county_id = '{$county}')) * 100)  +(((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period2}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period2} AND county_id = '{$county}')) * 100)+(((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period3}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period3} AND county_id = '{$county}')) * 100)  )/3 AS AAC,





(((SELECT
                                                                                                             drug_value
                                                                                                                FROM county_level_drugs
                                                                                                                WHERE
                                                                                                                  drug_category_id = 'rPAsF4cpNxm' AND drug_id = ddd AND period = {$period}
                                                                                                                  AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                                                                                                                                    FROM county_reporting_rates
                                                                                                                                                    WHERE period = {$period} AND county_id = '{$county}')) * 100) as SOH
FROM `county_level_drugs`
WHERE period = {$period} AND (drug_category_id = 'w77uMi1KzOH' ) AND
      county_id = '{$county}'
ORDER BY drug_id ASC, drug_category_id ASC;";
        $result=$this->db->query($sql);
        return $result->result();

    }


    function show_forecast_commodity_data_periods(){
        $query = $this->db->get('static_parameters');
        $query_result = $query->result();
        return $query_result;
    }

    function get_facility_level_periods()
    {


        $query="SELECT DISTINCT period FROM central_level_drugs ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }


    function get_forecast_commodity_data_periods()
    {


        $query="SELECT DISTINCT period FROM static_parameters ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }

    function get_county_level_periods()
    {

        $query="SELECT DISTINCT period FROM county_level_drugs ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();
    }

    function get_county_level_names()
    {

        $query="SELECT * FROM counties ORDER by county_name ASC";

        $result=$this->db->query($query);

        return $result->result();
    }

    function get_all_county_level_commodities()
    {

        $query="SELECT DISTINCT drug_id,(SELECT mapping_name FROM mapping_drugs_category2 WHERE mapping_id = drug_id) AS drug_name FROM county_level_drugs ORDER by drug_name ASC";

        $result=$this->db->query($query);

        return $result->result();
    }

    function get_most_recent_county_period()
    {
        $query="SELECT period FROM county_level_drugs ORDER by period DESC LIMIT 1 ";

        $result=$this->db->query($query);

        return $result->result()[0]->period;
    }



    public function get_mos_of_commodity_in_county($county,$period,$commodity_id)
    {

        $period1=$period-1;
        $period2=$period-2;
        $period3=$period-3;

        $sql="SELECT
  county_drugs_id,
  drug_id                                                                                             AS ddd,
  (SELECT
  mapping_name
   FROM mapping_drugs_category2
   WHERE mapping_id = drug_id)                                                                        AS commodity_name,
  period,
  drug_category_id ,
  drug_value,

  (SELECT
  reporting_rate_value
   FROM county_reporting_rates
   WHERE period = {$period} AND county_id =  '{$county}')                                               AS reporting_rate,




  ((((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period1}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period1} AND county_id = '{$county}')) * 100)  +(((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period2}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period2} AND county_id = '{$county}')) * 100)+(((SELECT
  drug_value
     FROM county_level_drugs
     WHERE
       drug_category_id = 'w77uMi1KzOH' AND drug_id = ddd AND period = {$period3}
       AND county_id = '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                         FROM county_reporting_rates
                                         WHERE period = {$period3} AND county_id = '{$county}')) * 100)  )/3 AS AAC,




                                         (((SELECT
                                                                                                             drug_value
                                                                                                                FROM county_level_drugs
                                                                                                                WHERE
                                                                                                                  drug_category_id = 'rPAsF4cpNxm' AND drug_id = ddd AND period = {$period}
                                                                                                                  AND county_id =  '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                                                                                                                                    FROM county_reporting_rates
                                                                                                                                                    WHERE period = {$period} AND county_id =  '{$county}')) * 100) as SOH
FROM `county_level_drugs`
WHERE period = {$period} AND (drug_category_id = 'w77uMi1KzOH' ) AND
      county_id =  '{$county}' AND drug_id='{$commodity_id}'
ORDER BY drug_id ASC, drug_category_id ASC";
        $result=$this->db->query($sql);


        $result=$result->result();

        if(!empty($result[0]->SOH) && !empty($result[0]->AAC)){
            $mos=($result[0]->SOH)/($result[0]->AAC);
        }
        else
        {
            $mos=null;
        }

        return $mos;

    }



    public function get_forecast_commodity_data_mos($period)
    {

        $sql="SELECT staticparameterid,period,commodity_id as cid,(SELECT mapping_name FROM mapping_drugs_category2 WHERE mapping_id=cid) as commodity_name,projected_monthly_consumption,reporting_rate,(SELECT drug_value  FROM central_level_drugs WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid )as physical_count,((projected_monthly_consumption/reporting_rate)*100) as AAC,(((SELECT drug_value FROM central_level_drugs WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid)/reporting_rate)*100) as SOH FROM static_parameters WHERE period ='{$period}' order by cid";
        $result=$this->db->query($sql);
        return $result->result();

    }

    // public function get_facility_level_($period,$commodity)
    // {

    //     $sql="SELECT staticparameterid,period,commodity_id as cid,(SELECT commodity_name FROM commodities WHERE commodity_id=cid) as cname ,projected_monthly_consumption,reporting_rate ,((projected_monthly_consumption*reporting_rate)/100) as AAC FROM static_parameters WHERE period ='{$period}' AND commodity_id='{$commodity}' ";
    //     $result=$this->db->query($sql);
    //     if($result->num_rows>0)
    //     {

    //         return $result->result()[0];

    //     }else
    //     {
    //         $result->result();
    //     }


    // }




}

?>