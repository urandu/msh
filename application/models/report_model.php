<?php
class Report_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();

    }
    function get_central_level_periods()
    {
        $query="SELECT DISTINCT period FROM current_stock ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }



    public function forecast_variance_tracker($period)
    {

        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);

        $query="SELECT commodity_id as cid,forecast_start_date,forecast_period,forecast_monthly_consumption,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period}')as reporting_rate_value,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period1}')as reporting_rate_value1,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period2}')as reporting_rate_value2,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period3}')as reporting_rate_value3,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period4}')as reporting_rate_value4,
         (SELECT reporting_rate_value FROM `facility_level_reporting_rates`where period='{$period5}')as reporting_rate_value5,
        (SELECT commodity_name FROM malaria_commodities WHERE commodity_id = cid)as commodity_name,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period}' AND drug_id=cid )as actual_consumption,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period1}' AND drug_id=cid )as actual_consumption1,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period2}' AND drug_id=cid )as actual_consumption2,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period3}' AND drug_id=cid )as actual_consumption3,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period4}' AND drug_id=cid )as actual_consumption4,
        (SELECT drug_value FROM facility_level_data WHERE drug_category_id='w77uMi1KzOH' AND period='{$period5}' AND drug_id=cid )as actual_consumption5 
        FROM `commodity_forecast_data` order by cid";
        $result=$this->db->query($query);
        return $result->result();

    }

    function get_national_level_mos($period)
    {


        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);

        $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )

    )/1
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";



        if(central_level_period_exists($period1)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )


    )/2
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period2)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
       ( (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )

    )/3
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period3)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
       ( (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )

    )/4
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period4)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
       ( (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )


    )/5
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period5)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
       ( (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period5}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period5}'))*100
      )
    )/6
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        $result=$this->db->query($query);
        return $result->result();


    }

 function get_national_level_mos_no_reporting_rate($period)
    {


        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);


        $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )

    )/1
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";



        if(central_level_period_exists($period1)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}')
      )


    )/2
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period2)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}')
      )

      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}')
      )

    )/3
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period3)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}')
      )

      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}')
      )

    )/4
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period4)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}')
      )

      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}')
      )


    )/5
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }


        if(central_level_period_exists($period5)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (select drug_value from facility_level_data where drug_category_id='rPAsF4cpNxm' and drug_id=com_id and period='{$period}') as physical_count,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}')
      )

      +
      (
       (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}')
      )
      +
      (
        (SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period5}')
      )
    )/6
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        $result=$this->db->query($query);
        return $result->result();

    }



    function get_central_level_mos($period)
    {

        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);

        $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )

    )/1
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";



        if(central_level_period_exists($period1)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )



    )/2
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        if(central_level_period_exists($period2)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )

    )/3
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        if(central_level_period_exists($period3)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )

    )/4
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        if(central_level_period_exists($period4)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )

    )/5
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }



        if(central_level_period_exists($period5)==true)
        {
            $query="SELECT
  commodity_id                      AS com_id,
  soh               AS central_stock,
  (SELECT
  sum(quantity)
   FROM pending_shipment_details
   WHERE commodity_id = com_id)     AS pending_shipment,
  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = commodity_id) AS commodity_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period5}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period5}'))*100
      )
    )/6
  )
                                    AS adjusted_facility_amc


FROM current_stock
WHERE period = '{$period}'";
        }




        $result=$this->db->query($query);
        return $result->result();


    }

    function get_county_name($county_id)
    {
        $query="select county_name from counties where county_id='{$county_id}' LIMIT 1";
        $result=$this->db->query($query);
        return $result->result()[0]->county_name;
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
        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);

        $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )

    )/1
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";




        if(county_level_period_exists($period1)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )


    )/2
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";
        }



        if(county_level_period_exists($period2)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )

    )/3
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";
        }



        if(county_level_period_exists($period3)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )

    )/4
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";
        }



        if(county_level_period_exists($period4)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period4}' and county_id=coun_id))*100
      )

    )/5
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";
        }



        if(county_level_period_exists($period5)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period4}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period ='{$period5}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period5}' and county_id=coun_id))*100
      )
    )/6
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'";
        }



        $result=$this->db->query($sql);
        // print_r($result);
        //die("mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm");
        return $result->result();

    }



    public function get_facility_level_mos($period)
    {
        $count=1;
        $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )

    )/1
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";

        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);

        if(facility_level_period_exists($period1)==true)
        {

            $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

    )/2
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";

        }
       if(facility_level_period_exists($period2)==true)
       {
           $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )

    )/3
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";
       }
       if(facility_level_period_exists($period3)==true)
       {
           $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )

    )/4
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";
       }
       if(facility_level_period_exists($period4)==true)
       {
           $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )

    )/5
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";
       }

        if(facility_level_period_exists($period5)==true)
        {
            $query="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period}'))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period1}'))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period2}'))*100
      )
       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period3}'))*100
      )
       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period4}'))*100
      )

       +
      (
        ((SELECT
  drug_value
         FROM facility_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period5}') / (SELECT
  facility_level_reporting_rates.reporting_rate_value
                                       FROM facility_level_reporting_rates
                                       WHERE period = '{$period5}'))*100
      )

    )/6
  )
                                    AS adjusted_facility_amc


FROM facility_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm'";
        }

        $result=$this->db->query($query);
        return $result->result();

    }








