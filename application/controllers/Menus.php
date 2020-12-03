<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
			redirect('login');
			$this->load->model('menus_model');         
	}
	public function index()
	{
		$result = $this->menus_model->get_menus_desc();
		$this->load->cabtemplate('menus', array("page"=>"menus", "data"=>$result));
	}
        
	public function savemenu(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->menus_model->update_menu($id);
                        if ($result){
                                $this->session->set_flashdata('menuedited',1);
                                redirect('menus');
                        }
                }
	}
	public function addmenu(){
                if (hasadminrights()){
                        $result = $this->menus_model->insert_menu();
                        if ($result){
                                $this->session->set_flashdata('menuadded',1);
                                redirect('menus');
                        }
                }
	}
	public function editmenu(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->menus_model->get_menu_desc($id);
                        $this->load->cabtemplate('editmenu', array("page"=>"editmenu", "data"=>$result, 'id'=>$id));
                }
	}
	public function deletemenu(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->menus_model->delete_menu($id);
                        redirect('menus');
                }
	}
}
