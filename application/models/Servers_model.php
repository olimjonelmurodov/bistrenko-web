<?php
class Servers_model extends CI_Model {
	

	public function insert_server()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'placeid' => $this->input->post('placeid')
		);
		$this->db->insert('servers', $data);
		return true;
	}
	public function get_server_desc($id)
	{
		$query = $this->db
		->select('id, phone, name, code, userid, placeid')
		->from('servers')
		->where('id', $id)
		->get()->result();
		return $query;
	}
	
	public function get_servers_desc($search="", $limit, $start)
	{

		$query = $this->db
		->select('servers.id as id, phone, name, code, userid, places.uzbek as place')
		->from('servers')
		->join('places', 'places.id=placeid', 'left');
		if ($search){
		$query = $query
				->like('LOWER(name)', $search)
				->or_like('phone', $search)
				->or_like('LOWER(places.uzbek)', $search);
		}
		$query = $query
		->limit($limit, $start)
		->order_by('servers.id DESC')
		->get()->result();
		return $query;
	}
	public function get_servers_count($search="")
	{
		if ($search){
			$query = $this->db
			->select('count(*) as count')
			->from('servers')
			->join('places', 'places.id=placeid', 'left')
			->like('LOWER(name)', $search)
			->or_like('phone', $search)
			->or_like('LOWER(places.uzbek)', $search)
			->get()->result();
		}
		else{
			$query = $this->db
			->select('count(*) as count')
			->from('servers')
			->get()->result();
		}
		return $query;
	}
	public function delete_server($id)
	{
		$this->db->delete('servers', array('id' => $id));
	}
	public function update_server($id)
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'code' => $this->input->post('code'),
			'placeid' => $this->input->post('placeid'),
			'name' => $this->input->post('name')
		);
		$this->db->where('id', $id);
		$this->db->update('servers', $data);
		return true;
	}
}
?>
