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
class Events extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }


    public function getEvents_get()
    {
        
        // $this->some_model->update_user( ... );
        $response = array();
        
        $this->load->model('Events_model');
        $events_list = $this->Events_model->events_all();
        if($events_list != null){
            array_push($response, $code = ["code" => REST_Controller::HTTP_OK, "message" => "All events have retrevied...", "events" => $events_list]);
                $this->response($response);
        }else{
            array_push($response, $code = ["code" => REST_Controller::HTTP_BAD_REQUEST, "message" => "Error, no events found..."]);
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
