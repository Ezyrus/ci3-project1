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
        $this->form_validation->set_rules('createFullName_systemAdmin', 'Full Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('createUsername_systemAdmin', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('createPassword_systemAdmin', 'Password', 'required|trim');
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }

        $password = $this->input->post('createPassword_systemAdmin', true);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'fullname' => $this->input->post('createFullName_systemAdmin', true),
            'username' => $this->input->post('createUsername_systemAdmin', true),
            'password' => $hashed_password
        ];

        if ($this->operationsModel->is_duplicate($table, $data['username'])) {
            echo json_encode(['status' => false, 'message' => 'Username already exists']);
        } else {
            if ($this->operationsModel->insert_data($table, $data)) {
                echo json_encode(['status' => true, 'message' => 'Create successful']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Create failed']);
            }
        }
        // redirect('adminPages/goToAdministrators');
    }

    public function update($id, $table)
    {
        $this->form_validation->set_rules('updateFullName_systemAdmin', 'Full Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('updateUsername_systemAdmin', 'Username', 'required|trim|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }

        $data = [
            'fullname' => $this->input->post('updateFullName_systemAdmin', true),
            'username' => $this->input->post('updateUsername_systemAdmin', true),
            'id' => $id
        ];

        if ($this->operationsModel->update_data($table, $id, $data)) {
            echo json_encode(['status' => true, 'message' => 'Update successful']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Update failed']);
        }
        // redirect('adminPages/goToAdministrators');
    }

    public function read($id, $table)
    {
        $data = [
            'fullname' => $this->input->post('readFullName_systemAdmin'),
            'username' => $this->input->post('readUsername_systemAdmin'),
            'id' => $id
        ];

        if ($data = $this->operationsModel->get_data($table, $id)) {
            echo json_encode(['status' => true, 'message' => 'Read successful', 'data' => $data]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Read failed']);
        }
        // redirect('adminPages/goToAdministrators');
    }

    public function delete($id, $table)
    {
        if ($this->operationsModel->delete_data($table, $id)) {
            echo json_encode(['status' => true, 'message' => 'Delete successful']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Delete failed']);
        }
        // redirect('adminPages/goToAdministrators');
    }

}

?>