<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model
{
  	function __construct()
  	{
  		parent::__construct();
  	}
  	
  	public function create_record($array, $username, $email){
  	    $this->db->from('users')->where('username', $username);
  	    $query_username = $this->db->get();
  	    
  	    if($query_username->num_rows() == 0){
  	        $this->db->from('users')->where('email', $email);
  	        $query_email = $this->db->get();
  	        if($query_email->num_rows() == 0){
  	            if($this->db->insert('users', $array)){
  			        return $this->db->insert_id();
          		}else{
          			return false;
          		}
  	        }else{
  	            return "found";
  	        }
  	    }else{
  	        return "reserved";
  	    }
	}

	
	public function events_all(){
  	    $this->db->from('event');
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->result_array();
  	    }
	}
	
	
	public function kalimat_all(){
	    
	    $this->db->select('k_id, title, body,publishDate, username');
  	    $this->db->from('kalimat k');
   	    $this->db->join('users u', 'u.u_id= k.user_id', 'left');
        //$this->db->join('likes l', 'l.k_id=k.k_id', 'left');
        //$this->db->where('c.album_id',$id);
  	    
  	    
  	    
  	    
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->result_array();
  	    }
	}
	
	
	
	public function kalimat_count_likes($k_id){
	    
  	    $this->db->from('likes');
   	    $this->db->where('k_id', $k_id);
  	    
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->result_array();
  	    }
	}
	
	
	public function kalimat_count_likes_countries($k_id){
	    
  	    $this->db->from('likes');
   	    $this->db->where('k_id', $k_id);
   	    $this->db->group_by('country');
  	    
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->num_rows();
  	    }
	}
	
	
	
	public function kalimat_country_with_highest_likes($k_id){
	    $this->db->select('country, count(id)');
  	    $this->db->from('likes');
   	    $this->db->where('k_id', $k_id);
   	    $this->db->group_by('country');
   	    $this->db->order_by('sum(country)');
   	    $this->db->limit(1);
  	    
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->row('country');
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