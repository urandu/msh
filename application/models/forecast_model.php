<?php
class Forecast_model extends CI_Model 
{

	
	function __construct()
    {
       parent::__construct();
        
    }
    function show_commodity_forecast_data($period){
	$query = "SELECT commodity_forecast_data_id,forecast_start_date,forecast_period,commodity_id as cid,(SELECT commodity_name FROM malaria_commodities WHERE commodity_id=cid) as commodity_name,forecast_monthly_consumption FROM commodity_forecast_data WHERE forecast_start_date ='{$period}' order by cid";
	$result=$this->db->query($query);

    return $result->result();
	}

	function show_commodity_forecast_data_id($datasp){
	$this->db->select('*');
	$this->db->from('commodity_forecast_data');
	$this->db->where('commodity_forecast_data_id', $datasp);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
	}


    function add_commodity_forecast_data($fore=NULL){	
    $this->db->insert('commodity_forecast_data', $fore);
    return $this->db->insert_id();						
	}

	function update_forecast_commodity_data($id,$data){
    $this->db->where('commodity_forecast_data_id', $id);
    $this->db->update('commodity_forecast_data', $data);
    }

    function get_forecast_period()
    {


        $query="SELECT DISTINCT forecast_start_date FROM commodity_forecast_data ORDER by forecast_start_date DESC";


        $result=$this->db->query($query);

        return $result->result();


    }
    
    function get_commodity_forecast_data(){	
	$this->db->select('*');
	$this->db->from('commodity_forecast_data');				
	$query = $this->db->get();		
	return $query->result();			
	}

	
function get_commodity_id_with_the_given_name($commodity_name){
	$this->db->select('commodity_id');
	$this->db->from('malaria_commodities');
	$this->db->where('commodity_name', $commodity_name);
	$query = $this->db->get();
	$result = $query->row()->commodity_id;
	return $result;
	}






}

    ?>