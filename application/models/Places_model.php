<?php
class Places_model extends CI_Model {


        public function insert_place()
        {
                $data = array(
                        'uzbek' => $this->input->post('uzbek'),
                        'russian' => $this->input->post('russian'),
                        'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'menulink' => $this->input->post('menulink'),
                );
                $this->db->insert('places', $data);
                $insert_id = $this->db->insert_id();
                $menuids = $this->input->post('menuid');
                foreach ($menuids as $menuid){
                        $data = array(
                                'placeid' => $insert_id,
                                'menuid' => $menuid,
                        );
                        $this->db->insert('place_menus', $data);
                }
                return true;
        }
        public function get_places_desc()
        {
                $query = $this->db
                ->select("places.id as id, uzbek, russian, string_agg((select uzbek from menus where menus.id = place_menus.menuid), ', ') as menu, menulink")
                ->from('places')
                ->join('place_menus', 'place_menus.placeid=places.id', 'left')
                ->group_by('places.id')
                ->order_by('places.id')
                ->get()->result();
                return $query;
        }
        public function delete_place($id)
        {
                $this->db->delete('places', array('id' => $id));
        }
        public function get_place_desc($id)
        {
                $query = $this->db
                ->select('id, uzbek, russian, menulink')
                ->from('places')
                ->where('id', $id)
                ->get()->result();
                return $query;
        }
        public function get_place_menus_desc($id)
        {
                $query = array_column($this->db
                ->select('menuid')
                ->from('place_menus')
                ->where('placeid', $id)
                ->get()->result_array(), 'menuid');
                return $query;
        }

        public function update_place($id)
        {
                $data = array(
                        'uzbek' => $this->input->post('uzbek'),
                        'russian' => $this->input->post('russian'),
                        'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'menulink' => $this->input->post('menulink'),
                );
                $this->db->where('id', $id);
                $this->db->update('places', $data);
                $this->db->delete('place_menus', array('placeid' => $id));
                $menuids = $this->input->post('menuid');
                foreach ($menuids as $menuid){
                        $data = array(
                                'placeid' => $id,
                                'menuid' => $menuid,
                        );
                        $this->db->insert('place_menus', $data);
                }
                return true;
        }
}
?>
