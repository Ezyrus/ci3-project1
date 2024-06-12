<?php

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Administrator_model');
    }

    public function adminLogin()
    {
        $this->load->view("inc/resources_header");
        $this->load->view("pages/admin/login");
    }

    public function login()
    {
        $this->form_validation->set_rules('admin_username', 'Username', 'required');
        $this->form_validation->set_rules('admin_password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pages/admin/login');
        } else {
            $username = $this->input->post('admin_username');
            $password = $this->input->post('admin_password');
            $validationResponse = $this->Administrator_model->adminValidation($username, $password);

            if ($validationResponse["status"]) {
                $adminLogged = array(
                    'admin_id' => $validationResponse['data']['admin_id'],
                    'admin_fullname' => $validationResponse['data']['fullname'],
                    'admin_username' => $validationResponse['data']['username'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($adminLogged);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', $validationResponse["message"]);
                redirect('admin/adminLogin');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/adminLogin');
    }

    public function dashboard()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/adminLogin');
        } else {
            $data['admin_username'] = $this->session->userdata('admin_username');
            $data['admin_fullname'] = $this->session->userdata('admin_fullname');
            $data['admin_id'] = $this->session->userdata('admin_id');

            $this->load->view("inc/resources_header");
            $this->load->view("inc/admin_navigation");
            $this->load->view('pages/admin/dashboard', $data);
            $this->load->view('inc/admin_footer');
        }
    }

    public function createAdmin()
    {
        $data = [
            'username' => $this->input->post('admin_username'),
            'password' => md5($this->input->post('admin_password'))
        ];
        $this->Administrator_model->createAdmin($data);
    }

    public function readAdmin($id)
    {
        $data['admin'] = $this->Administrator_model->readAdmin($id);
    }

    public function updateAdmin($id)
    {
        $data = [
            'username' => $this->input->post('admin_username'),
            'password' => md5($this->input->post('admin_password'))
        ];
        $this->Administrator_model->updateAdmin($id, $data);
    }

    public function deleteAdmin($id)
    {
        $this->Administrator_model->deleteAdmin($id);
    }
}
