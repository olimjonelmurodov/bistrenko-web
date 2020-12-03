<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends CI_Controller {
    public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
        redirect('login');
        $this->load->model('places_model');         
        $this->load->model('menus_model');         
    }
	public function index()
	{
		$result = $this->places_model->get_places_desc();
		$m = $this->menus_model->get_menus_desc();
		$this->load->cabtemplate('places', array("page"=>"places", "data"=>$result, "menus"=>$m));
	}
        
	public function addplace(){
                if (hasadminrights()){
                        $result = $this->places_model->insert_place();
                        if ($result){
                                $this->session->set_flashdata('placeadded',1);
                                redirect('places');
                        }
                }
	}
	public function saveplace(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->places_model->update_place($id);
                        if ($result){
                                $this->session->set_flashdata('placeadded',1);
                                redirect('places');
                        }
                }
	}

	public function editplace(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->places_model->get_place_desc($id);
                        $pm = $this->places_model->get_place_menus_desc($id);
			var_dump($pm);
			$m = $this->menus_model->get_menus_desc();
                        $placename = $result[0]->uzbek;
                        $this->load->cabtemplate('editplace', array("page"=>"editplace", "data"=>$result, 'id'=>$id, 'placename'=>$placename, 'menus'=>$m, 'place_menus'=>$pm));
                }
	}
	
	public function deleteplace(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->places_model->delete_place($id);
                        redirect('places');
                }
    }
}
