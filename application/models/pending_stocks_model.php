<?php
/**
 * Created by IntelliJ IDEA.
 * User: enock
 * Date: 7/9/15
 * Time: 4:46 PM
 */
function show_pending_shipment(){

    $transaction_status = "pending";
    $this->db->select('*');
    $this->db->from('pending_shipment_details');
    $this->db->where('transaction_status', $transaction_status);
    $query = $this->db->get();
    $query_result = $query->result();
    return $query_result;
}


function show_pending_shipment_id($psdata){
    //$transaction_state = "pending";
    $this->db->select('*');
    $this->db->from('pending_shipment_details');
    $this->db->where('pending_shipment_id', $psdata);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
}

function update_pending_shipment($psid,$pendingdata){
    $this->db->where('pending_shipment_id', $psid);
    $this->db->update('pending_shipment_details', $pendingdata);
}

function add_pending_shipment($pending=NULL){
    $this->db->insert('pending_shipment_details', $pending);
    return $this->db->insert_id();
}

