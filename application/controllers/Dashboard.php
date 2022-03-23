<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		if(! $this->Mdl_user->sessionCheck()){
			redirect("authenticate/login");
		}
	}
	public function index()
	{
		$this->load->view("vw_header");
		$this->load->view("vw_navbar");
		$this->load->view('vw_dashboard');
	}

	public function logout(){
		$this->session->unset_userdata("useroffit");
		redirect("authenticate");
	}
}
