<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    private $admin_tbl = "imo_admin";

    function __construct()
    {
        parent::__construct();
        checkAuth();
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
        
    }

    public function index()
    {
        $data['tabletile'] = array('Email','Name','Phone','Role','Created Date','Modified Date');
        $this->load->view('admin/common/header');
        $this->load->view('admin/admin_list',$data);
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
            $status = $this->Common_model->Insert_batch($data,$this->admin_tbl);

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

    function getlist(){
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $rowperpage = $this->input->post('length'); // Rows display per page
        $orderby = @$this->input->post('order')[0]['dir'];
        $search = @$this->input->post('search')['value'];
        if($search != ''){
        $searchField = array('admin_id' => $search, 'firstname' => $search,'phone'=> $search,'role'=> $search,'created_date'=>$search,'modified_date'=>$search);
        }
        else{
          $searchField = '';  
        }
        if ($orderby == '') {
            $orderby = 'ASC';
        }
        $orderfield = 'firstname';
        $response = $this->Common_model->getDatatableData('*',$this->admin_tbl,$rowperpage,$start,$orderby,$orderfield,$searchField);
        $countTotal = $this->Common_model->countDatatableTotal('id',$this->admin_tbl);

        $data = array();
        if(!empty($response)){
            foreach($response as $result){
                $data[] = array(
                'Email'=> $result['admin_id'],
                'Name' => $result['firstname'] . ' ' . @$result['lastname'],
                'Phone' => $result['phone'],
                'Role' => $result['role'],
                'Created Date' => $result['created_date'],
                'Modified Date' =>  $result['modified_date']
            );
            }
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $countTotal,
            "recordsFiltered" => count($data),
            "data" => $data
        );
        echo json_encode($output); exit();
    }
}

