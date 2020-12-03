<?php
class Auth_model extends CI_Model {
	
	public function check_login()
	{
		$username = $this->input->post('username');    
		$this->db->where('username', $username);
		$query = $this->db->get('auth');
		return $query->row_array(); 
    }
	public function check_login_by_session($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('auth');
		return $query->row_array(); 
    }
	public function get_auth_desc()
	{

			$query = $this->db
			->select('id, username, privilege')
			->from('auth')
			->get()->result();
		return $query;
	}

	public function changepassword($id)
	{
		$data = array(
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		);
		$this->db->where('id', $id);
		$this->db->update('auth', $data);
		return true;
    }    
	public function insert_auth()
	{
		$data = array(
                        'username'=> $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                        'privilege'=> $this->input->post('privilege')
		);
                $this->db->insert('auth', $data);
                return true;
    }
	public function delete_auth($id)
	{
		$this->db->delete('auth', array('id' => $id));
	}    
}
?>
