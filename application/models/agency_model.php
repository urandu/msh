<?php 
class Agency_model extends CI_Model{
	/*-----------------------------------Supply chain agency--------------------------------------------*/

	// Function To Fetch All Supply chain Agency Record

	function show_supply_chain_agencies(){
	$query = $this->db->get('supply_chain_agencies');
	$query_result = $query->result();
	return $query_result;
	}
	// Function To Fetch Selected Supply Chain Agency Record
	function show_supply_chain_agencies_id($data){
	$this->db->select('*');
	$this->db->from('supply_chain_agencies');
	$this->db->where('supply_chain_agency_id', $data);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
	}

	function add_supply_chain_agency($agency=NULL){
		$this->db->insert('supply_chain_agencies', $agency);
		return $this->db->insert_id();
	}

	// Update Query For Selected Student
	function update_supply_chain_agencies_id1($id,$data){
	    $this->db->where('supply_chain_agency_id', $id);
	    $this->db->update('supply_chain_agencies', $data);
	}
	// GET THE SUPPLY AGENCY WITH NAME SAME AS THE NAME IN COMMODITY
	function get_agency_id_with_the_given_name($datas){
	$this->db->select('supply_chain_agency_id');
	$this->db->from('supply_chain_agencies');
	$this->db->where('supply_chain_agency', $datas);
	$query = $this->db->get();
	$result = $query->row()->supply_chain_agency_id;
	return $result;
	}
	/*--------------------------------------------------------------------------------------------------*/

	
	/*-------------------------------Funding Agency------------------------------------------------------*/
	function show_funding_orgs(){
	$query = $this->db->get('funding_agencies');
	$query_result = $query->result();
	return $query_result;
	}
	// Function To Fetch Selected Student Record
	function show_funding_org_id($dataf){
	$this->db->select('*');
	$this->db->from('funding_agencies');
	$this->db->where('funding_agency_id', $dataf);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
	}

	/*this function adds a funding agency to the database*/
	function add_funding_agency($fagency=NULL){
	$this->db->insert('funding_agencies', $fagency);
	return $this->db->insert_id();
    }


    /*this function gets a list of all funding agencies in the datbase*/
	function get_funding_agency(){
	$this->db->select('*');
	$this->db->from('funding_agencies');
	$query = $this->db->get();
	return $query->result();
    }

    /*this function updates data of a particular agency given its id*/
	function update_funding_agency($fid,$fdata){
    $this->db->where('funding_agency_id', $fid);
    $this->db->update('funding_agencies', $fdata);
	}


	function get_funding_agency_id($dataf){
	$this->db->select('funding_agency_id');
	$this->db->from('funding_agencies');
	$this->db->where('funding_agency_name', $dataf);
	$query = $this->db->get();
	$result = $query->row()->funding_agency_id;
	return $result;
	}


	/*---------------------------------------------------------------------------------------------------*/

} 
?>

