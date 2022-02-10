<?php 
class Common_model extends CI_model{
	
	/*Return binary*/
	public function Insert_batch($data,$tablename){
		$this->db->insert_batch($tablename, $data); 
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_batch($data,$tablename,$where){
	   $this->db->db_debug = false;	
       $this->db->where($where);
       $res = $this->db->update($tablename,$data);
	    if(!$res)
		{
		   return 0;
		}else{
		   return 1;
		}
	}

	public function selectAll($tablename,$where){
		$query = $this->db->select('*')
				->from($tablename)
				->where($where)->get()->result_array();	
		if(!empty($query)){
			return  $query;
		} 
		else{
            return array();
		}
	}

    /*
    get record for datatble for single sql table
    Return array */
	public function getDatatableData($fields,$tablename,$rowperpage = null, $start = null, $orderby = null,$orderbyField = null,$search = null,$where = null){

		if($where){
			if ($rowperpage == '-1' || $search != '') { //all record or search
		       if($search != ''){
	             return $this->db->select($fields)->or_like($search)->where($where)->order_by($orderbyField,$orderby)->get($tablename)->result_array();
		       }
		       else{
		       	  return $this->db->select($fields)->where($where)->order_by($orderbyField,$orderby)->get($tablename)->result_array();
		       }		
	        
			}
			else{
				return $this->db->select($fields)->where($where)->order_by($orderbyField,$orderby)->limit($rowperpage,$start)->get($tablename)->result_array();
			}
		}
		else{
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
	}
    /* count total record
    return number */
	public function countDatatableTotal($fields,$tablename,$where = null){
		if($where){
			 return $this->db->select($fields)->where($where)->get($tablename)->num_rows();
		}
		else{
			 return $this->db->select($fields)->get($tablename)->num_rows();
		}
		
	}
  	
}
	
