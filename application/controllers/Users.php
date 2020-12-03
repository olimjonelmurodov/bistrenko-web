<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
        redirect('login');
        $this->load->model('users_model');         
    }
	public function index()
	{
                $limit = 5;
                if ($this->input->get('start') and $this->input->get('start')>0){
                        $start = $this->input->get('start');
                }
                else
                        $start = 0;
		$count = $this->users_model->get_users_count()[0]->count;

	$result = $this->users_model->get_users_desc($start, $limit);
        $this->load->cabtemplate('users', array("page"=>"users", "data"=>$result, "start"=>$start, "limit"=>$limit, "count"=>$count));
    }
}
