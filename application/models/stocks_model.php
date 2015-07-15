<?php
/**
 * Created by IntelliJ IDEA.
 * User: enock
 * Date: 7/9/15
 * Time: 4:49 PM
 */
class Stocks_model extends CI_Model{

function update_central_data($cdid,$cdData){
    $this->db->where('central_level_stock_id', $cdid);
    $this->db->update('central_level_data', $cdData);
}

function add_central_stock($central_data=NULL){
    $this->db->insert('central_level_data', $central_data);
    return $this->db->insert_id();
}

/*
function get_central_stock_by_period($period){
    $this->db->select('*');
    $this->db->where('period', $period)
    $this->db->from('central_level_data');
    $query = $this->db->get();
    return $query->result();
}*/



function show_central_stock(){
    $query = $this->db->get('central_level_data');
    $query_result = $query->result();
    return $query_result;

}
function show_central_stock_id($psdata){
    $this->db->select('*');
    $this->db->from('central_level_data');
    $this->db->where('central_level_stock_id', $psdata);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
}
}