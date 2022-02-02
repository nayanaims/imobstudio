<?php 
class Common_model extends CI_model{
	private $admin_tbl = "imo_admin";


	function Insert_batch($data){
		$this->db->insert_batch($this->admin_tbl, $data); 
		return ($this->db->affected_rows() != 1) ? false : true;
	}
  	
}
	
