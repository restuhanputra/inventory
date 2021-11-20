<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_unit extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("Admin_unit_model", "Unit");
    $this->redirect = "unit";
  }

  /**
   * Menampilkan halaman Unit (satuan)
   *
   * @return void
   */
  public function index()
  {
    $unitData = $this->Unit->getAllData();
    $data = [
      'title'     => 'Data Satuan',
      'deskripsi' => 'Melihat data Satuan',
      'unitData'  => $unitData->result(),
    ];
    $page = 'unit/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data Unit (satuan)
   *
   * @param string $post('name')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title'     => 'Tambah Data Satuan',
        'deskripsi' => 'Menambah data satuan',
      ];
      $page = 'unit/create';
      template($page, $data);
    } else {
      $this->db->set("id", "UUID()", FALSE);
      $dataInsert = [
        'unit_name' => $this->input->post("name"),
      ];
      $insert = $this->Unit->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data Unit (satuan)
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Unit->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Unit->delete(['id' => $id]);
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

  /**
   * @description Update data Unit (satuan)
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $cek = $this->Unit->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row = $cek->row();
      $oldName = $row->unit_name;
      $this->_validation($oldName);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'     => 'Ubah Data Satuan',
          'deskripsi' => 'Mengubah data satuan',
          'unit'      => $row,
        ];
        $page = 'unit/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'unit_name' => htmlspecialchars($this->input->post("name")),
          'updated_at' => date("Y-m-d H:i:s",)
        ];
        $where = [
          'id' => $id
        ];
        $update = $this->Unit->update($dataUpdate, $where);
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

  /**
   * Validasi input
   *
   * @param string|null $name
   * @return void
   */
  private function _validation($name = null)
  {
    $postName = $this->input->post("name");
    if ($postName != $name) {
      $is_unique = '|is_unique[m_unit.unit_name]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'name',
      'Nama Satuan',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );
  }
}
