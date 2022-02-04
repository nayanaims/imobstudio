<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		checkAuth();
		$this->load->model('Login_model');
	}	

	public function index()
	{
		/*echo "<pre>";
		print_r($this->session->userdata());
		exit;*/	
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/common/footer');
	}
}
