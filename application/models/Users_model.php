<?php
class Users_model extends CI_Model {
	public function get_users_desc($start, $limit)
	{
			$query = $this->db
			->select('id, phone, userid')
			->from('customers')
			->limit($limit, $start)
			->order_by('id')
			->get()->result();
		return $query;
	}
	public function get_users_count()
	{
		$query = $this->db
		->select('count(*) as count')
		->from('customers')
		->get()->result();
		return $query;
	}
}
?>
