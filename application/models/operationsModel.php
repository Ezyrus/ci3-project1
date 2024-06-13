<?php 

class operationsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function get_data($table, $id) {
        $query = $this->db->get_where($table, ['admin_id' => $id]);
        return $query->row_array();
    }
}


?>