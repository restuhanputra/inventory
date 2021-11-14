<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_department_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table         = 'm_department';
  }

  public function getAllData()
  {
    return $this->db->get($this->table);
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }
}
