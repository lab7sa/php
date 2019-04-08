<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player_model extends CI_Model
{
  	function __construct()
  	{
  		parent::__construct();
  	}
  	
  	public function create_record($array, $username){
  	    $this->db->from('users')->where('username', $username);
  	    $query_username = $this->db->get();
  	    
  	    if($query_username->num_rows() == 0){
  	        
            if($this->db->insert('players', $array)){
  		        return $this->db->insert_id();
      		}else{
      			return false;
      		}
  	    }else{
  	        return "reserved";
  	    }
	}
	
	public function login_users($email, $password){
	    $this->db->from('users')->where('email', $email)->where('is_deleted', 0)->where('password', $password);
	    
	    $query = $this->db->get();
	    if($query->num_rows() != 1){
	        $this->db->from('users')->where('email', $email)->where('is_deleted', 1);
  	        $query_email = $this->db->get();
  	        if($query_email->num_rows() == 1){
  	            return "deleted";
  	        }else{
  	            $this->db->from('users')->where('email', $email)->where('is_deleted', 2);
      	        $query_email = $this->db->get();
      	        if($query_email->num_rows() == 1){
      	            return "suspended";
      	        }
  	        }
	    }else if($query->num_rows() == 1){
	        return true;
	    }else{
	        return null;
	    }
	}
	
	public function get_users($email, $password){
	    $this->db->from('users')->where('email', $email)->where('is_deleted', 0)->where('password', $password);
	    
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	    
	        return $query->row_array();
	    }else{
	        return null;
	    }
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function create_record2($array, $username){
  	    $this->db->from('users')->where('username', $username);
  	    $query_username = $this->db->get();
  	    
  	    if($query_username->num_rows() == 0){
  	       
            if($this->db->insert('users2', $array)){
      	        return $this->db->insert_id();
  	        }else{
  	            return false;
  	        }
  	    }else{
  	        return "reserved";
  	    }
	}
	
	
	
}