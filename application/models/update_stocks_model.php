<?php
/**
 * Created by IntelliJ IDEA.
 * User: enock
 * Date: 7/9/15
 * Time: 4:49 PM
 */
class Update_stocks_model extends CI_Model{


    function show_current_stock(){
        $query = $this->db->get('current_stock');
        $query_result = $query->result();
        return $query_result;
    }
    // Function To Fetch All Commodies Record
    function show_malaria_commodities(){
    $query = $this->db->get('malaria_commodities');
    $query_result = $query->result();
    return $query_result;
    }

    // GET THE COMMODITY WITH NAME SAME AS THE NAME IN CENTRAL DATA
    function get_commodity_id_with_the_given_name($commodity_name){
    $this->db->select('commodity_id');
    $this->db->from('malaria_commodities');
    $this->db->where('commodity_name', $commodity_name);
    $query = $this->db->get();
    $result = $query->row()->commodity_id;
    return $result;
    }
    function add_current_stock($data=NULL){
    $this->db->insert('current_stock', $data);
    return $this->db->insert_id();
}
function update_commodity($id,$data){
    $this->db->where('current_stock_id', $id);
    $this->db->update('current_stock', $data);
    }


     public function delete_current_data($id){         
        $this->db->where('current_stock_id', $id);
        $deleterecord=$this->db->delete('current_stock');
        


     }

}