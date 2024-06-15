<?php 

class operationsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

    //TODO: remove column-specific name make it dynamic
    public function get_data($table, $id) {
        $query = $this->db->get_where($table, ['admin_id' => $id]); 
        return $query->row_array();
    }

        //TODO: remove column-specific name make it dynamic
    public function update_data($table, $id, $data) {
        $this->db->where('admin_id', $id);
        return $this->db->update($table, $data);
    }

    public function delete_data($table, $id) {
        $this->db->where('admin_id', $id);
        return $this->db->delete($table);
    }

    
}


?>