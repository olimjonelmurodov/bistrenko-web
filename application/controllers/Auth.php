<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
        public function __construct() {
                parent::__construct();
                        if (empty($this->session->userdata('username')))
                                redirect('login');
                        $this->load->model('auth_model');
                }

        public function index()
        {                       
                if (hasadminrights()){
                        $result = $this->auth_model->get_auth_desc();
                        $in = $this->session->flashdata('selfdelete');
                        $this->load->cabtemplate('auth', array("page"=>"auth", "data"=>$result, "in"=>$in));
                }
        }
        public function changepasswordindex($error="")
        {
                $this->load->cabtemplate('changepassword', array("page"=>"changepassword"));
        }
        public function changepassword()
        {
                $result = $this->auth_model->check_login_by_session($this->session->userdata('username'));
                $password = $this->input->post('oldpassword');
                if (!empty($result) && password_verify($password, $result['password'])) {
                        $result = $this->auth_model->changepassword($this->session->userdata('userid'));
                        if ($result){
                                $this->session->set_flashdata('passwordchanged',1);
                                redirect('orders');
                        }
                }
                else {
                        $this->load->cabtemplate('changepassword', array("error"=>"wrongpass", "page"=>"changepassword"));
                }
        }
        public function addauth()
        {
                if (hasadminrights()){
                        $result = $this->auth_model->insert_auth();
                        if ($result){
                                $this->session->set_flashdata('authadded',1);
                                redirect('auth');
                        }
                }
        }
        public function deleteauth(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        if ($this->session->userdata('userid')!=$id){
                                $this->auth_model->delete_auth($id);
                                redirect('auth');
                        }
                        else{
                                $this->session->set_flashdata('selfdelete',-1);
                                redirect('auth');
                        }
                }
        }
        public function logout(){
                $this->session->sess_destroy();
                redirect('/login');
        }
}
