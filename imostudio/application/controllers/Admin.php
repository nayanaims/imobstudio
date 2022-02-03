<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        checkAuth();
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }

    public function index()
    {
        $this->load->view('admin/common/header');
        $this->load->view('admin/admin_list');
        $this->load->view('admin/common/footer');
    }
 
    function add()
    {
        $this->load->view('admin/common/header');
        $this->load->view('admin/add_admin');
        $this->load->view('admin/common/footer');
    }

    function save()
    {

        $rules = array(
            array(
                'field' => 'firstname',
                'label' => 'First Name',
                'rules' => 'required'
            ) ,
            array(
                'field' => 'lastname',
                'label' => 'Last Name',
                'rules' => 'required'
            ) ,
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required', //regex_match[/^[0-9]{10}$/]
                'errors' => array(
                    'required' => 'You must provide a %s.',
                )
            ) ,
            array(
                'field' => 'admin_id',
                'label' => 'Email Address',
                'rules' => 'trim|required|valid_email|is_unique[imo_admin.admin_id]'
            ) ,
            array(
                'field' => 'admin_pass',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[6]'
            ) ,
            array(
                'field' => 'confirm_pass',
                'label' => 'Confirm Password',
                'rules' => 'trim|required|min_length[6]|matches[admin_pass]'
            ) ,
            array(
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false)
        {
            $this->load->view('admin/common/header');
            $this->load->view('admin/add_admin');
            $this->load->view('admin/common/footer');
        }
        else
        {
            $data[] = array(
                'firstname' => $this->input->post('firstname') ,
                'lastname' => $this->input->post('lastname') ,
                'admin_pass' => sha1($this->input->post('admin_pass')) ,
                'confirm_pass' => sha1($this->input->post('confirm_pass')) ,
                'role' => $this->input->post('role') ,
                'admin_id' => $this->input->post('admin_id') ,
                'phone' => $this->input->post('phone')
            );
            $status = $this->Common_model->Insert_batch($data);

            if ($status == 1)
            {
                $msg = get_message('Successfully saved!!', '0');
                $this->session->set_flashdata('message', $msg);
            }
            else
            {
                $msg = get_message('Failed to saved!!', '1');
                $this->session->set_flashdata('message', $msg);
            }
            redirect(base_url() . 'admin/add');
        }

    }
}

