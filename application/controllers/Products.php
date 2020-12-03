<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct() {
		parent::__construct();
		if (!isset($this->session) || $this->session->userdata('username')=='')
        redirect('login');
        $this->load->model('products_model');         
        $this->load->model('places_model');         
        $this->load->model('categories_model');         
    }
	public function index()
	{
                $limit = 5;
                if ($this->input->get('start') and $this->input->get('start')>0){
                        $start = $this->input->get('start');
                }
                else
                        $start = 0;
                if ($this->input->get('search')){
                        $search = strtolower($this->input->get('search'));
                }
                else
                        $search = "";
                $count = $this->products_model->get_products_count($search)[0]->count;
		$result = $this->products_model->get_products_desc($search, $limit, $start);
		$c = $this->categories_model->get_categories_desc_array();
		$lastplaceid=-1;
		if (!empty($this->session->userdata('lastcategory'))){
			for ($i=0; $i<count($c); $i++){
				if ($c[$i]['id']==$this->session->userdata('lastcategory'))
					$lastplaceid=$c[$i]['placeid'];
			}
		}
		$p = $this->places_model->get_places_desc();
		$this->load->cabtemplate('products', array("page"=>"products", "data"=>$result, "categories"=>json_encode($c), 
		"places"=>$p, "search"=>$search, "lastplaceid"=>$lastplaceid, "start"=>$start, "limit"=>$limit, "count"=>$count));
	}
        public function block()
        {
                if (hasadminrights()){
			if ($this->input->get('id')){
				$id = $this->input->get('id');
				$result = $this->products_model->block($id);
			}
			redirect('products');
                }
        }
        public function restore()
        {
                if (hasadminrights()){
			if ($this->input->get('id')){
				$id = $this->input->get('id');
				$result = $this->products_model->restore($id);
			}
			redirect('products');
                }
        }
	public function addproduct(){
                if (hasadminrights()){
			$this->session->set_userdata('lastcategory', $this->input->post('categoryid'));
                        $result = $this->products_model->insert_product();
                        if ($result){
                                $this->session->set_flashdata('productadded',1);
                                redirect('products');
                        }
                }
	}
	public function saveproduct(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->products_model->update_product($id);
                        if ($result){
                                $this->session->set_flashdata('productadded',1);
                                redirect('products');
                        }
                }
	}

	public function editproduct(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $result = $this->products_model->get_product_desc($id);
                        $c = $this->categories_model->get_categories_desc();
                        $productname = $result[0]->uzbek;
                        $this->load->cabtemplate('editproduct', array("page"=>"editproduct", "data"=>$result, 'id'=>$id, 'productname'=>$productname, 'categories'=>$c));
                }
	}
	
	public function deleteproduct(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->products_model->delete_product($id);
                        redirect('products');
	}
    }
}
