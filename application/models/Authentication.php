<?php

class Authentication extends CI_Model
{

    function SignInRequest($username, $password)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }

    function SignUpRequest($username, $password)
    {
        return $this->db->insert('tbl_user', $payload);
    }
}
