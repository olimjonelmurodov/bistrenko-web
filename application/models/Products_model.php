<?php
class Products_model extends CI_Model {


        public function insert_product()
        {
                if ($_FILES['image']['tmp_name'])
                        $data = array(
                                'uzbek' => $this->input->post('uzbek'),
                                'russian' => $this->input->post('russian'),
                                'desc_uz' => $this->input->post('desc_uz'),
                                'desc_ru' => $this->input->post('desc_ru'),
                                'image' => pg_escape_bytea(file_get_contents($_FILES['image']['tmp_name'])),
                                'price' => $this->input->post('price')*100,
                                'categoryid' => $this->input->post('categoryid'),
                                'maxcount' => $this->input->post('maxcount') ? $this->input->post('maxcount'): 100
                        );
                else
                        $data = array(
                                'uzbek' => $this->input->post('uzbek'),
                                'russian' => $this->input->post('russian'),
                                'desc_uz' => $this->input->post('desc_uz'),
                                'desc_ru' => $this->input->post('desc_ru'),
                                'price' => $this->input->post('price')*100,
                                'categoryid' => $this->input->post('categoryid'),
                                'maxcount' => $this->input->post('maxcount') ? $this->input->post('maxcount'): 100
                        );
                $this->db->insert('products', $data);
                return true;
        }
        public function get_products_desc($search="", $limit, $start)
        {
                $query = $this->db
                ->select('products.id as id, products.uzbek as uzbek, products.russian as russian, (select uzbek from categories where categories.id = categoryid) as category,
                (select uzbek from places where places.id = (SELECT placeid from categories where categories.id = categoryid)) as place,
                price, (image is not NULL) as hasimage, isactive')
                ->from('products');
		if ($search){
                        $query = $query
                        ->join('categories', 'products.categoryid=categories.id', 'left')
                        ->join('places', 'categories.placeid=places.id', 'left')
                        ->like('LOWER(products.uzbek)', $search)
                        ->or_like('LOWER(products.russian)', $search)
                        ->or_like('LOWER(places.uzbek)', $search)
                        ->or_like('LOWER(categories.uzbek)', $search);
		}
                $query = $query
		->limit($limit, $start)
                ->order_by('products.id DESC')
                ->get()->result();
                return $query;
        }
	public function get_products_count($search="")
	{
		if ($search){
			$query = $this->db
			->select('count(*) as count')
			->from('products')
                        ->join('categories', 'products.categoryid=categories.id', 'left')
                        ->join('places', 'categories.placeid=places.id', 'left')
                        ->like('LOWER(products.uzbek)', $search)
                        ->or_like('LOWER(products.russian)', $search)
                        ->or_like('LOWER(places.uzbek)', $search)
                        ->or_like('LOWER(categories.uzbek)', $search)
			->get()->result();
		}
		else{
			$query = $this->db
			->select('count(*) as count')
			->from('products')
			->get()->result();
		}
		return $query;
	}
   	public function block($id)
	{
		$this->db->set('isactive', 0);
		$this->db->where('id', $id);
		$this->db->update('products');
		return true;	
	}    
   	public function restore($id)
	{
		$this->db->set('isactive', 1);
		$this->db->where('id', $id);
		$this->db->update('products');
		return true;	
	}    
        public function delete_product($id)
        {
                $this->db->delete('products', array('id' => $id));
        }
        public function get_product_desc($id)
        {
                $query = $this->db
                ->select('id, uzbek, russian, price, desc_uz, desc_ru, categoryid, maxcount')
                ->from('products')
                ->where('id', $id)
                ->get()->result();
                return $query;
        }

        public function update_product($id)
        {
                if ($_FILES['image']['tmp_name'])
                        $data = array(
                                'uzbek' => $this->input->post('uzbek'),
                                'russian' => $this->input->post('russian'),
                                'desc_uz' => $this->input->post('desc_uz'),
                                'desc_ru' => $this->input->post('desc_ru'),
                                'image' => pg_escape_bytea(file_get_contents($_FILES['image']['tmp_name'])),
                                'price' => $this->input->post('price')*100,
                                'maxcount' => $this->input->post('maxcount') ? $this->input->post('maxcount'): 100
                        );
                else
                        $data = array(
                                'uzbek' => $this->input->post('uzbek'),
                                'russian' => $this->input->post('russian'),
                                'desc_uz' => $this->input->post('desc_uz'),
                                'desc_ru' => $this->input->post('desc_ru'),
                                'price' => $this->input->post('price')*100,
                                'maxcount' => $this->input->post('maxcount') ? $this->input->post('maxcount'): 100
                        );
                $this->db->where('id', $id);
                $this->db->update('products', $data);
                return true;
        }
}
?>
