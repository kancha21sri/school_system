<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

    function loginFunctionForAllUsers (){
        
        $email = html_escape($this->input->post('email'));			
        $password = html_escape($this->input->post('password'));	
        $credential = array('email' => $email, 'password' => sha1($password));	
  
        $query = $this->db->get_where('admin', $credential);

        if ($query->num_rows() > 0) {
            $row = $query->row();
  
            $this->session->set_userdata('login_type', 'admin');
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);

            return  $this->db->set('login_status', ('1'))
                    ->where('admin_id', $this->session->userdata('admin_id'))
                    ->update('admin');
        }
    }


    function logout_model_for_admin(){
        return  $this->db->set('login_status', ('0'))
                    ->where('admin_id', $this->session->userdata('admin_id'))
                    ->update('admin');
    }
}
