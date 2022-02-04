<?php 
//return css
// how to call | 
/*$header['css'] = array(
            'assets/css/client.css'
        );*/
if(!function_exists('include_css')){
	function include_css($header_scripts = array() ) {
        if(!empty($header_scripts)  ) { 
            foreach($header_scripts as $script_names)
            {
                $checkjscss = explode('.',$script_names);
                $status = end($checkjscss);
                if($status == 'css')
                {
                    echo '<link rel="stylesheet" href="'.base_url().$script_names.'" > ';
                }
            }
        }
    }
}

// return js
if(!function_exists('include_js')){
	function include_js($header_scripts = array() ) { 
        if(!empty($header_scripts)  ) { 
            foreach($header_scripts as $script_names)
            {
                $checkjscss = explode('.',$script_names);
                $status = end($checkjscss);
                if($status == 'js')
                {
                    echo '<script src="'.base_url().$script_names.'"></script>';
                }
            }
        }
    }
}

// return menu
if(!function_exists('header_menu')){
    function header_menu(){
        $ci =& get_instance();
        $base = base_url();
        $menu = array();
        $menu['base_url'] = $base;
        if($ci->session->userdata('role') == getAdminUserType()){
        $menu = array(
            'Dashbord' => $base . "dashboard",
            'Unit Management' => array(
                "Add Unit"=>$base . "unit/add",
                "Unit List"=>$base . "unit"
            )
         
        );   
    } 
    else if($ci->session->userdata('role') == getSuperEmployeeUserType()){
       $menu = array(
        'Dashbord' => $base . "dashboard",
        'Admin Management' => array(
                "Add User"=>$base . "admin/add",
                "List User"=> $base . "admin",
            ),
         'Unit Management' => array(
                "Add Unit"=>$base . "unit/add",
                "Unit List"=>$base . "unit"
            )
         ); 
    }
    else {
        $menu = array(
            'Dashbord' => $base . "dashboard"
            
        );   
    }
        return $menu;                                                                                                                 
    }
}
if(!function_exists('getSuperEmployeeUserType')){
    function getSuperEmployeeUserType(){
        return 'super-admin';
    }
}
if(!function_exists('getAdminUserType')){
    function getAdminUserType(){
        return 'admin';
    }
}
if(!function_exists('getEmployeeUserType')){
    function getEmployeeUserType(){
        return 'employee';
    }
}
if(!function_exists('meta_data')){
    function meta_data($user_id){
        $ci =& get_instance();
        $ci->db->select('meta_key,meta_value');
        $ci->db->from('atlas_user_meta');
        $ci->db->where(array('user_id' =>$user_id));
        $meta = $ci->db->get()->result_array();
        return $meta;                                                                                                                 
    }
}

?>