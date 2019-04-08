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
class Users_maha extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function login_post(){
        $response = array();
        $email = $this->POST('email');
        $password = $this->POST('password');
        
        $this->load->model('User_model');
        $this->load->library('decrypt_password');

        if($email != null && $password != null){
            
            $getResult = $this->User_model->login_users($email, $this->decrypt_password->decrypt($password));
            
            if ($getResult != NULL){

                $getUserInfo = $this->User_model->get_users($email, $this->decrypt_password->hex2bin($this->decrypt_password->decrypt($password)));
                
                $id = $getUserInfo['id'];
                $username = $getUserInfo['username'];
                $accountNumber = $getUserInfo['accountNumber'];
                
                array_push($response, $code = ["code" => REST_Controller::HTTP_OK, "message" => "Logged in successfully...", "user_id" => $id, "username" => $username, "accountNumber" => $accountNumber]);
                $this->response($response);
                    
                if($getResult == "suspended"){
                    array_push($response, $code = ["code" => REST_Controller::HTTP_FORBIDDEN, "message" => "Error, USERNAME FORBIDDEN..."]);
                    $this->response($response);
                }else if($getResult == "deleted"){
                    array_push($response, $code = ["code" => REST_Controller::HTTP_UNAUTHORIZED, "message" => "Error, the account is deleted..."]);
                $this->response($response);
                }
            }else{
                array_push($response, $code = ["code" => REST_Controller::HTTP_BAD_REQUEST, "message" => "Error, BAD REQUEST..."]);
                $this->response($response);
            }
        }else{
            array_push($response, $code = ["code" => REST_Controller::HTTP_UNAUTHORIZED, "message" => "Error, BAD REQUEST 2..."]);
            $this->response($response);
        }
        
    }




    public function users_post()
    {
        
        // $this->some_model->update_user( ... );
        $response = array();

        $userInfo = [
            'username' => $this->post('username'),
            'mobile_number' => $this->post('mobile_number'),
            'city' => $this->post('city'),
            'country' => $this->post('country'),
            'countryCode' => $this->post('countryCode')
        ];

        $this->load->model('User_maha_model');
        $is_created = $this->User_maha_model->create_record($userInfo);
        if($is_created === false){
            array_push($response, $code = array("code" => REST_Controller::HTTP_BAD_REQUEST, "message" => "Error, the account has not be created..."));
            $this->response($response);
        }else{
            array_push($response, $code = ["code" => REST_Controller::HTTP_CREATED, "message" => "The account has been created successfully...", "user_id" => $is_created]);
                $this->response($response);
            
            
        }
    }

     


}
