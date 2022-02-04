<?php 
class Common_model extends CI_model{
	
	/*Return binary*/
	public function Insert_batch($data,$tablename){
		$this->db->insert_batch($tablename, $data); 
		return ($this->db->affected_rows() != 1) ? false : true;
	}

    /*
    get record for datatble for single sql table
    Return array */
	public function getDatatableData($fields,$tablename,$rowperpage = null, $start = null, $orderby = null,$orderbyField = null,$search = null){
		if ($rowperpage == '-1' || $search != '') { //all record or search
	       if($search != ''){
             return $this->db->select($fields)->or_like($search)->order_by($orderbyField,$orderby)->get($tablename)->result_array();
	       }
	       else{
	       	  return $this->db->select($fields)->order_by($orderbyField,$orderby)->get($tablename)->result_array();
	       }		
        
		}
		else{
			return $this->db->select($fields)->order_by($orderbyField,$orderby)->limit($rowperpage,$start)->get($tablename)->result_array();
		}
	}

	public function countDatatableTotal($fields,$tablename){
		 return $this->db->select($fields)
		 ->get($tablename)
		 ->num_rows();
	}
  	
}
	
