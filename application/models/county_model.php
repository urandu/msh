<?php
/**
 * Created by IntelliJ IDEA.
 * User: enock
 * Date: 7/9/15
 * Time: 4:37 PM
 */

// Function To Fetch Selected County Record
function show_county_id($data){
    $this->db->select('*');
    $this->db->from('counties');
    $this->db->where('county_id', $data);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
}

// Function To Fetch All Counties Record
function show_counties(){
    $query = $this->db->get('counties');
    $query_result = $query->result();
    return $query_result;
}

function update_counties_id1($id,$data){
    $this->db->where('county_id', $id);
    $this->db->update('counties', $data);
}
