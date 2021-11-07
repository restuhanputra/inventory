<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
  public function index()
  {
    $this->load->view('auth/template/header');
    $this->load->view('auth/index');
    $this->load->view('auth/template/footer');
  }

  public function forgot()
  {
    $this->load->view('auth/template/header');
    $this->load->view('auth/forgot');
    $this->load->view('auth/template/footer');
  }
}
