<?php
class Forecast_model extends CI_Model 
{

	
	function __construct()
    {
       parent::__construct();
        
    }
    function show_commodity_forecast_data(){
	$query = $this->db->get('commodity_forecast_data');
	$query_result = $query->result();
	return $query_result;
	}

	function show_commodity_forecast_data_id($datasp){
	$this->db->select('*');
	$this->db->from('commodity_forecast_data');
	$this->db->where('commodity_forecast_data_id', $datasp);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
	}


    function add_commodity_forecast_data($sp=NULL){	
    $this->db->insert('commodity_forecast_data', $sp);
    return $this->db->insert_id();						
	}

	function update_commodity_forecast_data_id($id,$data){
    $this->db->where('commodity_forecast_data_id', $id);
    $this->db->update('commodity_forecast_data', $data);
    }


    function get_commodity_forecast_data(){	
	$this->db->select('*');
	$this->db->from('commodity_forecast_data');				
	$query = $this->db->get();		
	return $query->result();			
	}






}

    ?>