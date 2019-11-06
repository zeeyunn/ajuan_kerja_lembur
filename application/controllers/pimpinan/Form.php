<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        if ($this->session->userdata('type') == "admin") {
        redirect('admin/admin');
        }
        elseif ($this->session->userdata('type') == "member"){
            redirect('member/member');
        }
        $this->load->model('oprtModel/Form_model','form_model');
    }
    function index(){
        // $data['subunit'] = $this->form_model->get_data_sub();
        // $data['pegawai'] = $this->form_model->get_pegawai();
        $data['form_ajuan'] = $this->form_model->get_form_ajuan();
        $this->load->view('oprt/form/index',$data);
    }
    function detail($id_form_ajuan){
        $data['test'] = $this->form_model->get_form_detail($id_form_ajuan);
        $data['apa_yah'] = $this->form_model->get_pgw_detail($id_form_ajuan);
        $this->load->view('oprt/form/detail',$data);
    }
    function proses2(){
        // Proses terima
        $id=$this->input->post('id_form_ajuan',true);
        $this->db->set('status','2',false);
        $this->db->where('id_form_ajuan',$id);
        $this->db->update('form_ajuan_lembur');
        // proses absen
        
    }
    function absen($id_ajuan){
        $data = $this->form_model->get_ajuan($id_ajuan)->result();
        foreach ($data as $result) {
            $ajuan_id = $result->id_ajuan;
        }
        $this->session->set_flashdata('sukses',"");
		redirect('pimpinan/form');
    }
    function proses3(){
        $id=$this->input->post('id_form_ajuan',true);
        $this->db->set('status','3',false);
        $this->db->where('id_form_ajuan',$id);
        $this->db->update('form_ajuan_lembur');
        $this->session->set_flashdata('sukses',"");
		redirect('pimpinan/form');
    }
    function proses4(){
        $id=$this->input->post('id_form_ajuan',true);
        $this->db->set('status','4',false);
        $this->db->where('id_form_ajuan',$id);
        $this->db->update('form_ajuan_lembur');
        $this->session->set_flashdata('sukses',"");
		redirect('pimpinan/form');
    }
}