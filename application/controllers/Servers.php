<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
			redirect('login');
		$this->load->model('servers_model');         
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
		$count = $this->servers_model->get_servers_count($search)[0]->count;
		$result = $this->servers_model->get_servers_desc($search, $limit, $start);
		$places = $this->places_model->get_places_desc();
		$this->load->cabtemplate('servers', array("page"=>"servers", "search"=>$search, "data"=>$result, "start"=>$start, "limit"=>$limit, "count"=>$count, "places"=>$places));
	}
	public function addserver(){
                if (hasadminrights()){
                        $result = $this->servers_model->insert_server();
                        if ($result){
                                $this->session->set_flashdata('serveradded',1);
                                redirect('servers');
                        }
                }
	}
	public function saveserver(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->servers_model->update_server($id);
                        if ($result){
                                $this->session->set_flashdata('serveradded',1);
                                redirect('servers');
                        }
                }
	}

	public function editserver(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->servers_model->get_server_desc($id);
                        $p = $this->places_model->get_places_desc();
                        $this->load->cabtemplate('editserver', array("page"=>"editserver", "data"=>$result, 'id'=>$id, 'places'=>$p));
                }
	}
	
	public function deleteserver(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->servers_model->delete_server($id);
                        redirect('servers');
		}
	}

}
