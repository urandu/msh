<?php
class planned_procurements_model extends CI_Model
{


    function show_all_planned_procurement()
    {

        $this->db->distinct();
        $this->db->group_by('planned_delivery_date');
        $query =$this->db->get('planned_procurement_details');
        $query_result = $query->result();
        return $query_result;

    }

    function show_planned_procurement($pdeliverydate)
    {

        $this->db->select('*');
        $this->db->from('planned_procurement_details');
        $this->db->where('planned_delivery_date', $pdeliverydate);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    function show_planned_procurement_id($ppdata)
    {
        $this->db->select('*');
        $this->db->from('planned_procurement_details');
        $this->db->where('planned_procurement_id', $ppdata);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function update_planned_procurement($ppid,$procurement_data)
    {
        $this->db->where('planned_procurement_id', $ppid);
        $this->db->update('planned_procurement_details', $procurement_data);
    }

    function add_planned_procurement($procurement = NULL)
    {
        $this->db->insert('planned_procurement_details', $procurement);
        return $this->db->insert_id();
    }

    function show_commodities(){
        $query = $this->db->get('malaria_commodities');
        $query_result = $query->result();
        return $query_result;
    }

// GET THE COMMODITY WITH NAME SAME AS THE NAME IN procurement COMMODITY
    function get_commodity_id_with_the_given_name($comm_name)
    {
        $this->db->select('commodity_id');
        $this->db->from('malaria_commodities');
        $this->db->where('commodity_name', $comm_name);
        $query = $this->db->get();
        $result = $query->row()->commodity_id;
        return $result;
    }


    function show_fundingorgs(){
        $query = $this->db->get('funding_agencies');
        $query_result = $query->result();
        return $query_result;
    }

    // GET THE FUNDING AGENCY WITH NAME SAME AS THE NAME IN COMMODITY

    function get_funding_agency_id($dataf){
        $this->db->select('funding_agency_id');
        $this->db->from('funding_agencies');
        $this->db->where('funding_agency_name', $dataf);
        $query = $this->db->get();
        $result = $query->row()->funding_agency_id;
        return $result;
    }


}
