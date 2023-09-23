<?php

class MRPModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetMRPRequest()
    {
        return $this->db->get('tbl_mrp')->result();
    }
    public function FindMRPRequest($condition)
    {
        $this->db->limit(1);
        return $this->db->get_where('tbl_mrp', $condition)->result();
    }
    public function AddMRPRequest($payload)
    {
        return $this->db->insert('tbl_mrp', $payload);
    }

    public function DeleteMRPRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_mrp');
    }
}
