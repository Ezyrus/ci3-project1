<?php
defined('BASEPATH') or exit('No direct script access allowed');

class adminPages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administratorsModel');
    }

    public function goToAdminPortal()
    {
        $this->load->view("inc/resources_header");
        $this->load->view("pages/admin/admin_portal");
    }

    public function goToDashboard()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('adminPages/goToAdminPortal');
        } else {
            $this->load->view("inc/resources_header");
            $this->load->view("inc/admin_navigation");
            $this->load->view('pages/admin/dashboard');
            $this->load->view('inc/admin_footer');
        }
    }

    public function goToAdministrators()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('adminPages/goToAdminPortal');
        } else {
            $data['systemAdmins'] = $this->administratorsModel->getSystemAdministrators();
            $this->load->view("inc/resources_header");
            $this->load->view("inc/admin_navigation");
            $this->load->view('pages/admin/administrators', $data);
            $this->load->view('inc/admin_footer');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('admin_username', 'Username', 'required');
        $this->form_validation->set_rules('admin_password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pages/admin/admin_portal');
        } else {
            $username = $this->input->post('admin_username');
            $password = $this->input->post('admin_password');
            $validationResponse = $this->administratorsModel->adminLogInValidation($username, $password);

            if ($validationResponse["status"]) {
                $adminLogged = array(
                    'id' => $validationResponse['data']['id'],
                    'admin_fullname' => $validationResponse['data']['fullname'],
                    'admin_username' => $validationResponse['data']['username'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($adminLogged);
                redirect('adminPages/goToDashboard');
            } else {
                $this->session->set_flashdata('error', $validationResponse["message"]);
                redirect('adminPages/goToAdminPortal');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('adminPages/goToAdminPortal');
    }

    public function populateSystemAdministrators()
    {
        $response = array(
            'system_admins' => $this->administratorsModel->getSystemAdministrators()
        );
        echo json_encode($response);
    }

}
