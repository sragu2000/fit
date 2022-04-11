<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		if($this->Mdl_user->sessionCheck()){
			redirect("dashboard");
		}
	}
	public function login()
	{
		$this->load->view('vw_login');
	}
	public function index()
	{
		$this->load->view('vw_login');
	}

    public function signup()
	{
		$this->load->view('vw_signup');
	}
	public function usersignin(){
		$flag=$this->Mdl_user->checkuser();
		if($flag["result"]){
			$this->session->set_userdata("useroffit",$this->input->post('indnum'));
		}
		$this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"],"url"=>$this->session->userdata('myurl')));
		$this->session->unset_userdata("myurl");
	}
	public function signupuser(){
		$flag=$this->Mdl_user->addUser();
		$this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
	}
	private function sendJson($data) {
	  $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
