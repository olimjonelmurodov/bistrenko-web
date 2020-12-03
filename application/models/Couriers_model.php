<?php
class Couriers_model extends CI_Model {
	

	public function insert_courier()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
		);
		$this->db->insert('couriers', $data);
		return true;
	}
	public function get_courier_desc($id)
	{
		$query = $this->db
		->select('id, phone, name, code, userid')
		->from('couriers')
		->where('id', $id)
		->get()->result();
		return $query;
	}
	
	public function get_couriers_desc($search="", $limit, $start)
	{

		$query = $this->db
		->select('couriers.id as id, phone, name, code, userid')
		->from('couriers');
		if ($search){
		$query = $query
				->like('LOWER(name)', $search)
				->or_like('phone', $search);
		}
		$query = $query
		->limit($limit, $start)
		->order_by('couriers.id DESC')
		->get()->result();
		return $query;
	}
	public function get_couriers_count($search="")
	{
		if ($search){
			$query = $this->db
			->select('count(*) as count')
			->from('couriers')
			->like('LOWER(name)', $search)
			->or_like('phone', $search)
			->get()->result();
		}
		else{
			$query = $this->db
			->select('count(*) as count')
			->from('couriers')
			->get()->result();
		}
		return $query;
	}
	public function delete_courier($id)
	{
		$this->db->delete('couriers', array('id' => $id));
	}
	public function update_courier($id)
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'code' => $this->input->post('code'),
			'name' => $this->input->post('name')
		);
		$this->db->where('id', $id);
		$this->db->update('couriers', $data);
		return true;
	}
	
	public function update_courier_location()
	{
		$data = array(
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('couriers', $data);
		return true;
	}
	
	public function get_id(){
		$query = $this->db
		->select('id, name')
		->from('couriers')
		->where('code', $this->input->post('code'))
		->get()->result();
		return $query;
	}
}

?>
