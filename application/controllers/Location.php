<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('couriers_model');         
	}
	
	public function sendlocation(){
		$this->couriers_model->update_courier_location();
	}
	public function checkpass(){
		$result = $this->couriers_model->get_id();
		if ($result)
			echo $result[0]->id.';'.$result[0]->name;
		else
			echo '-1';
	}
	
}
