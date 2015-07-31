<?php
class Commodity_model extends CI_Model
{
    // GET THE COMMODITY WITH NAME SAME AS THE NAME IN CENTRAL DATA
    function get_commodity_id_with_the_given_name($commodity_name)
    {
        $this->db->select('commodity_id');
        $this->db->from('malaria_commodities');
        $this->db->where('commodity_name', $commodity_name);
        $query = $this->db->get();
        $result = $query->row()->commodity_id;
        return $result;
    }

    // Function To Fetch All Commodies Record
    function show_malaria_commodities()
    {
        $query = $this->db->get('malaria_commodities');
        $query_result = $query->result();
        return $query_result;
    }


    function update_commodity($id, $data)
    {
        $this->db->where('commodity_id', $id);
        $this->db->update('malaria_commodities', $data);
    }

    /*this function adds a commodity to the database*/
    function add_commodity($commodity = NULL)
    {
        $this->db->insert('malaria_commodities', $commodity);
        return $this->db->insert_id();
    }
}
?>

