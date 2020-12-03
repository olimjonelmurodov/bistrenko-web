<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();   
		if (!empty($this->session->userdata('userid')))
			redirect('orders');  		
		$this->load->model('auth_model');
	}

	public function index($error="")
	{
		$this->load->view('login', array("error"=>$error));
	}
	public function checklogin()
	{
		$result = $this->auth_model->check_login();
		$password = $this->input->post('password');
		if (!empty($result) && password_verify($password, $result['password'])) {
			if ($result['state']==0){
				$this->session->set_userdata('userid', $result['id']);   
				$this->session->set_userdata('username', $result['username']);		
				$this->session->set_userdata('privilege', $result['privilege']);		
				redirect('/orders');
			}
			else{
				redirect('/login/index/blocked');
				return false;
			}
		} else {
			redirect('/login/index/wrongpass');
			return false;
		}
	}
}
