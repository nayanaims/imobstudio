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
            'Dashbord' => $base . "dashboard"
            /*,'Users' => array(
                "Add User"=>$base . "employee/add_user",
                "List User"=> $base . "employee/user_list",
            ),
            'Client Management'=>array(
                "Add Client"=>$base . "add_client",
                "Client List"=>$base . "client_list",
            ),
            'Task Management'=>array(
                'Add Task'=>$base . "task/add",
                'Task List'=>$base . "task/list" 
            ),
            'Client Master Data' => $base . "client_master_data",
            'Client Wise Password' => $base . "client_password_data",
            'Leave'=>array(
                'Apply Leave'=>"$base"."leave_request",
                'Leave Status'=>"$base"."leave_status",
            )*/
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
                "Add Unit"=>$base . "unit/add"
            )
         ); 
    }
    else {
        $menu = array(
            'Dashbord' => $base . "dashboard",
            /*'Users' => array(
                "List User"=> $base . "employee/user_list",
            ),
            'Client Management'=>array(
                "Client List"=>$base . "client_list",
            ),
            'Task Management'=>array(
                'Task List'=>$base . "task/list" 
            ),
            'Client Master Data' => $base . "client_master_data",
            'Client Wise Password' => $base . "client_password_data",
            'Leave'=>array(
                'Apply Leave'=>"$base/leave_request",
                'Leave Status'=>"$base/leave_status",
            )*/
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