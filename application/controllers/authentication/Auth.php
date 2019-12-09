<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_users');
    }

    public function cekAkun(){
    //membuat validasi login
    $username = $this->input->post('username',TRUE);
    $password = $this->input->post('password',TRUE);
    $query = $this->model_users->cekAkun($username, $password);
    
        if ($query === 1) {
            return "Username Tidak diTemukan!";
        } elseif ($query === 2) {
            return "Password Salah!";
        }
        else {
            //membuat session dengan nama userdata
            $userData = array(
<<<<<<< HEAD
                'id_user' => $query->id_user,
                'username' => $query->username,
                'password' => $query->password,
=======
                'id_user'  => $query->id_user,
                'username' => $query->username,
                'password' => $query->password,
                'nickname' =>$query->nickname,
>>>>>>> adc3525105ef7b45c07361596a2ca948c06e9ff7
                'type' => $query->type,
                'nickname' => $query->nickname,
                'logged_in' => TRUE,
            );
            $this->session->set_userdata($userData);
            return TRUE;
        }
    }

    public function login(){
        //melakukan pengalihan halaman sesuai dengan typenya
        if ($this->session->userdata('type') == "admin"){redirect('admin/admin');}
        if ($this->session->userdata('type') == "member"){redirect('member/member');}
        if ($this->session->userdata('type') == "operator"){redirect('pimpinan/dashboard');}
        if ($this->session->userdata('type') == "pjbt_pk"){redirect('pimpinan/dashboard');}

        //proses login dan validasi nya
        if ($this->input->post('submit')) {
        $this->load->model('Model_users');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $error = $this->cekAkun();
            if ($this->form_validation->run() && $error === TRUE) {
                $data = $this->Model_users->cekAkun($this->input->post('username'), $this->input->post('password'));

                //jika bernilai TRUE maka alihkan halaman sesuai dengan type nya
                if($data->type == 'admin'){
                redirect('admin/admin');
                }
                elseif ($data->type == 'operator') {
                redirect('pimpinan/dashboard');
                }
                else if($data->type == 'member'){
                redirect('member/member');
                } 
                elseif ($data->type == 'pjbt_pk') {
                redirect('pimpinan/dashboard');
                }
            }

            //Jika bernilai FALSE maka tampilkan error
            else{
            $data['error'] = $error;
            $this->load->view('authentication/login',$data);
                }
            }
        //Jika tidak maka alihkan kembali ke halaman login
        else{
            $this->load->view('authentication/login');
        }
    }


    public function logout(){
    //Menghapus semua session (sesi)
    $this->session->sess_destroy();
    redirect('authentication/auth/login');
    }
}