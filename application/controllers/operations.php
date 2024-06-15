<?php

class operations extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("operationsModel");
    }
    public function create($table)
    {
        


        $password = $this->input->post('createPassword_systemAdmin', true);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'fullname' => $this->input->post('createFullName_systemAdmin', true),
            'username' => $this->input->post('createUsername_systemAdmin', true),
            'password' => $hashed_password
        ];

        if ($this->operationsModel->insert_data($table, $data)) {
            $this->session->set_flashdata('success', 'Record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add record.');
        }
        redirect('adminPages/goToAdministrators');
    }

    public function update($id, $table)
    {
        $data = [
            'fullname' => $this->input->post('updateFullName_systemAdmin', true),
            'username' => $this->input->post('updateUsername_systemAdmin', true),
            'admin_id' => $id
        ];

        if ($this->operationsModel->update_data($table, $id, $data)) {
            echo json_encode(['status' => true, 'message' => 'Update successful']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Update failed']);
        }
    }

    public function read($id, $table)
    {
        $data = [
            'fullname' => $this->input->post('readFullName_systemAdmin'),
            'username' => $this->input->post('readUsername_systemAdmin'),
            'admin_id' => $id
        ];
        
        if ($data = $this->operationsModel->get_data($table, $id)) {
            echo json_encode(['status' => true, 'message' => 'Read successful', 'data' => $data]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Read failed']);
        }
    }

    public function delete($id, $table)
    {
        if($this->operationsModel->delete_data($table, $id)) {
            echo json_encode(['status' => true, 'message' => 'Delete successful']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Delete failed']);
        }   
    }

}

?>