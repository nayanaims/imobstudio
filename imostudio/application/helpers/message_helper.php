<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('get_message')){
	function get_message($message, $type = 0) {
		$ci =& get_instance();
		if($type == 1){
			$msg = '<div class="alert alert-danger" role="alert">'.$message.'</div>';
		}else{
			$msg = '<div class="alert alert-success" role="alert">'.$message.'</div>';
		}
		return $msg; 
	}
}

?>