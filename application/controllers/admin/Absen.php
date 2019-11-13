<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends MY_Controller{
    public $db;
    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        if ($this->session->userdata('type') == "member") {
        redirect('member/member');
        }
        elseif ($this->session->userdata('type') == "operator"){
            redirect('pimpinan/dashboard');
        }
        $this->load->model('adminModel/Absen_model','absen_model');
        $this->load->library('breadcrumbs');
    }
    function index(){
        $this->breadcrumbs->push('Home','admin/');
        $this->breadcrumbs->push('Absen Lembur','admin/absen');
        $data['brcm'] = $this->breadcrumbs->show();
        $data['absen'] = $this->absen_model->absen();
        $this->load->view('admin/absen/index',$data);
    }
}