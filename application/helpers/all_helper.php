<?php

function template($page = null, $data = null)
{
  $ci = get_instance();
  $ci->load->view('admin/dashboard/template/header', $data);
  $ci->load->view('admin/dashboard/template/topbar', $data);
  $ci->load->view('admin/dashboard/template/sidebar', $data);
  $ci->load->view('admin/' . $page, $data);
  $ci->load->view('admin/dashboard/template/footer', $data);
}

function usetFlash()
{
  if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
  }
}
