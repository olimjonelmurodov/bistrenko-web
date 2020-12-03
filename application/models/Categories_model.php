<?php
class Categories_model extends CI_Model {
	

	public function insert_category()
	{
		$data = array(
			'uzbek' => $this->input->post('uzbek'),
			'russian' => $this->input->post('russian'),
			'placeid' => $this->input->post('placeid')
		);
		$this->db->insert('categories', $data);
		return true;
	}
	public function get_category_desc($id)
	{
		$query = $this->db
		->select('id, uzbek, russian, (SELECT uzbek from places where places.id=placeid) as place, placeid')
		->from('categories')
		->where('id', $id)
		->get()->result();
		return $query;
	}
	public function get_categories_desc()
	{

		$query = $this->db
		->select('id, uzbek, russian, (SELECT uzbek from places where places.id=placeid) as place')
		->from('categories')
		->order_by('id')
		->get()->result();
		return $query;
	}
	public function get_categories_desc_array()
	{

		$query = $this->db
		->select('id, uzbek, placeid')
		->from('categories')
		->order_by('id')
		->get()->result_array();
		return $query;
	}

	public function delete_category($id)
	{
		$this->db->delete('categories', array('id' => $id));
	}
	public function update_category($id)
	{
		$data = array(
			'uzbek' => $this->input->post('uzbek'),
			'russian' => $this->input->post('russian'),
			'placeid' => $this->input->post('placeid')
		);
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		return true;
	}
}
?>