//function to fetch periods in facility level data table
    function get_facility_level_periods()
    {


        $query="SELECT DISTINCT period FROM facility_level_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }




    function forecast_variance_periods()
    {


        $query="SELECT DISTINCT period FROM facility_level_data WHERE period >='201411' ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }


    function get_forecast_commodity_data_periods()
    {


        $query="SELECT DISTINCT period FROM facility_level_data ORDER by period DESC";

        $result=$this->db->query($query);

        return $result->result();

    }
    public function get_forecast_commodity_data_mos($period)
    {

        $sql="SELECT commodity_forecast_data_id,forecast_start_date,forecast_period,commodity_id as cid,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id=cid) as commodity_name,forecast_monthly_consumption,(SELECT drug_value  FROM facility_level_data WHERE drug_category_id='rPAsF4cpNxm' AND period='{$period}' AND drug_id=cid )as physical_count FROM commodity_forecast_data order by cid";
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
        $this->db->select('*, SUM(soh) as central_total');
        $this->db->group_by('commodity_id');
        $query = $this->db->get('current_stock');
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


    function get_most_recent_county_period()
    {
        $query="SELECT period FROM county_level_data ORDER by period DESC LIMIT 1 ";

        $result=$this->db->query($query);

        return $result->result()[0]->period;
    }

    function get_all_commodities()
    {

        $query="SELECT DISTINCT drug_id,(SELECT mapping_name FROM mapping_drugs_category WHERE mapping_id = drug_id) AS drug_name FROM county_level_data ORDER by drug_name ASC";

        $result=$this->db->query($query);

        return $result->result();
    }






    public function get_mos_of_commodity_in_county($county,$period,$commodity_id)
    {

        $period1=subtract_date($period,1);
        $period2=subtract_date($period,2);
        $period3=subtract_date($period,3);
        $period4=subtract_date($period,4);
        $period5=subtract_date($period,5);






        $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )

    )/1
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}' and drug_id='{$commodity_id}'";




        if(county_level_period_exists($period1)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )


    )/2
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}'  and drug_id='{$commodity_id}' ";
        }



        if(county_level_period_exists($period2)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )

    )/3
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}' and drug_id='{$commodity_id}' ";
        }



        if(county_level_period_exists($period3)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category

   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,

  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )

    )/4
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}' and drug_id='{$commodity_id}'  ";
        }



        if(county_level_period_exists($period4)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period4}' and county_id=coun_id))*100
      )

    )/5
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}' and drug_id='{$commodity_id}' ";
        }



        if(county_level_period_exists($period5)==true)
        {
            $sql="SELECT
  drug_id                      AS com_id,
  drug_value               AS physical_count,
  county_id as coun_id,

  (SELECT
  mapping_name
   FROM mapping_drugs_category
   WHERE mapping_id = com_id) AS commodity_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,(SELECT   alt_name    FROM malaria_commodities    WHERE commodity_id = com_id) AS alt_name,
  (
    (
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                            FROM county_level_reporting_rates
                                            WHERE period = '{$period}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period1}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period1}' and county_id=coun_id))*100
      )

      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period2}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period2}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period3}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period3}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period = '{$period4}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period4}' and county_id=coun_id))*100
      )
      +
      (
        ((SELECT
  drug_value
         FROM county_level_data
         WHERE drug_category_id = 'w77uMi1KzOH'
               AND drug_id = com_id
               AND period ='{$period5}' and county_id=coun_id) / (SELECT
  county_level_reporting_rates.reporting_rate_value
                                                             FROM county_level_reporting_rates
                                                             WHERE period = '{$period5}' and county_id=coun_id))*100
      )
    )/6
  )
                               AS adjusted_county_amc


FROM county_level_data
WHERE period = '{$period}' and drug_category_id='rPAsF4cpNxm' and county_id='{$county}' and drug_id='{$commodity_id}' ";
        }


        $result=$this->db->query($sql);


        $result=$result->result();

        if(!empty($result[0]->physical_count) && !empty($result[0]->adjusted_county_amc)){
            $mos=($result[0]->physical_count)/($result[0]->adjusted_county_amc);
        }
        else
        {
            $mos=null;
        }

        return $mos;

    }


    function show_sorted_pending_stock(){
    $this->db->distinct();
    $this->db->group_by('period DESC' );
    $query = $this->db->get('pending_shipment_details');
    $query_result = $query->result();
    return $query_result;

}
        function show_shipments_by_period($period){

        $this->db->select('*, SUM(quantity) AS PendingTotal');
         $this->db->group_by('commodity_id');
        $this->db->group_by('funding_agency_id');
        $this->db->from('pending_shipment_details');
        /*$this->db->where('period', $period);*/
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

      function show_pending_shipments_per_period($period){
        $this->db->select('*, SUM(quantity) AS PendingTotal');
        $this->db->group_by('commodity_id');
       /* $this->db->where('period', $period);*/
        $this->db->from('pending_shipment_details');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
        /*var_dump($query_result);*/



    }

      function show_central_stock_by_period($period){
        $this->db->select('*, SUM(soh) as central_total');
        $this->db->group_by('commodity_id');
        $this->db->where('period', $period);
        $query = $this->db->get('current_stock');
        $query_result = $query->result();
        return $query_result;

    }




}

?>