<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
        public function __construct() {
                parent::__construct();
                if (!isset($this->session) || $this->session->userdata('username')=='')
                        redirect('login');
                $this->load->model('categories_model');         
                $this->load->model('places_model');         
        }
        public function index()
        {
                $result = $this->categories_model->get_categories_desc();
                $p = $this->places_model->get_places_desc();
                $this->load->cabtemplate('categories', array("page"=>"categories", "data"=>$result, "places"=>$p));
        }
        public function addcategory(){
                if (hasadminrights()){
                        $result = $this->categories_model->insert_category();
                                if ($result){
                                        $this->session->set_flashdata('categoryadded',1);
                                        redirect('categories');
                                }
                }
        }
        public function savecategory(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->categories_model->update_category($id);
                        if ($result){
                                $this->session->set_flashdata('categoryupdated',1);
                                redirect('categories');
                        }
                }
        }
        public function editcategory(){
                if (hasadminrights()){                
                        $id = $this->input->get('id');
                        $result = $this->categories_model->get_category_desc($id);
                        $categoryname = $result[0]->uzbek;
                        $p = $this->places_model->get_places_desc();
                        $this->load->cabtemplate('editcategory', array("page"=>"editcategory", "data"=>$result, "id"=>$id, "categoryname"=>$categoryname, "places"=>$p));
                }       
        }
        
        public function deletecategory(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->categories_model->delete_category($id);
                        redirect('categories');
                }
        }
}
