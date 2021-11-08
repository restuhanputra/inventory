<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{

  public function index()
  {
    $data = [
      'title' => 'Login'
    ];
    $page = 'index';
    $this->_template($page, $data);
  }

  public function forgot()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Forgot Password'
      ];
      $page = 'forgot';
      $this->_template($page, $data);
    } else {
      // kirim email reset password
      echo "kirim email reset password";
    }
  }

  public function sendemail()
  {
    $config = configemail();
    $this->email->initialize($config);
    $this->email->from('isi email', 'Tim Support Aplikasi Inventory');
    $this->email->to('isi email tujuan');
    $this->email->subject('Lupa Password');
    $body = '<h1>testing email</h1>';
    $this->email->message($body);
    if ($this->email->send()) {
      echo 'email terkirim';
    } else {
      echo $this->email->print->debugger();
    }
  }

  private function _validation()
  {
    $this->form_validation->set_rules(
      'email',
      'Email',
      'trim|required|valid_email',
      [
        'required' => '%s wajib diisi',
        'valid_email' => 'Wajib berisi %s yang valid',
      ],
    );
  }

  private function _template($page = null, $data = null)
  {
    $this->load->view('auth/template/header', $data);
    $this->load->view('auth/' . $page, $data);
    $this->load->view('auth/template/footer', $data);
  }
}
