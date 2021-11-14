<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_department extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("Admin_department_model", "Department");
    $this->redirect = "department";
  }

  public function index()
  {
    $departmentData = $this->Department->getAllData();
    $data = [
      'title'          => 'Data Departemen',
      'deskripsi'      => 'Melihat data departemen',
      'departmentData' => $departmentData->result(),
    ];
    $page = 'department/index';
    template($page, $data);
  }

  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title'     => 'Tambah Data Departemen',
        'deskripsi' => 'Menambah data departemen',
      ];
      $page = 'department/create';
      template($page, $data);
    } else {
      $this->db->set("id", "UUID()", FALSE);
      $dataInsert = [
        'department_name' => $this->input->post("name"),
      ];
      $insert = $this->Department->insert($dataInsert);
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
    $cek = $this->Department->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Department->delete(['id' => $id]);
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
    $cek = $this->Department->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row = $cek->row();
      $oldName = $row->department_name;
      $this->_validation($oldName);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'      => 'Ubah Data Departemen',
          'deskripsi'  => 'Mengubah data departemen',
          'department' => $row,
        ];
        $page = 'department/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'department_name' => htmlspecialchars($this->input->post("name")),
          'updated_at' => date("Y-m-d H:i:s",)
        ];
        $where = [
          'id' => $id
        ];
        $update = $this->Department->update($dataUpdate, $where);
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
      $is_unique = '|is_unique[m_department.department_name]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'name',
      'Nama Departemen',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );
  }
}
