<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
/*
    function __construct() {
			parent::__construct();
	}
	
*/	
	
	public function index()
	{
	    $getLang = $this->session->userdata('lang');
	    $lang = ($getLang != "") ? $getLang : "arabic";
	    $this->lang->load("content", $lang);
		$this->load->view('welcome_message');
	}
	
	
    public function changeLang() {   
	    $language = $this->uri->segment(3); 
   
   /*
        $language = ($language != "") ? $language : "arabic";
        $this->session->set_userdata('lang', $language);   
        $this->lang->load("content","arabic");
        redirect($this->agent->referrer());   
    */
        $lang = $this->session->userdata('lang');
        if ($lang == '') {
            $this->session->set_userdata('lang', 'arabic');
			$this->lang->load("content","arabic");
			redirect($this->agent->referrer());   
        }else{
            $this->session->set_userdata('lang', $language);
			$this->lang->load("content", $language);
			redirect($this->agent->referrer());   
        }
        
    }

	
	
}

