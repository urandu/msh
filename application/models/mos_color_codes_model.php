<?php

class Mos_color_codes_model extends CI_Model
{


    function get_all()
    {

        $query = $this->db->get('mos_color_codes');


            return $query->result();

    }






    function get_color($color_id)
    {
        $this->db->where('color_id',$color_id);
        $colors=$this->db->get('mos_color_codes');
        return $colors->result();
    }

    function edit_color($color_id,$color)
    {
        $data = array(
            'color' => $color
        );
        $this->db->where('color_id', $color_id);
        $insert = $this->db->update('mos_color_codes', $data);

        return $insert;

    }



}

