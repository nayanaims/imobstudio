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
        $data['tabletile'] = array('Email','Name','Phone','Role','Created Date','Modified Date','Action');
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


    function validation($id = null){

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
        
     
        if($id == ''){
             $emailrule =  array(
                'field' => 'admin_id',
                'label' => 'Email Address',
                'rules' => 'trim|required|valid_email|is_unique[imo_admin.admin_id]'
            );
            array_push($rules,$emailrule); 
        }  
        
        return $rules;  
         

    }

  

    function save()
    {
       
        $rules = $this->validation();

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

     function Edit(){
      
       if($this->input->post('id')){ //edit record save

            $rules = $this->validation($this->input->post('id'));

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == false)
            {
             $msg = get_message(validation_errors(), '1');   
             $this->session->set_flashdata('message', $msg );
             redirect(base_url() . 'admin/edit?id=' . url_encode($this->input->post('id'))); 
            }
            else{

            $edit_id = $this->input->post('id');

            $where = array(
                 'id' =>  $edit_id
            );

            $editdata =  array(
            'firstname' => $this->input->post('firstname') ,
            'lastname' => $this->input->post('lastname') ,
            'admin_pass' => sha1($this->input->post('admin_pass')) ,
            'confirm_pass' => sha1($this->input->post('confirm_pass')) ,
            'role' => $this->input->post('role') ,
            'admin_id' => $this->input->post('admin_id') ,
            'phone' => $this->input->post('phone'));

            $editstatus = $this->Common_model->update_batch($editdata,$this->admin_tbl,$where);

            if($editstatus == 0){
                 $msg = get_message('Error on Edit record!!', '1');
            }
            else{
                 $msg = get_message('Successfully Edited!!', '0');
            }
           
            $this->session->set_flashdata('message', $msg);

            redirect(base_url() . 'admin/edit?id=' . url_encode($edit_id));
            }
         }
         else{ // go edit page
            $edit_id = url_decode($_GET['id']);
            $data['id'] = $edit_id;
            $where = array(
                         'id' =>  $edit_id
                    );
            $data['result'] = $this->Common_model->selectAll($this->admin_tbl,$where);
            //echo $this->db->last_query(); exit;
            $this->load->view('admin/common/header');
            $this->load->view('admin/edit_admin', $data);
            $this->load->view('admin/common/footer');
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
        $where = array(
                     'role !=' => 'super-admin' 
                );
        $response = $this->Common_model->getDatatableData('*',$this->admin_tbl,$rowperpage,$start,$orderby,$orderfield,$searchField,$where);
        $countTotal = $this->Common_model->countDatatableTotal('id',$this->admin_tbl,$where);

        $data = array();
        if(!empty($response)){
            foreach($response as $result){
                $data[] = array(
                $result['admin_id'],
                $result['firstname'] . ' ' . @$result['lastname'],
                $result['phone'],
                $result['role'],
                $result['created_date'],
                $result['modified_date'],
                '<a href="'. base_url("admin/edit?id=") . url_encode($result['id']) . '" class="btn btn-primary" >Edit</a>'
            );
            }
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($data),
            "recordsFiltered" => $countTotal,
            "data" => $data
        );
        echo json_encode($output); exit();
    }

   

}

