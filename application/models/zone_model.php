<?php
class zone_model extends CI_Model
{

    //Function To Fetch Selected zone Record
    function show_zone_id($data)
    {
        $this->db->select('*');
        $this->db->from('zones');
        $this->db->where('zone_id', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

// Function To Fetch All zones Record
    function show_zones()
    {
        $this->db->order_by('zone', 'asc');
        $query = $this->db->get('zones');
        $query_result = $query->result();
        return $query_result;
    }

    function update_zones_id1($id, $data)
    {
        $this->db->where('zone_id', $id);
        $this->db->update('zones', $data);
    }

    function add_zone($zone=NULL){
        $this->db->insert('zones', $zone);
        return $this->db->insert_id();
    }

    function delete_zone($zone_id){

        $this->db->where('zone_id', $zone_id);
        $this->db->delete('zones');
    }



}
