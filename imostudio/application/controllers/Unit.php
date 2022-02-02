<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct(){
		parent::__construct();
		checkAuth();
		$this->load->model('Login_model');
	}	

	public function index()
	{	
		//$this->load->view('admin/common/header');
		//$this->load->view('admin/dashboard');
		//$this->load->view('admin/common/footer');
	}

	function add(){

		$this->load->view('admin/common/header');
		$this->load->view('admin/add_unit');
		$this->load->view('admin/common/footer');
	}
}
