<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('checkAuth')){
   function checkAuth(){
      $ci =& get_instance();
      $ci->load->library('session');
	   $user_id = $ci->session->userdata('user_id');
      if(empty($user_id)){
		   redirect(base_url() . 'login');
	   }
   }
}