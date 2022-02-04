<?php 
class Login_model extends CI_model{
	private $admin_tbl = "imo_admin";
  	public function login($data) {
	    $where = array('admin_id' => $data['user_email_id'], 'admin_pass' => $data['user_pass']);
		$query = $this->db->select('*')
				->from($this->admin_tbl)
				->where($where)->get()->result_array();	
		if(!empty($query[0])){
			$result['data'] = $query[0];
			$result['error'] = 0;
      		}
      		else{
      			$result['error'] = 1;
      		}
			return $result;
		}
}
	
