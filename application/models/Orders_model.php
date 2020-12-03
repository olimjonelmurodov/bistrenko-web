<?php
class Orders_model extends CI_Model {
        
	public function get_orders_desc($search="", $limit, $start)
	{
		$query = $this->db
		->select('orders.id, phone, orientation, date::timestamp(0), status, is_read, SUM(value*price) as price, shown_price')
		->from('ordered_products')
		->join('orders', 'orders.id=orderid','left')
		->join('products', 'products.id=productid','left')
		->join('customers', 'orders.customerid=customers.id','left');
		if ($search){
		$query = $query
				->like('LOWER(orientation)', $search)
				->or_like('phone', $search);
		}
		$query = $query
				->group_by('orders.id, phone')
				->limit($limit, $start)
				->order_by('orders.id DESC')
				->get()->result();
		return $query;
	}
	public function get_products()
	{
			$query = $this->db
			->select('id, uzbek')
			->from('products')
			->get()->result();
		return $query;
	}
	public function get_products_in_orders_desc($id)
	{
		$query = $this->db
		->select('(select uzbek from products where products.id = productid) as uzbek, (select price from products where products.id = productid) as price, value')
		->from('ordered_products')
		->where('orderid', $id)
		->get()->result();
		return $query;
	}

	public function get_orders_export($vals)
	{
		if ($vals){
				$query = $this->db
				->select('orders.id, phone, orientation, date::timestamp(0), status, is_read, SUM(value*price) as price, shown_price')
				->from('ordered_products')
				->join('orders', 'orders.id=orderid','left')
				->join('products', 'products.id=productid','left')
				->join('customers', 'orders.customerid=customers.id','left')
				->group_by('orders.id, phone')
				->where($vals, NULL, FALSE)
				->order_by('orders.id DESC')
				->get()->result();
				return $query;
			}
		
	}

       
	public function get_orders_count($search="")
	{
		if ($search){
			$query = $this->db
			->select('count(*) as count')
			->from('orders')
			->like('LOWER(orientation)', $search)
			->or_like('phone', $search)
 			->join('customers', 'orders.customerid=customers.id','left')
			->get()->result();
		}
		else{
			$query = $this->db
			->select('count(*) as count')
			->from('orders')
			->get()->result();
		}
		return $query;
	}
	
	public function delete_order($id)
	{
		$this->db->delete('ordered_products', array('orderid' => $id));                
		$this->db->delete('orders', array('id' => $id));                
	}
	public function delete_orders_marked($vals)
	{
		if ($vals){
			$this->db
			->where($vals, NULL, FALSE)
			->delete('orders');
		}
                
	}

	public function get_order_desc($id)
	{
		$this->db->set('is_read', 1);
		$this->db->where('id', $id);
		$this->db->update('orders');
		$query = $this->db
		->select('orders.id as id, phone, name, date::timestamp(0), status, latitude, longitude, orientation, deliverytype, shown_price')
		->from('orders')
		->join('customers', 'orders.customerid=customers.id','left')
		->where('orders.id', $id)
		->get()->result();
		return $query;
	}
	public function set_ordered($id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $id);
		$this->db->update('orders');
		return true;
	}
	public function on_order($id)
	{
		$this->db->set('status', -1);
		$this->db->where('id', $id);
		$this->db->update('orders');
		return true;
	}
	public function cancel_order($id)
	{
		$this->db->set('status', -2);
		$this->db->where('id', $id);
		$this->db->update('orders');
		return true;
	}
	public function get_order_user_id($id)
	{
		$query = $this->db
		->select('uid, lang, transaction_id')
		->from('orders')
		->join('customers', 'orders.customerid=customers.id','left')
		->where('orders.id', $id)
		->get()->result();
		return $query;
	}
}
?>
