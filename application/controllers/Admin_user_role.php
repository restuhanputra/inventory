<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_user_role extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("Admin_user_role_model", "Role");
    $this->redirect = "role";
  }

  public function index()
  {
    $roleData = $this->Role->getAllData();
    $data = [
      'title'     => 'Data User Role',
      'deskripsi' => 'Melihat data user role',
      'roleData'  => $roleData->result(),
    ];
    $page = 'role/index';
    template($page, $data);
  }

  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title'     => 'Tambah User Role',
        'deskripsi' => 'Menambah user role',
      ];
      $page = 'role/create';
      template($page, $data);
    } else {
      $this->db->set("id", "UUID()", FALSE);
      $dataInsert = [
        'role_name' => $this->input->post("name"),
      ];
      $insert = $this->Role->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  public function delete($id)
  {
    $cek = $this->Role->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Role->delete(['id' => $id]);
      if ($delete > 0) {
        $this->session->set_flashdata("success", "Data berhasil dihapus");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
    } else {
      $this->session->set_flashdata("error", "Data tidak ada");
    }
    redirect($this->redirect);
  }

  public function update($id)
  {
    $cek = $this->Role->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row = $cek->row();
      $oldName = $row->role_name;
      $this->_validation($oldName);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'     => 'Ubah Data User Role',
          'deskripsi' => 'Mengubah data user role',
          'role'      => $row,
        ];
        $page = 'role/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'role_name' => htmlspecialchars($this->input->post("name")),
          'updated_at' => date("Y-m-d H:i:s",)
        ];
        $where = [
          'id' => $id
        ];
        $update = $this->Role->update($dataUpdate, $where);
        if ($update > 0) {
          $this->session->set_flashdata("success", "Data berhasil diupdate");
        } else {
          $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
        }
        redirect($this->redirect);
      }
    } else {
      $this->session->set_flashdata("error", "Data tidak ada");
      redirect($this->redirect);
    }
  }

  private function _validation($name = null)
  {
    $postName = $this->input->post("name");
    if ($postName != $name) {
      $is_unique = '|is_unique[m_user_role.role_name]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'name',
      'Nama User Role',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );
  }
}
