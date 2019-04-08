<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_maha_model extends CI_Model
{
  	function __construct()
  	{
  		parent::__construct();
  	}
  
	
	
	public function create_record($array){
  	       
        if($this->db->insert('users2', $array)){
  	        return $this->db->insert_id();
          }else{
              return false;
          }
  	   
	}
	
	
	
}