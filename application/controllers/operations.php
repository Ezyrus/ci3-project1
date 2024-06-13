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
        $data = $this->input->post();

        if ($this->operationsModel->insert_data($table, $data)) {
            $this->session->set_flashdata('success', 'Record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add record.');
        }
        redirect('adminPages/goToAdministrators');
    }

    public function update($id, $table)
    {

    }

    public function read($id, $table)
    {
        $data = $this->operationsModel->get_data($table, $id);
        echo json_encode($data);
    }

    public function delete($id, $table)
    {

    }

}

?>