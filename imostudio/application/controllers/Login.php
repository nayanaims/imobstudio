<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller{
		function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
		
	}	
	public function index(){
		$this->load->view('admin/common/login');
	}


	public function check(){

		$data['user_email_id'] = trim($this->input->post('admin_username'));
		$data['user_pass'] = sha1(trim($this->input->post('admin_pass')));
		$response = $this->Login_model->login($data);
		
		if (isset($response['error']) && $response['error'] == 1) {
			$type = 1;
			$msg = "Please enter valid email Id and password";
			$msg = get_message($msg, $type);
			$this->session->set_flashdata('message', $msg);
			redirect(base_url() . 'login');
		} else {
			$this->session->set_userdata($response['data']);
			$this->session->set_userdata('user_id',$response['data']['id']);
			redirect(base_url('welcome'));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}

}