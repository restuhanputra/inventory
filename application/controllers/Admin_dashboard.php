<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * @description Menampilkan halaman Dashboard (admin)
   *
   * @return void
   */
  public function index()
  {
    $data = [
      'title'     => 'Dashboard',
      'deskripsi' => 'Melihat data dashboard',
    ];
    $page = 'dashboard/index';
    template($page, $data);
  }
}
