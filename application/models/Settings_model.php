<?php
class Settings_model extends CI_Model {
	
	public function get_settings_desc()
	{

			$query = $this->db
			->select('id, keyword, value, type, desc')
			->from('settings')
			->where('ishidden', 0)
			->order_by('id')
			->get()->result();
		return $query;
    }
	public function get_setting_desc($id)
	{

			$query = $this->db
			->select('id, keyword, value, type, desc')
			->from('settings')
			->where('id', $id)
			->get()->result();
		return $query;
    }
    public function update_setting($id)
	{
		if (null !== $this->input->post('number')){
			$data = array(
				'value' => $this->input->post('number'),
			);
		}
		if (null !== $this->input->post('money')){
			$data = array(
				'value' => $this->input->post('money')*100,
			);
		}
		else if (null !== $this->input->post('time')){
			$s = explode(':', $this->input->post('time'));
			$a = intval($s[0])*60+intval($s[1]);
			$data = array(
				'value' => $a
			);
		}
		$this->db->where('id', $id);
		$this->db->update('settings', $data);
		return true;
	}
}
?>
