<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetUserRequest()
    {
        $this->db->order_by('nama_user', 'ASC');
        return $this->db->get('tbl_user')->result();
    }
    public function FindUserRequest($condition)
    {
        $this->db->limit(1);
        return $this->db->get_where('tbl_user', $condition)->result();
    }
    public function GetSupplierRequest($condition)
    {
        return $this->db->get_where('tbl_user', $condition)->result();
    }
    public function AddUserRequest($payload)
    {
        return $this->db->insert('tbl_user', $payload);
    }
    public function UpdateUserRequest($condition, $payload)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_user', $payload);
    }
    public function DeleteUserRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_user');
    }
    public function GetUserCount()
    {
        return $this->db->get_where('tbl_user', ["role" => "Supplier"])->num_rows();
    }
}
