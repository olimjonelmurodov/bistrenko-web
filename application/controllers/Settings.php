<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
        public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
                        redirect('login');
                $this->load->model('settings_model');         
        }
	public function index(){
                $result = $this->settings_model->get_settings_desc();
                $this->load->cabtemplate('settings', array("page"=>"settings", "data"=>$result));
	}
	public function editsetting(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->settings_model->get_setting_desc($id);
                        $desc = $result[0]->desc;
                        $this->load->cabtemplate('editsetting', array("page"=>"editsetting", "data"=>$result, 'id'=>$id, 'desc'=>$desc));
                }
	}
	public function savesetting(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->settings_model->update_setting($id);
                        if ($result){
                                $this->session->set_flashdata('settingsaved',1);
                                redirect('settings');
                        }
                }
	}
}
