<?php

class User_model extends CI_Model
{

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function validate($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user_table');

        if ($query->num_rows == 1) {
            return $query->result_array();
        }
        else{
            return null;
        }
    }




    //create_member

    function new_user($names,$phone_number,$national_id,$password,$email,$role=0)
    {

        $this->db->where('email', $email);
        $query = $this->db->get('user_table');


        if ($query->num_rows > 0) {
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
            echo "Email address already registered";
            echo '</strong></div>';
        } else {

            $new_user_insert_data = array(
                'names' => $names,
                'phone_number' => $phone_number,
                'national_id' => $national_id,
                'password' => md5($password),
                'email' => $email,
                'role'=>$role
            );
            $insert = $this->db->insert('user_table', $new_user_insert_data);
            return $insert;
        }
    }

    function edit_user($names,$phone_number,$national_id,$password,$email,$user_id)
    {

        if ($password==1111) {


            $new_user_insert_data = array(
                'phone_number' => $phone_number,
                'email' => $email,
                'names' => $names,
                'national_id'=>$national_id
            );


        } else {

            $new_user_insert_data = array(
                'phone_number' => $phone_number,
                'email' => $email,
                'names' => $names,
                'national_id'=>$national_id,
                'password'=>$password
            );

        }
        $this->db->where('user_id', $user_id);
        $insert = $this->db->update('user_table', $new_user_insert_data);

        return $insert;
    }


    function get_user($user_id)
    {
        $this->db->where('user_id',$user_id);
        $user=$this->db->get('user_table');
        return $user->result();
    }

    function get_all_users()
    {
        $users=$this->db->get('user_table');
        return $users->result();
    }

}

