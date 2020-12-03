<?php
class Menus_model extends CI_Model {


        public function get_menus_desc()
        {
                $query = $this->db
                ->select('id, uzbek, russian')
                ->from('menus')
                ->order_by('id')
                ->get()->result();
                return $query;
        }
	public function insert_menu()
	{
		$data = array(
			'uzbek' => $this->input->post('uzbek'),
			'russian' => $this->input->post('russian'),
		);
		$this->db->insert('menus', $data);
		return true;
	}
        public function get_menu_desc($id)
        {
                $query = $this->db
                ->select('id, uzbek, russian')
                ->from('menus')
                ->where('id', $id)
                ->get()->result();
                return $query;
        }
        public function delete_menu($id)
        {
                $this->db->delete('menus', array('id' => $id));
        }
        public function update_menu($id)
        {
                if ($_FILES['image']['tmp_name'])
                        $data = array(
                                'uzbek' => $this->input->post('uzbek'),
                                'russian' => $this->input->post('russian'),
                        );
                $this->db->where('id', $id);
                $this->db->update('menus', $data);
                return true;
        }
}
?>
