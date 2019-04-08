<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sports_model extends CI_Model
{
  	function __construct()
  	{
  		parent::__construct();
  	}
  	
  	public function get_all(){
  	    $this->db->from('sports');
  	    $query = $this->db->get();
  	    
  	    if($query->num_rows() == 0){
  	        return null;
  	    }else{
  	        return $query->result_array();
  	    }
	}
	
	
}