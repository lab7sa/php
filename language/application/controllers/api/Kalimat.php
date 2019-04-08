<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Kalimat extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }


    public function getKalimat_get()
    {
        
        // $this->some_model->update_user( ... );
        $response = array();
        
        $this->load->model('Events_model');
        $events_list = $this->Events_model->kalimat_all();
        
        if($events_list != null){
            foreach($events_list as $key){
                $count_likes = $this->Events_model->kalimat_count_likes($key['k_id']);
                $countries = $this->Events_model->kalimat_count_likes_countries($key['k_id']);
                $country_with_highest_likes = $this->Events_model->kalimat_country_with_highest_likes($key['k_id']);
                
                $num_countries = array('num_countries' => $countries);
                $highest_likes = array('highest_likes' => $country_with_highest_likes);
                $likes  = array('number_of_likes' => count($count_likes));
                
                $events[] = array_merge($key, $likes, $num_countries, $highest_likes);
               // $arrayAll = array_merge($likes);
              // $arrayAll = $events_list + $likes['sa'];
               
               // array_push($events_list,$count_likes);
                //$events_list['numberOfLikes'] = $count_likes;
                if($events_list != null){
                    array_push($response, $code = ["code" => REST_Controller::HTTP_OK, "message" => "All events have retrevied...", "events" => $events]);
                        $this->response($response);
                }else{
                    array_push($response, $code = ["code" => REST_Controller::HTTP_BAD_REQUEST, "message" => "Error, no events found..."]);
                        $this->response($response);
                }
            }
        }else{
            array_push($response, $code = ["code" => REST_Controller::HTTP_BAD_REQUEST, "message" => "Error, no events added..."]);
                        $this->response($response);
        }
        
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
     


}
