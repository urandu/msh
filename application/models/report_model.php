<?php
class Report_model extends CI_Model 
{

	
	function __construct()
    {
       parent::__construct();
        
    }


public function get_pending_shipment_totals(){
	$this->db->select('*,SUM(quantity) AS PendingTotal');
	$this->db->group_by('commodity_id');
	$this->db->order_by('PendingTotal', 'desc'); 
	$query=$this->db->get('pending_shipment_details',10);
	/*return $query->result();*/
	return $query->result();

  }



    public function get_facility_level_afc($period)
    {

        $sql="SELECT central_drugs_id,drug_id as ddd ,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id=drug_id ) as commodity_name,period,drug_category_id,drug_value,(SELECT reporting_rate_value FROM facility_level_reporting_rates where period ='{$period}') as reporting_rate ,((drug_value/(SELECT reporting_rate_value FROM facility_level_reporting_rates where period ='{$period}'))*100) as AAC ,(((SELECT  drug_value   FROM facility_level_data
                      WHERE
                        drug_category_id = 'rPAsF4cpNxm' AND drug_id = ddd AND period = '{$period}'
                     )/(SELECT reporting_rate_value FROM facility_level_reporting_rates where period ='{$period}'))*100) as SOH FROM `facility_level_data` where period='{$period}' and (drug_category_id= 'w77uMi1KzOH' ) order by drug_id asc , drug_category_id asc";
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
                                                                                                                                                    FROM county_reporting_rates
                                                                                                                                                    WHERE period = {$period} AND county_id = '{$county}')) * 100) as SOH
FROM `county_level_data`
WHERE period = {$period} AND (drug_category_id = 'w77uMi1KzOH' ) AND
      county_id = '{$county}'
ORDER BY drug_id ASC, drug_category_id ASC;";
        $result=$this->db->query($sql);
        return $result->result();

    }


    function show_forecast_commodity_data_periods(){
        $query = $this->db->get('commodity_forecast_data');
        $query_result = $query->result();
        return $query_result;
    }

    function get_facility_level_periods()
    {


        $query="SELECT DISTINCT period FROM facility_level_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }


    function get_forecast_commodity_data_periods()
    {


        $query="SELECT DISTINCT period FROM commodity_forecast_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }

    function get_county_level_periods()
    {

        $query="SELECT DISTINCT period FROM county_level_data ORDER by period DESC";

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

        $query="SELECT DISTINCT drug_id,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id = drug_id) AS drug_name FROM county_level_data ORDER by drug_name ASC";

        $result=$this->db->query($query);

        return $result->result();
    }

    function get_most_recent_county_period()
    {
        $query="SELECT period FROM county_level_data ORDER by period DESC LIMIT 1 ";

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
   FROM mapping_drugs_category
   WHERE mapping_id = drug_id)                                                                        AS commodity_name,
  period,
  drug_category_id ,
  drug_value,

  (SELECT
  reporting_rate_value
   FROM county_level_reporting_rates
   WHERE period = {$period} AND county_id =  '{$county}')                                               AS reporting_rate,




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
                                                                                                                  AND county_id =  '{$county}') / (SELECT
                                                                                                             reporting_rate_value
                                                                                                                                                    FROM county_reporting_rates
                                                                                                                                                    WHERE period = {$period} AND county_id =  '{$county}')) * 100) as SOH
FROM `county_level_data`
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

        $sql="SELECT commodity_forecast_data_id,forecast_period,commodity_id as cid,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id=cid) as commodity_name,forecast_monthly_consumption,(SELECT drug_value  FROM facility_level_data WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid )as physical_count,forecast_monthly_consumption as AAC,(SELECT drug_value FROM facility_level_data WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid) as SOH FROM commodity_forecast_data WHERE period ='{$period}' order by cid";
        $result=$this->db->query($sql);
        return $result->result();

    }

    // Function To Fetch All Commodies Record
  function show_malaria_commodities(){
  $query = $this->db->get('malaria_commodities');
  $query_result = $query->result();
  return $query_result;
  }


  function show_pending_shipments(){
     $transaction_status = "pending";
    $this->db->select('*, SUM(quantity) AS PendingTotal');
     $this->db->group_by('commodity_id');
    $this->db->from('pending_shipment_details');
    $query = $this->db->get();
    $query_result = $query->result();
    return $query_result;
    /*var_dump($query_result);*/



  }

    function pending_shipments(){
     $transaction_status = "pending";
    $this->db->select('*, SUM(quantity) AS PendingTotal');
     $this->db->group_by('commodity_id');
     $this->db->group_by('funding_agency_id');
    $this->db->from('pending_shipment_details');
    $query = $this->db->get();
    $query_result = $query->result();
    return $query_result;
    /*var_dump($query_result);*/
    }
/*public function get_pending_shipment_totals(){
  $this->db->select('*,SUM(quantity) AS PendingTotal');
  $this->db->group_by('commodity_id');
  $this->db->order_by('PendingTotal', 'desc'); 
  $query=$this->db->get('pending_shipment_details',10);
  return $query->result();
  return $query->result();

  }*/

  function show_pending_shipment_per_commodity(){

   // $transaction_status = "pending";
    $this->db->group_by('commodity_id');
    $this->db->select_sum('quantity', 'total_per_commodity');
    $this->db->from('pending_shipment_details');
  // $this->db->group_by('commodity_id');
   // $this->db->where('transaction_status', $transaction_status);

    $query = $this->db->get();
    $query_result = $query->result();
    return $query_result;
}
  function show_funding_orgs(){
  $query = $this->db->get('funding_agencies');
  $query_result = $query->result();
  return $query_result;
  }
  /*public function get_pending_shipment_totals(){
    $this->db->select('*,SUM(quantity) AS PendingTotal');
    $this->db->group_by('commodity_id');
    $this->db->order_by('PendingTotal', 'desc'); 
    $query=$this->db->get('pending_shipment_details',10);
    return $query->result();
    return $query->result();

    }*/
function show_central_stock(){
  $this->db->select('*, SUM(soh_closing_balance) as central_total');
  $this->db->group_by('commodity_id');
    $query = $this->db->get('central_level_data');
    $query_result = $query->result();
    return $query_result;

}

function show_shipments(){

    $transaction_status = "pending";
    $this->db->select('*');
    $this->db->from('pending_shipment_details');
    $this->db->where('transaction_status', $transaction_status);
    $query = $this->db->get();
    $query_result = $query->result();
    return $query_result;
}

}

?>