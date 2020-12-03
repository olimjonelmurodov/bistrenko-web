<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Couriers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
			redirect('login');
		$this->load->model('couriers_model');         
		$this->load->model('places_model');         
	}
	
	public function index()
	{
                $limit = 5;
                if ($this->input->get('start') and $this->input->get('start')>0)
                        $start = $this->input->get('start');
                else
                        $start = 0;
                if ($this->input->get('search'))
                        $search = strtolower($this->input->get('search'));
		else
			$search = "";
		$count = $this->couriers_model->get_couriers_count($search)[0]->count;
		$result = $this->couriers_model->get_couriers_desc($search, $limit, $start);
		$this->load->cabtemplate('couriers', array("page"=>"couriers", "search"=>$search, "data"=>$result, "start"=>$start, "limit"=>$limit, "count"=>$count));
	}
	public function addcourier(){
                if (hasadminrights()){
                        $result = $this->couriers_model->insert_courier();
                        if ($result){
                                $this->session->set_flashdata('courieradded',1);
                                redirect('couriers');
                        }
                }
	}
	public function savecourier(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->couriers_model->update_courier($id);
                        if ($result){
                                $this->session->set_flashdata('courieradded',1);
                                redirect('couriers');
                        }
                }
	}

	public function editcourier(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->couriers_model->get_courier_desc($id);
                        $this->load->cabtemplate('editcourier', array("page"=>"editcourier", "data"=>$result, 'id'=>$id));
                }
	}
	
	public function deletecourier(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->couriers_model->delete_courier($id);
                        redirect('couriers');
		}
	}

	

}
