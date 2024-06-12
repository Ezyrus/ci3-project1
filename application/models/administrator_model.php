<?php

class Administrator_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function adminValidation($username, $password)
    {
        $query = $this->db->get_where('administrators', ['username' => $username]);
        $admin = $query->row_array();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                return [
                    "status" => true,
                    "data" => $admin,
                    "message" => "Welcome $username, logging in as admin."
                ];
            } else {
                return [
                    "status" => false,
                    "message" => "Wrong password"
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Username does not exist"
            ];
        }
    }

    public function get_systemAdmins()
    {
        $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get('administrators');
        return $query->result_array();
    }

    public function createAdmin($data)
    {
        return $this->db->insert('administrators', $data);
    }

    public function readAdmin($id)
    {
        return $this->db->get_where('administrators', ['id' => $id])->row_array();
    }

    public function updateAdmin($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('administrators', $data);
    }

    public function deleteAdmin($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('administrators');
    }
}
?>