<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->view('home/index');
    }

    public function page()
    {
        echo 'ini adalah controller home method page';
    }
}
