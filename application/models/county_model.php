<?php
class County_model extends CI_Model
{

    //Function To Fetch Selected County Record
    function show_county_id($data)
    {
        $this->db->select('*');
        $this->db->from('counties');
        $this->db->where('county_id', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

// Function To Fetch All Counties Record
    function show_counties()
    {
        $this->db->order_by('county_name', 'asc');
        $query = $this->db->get('counties');
        $query_result = $query->result();
        return $query_result;
    }

    function update_counties_id1($id, $data)
    {
        $this->db->where('county_id', $id);
        $this->db->update('counties', $data);
    }

    function get_zone(){
        $this->db->select('*');
        $this->db->from('zones');
        $query = $this->db->get();
        return $query->result();
    }



    function get_zone_id($zone_name)
    {
        $this->db->select('zone_id');
        $this->db->from('zones');
        $this->db->where('zone', $zone_name);
        $query = $this->db->get();
        $result = $query->row()->zone_id;
        return $result;
    }


}
