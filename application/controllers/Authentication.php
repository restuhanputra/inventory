<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
  public function index()
  {
    // $this->load->view('auth/template/header');
    // $this->load->view('auth/index');
    // $this->load->view('auth/template/footer');
    $data = [
      'title' => 'Login'
    ];
    $page = 'index';
    $this->_template($page, $data);
  }

  public function forgot()
  {
    // $this->load->view('auth/template/header');
    // $this->load->view('auth/forgot');
    // $this->load->view('auth/template/footer');

    $data = [
      'title' => 'Forgot Password'
    ];
    $page = 'forgot';
    $this->_template($page, $data);
  }

  private function _template($page = null, $data = null)
  {
    $this->load->view('auth/template/header', $data);
    $this->load->view('auth/' . $page, $data);
    $this->load->view('auth/template/footer', $data);
  }
}
