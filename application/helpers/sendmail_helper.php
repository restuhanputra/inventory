<?php

function configemail()
{
  $config = [
    'protocol'  => 'smtp',
    'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_user' => 'isi email',
    'smtp_pass' => 'isi password',
    'smtp_port' => 465,
    'wordwrap'  => true,
    'mailtype'  => 'html',
    'charset'   => 'UTF-8',
    'newline'   => "\r\n",
  ];

  return $config;
}
